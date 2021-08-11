<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShipDev;
use App\Models\ShipDistrict;
use App\Models\ShipState;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShippingArea extends Controller
{
    public function index()
    {
        $divisions = ShipDev::latest()->get();
        return view('admin.shipping-area.shipping-division.index', compact('divisions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'division_name'=>'required'
        ]);
        $shipDiv = ShipDev::insert([
            'division_name'=>$request->division_name,
            'created_at'=>Carbon::now()
        ]);
        $notification = array(
            'toster' => "Yes",
            "message" => "Division created successful",
            "alert-type" => "success"
        );
        return redirect()->back()->with($notification); 
    }

    public function edite($id)
    {
        $division = ShipDev::find($id);
        return view('admin.shipping-area.shipping-division.edite', compact('division'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'division_name'=>'required'
        ]);
        ShipDev::find($id)->update([
            'division_name'=>$request->division_name,
            'updated_at'=>Carbon::now()  
        ]);
        $notification = array(
            'toster' => "Yes",
            "message" => "Division updated successful",
            "alert-type" => "success"
        );
        return redirect()->route('admin.ship.area')->with($notification);
    }
    public function destory($id)
    {
        ShipDev::find($id)->delete();
        $notification = array(
            'toster' => "Yes",
            "message" => "Division updated successful",
            "alert-type" => "success"
        );
        return redirect()->back()->with($notification);
    }

    public function district_index()
    {
        $districts = ShipDistrict::latest()->get();
        $divisions = ShipDev::orderBy('division_name', 'ASC')->get();
        return view('admin.shipping-area.shipping-district.index', compact('districts', 'divisions'));
    }
    public function district_store(Request $request)
    {
        $request->validate([
            'district_name'=>'required',
            'division'=>'required'
        ]);
        $district = ShipDistrict::insert([
            'division_id'=>$request->division,
            'district_name'=>$request->district_name,
            'created_at'=>Carbon::now()
        ]);
        $notification = array(
            'toster' => "Yes",
            "message" => "District created successful",
            "alert-type" => "success"
        );
        return redirect()->back()->with($notification);
    }
    public function district_edite($id)
    {
        $district = ShipDistrict::find($id);
        $divisions = ShipDev::orderBy('division_name', 'ASC')->get();
        return view('admin.shipping-area.shipping-district.edite', compact('district', 'divisions'));
    }
    public function district_update(Request $request, $id)
    {
        $request->validate([
            'division'=>'required',
            'district_name'=>'required'
        ]);
        ShipDistrict::find($id)->update([
            'division_id'=>$request->division,
            'district_name'=>$request->district_name,
            'updated_at'=>Carbon::now()
        ]);
        $notification = array(
            'toster' => "Yes",
            "message" => "District updated successful",
            "alert-type" => "success"
        );
        return redirect()->route('admin.ship.area')->with($notification);
    }
    public function district_destory($id)
    {
        ShipDistrict::find($id)->delete();
        $notification = array(
            'toster' => "Yes",
            "message" => "District updated successful",
            "alert-type" => "success"
        );
        return redirect()->back()->with($notification);
    }
    
    public function state_index()
    {
        $stats = ShipState::latest()->get();
        $divisions = ShipDev::orderBy('division_name', 'ASC')->get();
        return view('admin.shipping-area.shipping-state.index', compact('stats', 'divisions'));
    }
    public function get_division($id)
    {
        $districh = ShipDistrict::where('division_id', '=', $id)->orderBy('district_name', 'ASC')->get();
        return json_encode($districh);
       
    }
    public function state_store(Request $request)
    {
        $request->validate([
            'division'=>'required',
            'district'=>'required',
            'state_name'=>'required'
        ]);
        $district = ShipState::insert([
            'division_id'=>$request->division,
            'district_id'=>$request->district,
            'state_name'=>$request->state_name,
            'created_at'=>Carbon::now()
        ]);
        $notification = array(
            'toster' => "Yes",
            "message" => "State created successful",
            "alert-type" => "success"
        );
        return redirect()->back()->with($notification);
    }
    public function state_edite($id)
    {
        $district = ShipState::find($id);
        $divisions = ShipDev::orderBy('division_name', 'ASC')->get();
        return view('admin.shipping-area.shipping-state.edite', compact('district', 'divisions'));
    }
    public function state_update(Request $request, $id)
    {
        $request->validate([
            'division'=>'required',
            'district_name'=>'required'
        ]);
        ShipState::find($id)->update([
            'division_id'=>$request->division,
            'district_name'=>$request->district_name,
            'updated_at'=>Carbon::now()
        ]);
        $notification = array(
            'toster' => "Yes",
            "message" => "District updated successful",
            "alert-type" => "success"
        );
        return redirect()->route('admin.ship.area')->with($notification);
    }
    public function state_destory($id)
    {
        ShipState::find($id)->delete();
        $notification = array(
            'toster' => "Yes",
            "message" => "District updated successful",
            "alert-type" => "success"
        );
        return redirect()->back()->with($notification);
    }

}
