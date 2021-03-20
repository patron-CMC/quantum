<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Auth;
use Illuminate\Support\Facades\DB;

class CarsController extends Controller
{
    public function show(){
        $cars = DB::table('cars')->where('user_id', Auth::user()->id)->get();
        return view('vehicles', ['cars' => $cars->all()]);
    }
    public function add(Request  $request){
        $car = new Car();
        $car->user_id = Auth::user()->id;
        $car->license_plate = $request->input('license_plate');
        $car->car_brand= $request->input('car_brand');
        $car->release_year= $request->input('release_year');
        $car->save();
        return redirect()->route('vehicles');
    }
    public function delete($id){
        DB::table('cars')->where('id', $id)->delete();
        return redirect()->route('vehicles');
    }
}
