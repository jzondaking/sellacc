@extends('templates.client')

@section('content')
<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <div class="card">
            <div class="card-header bg-white py-4">
                <h4 style="margin-bottom: -4px;">
                    @lang('sidebar.orders')
                </h4>
            </div>

            <div class="table-responsive">
                <table class="table text-nowrap mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="1%">@lang('orders.created_time')</th>
                            <th width="1%">@lang('orders.code')</th>
                            <th width="40%">@lang('orders.product_name')</th>
                            <th>@lang('orders.quantity')</th>
                            <th>@lang('orders.total_pay')</th>
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
        
                            <td class="align-middle">
                                <a href="{{ route('orders.details', [ $o['code'] ]) }}" class="btn btn-success">
                                    <i class="fa-solid fa-eye"></i> @lang('orders.details')
                                </a>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {!! $orders->links('pagination::bootstrap-5') !!}
    </div>
    <div class="col-lg-1"></div>
</div>
@endsection