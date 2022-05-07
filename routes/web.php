<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\ExtensionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware([ "xss", "active_user" ])->group(function () {
    Route::get("/", [ HomeController::class, "index" ])->name("home.index");

    Route::prefix("/filter")->group(function () {
        Route::post("/products", [ ProductController::class, "filter" ])->name("filter.products");
    });

    Route::post("/purchase", [ ProductController::class, "purchase" ])->name("product.purchase");
    Route::post("/calculate-total-pay", [ ProductController::class, "calculate_total_pay" ])->name("product.calculate_total_pay");

    Route::middleware("guest")->group(function() {
        Route::get("/login", [ AccountController::class, "login" ])->name("account.login");
        Route::post("/login", [ AccountController::class, "doLogin" ])->name("account.doLogin");

        Route::get("/register", [ AccountController::class, "register" ])->name("account.register");
        Route::post("/register", [ AccountController::class, "doRegister" ])->name("account.doRegister");
    });

    Route::middleware("auth")->group(function() {
        Route::get("/deposit", [ DepositController::class, "index" ])->name("deposit.index");

        Route::get("/orders", [ OrderController::class, "index" ])->name("orders.index");
        Route::get("/orders/{code}", [ OrderController::class, "details" ])->name("orders.details");

        Route::get("/profile", [ AccountController::class, "profile" ])->name("account.profile");
        Route::get("/change-password", [ AccountController::class, "change_password" ])->name("account.change_password");
        Route::post("/change-password", [ AccountController::class, "doChangePassword" ])->name("account.doChangePassword");
        Route::get("/logout", [ AccountController::class, "logout" ])->name("account.logout");
    
        Route::post("/payment-details", [ DepositController::class, "paymentDetails" ])->name("deposit.payment_details");
    });

    Route::prefix("/extension")->group(function() {
        Route::get("/authenticator", [ ExtensionController::class, "authenticator" ])->name("extension.authenticator");
        Route::get("/check-live-fb-uids", [ ExtensionController::class, "check_live_fb_uids" ])->name("extension.check_live_fb_uids");
    });

    Route::prefix("/admin")->middleware("admin")->group(function() {
        Route::get("/dashboard", [ AdminController::class, "dashboard" ])->name("admin.dashboard");
        
        Route::post("/set-lang", [ AdminController::class, "set_lang" ])->name("admin.set_lang");

        Route::get("/delete-row/{table}/{id}", [ AdminController::class, "delete_row" ])->name("admin.delete_row");
        Route::get("/edit-row/{table}/{id}/{view}", [ AdminController::class, "edit_row" ])->name("admin.edit_row");
        
        Route::prefix("/manage")->group(function() {
            Route::get("/users", [ AdminController::class, "manage_users" ])->name("admin.manage_users");
            Route::get("/orders", [ AdminController::class, "manage_orders" ])->name("admin.manage_orders");
            Route::get("/categories", [ AdminController::class, "manage_categories" ])->name("admin.manage_categories");
            Route::get("/products", [ AdminController::class, "manage_products" ])->name("admin.manage_products");
            Route::get("/resource/{product_id}", [ AdminController::class, "manage_resources" ])->name("admin.manage_resources");
            Route::get("/payments", [ AdminController::class, "manage_payments" ])->name("admin.manage_payments");
        });

        Route::get("/setting/{view}", [ AdminController::class, "view_setting" ])->name("admin.view_setting");
        Route::post("/save-settings", [ AdminController::class, "save_settings" ])->name("admin.save_settings");
        Route::post("/convert-price-currency", [ AdminController::class, "convert_price_currency" ])->name("admin.convert_price_currency");

        Route::prefix("/add")->group(function() {
            Route::post("/category", [ AdminController::class, "add_category" ])->name("admin.add_category");
            Route::get("/product", [ AdminController::class, "add_product_view" ])->name("admin.add_product_view");
            Route::post("/product", [ AdminController::class, "add_product" ])->name("admin.add_product");
            Route::get("/accounts/{product_id}", [ AdminController::class, "add_accounts_view" ])->name("admin.add_accounts_view");
            Route::post("/accounts/{product_id}", [ AdminController::class, "add_accounts" ])->name("admin.add_accounts");
            Route::post("/payment", [ AdminController::class, "add_payment" ])->name("admin.add_payment");
        });

        Route::prefix("/edit")->group(function() {
            Route::get("/user/{id}", [ AdminController::class, "edit_user" ])->name("admin.edit_user");
            Route::get("/category/{id}", [ AdminController::class, "edit_category" ])->name("admin.edit_category");
            Route::get("/product/{id}", [ AdminController::class, "edit_product" ])->name("admin.edit_product");
        });

        Route::prefix("/save")->group(function() {
            Route::post("/user/{id}", [ AdminController::class, "save_user" ])->name("admin.save_user");
            Route::post("/category/{id}", [ AdminController::class, "save_category" ])->name("admin.save_category");
            Route::post("/product/{id}", [ AdminController::class, "save_product" ])->name("admin.save_product");
        });

        Route::post("/cash/user/{id}", [ AdminController::class, "cash_user" ])->name("admin.cash_user");
        Route::get("/clean-sold-orders/{product_id}", [ AdminController::class, "clean_sold_orders" ])->name("admin.clean_sold_orders");
    });
});