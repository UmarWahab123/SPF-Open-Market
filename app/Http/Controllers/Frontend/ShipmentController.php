<?php 
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Services\SpeedShipService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShipmentController extends Controller
{
    protected $speedShipService;

    public function __construct(SpeedShipService $speedShipService)
    {
        $this->speedShipService = $speedShipService;
    }

    public function updateShipment(Request $request)
    {
        $domesticShopFlowPayload = [
            "request" => [
                "productType" => "SMALLPACK",
                "shipment" => [
                    "shipmentDate" => "2025-01-06 00:00:00",
                    "originAddress" => [
                        "address" => [
                            "addressLineList" => ["2323 Victory Avenue"],
                            "locality" => "DALLAS",
                            "region" => "TX",
                            "postalCode" => "75219",
                            "countryCode" => "US",
                            "companyName" => "WWEX GROUP",
                            "phone" => "+18007587447",
                            "contactList" => [
                                [
                                    "firstName" => "John",
                                    "lastName" => "Smith",
                                    "phone" => "+18007587447",
                                    "contactType" => "SENDER",
                                    "fax" => null,
                                    "website" => null
                                ]
                            ]
                        ]
                    ],
                    "destinationAddress" => [
                        "address" => [
                            "addressLineList" => ["7158 South FL Smidth Drive"],
                            "locality" => "SALT LAKE CITY",
                            "region" => "UT",
                            "postalCode" => "84047",
                            "countryCode" => "US",
                            "companyName" => "UNISHIPPERS",
                            "phone" => "+18669987447",
                            "contactList" => [
                                [
                                    "firstName" => "Mary",
                                    "lastName" => "Jones",
                                    "phone" => "+18669987447",
                                    "contactType" => "RECEIVER",
                                    "fax" => null,
                                    "website" => null
                                ]
                            ]
                        ]
                    ],
                    "handlingCharge" => [
                        "value" => 50,
                        "unit" => "PERCENT"
                    ],
                    "handlingUnitList" => [
                        [
                            "billedDimension" => [
                                "length" => [
                                    "value" => "24",
                                    "unit" => "in"
                                ],
                                "width" => [
                                    "value" => "24",
                                    "unit" => "in"
                                ],
                                "height" => [
                                    "value" => "24",
                                    "unit" => "in"
                                ]
                            ],
                            "packagingType" => "02",
                            "packagingTypeName" => "Custom",
                            "quantity" => 1,
                            "referenceList" => [
                                [
                                    "type" => "Reference 1",
                                    "value" => "12345",
                                    "isPrintAsBarCode" => true
                                ],
                                [
                                    "type" => "Reference 2",
                                    "value" => "alpha numeric 123",
                                    "isPrintAsBarCode" => false
                                ]
                            ],
                            "shippedItemList" => [
                                [
                                    "insuredValue" => [
                                        "value" => "5000",
                                        "unit" => "USD"
                                    ],
                                    "codAmount" => [
                                        "value" => "1700",
                                        "unit" => "USD"
                                    ],
                                    "isHazMat" => false
                                ]
                            ],
                            "weight" => [
                                "value" => "15",
                                "unit" => "LB"
                            ]
                        ]
                    ],
                    "isCOD" => true,
                    "allowedCODPaymentMethodsList" => [
                        "CASHIERS_CHECK",
                        "PERSONAL_CHECKS",
                        "CHECKS_MONEY_ORDERS"
                    ],
                    "totalWeight" => [
                        "value" => 15,
                        "unit" => "LB"
                    ],
                    "insuranceRequestFlag" => true,
                    "deliveryConfirmationFlag" => false,
                    "isCarbonNeutral" => false,
                    "adultSignatureRequiredFlag" => false,
                    "isSignatureRequired" => false,
                    "isSelfScheduled" => false,
                    "residentialDeliveryFlag" => false,
                    "shipperReleaseFlag" => false,
                    "description" => null,
                    "returnLabelFlag" => false,
                    "returnServiceType" => null,
                    "returnDescription" => "Return Package"
                ]
            ],
            "correlationId" => "WWEX-M2M-shopFlow-smallpack"
        ];
        $response = $this->speedShipService->shopFlowDomestic($domesticShopFlowPayload);
        $offerPriceValue = $response['response']['offerList'][0]['offeredProductList'][0]['offerPrice']['value'];
        $timeInTransitServiceDescription = $response['response']['offerList'][0]['offeredProductList'][0]['shopRQShipment']['timeInTransit']['serviceDescription'];
        $upsServiceCode = $response['response']['offerList'][0]['offeredProductList'][0]['shopRQShipment']['timeInTransit']['upsServiceCode'];
        // dd($response['response']['offerList'],"offerPriceValue",$offerPriceValue,"timeInTransitServiceDescription",$timeInTransitServiceDescription,"upsServiceCode",$upsServiceCode);
        $offerList = $response['response']['offerList'];

        $html = '<table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Service Description</th>
                    <th>Price Value</th>
                </tr>
            </thead>
            <tbody>';
        
        foreach ($offerList as $offer) {
            if (isset($offer['totalOfferPrice']) && isset($offer['offeredProductList'][0]['shopRQShipment'])) {
                $offerPrice = $offer['totalOfferPrice'];
                $shopRQShipment = $offer['offeredProductList'][0]['shopRQShipment'];
        
                // Adjust if `serviceDescription` exists deeper in the structure
                $serviceDescription = $shopRQShipment['timeInTransit']['serviceDescription'] ?? 'N/A';
        
                $html .= '<tr>
                             <td>' . htmlspecialchars($serviceDescription) . '</td>
                             <td>' . $offerPrice['value'] . '</td>
                          </tr>';
            }
        }
        
        $html .= '</tbody></table>';
        
        // Output the table
        echo $html;
        

        

        // $offerList = $response['response']['offerList'];
        // $timeInTransit = $response['response']['offerList'][0]['offeredProductList'][0]['shopRQShipment']['timeInTransit'];
        // $html = '<table border="1" cellpadding="10" cellspacing="0">
        //     <thead>
        //         <tr>
        //             <th>Service Description</th>
        //              <th>Price Value</th>
        //         </tr>
        //     </thead>
        //     <tbody>';

        // foreach ($offerList as $offer) {
        //     if (isset($offer['totalOfferPrice'])) {
        //         $offerPrice = $offer['totalOfferPrice'];

        //         $html .= '<tr>
        //                      <td>UPS</td>
        //                     <td>' . $offerPrice['value'] . '</td>

        //                 </tr>';
        //     }
        // }

        // $html .= '</tbody></table>';

        // Return or echo the HTML
       // Echo the HTML table

            // Echo the offerList array for debugging
            echo '<pre>';
            print_r($offerList);
            echo '</pre>';
            dd($offerList);
       
        if (isset($response['error'])) {
            return response()->json(['error' => $domesticShopFlowResponse['error']], 500);
        }
    
        return response()->json($domesticShopFlowResponse, 200);
        // $shopFlowData = [
        //     "request" => [
        //         "productType" => "SMALLPACK",
        //         "shipment" => [
        //             "shipmentDate" => "2025-01-06 00:00:00",
        //             "originAddress" => [
        //                 "address" => [
        //                     "addressLineList" => ["2323 Victory Avenue"],
        //                     "locality" => "Dallas",
        //                     "region" => "TX",
        //                     "postalCode" => "75219",
        //                     "countryCode" => "US",
        //                     "companyName" => "WWEX GROUP",
        //                     "phone" => "+18007587447",
        //                     "contactList" => [
        //                         [
        //                             "firstName" => "JOHN",
        //                             "lastName" => "SMITH",
        //                             "phone" => "+18007587447",
        //                             "contactType" => "SENDER",
        //                             "fax" => null,
        //                             "website" => null
        //                         ]
        //                     ]
        //                 ]
        //             ],
        //             "destinationAddress" => [
        //                 "address" => [
        //                     "addressLineList" => ["671 Carling Avenue"],
        //                     "locality" => "Ottowa",
        //                     "region" => "ON",
        //                     "postalCode" => "K1Z7B5",
        //                     "countryCode" => "CA",
        //                     "companyName" => "CANADA TEST PKG",
        //                     "phone" => "+18669447447",
        //                     "contactList" => [
        //                         [
        //                             "firstName" => "MARY",
        //                             "lastName" => "JONES",
        //                             "phone" => "+18669447447",
        //                             "contactType" => "RECEIVER",
        //                             "fax" => null,
        //                             "website" => null
        //                         ]
        //                     ]
        //                 ]
        //             ],
        //             "billToInfoList" => [
        //                 [
        //                     "billToAccountNbr" => "2RY229",
        //                     "billToType" => "SENDER",
        //                     "billToPostalCode" => "75219",
        //                     "billToCountryCode" => "US",
        //                     "shipmentChargeType" => "Transportation",
        //                     "companyName" => "WWEX GROUP"
        //                 ]
        //             ],
        //             "shipmentForm" => [
        //                 "allowPaperless" => false,
        //                 "shipmentFormRequestDetails" => [
        //                     [
        //                         "shipmentFormName" => "CI",
        //                         "shipmentFormRequestType" => "PRINT_POPULATED"
        //                     ],
        //                     [
        //                         "shipmentFormName" => "CO",
        //                         "shipmentFormRequestType" => "PRINT_POPULATED"
        //                     ]
        //                 ],
        //                 "totalInvoice" => [
        //                     "value" => 1000,
        //                     "unit" => "USD"
        //                 ],
        //                 "billToInfoList" => [
        //                     [
        //                         "billToType" => "SENDER",
        //                         "shipmentChargeType" => "DutiesAndTaxes"
        //                     ]
        //                 ]
        //             ],
        //             "handlingCharge" => [
        //                 "value" => 100,
        //                 "unit" => "AMOUNT"
        //             ],
        //             "handlingUnitList" => [
        //                 [
        //                     "billedDimension" => [
        //                         "length" => [
        //                             "value" => 18,
        //                             "unit" => "in"
        //                         ],
        //                         "width" => [
        //                             "value" => 13,
        //                             "unit" => "in"
        //                         ],
        //                         "height" => [
        //                             "value" => 3,
        //                             "unit" => "in"
        //                         ]
        //                     ],
        //                     "packagingType" => "2c",
        //                     "packagingTypeName" => "UPS Express Box Large",
        //                     "quantity" => 1,
        //                     "referenceList" => [
        //                         [
        //                             "type" => "Reference 1",
        //                             "value" => "12345",
        //                             "isPrintAsBarCode" => true
        //                         ],
        //                         [
        //                             "type" => "Reference 2",
        //                             "value" => "alpha numeric 123",
        //                             "isPrintAsBarCode" => false
        //                         ]
        //                     ],
        //                     "shippedItemList" => [
        //                         [
        //                             "insuredValue" => [
        //                                 "value" => "1000",
        //                                 "unit" => "USD"
        //                             ]
        //                         ]
        //                     ],
        //                     "weight" => [
        //                         "value" => "7",
        //                         "unit" => "LB"
        //                     ]
        //                 ]
        //             ],
        //             "totalWeight" => [
        //                 "value" => 7,
        //                 "unit" => "LB"
        //             ],
        //             "insuranceRequestFlag" => true,
        //             "shipperReleaseFlag" => false,
        //             "deliveryConfirmationFlag" => false,
        //             "isSignatureRequired" => false,
        //             "adultSignatureRequiredFlag" => false,
        //             "isCarbonNeutral" => false,
        //             "isCOD" => false,
        //             "allowedCODPaymentMethodsList" => [],
        //             "isSelfScheduled" => true,
        //             "marksNumbers" => null,
        //             "description" => "musical equipment",
        //             "returnLabelFlag" => false,
        //             "returnServiceType" => null,
        //             "returnDescription" => "musical equipment",
        //             "selectedServiceType" => "05"
        //         ]
        //     ],
        //     "correlationId" => "WWEX-UI-532e945a-e679-4eb3-a682-3154390059b5"
        // ];
     
        // $shopFlowResponse = $this->speedShipService->shopFlow($shopFlowData);
        // // Extract the productTransactionId from the response
        // $productTransactionId = "b14da614-20ea-4200-9b1b-ad5bd20f1a29";
    
        // if (!$productTransactionId) {
        //     return response()->json(['error' => 'Product Transaction ID not found'], 500);
        // }
    
        // $data = [
        //     "request" => [
        //         "productTransactionId" => $productTransactionId,
        //         "shipmentForm" => [
        //             "allowPaperless" => false,
        //             "shipmentProductsList" => [
        //                 [
        //                     "commodityDescription" => "SPECIAL EFFECTS PEDALS FOR USE WITH",
        //                     "unitOfMeasure" => "EA",
        //                     "scheduleBCode" => "8543709620",
        //                     "primaryQuantity" => [
        //                         "value" => "1",
        //                         "unit" => "NO"
        //                     ],
        //                     "weight" => [
        //                         "value" => "2",
        //                         "unit" => "kgs"
        //                     ],
        //                     "ciPricePerUnit" => [
        //                         "value" => "1000",
        //                         "unit" => "USD"
        //                     ],
        //                     "coSpecialMarks" => "",
        //                     "packageCount" => 1,
        //                     "originCountryCode" => "US",
        //                     "coPreferenceCriteria" => "A",
        //                     "coProducerInfo" => "Yes",
        //                     "totalLineValue" => [
        //                         "value" => 1000,
        //                         "unit" => "USD"
        //                     ]
        //                 ]
        //             ],
        //             "totalWeight" => [
        //                 "value" => 2,
        //                 "unit" => "LB"
        //             ],
        //             "ciComment" => "",
        //             "destinationControlStatement" => "Diversion contrary to U.S. law is prohibited",
        //             "shipFromTaxId" => "12345678",
        //             "soldToTaxId" => "",
        //             "ciDeclarationStatement" => "I hereby certify that the information on this invoice is true and correct and the contents and value of this shipment is as stated above.",
        //             "ciExportReason" => "Sale",
        //             "govtDesc" => "Standard",
        //             "soldToAddress" => [
        //                 "address" => [
        //                     "addressLineList" => ["671 Carling Avenue"],
        //                     "locality" => "Ottowa",
        //                     "region" => "ON",
        //                     "postalCode" => "K1Z7B5",
        //                     "countryCode" => "CA",
        //                     "companyName" => "CANADA TEST",
        //                     "contactList" => [
        //                         [
        //                             "firstName" => "MARY",
        //                             "lastName" => "JONES",
        //                             "phone" => "8669447447"
        //                         ]
        //                     ]
        //                 ]
        //             ]
        //         ]
        //     ]
        // ];
        // // Call the speedship service
        // $response = $this->speedShipService->updateShipment($data);
        // echo '<pre>';
        // print_r($response);
        // echo '</pre>';
        // dd($response);
        // if (isset($response['error'])) {
        //     return response()->json(['error' => $response['error']], 500);
        // }
    
        // return response()->json($response, 200);
    }
    
}
