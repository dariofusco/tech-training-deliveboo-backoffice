<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Braintree\ClientToken;
use Braintree\Transaction;
class PaymentController extends Controller
{
    public function initialize() {
        $token = ClientToken::generate();
        return response()->json(['token' => $token]);
    }

    public function process(Request $request)
    {
        $status = Transaction::sale([
            'amount' => $request->total_price,
            'paymentMethodNonce' => $request->payment_method_nonce,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        function saveOrder($newOrder, $request)
        {
            $newOrder->save();
            foreach ($request->products as $dish) {
                $newOrder->dishes()->attach([$dish['id'] => ['quantity' => $dish['qty']]]);
            }
        }

        $newOrder = new Order();
        $newOrder->name = $request->name;
        $newOrder->lastname = $request->last_name;
        $newOrder->address = $request->address;
        $newOrder->phone = $request->phone;
        $newOrder->totalprice = $request->total_price;

        if ($status) {
            $newOrder->status = 1;
            saveOrder( $newOrder, $request );
            return response()->json(['success' => true]);
        } else {
            $newOrder->status = 0;
            saveOrder( $newOrder, $request );
            return response()->json(['success' => false]);
        }
    }
}

