<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Product;
use App\Models\Log;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //

    public function filter(Request $request)
    {
        
        if ($request->has('category') && !empty($request->category)) {

            $list_category = Category::where('id', $request->category)->get();

        } else {

            $list_category = Category::all();

        }

        return view('home.filter.products', compact('request', 'list_category'));
    }

    public function purchase(Request $request)
    {   
        if (Auth::check()) {
            
            $validator = Validator::make($request->all(), [
                "product_id" => "required|numeric",
            ]);

            if ($validator->fails()) {

                return response()->json([
                    "success" => false,
                    "message" => $validator->errors()->first()
                ]);

            } else {

                $product_id = intval($request->product_id);
                $product = Product::where('id', $product_id)->first();

                if ($product) {

                    $minimum = $product['minimum'];
                    $maximum = $product['maximum'];

                    $validator = Validator::make($request->all(), [
                        "quantity" => "required|numeric|min:$minimum|max:$maximum",
                    ]);
                    
                    if ($validator->fails()) {

                        return response()->json([
                            "success" => false,
                            "message" => $validator->errors()->first()
                        ]);

                    } else {

                        $quantity = intval($request->quantity);
                        $account_remain = count(Account::where('product_id', $product_id)->where('buyer', NULL)->get());

                        if ($account_remain >= $quantity) {

                            $total_pay = $product['price'] * $quantity;

                            if (Auth::user()->cash >= $total_pay) {
                                $order_code = strtoupper(Str::random(11));

                                Log::insert([
                                    "user" => Auth::user()->email,
                                    "content" => __('product.purchase_success_log', [
                                        'quantity' => $quantity,
                                        'product' => $product['name']
                                    ]),
                                    "balance" => Auth::user()->cash." - ".$total_pay,
                                    "order_code" => $order_code,
                                    "useragent" => $request->server('HTTP_USER_AGENT'),
                                    "ip" => $request->ip()
                                ]);

                                $user = Auth::user();
                                $user->cash = Auth::user()->cash - $total_pay;
                                $user->save();

                                Order::insert([
                                    "code" => $order_code,
                                    "buyer" => Auth::user()->email,
                                    "product" => $product,
                                    "product_id" => $product['id'],
                                    "quantity" => $quantity,
                                    "total_pay" => $total_pay,
                                ]);

                                Account::where('buyer', NULL)->where('product_id', $product_id)->limit($quantity)->inRandomOrder()->update([
                                    "order_code" => $order_code,
                                    "buyer" => Auth::user()->email
                                ]);

                                Product::where('id', $product['id'])->update([
                                    "sold" => $product['sold'] + 1
                                ]);

                                $g_details = Account::where('buyer', Auth::user()->email)->where('order_code', $order_code)->get();

                                $details = array();

                                foreach ($g_details as $d) {
                                    array_push($details, $d['content']);
                                }

                                return response()->json([
                                    "success" => true,
                                    "code" => $order_code,
                                    "details" => $details
                                ]); 

                            } else {
                                return response()->json([
                                    "success" => false,
                                    "message" => __('product.cash_not_enough')
                                ]);
                            }

                        } else {
                            return response()->json([
                                "success" => false,
                                "message" => __('product.quantity_not_enough')
                            ]);
                        }

                    }

                } else {

                    return response()->json([
                        "success" => false,
                        "message" => __('product.not_exists')
                    ]);

                }

            }

        } else {
            return response()->json([
                "success" => false,
                "message" => __('auth.unauthicated')
            ]);
        }
    }

    public function calculate_total_pay(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            "product_id" => "required|numeric",
        ]);

        if ($validator->fails()) {

            return response()->json([
                "success" => false,
                "message" => $validator->errors()->first()
            ]);

        } else {

            $product_id = intval($request->product_id);
            $product = Product::where('id', $product_id)->first();

            if ($product) {
                $minimum = $product['minimum'];
                $maximum = $product['maximum'];

                $validator = Validator::make($request->all(), [
                    "quantity" => "required|numeric|min:$minimum|max:$maximum",
                ]);
                
                if ($validator->fails()) {

                    return response()->json([
                        "success" => false,
                        "message" => $validator->errors()->first()
                    ]);

                } else {

                    $quantity = intval($request->quantity);
                    $total_pay = $product['price'] * $quantity;

                    return response()->json([
                        "success" => true,
                        "message" => __('product.calculate_total_pay_success', [
                            "quantity" => $quantity,
                            "price" => $product['price'],
                            "total_pay" => displayCash($total_pay),
                            "product_name" => $product['name']
                        ])
                    ]);

                }

            } else {

                return response()->json([
                    "success" => false,
                    "message" => __('product.not_exists')
                ]);

            }

        }
    }
}
