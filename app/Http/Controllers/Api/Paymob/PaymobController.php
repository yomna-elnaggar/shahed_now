<?php

namespace App\Http\Controllers\Api\Paymob;

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Controller;
use App\Models\CombinedOrder;
use App\Models\Order;

use App\Utility\NotificationUtility;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaymobController extends Controller
{
    /**
     * Display checkout page.
     *
     * @param $payment_method
     * @param $integration_id
     * @param $order_id
     * @param $iframe_id_or_wallet_number
     * @return RedirectResponse
     */
    public function checkingOut($payment_method, $integration_id, $order_id, $iframe_id_or_wallet_number): RedirectResponse
    {
        // step 1: login to paymob
        $response = Http::withHeaders([
            'content-type' => 'application/json'
        ])->post('https://accept.paymobsolutions.com/api/auth/tokens',[
            "api_key"=> env('PAYMOB_API_KEY')
        ]);
        $json=$response->json();
//dd($json);
        $order = Order::query()->findOrFail($order_id);
        $grand_total = $order->order_total;

        // step 2: send order data
        $response_final=Http::withHeaders([
            'content-type' => 'application/json'
        ])->post('https://accept.paymobsolutions.com/api/ecommerce/orders',[
            "auth_token"=>$json['token'],
            "delivery_needed"=>"false",
            "amount_cents"=>$grand_total*100,
            "merchant_order_id" => $order->id
        ]);

        $json_final=$response_final->json();
      // dd($json_final);
        $user = Auth::user();
        $name = $user->name;
        if ((count(explode(" ",$name)) == 1)) {
            $first_name = $name;$last_name=$name;
        } else {
            $first_name = explode(" ",$name)[0];
            $last_name = explode(" ",$name)[1];
        }
        //  step 3: send customer data
        $response_final_final=Http::withHeaders([
            'content-type' => 'application/json'
        ])->post('https://accept.paymobsolutions.com/api/acceptance/payment_keys',[
            "auth_token"=>$json['token'],
            "expiration"=> 36000,
            "amount_cents"=>$json_final['amount_cents'],
            "order_id"=>$json_final['id'],
            "billing_data"=>[
                "first_name"            => $first_name,
                "last_name"             => $last_name,
                "phone_number"          => $user->phone ?: "NA",
                "email"                 => $user->email,
                "apartment"             => "NA",
                "floor"                 => "NA",
                "street"                => $user->addres?: "NA",
                "building"              => "NA",
                "shipping_method"       => "NA",
                "postal_code"           => $user->postal_code?: "NA",
                "city"                  => $user->city?: "NA",
                "state"                 => $user->state ?: "NA",
                "country"               => $user->country?: "NA",
            ],
            "currency"=>"EGP",
            "integration_id"=>$integration_id
        ]);

        $response_final_final_json=$response_final_final->json();
//dd($response_final_final_json);
        if ($payment_method == 'paymob_mobile_wallet_payment') {
            $response_iframe =Http::withHeaders([
                'content-type' => 'application/json'
            ])->post('https://accept.paymob.com/api/acceptance/payments/pay',[
                "source"=>[
                    "identifier"=> $iframe_id_or_wallet_number,
//                "identifier"=> "01010101010",
                    "subtype"=> "WALLET"
                ],
                "payment_token"=>$response_final_final_json['token'],
            ]);
            return redirect($response_iframe->json()['redirect_url']);
        } else {
            return redirect('https://accept.paymobsolutions.com/api/acceptance/iframes/'. $iframe_id_or_wallet_number .'?payment_token=' . $response_final_final_json['token']);
        }
    }

    public function callback(Request $request): RedirectResponse
    { dd($request->all());
        $payment_details = json_encode($request->all());
        if ($request->success === "true")
        {
            return (new CheckoutController)->checkout_done($request->merchant_order_id, $payment_details);
        } else {
            flash(translate('Payment Failed'))->error();
            return redirect()->route('home');
        }
    }

}
