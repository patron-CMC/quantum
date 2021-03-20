<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Auth;
use Illuminate\Support\Facades\DB;

class PaymentsController extends Controller
{
    public function show_payments(){
        $user_id = Auth::user()->id;
        $payments = DB::table('payments')
            ->where('id_client', $user_id)->whereIn('status',['sent', 'returned'])
            ->orWhere([['id_driver', $user_id],
                ['status', 'received']])
            ->leftJoin('users as clients', 'clients.id', '=', 'payments.id_client')
            ->leftJoin('users as drivers', 'drivers.id', '=', 'payments.id_driver')
            ->select('payments.*', 'clients.name as client_name', 'drivers.name as driver_name')
            ->orderBy('id', 'desc')
            ->get();
        return view('payments', ['payments' => $payments->all()]);
    }
}
