<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\orderMail;
use App\Models\order;
use App\Models\orderItem;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class StripeController extends Controller
{
    public function Store(Request $request)
    {
        if(session()->get('coupon')){
            $total_amount = session()->get('coupon')['coupon_total'];
        }else{
            $total_amount = round(str_replace(',', '', Cart::total()));
        }
        \Stripe\Stripe::setApiKey('sk_test_51JJKG3A5O262omJdwyJTYJkrfecZfUfWTbMzvyKrEr3kU41bCEBcpaTigA1qILZfCZSRww3pnE2pkzhN7Q3Gxp3B00smtbetiU');
        $token = $_POST['stripeToken'];
        $charge = \Stripe\Charge::create([
            'amount' => $total_amount * 100,
            'currency' => 'usd',
            'description' => 'Payment from skdevbd',
            'source' => $token,
            'statement_descriptor' => 'Custom descriptor',
            'metadata'=>['order_id'=> uniqid()]
        ]);
        
        $order_id = order::insertGetId([
            'user_id'=>Auth::id(),
            'division_id'=>$request->select_division,
            'district_id'=>$request->select_district,
            'state_id'=>$request->select_state,
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'post_code'=>$request->post_code,
            'notes'=>$request->notes,
            'payment_type'=>"Stripe",
            'payment_mathod'=>$charge->payment_method,
            'transaction_id'=>$charge->balance_transaction,
            'currency'=>$charge->currency,
            'amound'=>$total_amount,
            'order_number'=>$charge->metadata->order_id,
            'invoice_no'=>mt_rand(10000000,99999999),
            'order_date'=>Carbon::now()->format('d F Y'),
            'order_year'=>Carbon::now()->format('Y'),
            'order_month'=>Carbon::now()->format('F'),
            'status'=>'pending',
        ]);

        foreach (Cart::content() as $Cart) {
            orderItem::insert([
                'order_id'=>$order_id,
                'product_id'=>$Cart->id,
                'color'=>$Cart->options->color,
                'size'=>$Cart->options->size,
                'qty'=>$Cart->qty,
                'price'=>$Cart->subtotal,
                'created_at'=>Carbon::now(),
            ]);
        }
        
        $invoice = order::findOrFail($order_id);
        $data = [
            'invoice'=>$invoice->invoice_no,
            'price'=> $total_amount
        ];
        Mail::to($request->email)->send(new orderMail($data));

        if(Session::has('coupon')){
            Session::forget('coupon');
        }
        Cart::destroy();
        $notification = array(
            'toster' => "Yes",
            "message" => "Your order place Success",
            "alert-type" => "success"
        );
        return redirect()->to('/')->with($notification);
    }
}
