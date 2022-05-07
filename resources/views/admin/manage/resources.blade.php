@extends('templates.admin')
@section('title', __('admin.manage_resources'))

@section('content')

@php

    $raw_instock = "";
    foreach ($accounts_instock as $ait) {
        $raw_instock .= $ait['content']."\n";
    }

    $raw_sold = "";
    foreach ($accounts_sold as $as) {
        $raw_sold .= $as['content']."\n";
    }

@endphp

<div class="row">
    <div class="col-lg-12" style="margin-bottom: 10px;">
        <a class="btn btn-primary" href="{{ route('admin.add_accounts_view', $product['id']) }}">
            <i class="fas fa-plus-circle"></i> @lang('admin.add_accounts')
        </a>
    </div>
    
    <div class="col-lg-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">@lang('product.in_stock')</h3>
            </div>
            
            <div class="card-body">
                <div class="form-group">
                    <textarea class="form-control" cols="30" rows="10" readonly id="instock">{{ $raw_instock }}</textarea>
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-success" onclick="copyRaw('instock')">
                        <i class="fas fa-copy"></i> @lang('system.copy')
                    </button>
                    <button class="btn btn-success" onclick="download_txt('instock')">
                        <i class="fas fa-download"></i> @lang('system.download') .txt
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">@lang('product.sold')</h3>
            </div>
            
            <div class="card-body">
                <div class="form-group">
                    <textarea class="form-control" cols="30" rows="10" readonly id="sold">{{ $raw_sold }}</textarea>
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-danger" onclick="copyRaw('sold')">
                        <i class="fas fa-copy"></i> @lang('system.copy')
                    </button>
                    <button class="btn btn-danger" onclick="download_txt('sold')">
                        <i class="fas fa-download"></i> @lang('system.download') .txt
                    </button>
                    <a class="btn btn-danger" href="{{ route('admin.clean_sold_orders', [ $product['id'] ]) }}">
                        <i class="fas fa-trash-alt"></i> @lang('system.clean')
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function copyRaw(id) {
        var copyText = document.getElementById(id);
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);
    }

    function download_txt(id) {
        var textcontent = document.getElementById(id).value;
        var downloadableLink = document.createElement('a');
        downloadableLink.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(textcontent));
        downloadableLink.download = Date.now() + ".txt";
        document.body.appendChild(downloadableLink);
        downloadableLink.click();
        document.body.removeChild(downloadableLink);
    }
</script>

@endsection