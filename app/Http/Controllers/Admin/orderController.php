<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\order;
use App\Models\orderItem;
use Illuminate\Http\Request;

class orderController extends Controller
{
    public function pendingOrder()
    {
        $orders = order::where('status', 'pending')->orderBy('id', 'DESC')->get();
        return view('admin.orders.pending', compact('orders'));
    }
    public function vieworder($id)
    {
        $orders = order::find($id);
        $order_items = orderItem::where('order_id', '=', $id)->orderBy('id', 'ASC')->get();
        return view('admin.orders.orderview', compact('orders', 'order_items'));

    }
    public function confirmendOrder()
    {
        $orders = order::where('status', 'confirmed')->orderBy('id', 'ASC')->get();
        return view('admin.orders.confirmed', compact('orders'));
    }
    public function processingOrder()
    {
        $orders = order::where('status', 'processing')->orderBy('id', 'ASC')->get();
        return view('admin.orders.processing', compact('orders'));
    }
    public function pickedOrder()
    {
        $orders = order::where('status', 'picked')->orderBy('id', 'ASC')->get();
        return view('admin.orders.picked', compact('orders'));
    }
    public function shippedOrder()
    {
        $orders = order::where('status', 'shipped')->orderBy('id', 'ASC')->get();
        return view('admin.orders.shipped', compact('orders'));
    }
    public function deliveredOrder()
    {
        $orders = order::where('status', 'delivered')->orderBy('id', 'ASC')->get();
        return view('admin.orders.delivered', compact('orders'));
    }
    public function cancelOrder()
    {
        $orders = order::where('status', 'cancel')->orderBy('id', 'ASC')->get();
        return view('admin.orders.cancel', compact('orders'));
    }

    // CHANGE STATUS
    public function pendingToConfirem($id)
    {
        order::find($id)->update([
            'status'=>'confirmed'
        ]);
        $notification = array(
            'toster' => "Yes",
            "message" => "Pending to confirmed success",
            "alert-type" => "success"
        );
        return redirect()->route('admin.pending.order')->with($notification);
    }
    public function ConfiremToProcessing($id)
    {
        order::find($id)->update([
            'status'=>'processing'
        ]);
        $notification = array(
            'toster' => "Yes",
            "message" => "Pending to processing success",
            "alert-type" => "success"
        );
        return redirect()->route('admin.pending.order')->with($notification);
    }
    public function ProcessingToPicked($id)
    {
        order::find($id)->update([
            'status'=>'picked'
        ]);
        $notification = array(
            'toster' => "Yes",
            "message" => "Pending to picked success",
            "alert-type" => "success"
        );
        return redirect()->route('admin.pending.order')->with($notification);
    }
    public function pickedToShiped($id)
    {
        order::find($id)->update([
            'status'=>'shipped'
        ]);
        $notification = array(
            'toster' => "Yes",
            "message" => "Pending to shipped success",
            "alert-type" => "success"
        );
        return redirect()->route('admin.pending.order')->with($notification);
    }
    public function ShipedToDelivered($id)
    {
        order::find($id)->update([
            'status'=>'delivered'
        ]);
        $notification = array(
            'toster' => "Yes",
            "message" => "Pending to delivered success",
            "alert-type" => "success"
        );
        return redirect()->route('admin.pending.order')->with($notification);
    }



}
