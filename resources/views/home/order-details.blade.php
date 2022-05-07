@extends('templates.client')

@section('content')

<style>
    .details-item {
        font-weight: normal!important;
        margin-bottom: 10px;
    }

    @media only screen and (max-width: 600px) {
        .mobile_margin {
            margin-bottom: 1.25rem!important;
        }
    }

    .order-value {
        display: flex;
    }

    .order-value .value {
        margin-left: auto;
    }
</style>

<div class="row">
    <div class="col-lg-12 mb-3">
        <div class="card">
            <div class="card-header bg-white py-4">
                <h4 class="bold">
                    @lang('orders.order_details') #{{ $order['code'] }}
                </h4>
                <span style="margin-bottom: -4px;">
                    @lang('orders.message_under_order_details')
                </span>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 mobile_margin">
                        <h4 style="margin-bottom: 20px;" class="bold">@lang('orders.order_information')</h4>
                        <h5 class="details-item">
                            <b>@lang('orders.code'):</b> #{{ $order['code'] }}
                        </h5>
                        <h5 class="details-item">
                            <b>@lang('orders.created_time'):</b> {{ date('Y-m-d H:i:s', strtotime($order['created_at'])) }}
                        </h5>
                        <h5 class="details-item">
                            <b>@lang('orders.status'):</b> <span class="badge bg-success">Purchased</span>
                        </h5>
                        <h5 class="details-item">
                            <b>@lang('orders.buyer'):</b> {{ $order['buyer'] }}
                        </h5>
                    </div>

                    <div class="col-lg-3">
                        <h4 style="margin-bottom: 20px;" class="bold">@lang('orders.order_value')</h4>
                        
                        <h5 class="details-item order-value">
                            <b>@lang('orders.quantity'):</b>
                            <span class="value bold" style="color: blue;">{{ $order['quantity'] }}</span>
                        </h5>
                        <h5 class="details-item order-value">
                            <b>@lang('orders.price'):</b>
                            <span class="value bold" style="color: red;">{{ $product['price'] }}</span>
                        </h5>
                        <h5 class="details-item order-value">
                            <b>@lang('orders.total_pay'):</b>
                            <span class="value text-success bold">{{ displayCash($order['total_pay']) }}</span>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <label for="textarea-input" class="form-label bold">@lang('product.purchase_order_details'):</label>
                <textarea class="form-control" rows="15" id="accounts" readonly>{{ $accounts }}</textarea>
                
                <div style="text-align: center; margin-top: 15px;">
                    <button class="btn btn-warning" onclick="copy()">
                        <i class="fa-solid fa-copy"></i> @lang('system.copy')
                    </button>
                    <button class="btn btn-danger" onclick="download_txt()">
                        <i class="fa-solid fa-file-arrow-down"></i> @lang('system.download') .txt
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function copy() {
        var copyText = document.getElementById("accounts");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);
    }

    function download_txt() {
        var textcontent = document.getElementById("accounts").value;
        var downloadableLink = document.createElement('a');
        downloadableLink.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(textcontent));
        downloadableLink.download = "{{ $order['code'] }}" + ".txt";
        document.body.appendChild(downloadableLink);
        downloadableLink.click();
        document.body.removeChild(downloadableLink);
    }
</script>
@endsection