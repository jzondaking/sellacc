@foreach ($list_category as $category)
<div class="card mb-3">
    <!-- card header  -->
    <div class="card-header bg-white py-4">
        <h4 style="margin-bottom: -4px;">
            <img src="{{ $category['icon'] }}" alt="" style="width: 30px; margin-right: 5px;">
            <span style="font-size: 22px; vertical-align: middle;">{{ $category['name'] }}</span>
        </h4>
    </div>
    <!-- table  -->
    <div class="table-responsive">
        <table class="table text-nowrap mb-0">
            <thead class="table-light">
                <tr>
                    <th width="50%">@lang('product.name')</th>
                    <th>@lang('product.in_stock')</th>
                    <th>@lang('product.sold')</th>
                    <th>@lang('product.price')</th>
                    <th width="1%">@lang('product.quantity_buy')</th>
                    <th width="1%">@lang('product.action')</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $product_q = App\Models\Product::query();

                    $product_q->where('category_id', $category['id']);

                    if ($request->has('trend') && !empty($request->trend)) {
                        if ($request->trend == 'less_buyers') {
                            $product_q->orderBy('sold', 'asc');
                        }

                        if ($request->trend == 'most_buyers') {
                            $product_q->orderBy('sold', 'desc');
                        }

                        if ($request->trend == 'hot') {
                            $product_q->orderBy('hot', 'desc');
                        }
                    }

                    if ($request->has('price') && !empty($request->price)) {
                        if ($request->price == 'low_high') {
                            $product_q->orderBy('price', 'asc');
                        }

                        if ($request->price == 'high_low') {
                            $product_q->orderBy('price', 'desc');
                        }
                    } else {
                        $product_q->orderBy('id', 'desc');
                    }

                    $list_product = $product_q->get();

                    if ($request->has('status') && !empty($request->status)) {
                        $i = 0;

                        foreach ($list_product as $__product) {
                            if ($request->status == 'available') {
                                if (count(App\Models\Account::where('product_id', $__product['id'])->where('buyer', NULL)->get()) <= 0) {
                                    unset($list_product[$i]);
                                }
                            }

                            if ($request->status == 'out_of_stock') {
                                if (count(App\Models\Account::where('product_id', $__product['id'])->where('buyer', NULL)->get()) > 0) {
                                    unset($list_product[$i]);
                                }
                            }
                            
                            $i++;
                        }
                        
                    }
                @endphp

                @foreach ($list_product as $product)
                <tr>
                    <td class="align-middle">
                        <h5 class="mb-1">
                            <a href="javascript:;" class="text-inherit" id="product_name_{{ $product['id'] }}" data-bs-toggle="tooltip" data-placement="top" title="{{ $product['description'] }}">
                                @if ($product['flag'])
                                <img src="/public/images/flags/{{ strtolower($product['flag']) }}.svg"  style="width: 30px; vertical-align: bottom; margin-right: 3px;" alt="">
                                @endif

                                {{ $product['name'] }}

                                @if ($product['hot'] == 1)
                                <img src="/public/images/hot.gif" alt="">
                                @endif
                            </a>
                        </h5>
                    </td>

                    <script>
                        $("#product_name_{{ $product['id'] }}").tooltip()
                    </script>

                    <td class="align-middle">
                        <span class="badge bg-success jzon-badge-13">
                            {{ number_format(count(App\Models\Account::where('buyer', NULL)->where('category_id', $category['id'])->where('product_id', $product['id'])->get())) }}
                        </span>
                    </td>
                    <td class="align-middle">
                        <span class="badge bg-danger jzon-badge-13">
                            {{ number_format($product['sold']) }}
                        </span>
                    </td>
                    <td class="align-middle">
                        <span class="badge bg-primary jzon-badge-13">
                            {{ displayCash($product['price']) }}
                        </span>
                    </td>
                    <td class="align-middle">
                        <input type="number" class="form-control" id="quantity_{{ $product['id'] }}" @if (count(App\Models\Account::where('product_id', $product['id'])->where('buyer', NULL)->get()) <= 0) disabled @endif>
                        <a href="javascript:;" data-product-id="{{ $product['id'] }}" onclick="calculateTotalPay(this)">
                            <span class="badge bg-success text-center">
                                @lang('product.calculate_total_pay')
                            </span>
                        </a>
                    </td>
                    <td class="align-middle">
                        @if (count(App\Models\Account::where('product_id', $product['id'])->where('buyer', NULL)->get()) <= 0)
                        <button class="btn btn-danger" disabled>
                            <i class="fa-solid fa-xmark"></i> @lang('product.sold_out_btn')
                        </button>
                        @else
                        <button class="btn btn-warning btn-purchase" data-product-id="{{ $product['id'] }}" @if (Auth::check()) onclick="purchase(this)" @else onclick="window.location.href = '{{ route('account.login') }}'" @endif>
                            <i class="fa-solid fa-cart-shopping"></i> @lang('product.purchase_btn')
                        </button>
                        @endif
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>
@endforeach