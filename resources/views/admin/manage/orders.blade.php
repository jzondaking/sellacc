@extends('templates.admin')
@section('title', __('admin.manage_orders'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang("admin.manage_orders")</h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="@lang("admin.find_order")">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th width="1%">@lang('orders.created_time')</th>
                            <th width="1%">@lang('orders.code')</th>
                            <th width="40%">@lang('orders.product_name')</th>
                            <th>@lang('orders.quantity')</th>
                            <th>@lang('orders.total_pay')</th>
                            <th>@lang('orders.buyer')</th>
                            <th width="1%">@lang('orders.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $o)

                        @php
                            $product = json_decode($o['product'], true);
                        @endphp
                            
                        <tr>
                            <td class="align-middle bold">
                                {{ date('Y-m-d H:i:s', strtotime($o['created_at'])) }}
                            </td>

                            <td class="align-middle bold">
                                <a href="{{ route('orders.details', [ $o['code'] ]) }}">
                                    {{ $o['code'] }}
                                </a>
                            </td>
        
                            <td class="align-middle bold">
                                {{ $product['name'] }}
                            </td>
        
                            <td class="align-middle bold" style="color: blue;">
                                {{ number_format($o['quantity']) }}
                            </td>
        
                            <td class="align-middle text-danger bold">
                                {{ displayCash($o['total_pay']) }}
                            </td>

                            <td>
                                <input type="text" class="form-control form-control-sm" value="{{ $o['buyer'] }}" readonly>
                            </td>
        
                            <td class="align-middle">
                                <a style="text-transform: uppercase;" href="{{ route('orders.details', [ $o['code'] ]) }}" class="btn btn-success" target="_blank">
                                    <i class="fas fa-eye"></i> @lang('orders.details')
                                </a>

                                <a href="{{ route('admin.delete_row', [ "orders", $o['id'], "redirect" => route("admin.manage_orders") ]) }}" class="btn btn-danger">
                                    @lang("system.action_delete")
                                </a>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                {!! $orders->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
</div>


@endsection