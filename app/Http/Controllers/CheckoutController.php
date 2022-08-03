<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    const STRIPE_SECRET_KET = 'sk_test_51LSajFLDccINHsSAI6gECQoue6JzrhnqnS68FMamEwLcuHgqpXlnt0dNW7yWaTHhwXmZ48vnVCHZWXpBoqwkFOah00Epp8MZlQ';
    const STRIPE_PUBLIC_KEY = 'pk_test_51LSajFLDccINHsSAlLYZdtpgmeX5mMVtKPRZhEEghrFfe0jR2u1TLiSf1RgGVUq1OnPY3fwMyL1SSNbqlfAYIWvF00ZejP4UPt';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('checkout', ['stipe_public_key' => self::STRIPE_PUBLIC_KEY]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function createStripePayment()
    {
        // This is your test secret API key.
        \Stripe\Stripe::setApiKey(self::STRIPE_SECRET_KET);

        function calculateOrderAmount(array $items): int
        {
            // Replace this constant with a calculation of the order's amount
            // Calculate the order total on the server to prevent
            // customers from directly manipulating the amount on the client
            return 1400;
        }

        header('Content-Type: application/json');

        try {
            // retrieve JSON from POST body
            $json_str = file_get_contents('php://input');
            $json_obj = json_decode($json_str);

            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => calculateOrderAmount($json_obj->items),
                'currency' => 'usd',
            ]);

            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];

            return json_encode($output);
        } catch (Error $e) {
            http_response_code(500);
            return json_encode(['error' => $e->getMessage()]);
        }
    }
}
