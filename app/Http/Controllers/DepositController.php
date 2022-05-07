<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DepositController extends Controller
{
    //

    public function index()
    {
        return view('home.deposit');
    }

    public function paymentDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required|numeric"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()->first()
            ]);
        }

        $payment = Payment::where('id', $request->id)->first();

        if ($payment) {

            return response()->json([
                "success" => true,
                "data" => array(
                    "logo" => $payment['logo'],
                    "name" => $payment['name'],
                    "owner" => $payment['owner'],
                    "number_account" => $payment['number_account'],
                    "branch" => $payment['branch'],
                    "note" => $payment['note'],
                    "content" => setting('payment_prefix')." ".Auth::user()->id
                )
            ]);

        } else {
            return response()->json([
                "success" => false,
                "message" => __("deposit.payment_not_found")
            ]);
        }
    }

}
