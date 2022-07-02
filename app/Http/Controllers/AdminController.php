<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Log;
use App\Models\User;
use App\Models\Order;
use App\Models\Account;
use App\Models\Category;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;

class AdminController extends Controller
{
    //

    public function dashboard()
    {
       
        $userQuery = User::query();
        $accountQuery = Account::query();
        $orderQuery = Order::query();

        $statistic = array(
            "total_users" =>  $userQuery->count(),
            "total_customers" =>  $userQuery->where('cash', '>', 0)->count(),
            "total_clones" =>   $userQuery->where('cash', '<=', 0)->count()),
            "today_registrations" =>  $userQuery->whereDate('created_at', Carbon::today())->count(),
            "accounts_instock" => $accountQuery->where('buyer', NULL)->count(),
            "accounts_sold" => $accountQuery->where('buyer', '!=', NULL)->count(),
            "today_revenue" => $orderQuery->whereDate('created_at', Carbon::today())->sum('total_pay'),
            "month_revenue" => $orderQuery->whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->sum('total_pay'),
            "logs" => Log::orderBy('id', 'desc')->paginate(10)
        );

        return view("admin.dashboard", compact('statistic'));
    }

    public function manage_users()
    {
        $users = User::orderBy('id', 'desc')->paginate(15);
        return view("admin.manage.users", compact('users'));
    }

    public function delete_row(Request $request, $table, $id) 
    {
        $id = intval($id);

        if ($request->query('confirm') && $request->query('redirect')) {
            
            $check = DB::table($table)->where('id', $id)->first();

            if ($check) {
                DB::table($table)->where('id', $id)->delete();
                return redirect($request->query('redirect'))->with('success', __("system.delete_success"));
            } else {
                return redirect()->back()->with("error", __("system.data_not_found"));
            }
            
        } else {
            return view("admin.action.confirm_delete", compact("request"));
        }
    }

    public function save_user(Request $request, $id)
    {
        $user = User::where('id', $id)->first();

        if ($user) {
            
            $validator = Validator::make($request->all(), [
                "name" => "required",
                "cash" => "required|numeric",
                "cash_used" => "required|numeric",
                "email" => "required|email",
                "role" => "required",
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with("error", $validator->errors()->first());
            }

            User::where('id', $id)->update([
                "name" => $request->name,
                "cash" => $request->cash,
                "cash_used" => $request->cash_used,
                "email" => $request->email,
                "role" => $request->role,
            ]);

            return redirect()->back()->with("success", __("system.save_success"));

        } else {
            return redirect()->route("admin.manage_users")->with("error", __("system.data_not_found"));
        }
    }

    public function cash_user(Request $request, $id)
    {

        $user = User::where('id', $id)->first();

        if ($user) {
            
            $validator = Validator::make($request->all(), [
                "type" => "required",
                "value" => "required|numeric"
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->with("error", $validator->errors()->first());
            }
    
            if ($request->type == "plus") {
                User::where('id', $id)->update([
                    "cash" => $user['cash'] + $request->value
                ]);

                return redirect()->back()->with("success", __("system.excute_success"));
            }

            if ($request->type == "minus") {
                User::where('id', $id)->update([
                    "cash" => $user['cash'] - $request->value
                ]);

                return redirect()->back()->with("success", __("system.excute_success"));
            }

            return redirect()->route("admin.manage_users")->with("error", __("system.data_not_found"));

        } else {
            return redirect()->route("admin.manage_users")->with("error", __("system.data_not_found"));
        }

    }

    public function manage_orders()
    {
        $orders = Order::orderBy("id", "desc")->paginate(15);
        return view("admin.manage.orders", compact("orders"));
    }

    public function manage_categories()
    {
        $categories = Category::orderBy("id", "desc")->paginate(5);
        return view("admin.manage.categories", compact("categories"));
    }

    public function add_category(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "icon" => "required",
            "name" => "required"
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with("error", $validator->errors()->first());
        }

        Category::insert([
            "icon" => $request->icon,
            "name" => $request->name,
        ]);

        return redirect()->back()->with("success", __("system.add_success"));
    }

    public function save_category(Request $request, $id)
    {
        $category = Category::where('id', $id)->first();

        if ($category) {
            
            $validator = Validator::make($request->all(), [
                "icon" => "required",
                "name" => "required"
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->with("error", $validator->errors()->first());
            }
    
            Category::where('id', $id)->update([
                "icon" => $request->icon,
                "name" => $request->name,
            ]);
    
            return redirect()->back()->with("success", __("system.save_success"));

        } else {
            return abort(404);
        }
    }

    public function manage_products()
    {
        $products = Product::orderBy("id", "desc")->paginate(5);
        return view("admin.manage.products", compact("products"));
    }

    public function edit_row($table, $id, $view)
    {
        $row = DB::table($table)->where('id', $id)->first();

        if ($row) {
            $row = json_decode(json_encode($row), true);
            return view($view, compact('row'));
        } else {
            return abort(404);
        }
    }

    public function save_product(Request $request, $id) {
        $product = Product::where('id', $id)->first();

        if ($product) {

            $validator = Validator::make($request->all(), [
                "name" => "required",
                "category" => "required",
                "price" => "required|numeric",
                "minimum" => "required|numeric|min:1",
                "maximum" => "required|numeric|min:1",
                "flag" => "required",
                "hot" => "required|numeric",
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with("error", $validator->errors()->first());
            }

            $category = Category::where('id', $request->category)->exists();

            if ($category) {
                if (!$request->description || empty($request->description)) {
                    $description = null;
                } else {
                    $description = $request->description;
                }
    
                Product::where('id', $id)->update([
                    "name" => $request->name,
                    "category_id" => $request->category,
                    "price" => $request->price,
                    "minimum" => $request->minimum,
                    "maximum" => $request->maximum,
                    "flag" => $request->flag,
                    "hot" => $request->hot,
                    "description" => $description
                ]);

                Account::where('product_id', $id)->update([
                    "category_id" => $request->category
                ]);

                return redirect()->back()->with("success", __("system.save_success"));
            } else {
                return redirect()->back()->with("error", __('system.data_not_found', [
                    "data" => __('product.filter_category')
                ]));
            }
        } else {
            return abort(404);
        }
    }

    public function add_product(Request $request) {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "category" => "required",
            "price" => "required|numeric",
            "minimum" => "required|numeric|min:1",
            "maximum" => "required|numeric|min:1",
            "hot" => "required|numeric",
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with("error", $validator->errors()->first());
        }

        $category = Category::where('id', $request->category)->exists();

        if ($category) {
            $description = (!$request->description || empty($request->description)) ? NULL : $request->description;
            $flag = (!$request->flag || empty($request->flag)) ? NULL : $request->flag;

            Product::insert([
                "name" => $request->name,
                "category_id" => $request->category,
                "price" => $request->price,
                "minimum" => $request->minimum,
                "maximum" => $request->maximum,
                "flag" => $flag,
                "hot" => $request->hot,
                "description" => $description
            ]);

            return redirect()->back()->with("success", __("system.add_success"));
        } else {
            return redirect()->back()->with("error", __('system.data_not_found', [
                "data" => __('product.filter_category')
            ]));
        }
    }

    public function add_product_view()
    {
        return view('admin.add.product');
    }

    public function manage_resources($product_id)
    {
        $product = Product::where('id', $product_id)->first();

        if ($product) {

            $category = Category::where('id', $product['category_id'])->first();

            if ($category) {
                $accounts_instock = Account::where('product_id', $product_id)->where('buyer', NULL)->orderBy('id', 'desc')->get();
                $accounts_sold = Account::where('product_id', $product_id)->where('buyer', '!=', NULL)->orderBy('id', 'desc')->get();

                return view('admin.manage.resources', compact('product', 'category', 'accounts_instock', 'accounts_sold'));
            } else {
                return abort(404);
            }

        } else {
            return abort(404);
        }
    }

    public function clean_sold_orders($product_id)
    {
        Order::where('product_id', $product_id)->delete();
        Account::where('product_id', $product_id)->where('buyer', '!=', NULL)->delete();
        return redirect()->back()->with("success", __("system.clean_success"));
    }

    public function add_accounts_view($product_id)
    {

        $product = Product::where('id', $product_id)->first();

        if ($product) {
            return view('admin.add.accounts', compact('product'));
        } else {
            return abort(404);
        }

    }

    public function add_accounts(Request $request, $product_id)
    {
        $product = Product::where('id', $product_id)->first();

        if ($product) {
            
            $add = 0;
            $duplicate = 0;
            $error = 0;

            $validator = Validator::make($request->all(), [
                "accounts" => "required"
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with("error", $validator->errors()->first());
            }

            foreach(explode("\n", $request->accounts) as $account) {

                $check = Account::where('content', $account)->exists();

                if (!$check) {
                    Account::insert([
                        "category_id" => $product['category_id'],
                        "product_id" => $product['id'],
                        "content" => $account,
                    ]);
    
                    $add++;
                } else {
                    $duplicate++;
                }
                
            }

            return redirect()->back()->with("success", __("system.add_account_success", [
                "add" => number_format($add),
                "duplicate" => number_format($duplicate),
                "error" => number_format($error),
            ]));

        } else {
            return abort(404);
        }
    }

    public function manage_payments()
    {
        $payments = Payment::orderBy('id', 'desc')->paginate(5);
        return view('admin.manage.payments', compact('payments'));
    }

    public function add_payment(Request $request) {
        $validator = Validator::make($request->all(), [
            "logo" => "required",
            "name" => "required",
            "number_account" => "required",
            "owner" => "required",
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $branch = empty($request->branch) ? NULL : $request->branch;
        $note = empty($request->note) ? NULL : $request->note;

        Payment::insert([
            "logo" => $request->logo,
            "name" => $request->name,
            "number_account" => $request->number_account,
            "owner" => $request->owner,
            "branch" => $branch,
            "note" => $note,
        ]);

        return redirect()->back()->with('success', __('system.add_success'));
    }

    public function view_setting($view)
    {
        return view('admin.settings.'.$view, compact('view'));
    }

    public function save_settings(Request $request) 
    {
        foreach ($request->all() as $key => $value) {
            Settings::where('name', $key)->update([
                "value" => $value
            ]);
        }
        return redirect()->back()->with("success", __("system.save_success"));
    }

    public function convert_price_currency(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            "convert" => "required"
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        if (exchangeRate($request->convert)) {
            $products = Product::all();
        
            foreach($products as $product) {
                Product::where('id', $product['id'])->update([
                    "price" => convertPriceCurrency($product['price'], $request->convert)
                ]);
            }

            return redirect()->back()->with('success', __('system.excute_success'));
        } else {
            return redirect()->back()->with('error', __('system.data_not_found'));
        }
    }

    public function set_lang(Request $request) {
        $validator = Validator::make($request->all(), [
            "lang" => "required",
            "timezone" => "required",
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        if (in_array($request->lang, [ "en", "vi" ])) {
            update_env([ 
                'APP_LOCALE' => $request->lang,
                'APP_TIMEZONE' => $request->timezone
            ]);
            return redirect()->back()->with("success", __("system.save_success"));
        } else {
            return redirect()->back()->with('error', __('system.data_not_found'));
        }
    }

}
