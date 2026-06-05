<?php

namespace App\Http\Controllers;

use App\Services\ShiprocketService;
use Illuminate\Http\JsonResponse;
use App\Models\Order;
use DB;

class ShiprocketController extends Controller
{
    protected $shiprocket;

    public function __construct(ShiprocketService $shiprocket)
    {
        $this->shiprocket = $shiprocket;
    }

    public function getToken(): JsonResponse
    {
        try {
            $token = $this->shiprocket->getToken();

            return response()->json([
                'success' => true,
                'token' => $token
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
public function createOrder($id)
{
    try {

        $order = Order::findOrFail($id);

        $biiling=json_decode($order->billing_address,true);
        
        $items = DB::table('order_details')
    ->join('products', 'products.id', '=', 'order_details.product_id')
    ->where('order_details.order_id', $id)
    ->select(
        'order_details.*',
        'products.name as product_name'
    )
    ->get();

$orderItems = [];

foreach ($items as $item) {
    $orderItems[] = [
        "name" => $item->product_name,
        "sku" => "SKU".$item->id,
        "units" => (int) $item->quantity,
        "selling_price" => (float) $item->price,
    ];
}


        $orderData = [
            "order_id" => "ORD-" . time(),
            "order_date" => now()->format('Y-m-d H:i'),
            "pickup_location" => "work-1",
            "billing_customer_name" => $biiling['name'],
            "billing_last_name" => $biiling['name'],
            "billing_address" => $biiling['address'],
            "billing_city" => $biiling['city'],
            "billing_pincode" => $biiling['postal_code'],
            "billing_state" => $biiling['state'],
            "billing_country" =>$biiling['country'],
            "billing_email" =>$biiling['email'],
            "billing_phone" => $biiling['phone'],
            "shipping_is_billing" => true,
            "order_items" => $orderItems,
            "payment_method" => "Prepaid",
            "sub_total" => $order->grand_total,
            "length" => 10,
            "breadth" => 10,
            "height" => 10,
            "weight" => 0.5
        ];

        $response = $this->shiprocket->createOrder($orderData);
        $courier = $this->shiprocket->assignAwb($response['shipment_id'],$biiling['postal_code']);

        $awbCode = $courier['response']['data']['awb_code'] ?? null;

        DB::table('orders')->where('id',$id)->update([
            'shiprocket_order_id'     => $response['order_id'] ?? null,
            'shiprocket_shipment_id'  => $response['shipment_id'] ?? null,
            'shiprocket_status'       => $response['status'] ?? null,
            'shiprocket_status_code'  => $response['status_code'] ?? null,
            'tracking_code'=>$awbCode
        ]);
        
        return response()->json([
            'success' => true,
            'data' => $response,
            'courier'=>$courier
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}

}
