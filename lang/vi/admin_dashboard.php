<?php

use Illuminate\Support\Carbon;

return [
    "total_users" => "Người dùng",
    "total_customers" => "Khách hàng",
    "total_clones" => "Khách vãng lai",
    "today_registrations" => "Đăng kí hôm nay",
    "total_account_instock" => "Tài khoản tồn kho",
    "total_account_sold" => "Tài khoản đã bán",
    "today_revenue" => "Doanh thu hôm nay",
    "month_revenue" => "Doanh thu tháng ".Carbon::now()->format('m'),
    "log_table" => "Nhật kí hoạt động người dùng",
];