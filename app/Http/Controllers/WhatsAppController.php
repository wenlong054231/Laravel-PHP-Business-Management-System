<?php

// Programer Name: CHOW WEN LONG
// Program Name: WhatsAppController.php
// Description: To manage functions for WhatsApp api 
// First Written on: 20/4/2023
// Edited on: 20/6/2023


namespace App\Http\Controllers;

use App\Models\Customer;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class WhatsAppController extends Controller
{
    public function sendWhatsAppMessage(Request $request,$id)
    {       
        $customer = Customer::find($id);

        $fullName = $customer->first_name . ' ' . $customer->last_name;
        $template = [
            "name" => "hello_world",
            "namespace" => "iams",
            "language" => [
                "code" => "en_US"
            ],
            "components" => [
                [
                    "type" => "text",
                    "text" => "Hello " . $fullName . ","
                ],
                [
                    "type" => "text",
                    "text" => "Your policy has expired"
                ],             
            ]
        ];

        // Call the function to send the WhatsApp message
        $result = $this->sendWhatsAppMessageViaAPI('6'. $customer->phone,$template);

        if ($result) {
            return redirect()->back()->with(['message' => 'WhatsApp message sent successfully!', 'user_id' => $id]);
        } else {
            return redirect()->back()->with(['error' => 'Failed to send the WhatsApp message.', 'user_id' => $id]);
        }
        
    }

    private function sendWhatsAppMessageViaAPI($to)
    {
        $accessToken = 'EAAIRN6EfOZAoBO5d1MIZA2F0FuiwkAeMzU4gsZA5MPVMFbZCRC0fMqe6gIrxtiJoDRN263KoXyEZAdc8agKlx0reuiaZBpSqkHZCQouoQXsncpiHPz3y3PyIsN9gVVlR5yHkdVsZA669CT1fedjnF0nVD4gJyz3vDIpHgavjbBFaOeaAKAEc0tg8rRv7QcTvSrhEf6A3gebu9fZAU';
        $apiVersion = 'v18.0'; // Update the API version as needed
        $objectId = '115005984987601'; // Replace with the correct object ID
        $url = "https://graph.facebook.com/{$apiVersion}/{$objectId}";
    
        $client = new Client();
    
        try {
            $response = $client->post($url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'messaging_product' => 'whatsapp',
                    'to' => $to,
                    'type' => 'template',
                    'template' => [
                        'name' => 'hello_world',
                        'language' => [
                            'code' => 'en_US',
                        ],
                    ],
                ],
            ]);
    
            $statusCode = $response->getStatusCode();
    
            return $statusCode === 200;
        } catch (ClientException $e) {
            // Capture and log detailed error information
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            $errorBody = json_decode($response->getBody()->getContents(), true);
            // Log or handle the error information as needed
    
            return false;
        }
    }
}
?>