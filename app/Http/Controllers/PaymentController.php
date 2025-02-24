<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function verifyPayment(Request $request)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Key ' . config('services.khalti.secret_key'),
        ])->post(config('services.khalti.payment_url'), [
            'token' => $request->token,
            'amount' => $request->amount,
        ]);

        $result = $response->json();

        if (isset($result['state']) && $result['state']['name'] === "Completed") {
            // Save to database (if needed)

            // Redirect to thank-you page
            return view('thank-you', ['message' => 'Payment Successful']);
        }

        return response()->json(['success' => false, 'message' => 'Payment Failed']);
    }
}
