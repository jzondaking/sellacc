<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public function index()
    {
        $orders = Order::where('buyer', Auth::user()->email)->orderBy('id', 'desc')->paginate(9);
        return view('home.orders', compact('orders'));
    }

    public function details($code)
    {
        if (Auth::user()->role == "admin") {
            $order = Order::where('code', $code)->first();
        } else {
            $order = Order::where('code', $code)->where('buyer', Auth::user()->email)->first();
        }

        if ($order) {
            $product = json_decode($order['product'], true);

            $accounts = "";
            $g_accounts = Account::where('order_code', $order['code'])->where('buyer', $order['buyer'])->get();

            foreach ($g_accounts as $a) {
                $accounts .= $a['content']."\n";
            }

            return view('home.order-details', compact('order', 'product', 'accounts'));
        } else {
            return redirect()->back()->with('error', __('orders.not_found'));
        }
    }
}
