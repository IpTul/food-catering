<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Order;
use App\Models\OrderItem;
use Midtrans\Notification;

class PaymentController extends Controller
{
    public function getSnapToken(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $itemDetails = $request->input('items');

        $order = Order::create([
            'customer_name' => $request->input('customer.first_name'),
            'phone'         => $request->input('customer.phone'),
            'address'       => $request->input('customer.address'),
            'items'         => json_encode($itemDetails),
            'gross_amount'  => $request->input('gross_amount'),
            'status'        => 'pending',
        ]);

        foreach ($request->items as $item) {
            $order->items()->create([
                'name'     => $item['name'],
                'price'    => $item['price'],
                'quantity' => $item['quantity'],
                'type'     => str_contains($item['id'], 'recipe') ? 'recipe' : 'ingredient',
            ]);
        }

        $transactionDetails = [
            // 'order_id' => 'order-' . uniqid(),
            'order_id' => 'order-' . $order->id,
            'gross_amount' => $request->input('gross_amount'),
        ];

        $params = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => $request->input('customer'),
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        };
    }

    public function callback(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        $notification = new Notification();

        $parts = explode('-', $notification->order_id);
        $orderId = $parts[1] ?? null;

        $order = Order::find($orderId);

        $status = match ($notification->transaction_status) {
            'capture', 'settlement' => 'settlement',
            'cancel', 'deny' => 'cancel',
            'expire' => 'expire',
            'pending' => 'pending',
            default => 'pending',
        };

        if ($order) {
            $order->transaction_id = $notification->transaction_id;
            $order->status = $status;
            $order->save();
        }

        return response()->json(['success' => true]);
    }
}
