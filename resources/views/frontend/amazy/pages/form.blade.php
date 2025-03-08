@extends('frontend.amazy.layouts.app')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Info Form</title>
    <style>
         <style>
        .business-form {
            max-width: 800px;
            margin: 0 auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            font-family: Arial, sans-serif;
        }
        .business-form input[type="text"],
        .business-form input[type="email"],
        .business-form input[type="number"],
        .business-form input[type="file"],
        .business-form select,
        .business-form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .business-form label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
        .business-form .form-group {
            margin-bottom: 20px;
        }
        .business-form button {
            background-color: #002021;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .business-form button:hover {
            background-color: #002021;
        }
        .form-section {
            margin-bottom: 30px;
        }
        .form-section h2 {
            background: #f3f3f3;
            padding: 10px;
            border-radius: 5px;
            font-size: 18px;
        }
    </style>
</head>
@section('content')
<div class="container">
<div class="row">

<form action="{{ route('form.submit') }}" method="POST" class="business-form" enctype="multipart/form-data">
    @csrf

    <!-- Basic Business Info -->
    <div class="form-section">
        <h2>Basic Business Info</h2>
        <div class="form-group-row row">
            <div class="form-group col-md-4">
                <label for="Name">Name</label>
                <input type="text" class="form-control" id="Name" name="Name" required>
            </div>
            <div class="form-group col-md-4">
                <label for="Company_name">Company Name</label>
                <input type="text" class="form-control" id="Company_name" name="Company_name" required>
            </div>
            <div class="form-group col-md-4">
                <label for="Phone_number">Phone Number</label>
                <input type="text" class="form-control" id="Phone_number" name="Phone_number" required>
            </div>
        </div>

        <div class="form-group-row row">
            <div class="form-group col-md-4">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group col-md-4">
                <label for="Billing_address">Billing Address</label>
                <input type="text" class="form-control" id="Billing_address" name="Billing_address" required>
            </div>
            <div class="form-group col-md-4">
                <label for="Shipping_address">Shipping Address</label>
                <input type="text" class="form-control" id="Shipping_address" name="Shipping_address" required>
            </div>
        </div>

        <div class="form-group-row row">
            <div class="form-group col-md-4">
                <label for="commercial_or_residential">Commercial or Residential?</label>
                <select class="form-control" id="commercial_or_residential" name="commercial_or_residential" required>
                    <option value="commercial">Commercial</option>
                    <option value="residential">Residential</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="loading_dock">Loading Dock?</label>
                <select class="form-control" id="loading_dock" name="loading_dock" required>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="forklift">Forklift?</label>
                <select class="form-control" id="forklift" name="forklift" required>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
        </div>



         <div class="form-group-row row">
           <div class="form-group col-md-4">
                <label for="pallet_jack">Pallet Jack?</label>
                <select id="pallet_jack" name="pallet_jack" required>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
           </div>

            <div class="form-group col-md-4">
                <label for="hours">Hours?</label>
                <select id="hours" name="hours" required>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>

            <div class="form-group col-md-4">
                <label for="call_ahead">Call Ahead?</label>
                <select id="call_ahead" name="call_ahead" required>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
        </div>

        <div class="form-group-row row">
            <div class="form-group col-md-4">
                <label for="special_instructions">Special Instructions for Deliveries?</label>
                <textarea id="special_instructions" name="special_instructions"></textarea>
            </div>

            <div class="form-group col-md-4">
                <label for="accounts_payable_contact_name">Accounts Payable Contact Name</label>
                <input type="text" id="accounts_payable_contact_name" name="accounts_payable_contact_name" required>
            </div>

            <div class="form-group col-md-4">
                <label for="accounts_payable_number">Accounts Payable Number</label>
                <input type="text" id="accounts_payable_number" name="accounts_payable_number" required>
            </div>
        </div>

        <div class="form-group-row row">
            <div class="form-group col-md-4">
                <label for="accounts_payable_email">Accounts Payable Email</label>
                <input type="email" id="accounts_payable_email" name="accounts_payable_email" required>
            </div>
            <div class="form-group col-md-4">
                <label for="general_liability">Current General Liability Insurance Provider</label>
                <input type="text" id="general_liability" name="general_liability" placeholder="Enter insurance provider">
            </div>
            {{-- <div class="form-group col-md-4">
                <label for="certifications">List of Current Certifications (Insulation/Roofing)</label>
                <input type="file" id="certifications" name="certifications">
            </div> --}}
           <div class="form-group col-md-4">
                <label for="preferred_language">Preferred Language</label>
                <input type="text" id="preferred_language" name="preferred_language" placeholder="Enter preferred language">
            </div>
            </div>
        </div>

    <!-- Detailed Business Info -->
        <div class="form-section">
        <h2>Detailed Business Info</h2>
        <div class="form-group-row row">
            <div class="form-group col-md-4">
                <label for="years_in_business">Years in Business</label>
                <input type="number" class="form-control" id="years_in_business" name="years_in_business" required>
            </div>
            <div class="form-group col-md-4">
                <label for="number_of_locations">Number of Locations</label>
                <input type="number" class="form-control" id="number_of_locations" name="number_of_locations">
            </div>
            <div class="form-group col-md-4">
                <label for="primary_business_function">Primary Business Function</label>
                <input type="text" class="form-control" id="primary_business_function" name="primary_business_function">
            </div>
        </div>


        <div class="form-group-row row">
            <div class="form-group col-md-4">
                <label for="number_of_rigs">Number of Rigs</label>
                <input type="number" id="number_of_rigs" name="number_of_rigs" placeholder="Enter number of rigs">
            </div>
            <div class="form-group col-md-4">
                <label for="monthly_volume">Monthly Volume</label>
                <input type="number" id="monthly_volume" name="monthly_volume" placeholder="Enter monthly volume">
            </div>
            <div class="form-group col-md-4">
                <label for="open_cell_volume">Open Cell Volume</label>
                <input type="number" id="open_cell_volume" name="open_cell_volume" placeholder="Enter open cell volume">
            </div>
        </div>

        <div class="form-group-row row">
            <div class="form-group col-md-4">
                <label for="closed_cell_volume">Closed Cell Volume</label>
                <input type="number" id="closed_cell_volume" name="closed_cell_volume" placeholder="Enter closed cell volume">
            </div>
            <div class="form-group">
                <label for="total_volume_previous_year">Total Volume Previous Year</label>
                <input type="number" id="total_volume_previous_year" name="total_volume_previous_year" placeholder="Enter total volume">
            </div>
            <div class="form-group">
                <label for="preferred_foam_brand">Preferred Foam Brand</label>
                <input type="text" id="preferred_foam_brand" name="preferred_foam_brand" placeholder="Enter preferred foam brand">
            </div>
        </div>
    </div>
            


     <div class="form-section">
        <h2>Equipment Info</h2>
        <div class="form-group-row row">
            <div class="form-group col-md-4">
                <label for="preferred_rig_type">Preferred Rig Type</label>
                <input type="text" class="form-control" id="preferred_rig_type" name="preferred_rig_type">
            </div>
            <div class="form-group col-md-4">
                <label for="power_source">Shore Power or Diesel Generator</label>
                <input type="text" class="form-control" id="power_source" name="power_source">
            </div>
            <div class="form-group col-md-4">
                <label for="proportioner_brand">What Brand Proportioners</label>
                <input type="text" class="form-control" id="proportioner_brand" name="proportioner_brand">
            </div>
        </div> 
        
        <div class="form-group-row row">
            <div class="form-group col-md-4">
                <label for="proportioner_model">What Model Proportions</label>
                <input type="text" id="proportioner_model" name="proportioner_model" placeholder="Enter model">
            </div>
            <div class="form-group col-md-4">
                <label for="preferred_spray_gun">Preferred Spray Gun Brand and Model</label>
                <input type="text" id="preferred_spray_gun" name="preferred_spray_gun" placeholder="Enter spray gun brand and model">
            </div>
        </div>

           
    </div>

    <button type="submit">Submit</button>
</form>



  {{-- <form action="#" method="POST" class="business-form" enctype="multipart/form-data">
        @csrf

        <!-- Basic Business Info -->
        <div class="form-section">
            <h2>Basic Business Info</h2>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your name">
            </div>
            <div class="form-group">
                <label for="company_name">Company Name</label>
                <input type="text" id="company_name" name="company_name" placeholder="Enter your company name">
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" placeholder="Enter your phone number">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email address">
            </div>
            <div class="form-group">
                <label for="billing_address">Billing Address</label>
                <input type="text" id="billing_address" name="billing_address" placeholder="Enter your billing address">
            </div>
            <div class="form-group">
                <label for="shipping_address">Shipping Address</label>
                <input type="text" id="shipping_address" name="shipping_address" placeholder="Enter your shipping address">
            </div>
            <div class="form-group">
                <label>Commercial or Residential?</label>
                <select name="commercial_residential">
                    <option value="" disabled selected>Please Select</option>
                    <option value="Commercial">Commercial</option>
                    <option value="Residential">Residential</option>
                </select>
            </div>
            <div class="form-group">
                <label for="loading_dock">Loading Dock Available?</label>
                <select name="loading_dock">
                    <option value="" disabled selected>Please Select</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="forklift">Forklift Available?</label>
                <select name="forklift">
                    <option value="" disabled selected>Please Select</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="pallet_jack">Pallet Jack Available?</label>
                <select name="pallet_jack">
                    <option value="" disabled selected>Please Select</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="hours">Hours of Operation</label>
                <input type="text" id="hours" name="hours" placeholder="e.g., 9 AM - 5 PM">
            </div>
            <div class="form-group">
                <label>Call Ahead for Deliveries?</label>
                <input type="radio" name="call_ahead" value="Yes"> Yes
                <input type="radio" name="call_ahead" value="No"> No
            </div>
            <div class="form-group">
                <label for="special_instructions">Special Instructions for Deliveries</label>
                <textarea id="special_instructions" name="special_instructions" placeholder="Enter special instructions"></textarea>
            </div>
            <div class="form-group">
                <label for="accounts_contact">Accounts Payable Contact Name</label>
                <input type="text" id="accounts_contact" name="accounts_contact" placeholder="Enter contact name">
            </div>
            <div class="form-group">
                <label for="accounts_number">Accounts Payable Number</label>
                <input type="text" id="accounts_number" name="accounts_number" placeholder="Enter contact number">
            </div>
            <div class="form-group">
                <label for="accounts_email">Accounts Payable Email</label>
                <input type="email" id="accounts_email" name="accounts_email" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="general_liability">Current General Liability Insurance Provider</label>
                <input type="text" id="general_liability" name="general_liability" placeholder="Enter insurance provider">
            </div>
            <div class="form-group">
                <label for="certifications">List of Current Certifications (Insulation/Roofing)</label>
                <input type="file" id="certifications" name="certifications">
            </div>
            <div class="form-group">
                <label for="preferred_language">Preferred Language</label>
                <input type="text" id="preferred_language" name="preferred_language" placeholder="Enter preferred language">
            </div>
        </div>

        <!-- Detailed Business Info -->
        <div class="form-section">
            <h2>Detailed Business Info</h2>
            <div class="form-group">
                <label for="years_in_business">Years in Business</label>
                <input type="number" id="years_in_business" name="years_in_business" placeholder="Enter number of years">
            </div>
            <div class="form-group">
                <label for="number_of_locations">Number of Locations</label>
                <input type="number" id="number_of_locations" name="number_of_locations" placeholder="Enter number of locations">
            </div>
            <div class="form-group">
                <label for="primary_business_function">Primary Business Function</label>
                <input type="text" id="primary_business_function" name="primary_business_function" placeholder="e.g., Foam/Fiberglass">
            </div>
            <div class="form-group">
                <label for="number_of_rigs">Number of Rigs</label>
                <input type="number" id="number_of_rigs" name="number_of_rigs" placeholder="Enter number of rigs">
            </div>
            <div class="form-group">
                <label for="monthly_volume">Monthly Volume</label>
                <input type="number" id="monthly_volume" name="monthly_volume" placeholder="Enter monthly volume">
            </div>
            <div class="form-group">
                <label for="open_cell_volume">Open Cell Volume</label>
                <input type="number" id="open_cell_volume" name="open_cell_volume" placeholder="Enter open cell volume">
            </div>
            <div class="form-group">
                <label for="closed_cell_volume">Closed Cell Volume</label>
                <input type="number" id="closed_cell_volume" name="closed_cell_volume" placeholder="Enter closed cell volume">
            </div>
            <div class="form-group">
                <label for="total_volume_previous_year">Total Volume Previous Year</label>
                <input type="number" id="total_volume_previous_year" name="total_volume_previous_year" placeholder="Enter total volume">
            </div>
            <div class="form-group">
                <label for="preferred_foam_brand">Preferred Foam Brand</label>
                <input type="text" id="preferred_foam_brand" name="preferred_foam_brand" placeholder="Enter preferred foam brand">
            </div>
        </div>

        <!-- Equipment Info -->
        <div class="form-section">
            <h2>Equipment Info</h2>
            <div class="form-group">
                <label for="preferred_rig_type">Preferred Rig Type</label>
                <input type="text" id="preferred_rig_type" name="preferred_rig_type" placeholder="e.g., Trailer or Box Truck">
            </div>
            <div class="form-group">
                <label for="power_source">Shore Power or Diesel Generator</label>
                <input type="text" id="power_source" name="power_source" placeholder="Enter power source">
            </div>
            <div class="form-group">
                <label for="proportioner_brand">What Brand Proportioners</label>
                <input type="text" id="proportioner_brand" name="proportioner_brand" placeholder="Enter brand of proportioners">
            </div>
            <div class="form-group">
                <label for="proportioner_model">What Model Proportions</label>
                <input type="text" id="proportioner_model" name="proportioner_model" placeholder="Enter model">
            </div>
            <div class="form-group">
                <label for="preferred_spray_gun">Preferred Spray Gun Brand and Model</label>
                <input type="text" id="preferred_spray_gun" name="preferred_spray_gun" placeholder="Enter spray gun brand and model">
            </div>
        </div>

        <button type="submit">Submit</button>
    </form> --}}















{{-- <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/embed/v2.js"></script>
<script>
 



  function submit_to_hubspot($data)
{
  $hubspot_form_guid = '797e42f6-4a78-4ab2-a866-9eff22ed8597'; // Replace with your HubSpot Form GUID
  $hubspot_portal_id = '47751143'; // Replace with your HubSpot Portal ID
  $hubspot_api_key = 'pat-na1-a43224be-6711-464c-84fe-5c72168b18d2'; // Replace with your HubSpot Private App API Key

  $url = "https://api.hsforms.com/submissions/v3/integration/submit/$hubspot_portal_id/$hubspot_form_guid";

  $postData = [
    'fields' => [
      ['name' => 'firstname', 'value' => $data['firstname']],
      ['name' => 'lastname', 'value' => $data['lastname']],
      ['name' => 'email', 'value' => $data['email']],
      ['name' => 'phone', 'value' => $data['tel']],
      ['name' => 'company', 'value' => $data['company']],
      ['name' => 'about_your_company', 'value' => $data['about_your_company']]
    ],
    'context' => [
      //'hutk' => $_COOKIE['hubspotutk'] ?? '', // Include this line if you are using the HubSpot tracking code
      'pageUri' => 'https://spfopenmarket.com/form', // Replace with your page URL
      'pageName' => 'form' // Replace with your page name
    ]
  ];

  $options = [
    'http' => [
      'header' => [
        "Content-type: application/json",
        "Authorization: Bearer $hubspot_api_key"
      ],
      'method' => 'POST',
      'content' => json_encode($postData)
    ]
  ];

  $context = stream_context_create($options);
  $response = file_get_contents($url, false, $context);
  $responseKeys = json_decode($response, true);

  return isset($responseKeys['inlineMessage']);
}


$data = [
  'firstname' => $firstName,
  'lastname' => $lastName,
  'email' => $email,
  'tel' => $phone,
  'company' => $company,
  'about_your_company' => $aboutYourCompany
];

submit_to_hubspot($data)
</script> --}}




</div>
</div>


@endsection
