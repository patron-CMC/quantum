<?php

namespace App\Http\Controllers;

use App\Models\Freight;
use App\Models\Payment;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FreightsController extends Controller
{
    public function publish(Request  $request){
        $freight = new Freight();
        $freight->id_client = Auth::user()->id;
        $freight->departure = $request->input('departure');
        $freight->destination = $request->input('destination');
        $date_list = explode(".", $request->input('dep_date'));
        $date = implode("-", array_reverse($date_list));
        $freight->dep_date = $date;
        $freight->dep_time = $request->input('dep_time');
        $freight->dimensions = $request->input('dimensions');
        $freight->weight = $request->input('weight');
        $freight->add_info = $request->input('add_info');
        if (is_null($freight->add_info)){
            $freight->add_info = "не указано";
        }
        $freight->price = $request->input('price');
        $freight->status = "opened";
        $freight->save();
        return redirect()->route('freights_published');
    }
    public function search(Request $request){
        $dep = $request->input('departure');
        $dest = $request->input('destination');
        $date_list = explode(".", $request->input('dep_date'));
        $date = implode("-", array_reverse($date_list));
        //$freights = DB::select('select freights.id, id_client, name, departure, destination,
        //dep_time, dimensions, weight, add_info, price from freights' );
        $freights = DB::table('freights')->where([['departure', $dep],
                ['destination', $dest],
                ['dep_date', $date],
                ['id_client', '!=', Auth::user()->id],
                ['status', 'opened']])
            ->join('users', 'users.id', '=', 'freights.id_client')
            ->select('freights.*', 'users.name', 'users.email')
            ->get();
        return view('freights_searchList', ['freights' => $freights->all()]);
    }
    public function book($freight_id, $user_id){
        DB::table('freights')->where('id', $freight_id)->update(['id_driver' => $user_id,
            'status' => 'booked']);
        return redirect()->route('freights_executing');
    }
    public function show_published(){
        $user_id = Auth::user()->id;
        $actual_freights = DB::table('freights')->where(['id_client' => $user_id])
            ->whereIn('status',['opened','booked', 'executing', 'confirm_exec'])->get();
        $executed_freights = DB::table('freights')->where(['id_client' => $user_id])
            ->whereIn('status',['executed'])->get();
        $canceled_freights = DB::table('freights')->where(['id_client' => $user_id])
            ->whereIn('status',['canceled_by_driver', 'canceled_by_client'])->get();
        return view('freights', compact('actual_freights', 'executed_freights',
            'canceled_freights'));
    }
    public function show_executing(){
        $user_id = Auth::user()->id;
        $actual_freights = DB::table('freights')->where(['id_driver' => $user_id])
            ->whereIn('status',['booked', 'executing', 'confirm_exec'])->get();
        $executed_freights = DB::table('freights')->where(['id_driver' => $user_id])
            ->whereIn('status',['executed'])->get();
        $canceled_freights = DB::table('freights')->where(['id_driver' => $user_id])
            ->whereIn('status',['canceled_by_driver'])->get();
        return view('freights', compact('actual_freights', 'executed_freights',
            'canceled_freights'));
    }
    public function show_FreightCard($freight_id){
        $freight_info = DB::select(
            'select freights.*, clients.id as client_id, clients.name as client_name,
                    drivers.id as driver_id, drivers.name as driver_name
                    from freights left join (users as clients, users as drivers)
                        on (clients.id = freights.id_client and drivers.id = freights.id_driver)
                        where (freights.id = ?)', [$freight_id]);
        return view('freight-card', ['freight_info' => $freight_info[0]]);
    }
    public function cancel_by_client($freight_id){
        DB::table('freights')->where('id', $freight_id)
            ->update(['status' => 'canceled_by_client']);
        return redirect()->route('FreightCard', $freight_id);
    }
    public function user_profile($user_id){
        $user_info = DB::table('users')->where('id', $user_id)->get();
        $user_cars = DB::table('cars')->where('user_id', $user_id)->get();
        return view('user_profile', compact('user_info', 'user_cars'));
    }
    public function to_executing($freight_id){
        $payment = new Payment();
        $freight = DB::table('freights')->where('id', $freight_id)->get();
        $freight = $freight[0];
        DB::table('freights')->where('id', $freight_id)
            ->update(['status' => 'executing']);
        DB::table('users')->where('id', Auth::user()->id)
            ->decrement('acc_balance', $freight->price);
        $payment->id_freight = $freight->id;
        $payment->id_client = $freight->id_client;
        $payment->id_driver = $freight->id_driver;
        $payment->amount = $freight->price;
        $payment->timestamp = Carbon::now();
        $payment->status = 'sent';
        $payment->save();
        return redirect()->route('FreightCard', $freight_id);
    }
    public function to_opened($freight_id){
        DB::table('freights')->where('id', $freight_id)
            ->update(['status' => 'opened', 'id_driver' => null]);
        return redirect()->route('FreightCard', $freight_id);
    }
    public function to_confirm($freight_id){
        DB::table('freights')->where('id', $freight_id)
            ->update(['status' => 'confirm_exec']);
        return redirect()->route('FreightCard', $freight_id);
    }
    public function cancel_by_driver($freight_id){
        $payment = new Payment();
        $freight = DB::table('freights')->where('id', $freight_id)->get();
        $freight = $freight[0];
        DB::table('freights')->where('id', $freight_id)
            ->update(['status' => 'canceled_by_driver']);
        DB::table('users')->where('id', $freight->id_client)
            ->increment('acc_balance', $freight->price);
        $payment->id_freight = $freight->id;
        $payment->id_client = $freight->id_client;
        $payment->id_driver = $freight->id_driver;
        $payment->amount = $freight->price;
        $payment->timestamp = Carbon::now();
        $payment->status = 'returned';
        $payment->save();
        return redirect()->route('FreightCard', $freight_id);
    }
    public function confirm_exec($freight_id){
        $payment = new Payment();
        $freight = DB::table('freights')->where('id', $freight_id)->get();
        $freight = $freight[0];
        DB::table('freights')->where('id', $freight_id)
            ->update(['status' => 'executed']);
        DB::table('users')->where('id', $freight->id_driver)
            ->increment('acc_balance', $freight->price);
        $payment->id_freight = $freight->id;
        $payment->id_client = $freight->id_client;
        $payment->id_driver = $freight->id_driver;
        $payment->amount = $freight->price;
        $payment->timestamp = Carbon::now();
        $payment->status = 'received';
        $payment->save();
        return redirect()->route('FreightCard', $freight_id);
    }
}
