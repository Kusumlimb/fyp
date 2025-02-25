<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function verifyPayment(Request $request)
    {
        $khaltiPaymentData = session()->pull('khalti_payment_init');
        $secretKey = config('services.khalti.secret_key');
        $endpoint = config('services.khalti.endpoint');
        if(empty($khaltiPaymentData)){
             return redirect()->route('front.home')->with(['toastr.error' => 'Invalid Action']);
        }
        $response = Http::withHeaders([
             'Authorization' => "key $secretKey",
            'Content-Type' => 'application/json',
        ])->post("$endpoint/epayment/lookup/", [
             'pidx' => $khaltiPaymentData['pidx'] ?? null,
        ]);
        $result = $response->json();
        if(empty($result['status']) || $result['status'] !== 'Completed'){
             return redirect()->route('front.home')->with(['toastr.error' => 'Something went wrong!']);
        }
        $courseSlug = $request->input("purchase_order_id");
        $course = Course::query()->where('slug', $courseSlug)->first();
        $student = auth()->user();
        $student->courses()->attach($course->id);
        return view('front.payment.thank-you');
    }

     public function initiatePayment(Course $course)
     {
          $student = auth()->user();
          $secretKey = config('services.khalti.secret_key');
          $endpoint = config('services.khalti.endpoint');

          $isAlreadyEnrolled = in_array($course->id, auth()->user()->courses()->pluck('id')->toArray());
          if($isAlreadyEnrolled){
               return response()->json(['success' => false, 'message' => 'Student Already Enrolled'], 422);
          }
          if(Session::has('khalti_payment_init')){
               $khaltiPaymentData = session('khalti_payment_init');
               $expiresAt = $khaltiPaymentData['expires_at'];
               if(!Carbon::parse($expiresAt)->setTimezone(config('app.timezone'))->isPast()){
                    return response()->json($khaltiPaymentData);
               }
          }

          $response = Http::withHeaders([
               'Authorization' => "key $secretKey",
               'Content-Type' => 'application/json',
          ])->post("$endpoint/epayment/initiate/", [
               'return_url' => route('payment.verify-payment'),
               'website_url' => route('front.home'),
               'amount' => $course->price,
               'purchase_order_id' => $course->slug,
               'purchase_order_name' => $course->title,
               'customer_info' => [
                    'name' => $student->name,
                    'email' => $student->email,
               ],
          ]);
          if($response->failed()){
               session()->forget('khalti_payment_init');
               return response()->json(['success' => false, 'message' => 'Payment Failed'], $response->getStatusCode());
          }
          $responseData = $response->json();
          session(['khalti_payment_init' => $responseData]);
          return response()->json($responseData);
     }
}
