<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    function home()
    {
        return view('home');
    }

    function suppliers()
    {
        return view("create_suppliers");
    }

    function suppliersCreate(Request $request)
    {
        $generate_token=$this->generate();

        $data = $request->all();
        // URL Zoho API для створення угод
        $zohoApiUrl = 'https://www.zohoapis.eu/crm/v6/Accounts';
        $client = new Client();
        $response = $client->post($zohoApiUrl, [
                'headers' => [
                    'Authorization' => 'Zoho-oauthtoken ' . $generate_token,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'data' => [
                        [
                            'Account_Name' => $data['accountName'],
                        ],
                    ],
                ],
            ]
        );
        $result = $response->getBody()->getContents();


        $zohoApiUrlVendors = 'https://www.zohoapis.eu/crm/v6/Vendors';
        $responseVendors = $client->post($zohoApiUrlVendors, [
            'headers' => [
                'Authorization' => 'Zoho-oauthtoken ' . $generate_token,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'data' => [
                    [
                        'Website' => $data['website'],
                        'Phone' => $data['phone'],
                        'Vendor_Name' => 'default',
                    ],
                ],
            ],
        ]);
        $result2 = $responseVendors->getBody()->getContents();
        return response()->json(['result' => $result,'result2'=>$result2]);
    }

    function dealCreate(Request $request)
    {
        $generate_token=$this->generate();

        $data = $request->all();
        // URL Zoho API для створення угод
        $zohoApiUrl = 'https://www.zohoapis.eu/crm/v6/Deals';
        $client = new Client();
        $response = $client->post($zohoApiUrl, [
                'headers' => [
                    'Authorization' => 'Zoho-oauthtoken ' . $generate_token,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'data' => [
                        [
                            'Deal_Name' => $data['agreementName'],
                            'Stage' => $data['agreementStage'],
                        ],
                    ],
                ],
            ]
        );
        $result = $response->getBody()->getContents();

        return response()->json(['result' => $result]);
    }

    function generate()
    {
        $post = [
            'code' => '1000.7df12652d2aaa54b5bad072206a21990.021d48122ae754d5db3ea925cb3a6c38',
            'redirect_uri' => 'http://127.0.0.1:8000/index',
            'client_id' => '1000.4HN56FRSAQFPEL2L8EETN3Q9J1RKJG',
            'client_secret' => '438dd8acfbdf59ddc138dc4db54b4edfffddd867fb',
            'grant_type' => 'authorization_code'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://accounts.zoho.eu/oauth/v2/token");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/x-www-form-urlencoded'));
        $response = curl_exec($ch);
        $responseData = json_decode($response, true);
        return $responseData['access_token'];
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    function index()
    {
        return view('index');
    }

}
