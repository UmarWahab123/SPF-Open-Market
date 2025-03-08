<?php
namespace App\Services;

use GuzzleHttp\Client;
use Exception;
use Modules\Shipping\Entities\SpeedshipAuthToken;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Http;
use Modules\Shipping\Repositories\CarrierRepository;
use Carbon\Carbon;
class SpeedShipService
{
    protected $client;
    protected $carrierRepo;

    public function __construct(CarrierRepository $carrierRepo)
    {
        $this->carrierRepo = $carrierRepo;

        // Fetch the first SpeedshipAuthToken record
        $SpeedshipAuth = SpeedshipAuthToken::first();
        $accessToken = $SpeedshipAuth->access_token;
        $speedship_api_auth_url = $SpeedshipAuth->auth_url;
        $speedship_api_base_url = $SpeedshipAuth->url;
        // Check if the token is expired
        if (Carbon::parse($SpeedshipAuth->expires_in)->isPast()) {
            // Prepare the request payload
            $request = [
                'client_id'     => $SpeedshipAuth->client_id,
                'client_secret' => $SpeedshipAuth->client_secret,
                'audience'      => $SpeedshipAuth->audience,
            ];
        
            // Fetch a new token
            $authData = $this->fetchAuthToken($request, $speedship_api_auth_url);
        
            // Calculate the new expiration time
            $expiresAt = Carbon::now()->addSeconds($authData['expires_in']);
        
            // Update the token in the database
            $updatedData = [
                'access_token' => $authData['access_token'],
                'expires_in'   => $expiresAt->toDateTimeString(),
            ];
        
            // Update the existing record
            $this->carrierRepo->update($updatedData);
        
            // Assign the new access token to the variable
            $accessToken = $authData['access_token'];
        }
        // dd(rtrim($speedship_api_base_url, '/') . '/');
        $this->client = new Client([
            'base_uri' => rtrim($speedship_api_base_url, '/') . '/',
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
                // 'Content-Type' => 'application/json', // Include this if required
            ],
        ]);
    }
    public function shopFlowDomestic($data)
    {
        try {
            $response = $this->client->post('svc/shopFlow', [
                'json' => $data, // Ensure $data is passed to the API
            ]);
            // dd($response);
            return json_decode($response->getBody(), true);
        }  catch (ClientException $e) {
            $statusCode = $e->getResponse() ? $e->getResponse()->getStatusCode() : 500;
            $message = $e->getMessage();
        
            \Log::error('Guzzle ClientException', [
                'message' => $message,
                'status_code' => $statusCode,
                'trace' => $e->getTraceAsString(),
            ]);
        
            return response()->json(['error' => $message], $statusCode);
        }
    }
    private function fetchAuthToken($request, $speedship_api_auth_url)
    {
        // Append the oauth/token path to the base URL dynamically
        $url = rtrim($speedship_api_auth_url, '/') . '/oauth/token';
        $response = Http::asForm()->post($url, [
            'grant_type'    => $request['grant_type'] ?? 'client_credentials',  // Default to 'client_credentials' if not provided
            'client_id'     => $request['client_id'],
            'client_secret' => $request['client_secret'],
            'audience'      => $request['audience'],
        ]);

        if ($response->successful()) {
            return $response->json(); // Return token data directly
        }

        // Return error if request fails
        return ['error' => $response->body()];
    }
    public function shopFlow($data)
    {
        try {
            $response = $this->client->post('https://speedship.staging-wwex.com/svc/shopFlow', [
                'json' => $data,
            ]);
            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
    public function updateShipment($data)
    {
        try {
            $response = $this->client->post('https://speedship.staging-wwex.com/svc/updateShipmentFormsFlow', [
                'json' => $data, // Pass request body as JSON
            ]);

            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
