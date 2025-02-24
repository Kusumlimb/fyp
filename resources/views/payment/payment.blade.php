@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-[#084f9c]">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md text-center">
        <h2 class="text-2xl font-bold text-gray-800">Make a Payment</h2>
        <p class="text-gray-600 mt-2">Complete your course enrollment by making a payment.</p>
        
        <div class="mt-6">
            <button id="khalti-pay-btn" class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition duration-300">
                Pay with Khalti
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    var config = {
        publicKey: "{{ env('KHALTI_PUBLIC_KEY') }}", // Replace with your Khalti Public Key
        productIdentity: "course_1234",
        productName: "Course Enrollment",
        productUrl: "{{ url('/') }}",
        paymentPreference: ["KHALTI"],
        eventHandler: {
            onSuccess(payload) {
                // Send payment token to Laravel backend for verification
                fetch("{{ route('khalti.payment') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        token: payload.token,
                        amount: payload.amount
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Payment Successful!");
                        window.location.href = "{{ route('thank-you') }}";
                    } else {
                        alert("Payment Failed!");
                    }
                });
            },
            onError(error) {
                console.error("Payment Error: ", error);
                alert("Payment Error: " + error.message);
            },
            onClose() {
                console.log("Khalti Payment Closed");
            }
        }
    };

    var khaltiCheckout = new KhaltiCheckout(config);

    document.getElementById("khalti-pay-btn").addEventListener("click", function () {
        khaltiCheckout.show({ amount: 1000 }); // Amount in paisa (1000 = Rs. 10)
    });
});

</script>

<script src="https://khalti.com/static/khalti-checkout.js"></script>
@endsection
