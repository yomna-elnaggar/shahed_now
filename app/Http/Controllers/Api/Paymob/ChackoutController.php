<?php

namespace App\Http\Controllers\Api\Paymob;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChackoutController extends Controller
{
    public function chackout(Request $request){
        $user = $request->user();
//dd($user);
        $order = Order::create([
            'user_id' => 2,//$user->id,
            'package_id' =>1,//$request->package_id,
            'order_total' =>100//$request->order_total,
        ]);


        if($request->payment_option == 'paymob_card'){

            return (new PaymobController)->checkingOut('paymob_card_payment',env('PAYMOB_CARD_INTEGRATION_ID'),$order->id,env('PAYMOB_CARD_IFRAME_ID'));
        }elseif($request->payment_option == 'paymob_wallet'){
            return (new PaymobController)->checkingOut('paymob_mobile_wallet_payment',env('PAYMOB_WALLET_INTEGRATION_ID'),$order->id,env('PAYMOB_CARD_IFRAME_ID'));
        }
    }
}
