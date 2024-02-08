<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\ClientToken;
use Braintree\Transaction;

class PaymentController extends Controller
{
    public function initialize() {
        $token = ClientToken::generate();
        return response()->json(['token' => $token]);
    }
}
