@extends('templates.admin')
@section('title', __('admin.manage_products'))

@section('content')
<div class="row">

    <div class="col-lg-12" style="margin-bottom: 10px;">
        <a class="btn btn-primary" href="{{ route('admin.add_product_view') }}">
            <i class="fas fa-plus-circle"></i> @lang('admin.add_product')
        </a>
    </div>

    @foreach (App\Models\Category::orderBy('id', 'desc')->get() as $category)
    <div class="col-lg-12">
        <div class="card collapsed-card">
            <div class="card-header">
                <h3 class="card-title">
                    <img src="{{ $category['icon'] }}" alt="" style="width: 30px; margin-right: 5px;">
                    <span style="font-size: 22px; vertical-align: middle;">{{ $category['name'] }}</span> 
                    <span class="badge badge-danger" style="margin-left: 5px;">@lang('product.products', [
                        "total" => number_format(count(App\Models\Product::where('category_id', $category['id'])->get()))
                    ])</span>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th width="50%">@lang('product.name')</th>
                            <th>@lang('product.in_stock')</th>
                            <th>@lang('product.sold')</th>
                            <th>@lang('product.price')</th>
                            <th width="1%">@lang('product.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (App\Models\Product::where('category_id', $category['id'])->get() as $product)
                        
                        <tr>
                            <td class="">
                                <h5 class="mb-1">
                                    <a href="javascript:;" class="text-inherit" id="product_name_{{ $product['id'] }}" data-toggle="tooltip" data-placement="top" title="{{ $product['description'] }}">
                                        @if ($product['flag'])
                                        <img src="/public/images/flags/{{ $product['flag'] }}.svg"  style="width: 30px; vertical-align: bottom; margin-right: 3px;" alt="">
                                        @endif
        
                                        {{ $product['name'] }}
        
                                        @if ($product['hot'] == 1)
                                        <img src="/public/images/hot.gif" alt="">
                                        @endif
                                    </a>
                                </h5>
                            </td>
        
                            <script>
                                $(function() {
                                    $("#product_name_{{ $product['id'] }}").tooltip()
                                })
                            </script>
        
                            <td class="">
                                <span class="badge badge-success">
                                    {{ number_format(count(App\Models\Account::where('buyer', NULL)->where('category_id', $product['category_id'])->where('product_id', $product['id'])->get())) }}
                                </span>
                            </td>
                            <td class="">
                                <span class="badge badge-danger">
                                    {{ number_format($product['sold']) }}
                                </span>
                            </td>
                            <td class="">
                                <span class="badge badge-warning">
                                    {{ displayCash($product['price']) }}
                                </span>
                            </td>
                            <td class="">
                                <a class="btn btn-primary" href="{{ route("admin.edit_row", [ 'products', $product['id'], 'admin.edit.product' ]) }}">
                                    @lang("system.action_edit")
                                </a>
                                <a href="{{ route('admin.delete_row', [ "products", $product['id'], "redirect" => route("admin.manage_products") ]) }}" class="btn btn-danger">
                                    @lang("system.action_delete")
                                </a>
                                <a href="{{ route('admin.manage_resources', [ $product['id'] ]) }}" class="btn btn-warning">
                                    @lang('product.resources')
                                </a>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>  
    @endforeach

    
</div>


@endsection