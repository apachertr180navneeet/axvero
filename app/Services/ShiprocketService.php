<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ShiprocketService
{
    protected $baseUrl;
    protected $email;
    protected $password;

    public function __construct()
    {
        $this->baseUrl = config('services.shiprocket.base_url');
        $this->email = config('services.shiprocket.email');
        $this->password = config('services.shiprocket.password');
    }

    public function getToken()
    {
        // Cache token for 55 minutes (Shiprocket token usually valid ~1 hour)
        return Cache::remember('shiprocket_token', now()->addMinutes(55), function () {

            $response = Http::post($this->baseUrl . '/auth/login', [
                'email' => $this->email,
                'password' => $this->password,
            ]);

            if (!$response->successful()) {
                throw new \Exception('Shiprocket authentication failed: ' . $response->body());
            }

            return $response->json()['token'];
        });
    }
    
    public function createOrder(array $orderData)
{
    $token = $this->getToken();

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token,
        'Content-Type'  => 'application/json',
    ])->post($this->baseUrl . '/orders/create/adhoc', $orderData);

    if (!$response->successful()) {
        throw new \Exception('Order creation failed: ' . $response->body());
    }

    return $response->json();
}


public function assignAwb($shipmentId,$postcode)
{
    $token = $this->getToken();

    // Step 1: Get available couriers
    $serviceability = Http::withToken($token)->get(
        $this->baseUrl . '/courier/serviceability/', [
            'pickup_postcode' => '110016',
            'delivery_postcode' => (string) $postcode,
            'cod' => 0,
            'weight' => 0.5
        ]
    )->json();

    $courierId = $serviceability['data']['available_courier_companies'][0]['courier_company_id'];

    // Step 2: Assign courier (Generate AWB)
    $response = Http::withToken($token)->post(
        $this->baseUrl . '/courier/assign/awb',
        [
            'shipment_id' => $shipmentId,
            'courier_company_id' => $courierId
        ]
    );

    return $response->json();
}


}
