@extends('templates.client')

@section('content')

<style>
    .jzon-badge-13 {
        font-size: 13px;
    }

    @media screen and (min-width: 800px) {
        .filter-products {
            margin-bottom: -1rem!important;
        }
    }
</style>

<div class="modal" id="result_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4 bold text-success">
                    <i class="fa-solid fa-circle-check"></i> @lang('product.purchase_success')
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="quick_display_order_code">

                <label for="textarea-input" class="form-label bold">@lang('product.purchase_order_details'):</label>
                <textarea class="form-control" rows="15" id="purchase_details" readonly></textarea>

                <div style="text-align: center; margin-top: 15px;">
                    <button class="btn btn-warning" onclick="copy()">
                        <i class="fa-solid fa-copy"></i> @lang('system.copy')
                    </button>
                    <button class="btn btn-danger" onclick="download_txt()">
                        <i class="fa-solid fa-file-arrow-down"></i> @lang('system.download') .txt
                    </button>
                </div>

                <script>
                    function copy() {
                        var copyText = document.getElementById("purchase_details");
                        copyText.select();
                        copyText.setSelectionRange(0, 99999);
                        navigator.clipboard.writeText(copyText.value);
                    }
                
                    function download_txt() {
                        var textcontent = document.getElementById("purchase_details").value;
                        var downloadableLink = document.createElement('a');
                        downloadableLink.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(textcontent));
                        downloadableLink.download = $("#quick_display_order_code").val() + ".txt";
                        document.body.appendChild(downloadableLink);
                        downloadableLink.click();
                        document.body.removeChild(downloadableLink);
                    }
                </script>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 text-center mb-6">
        <h1 style="margin-bottom: 3px; color: white; font-weight: bold;">
            {{ setting('client_title_banner') }}
        </h1>
        <span class="badge bg-light" style=" color: black; font-size: 14px; margin-top: 5px; ">
            {{ setting('client_description_banner') }}
        </span>
    </div>

    <div class="col-lg-1"></div>
    <div class="col-lg-10 mb-3">
        <div class="card">
            <div class="card-body" style="margin-bottom: -4px; display: flex; color: #dd4135!important;">
                <i class="fa-solid fa-bell" style="font-size: 25px; margin-top: 3px; margin-right: 15px;"></i>
                <marquee direction="left" onmouseover="this.stop();" onmouseout="this.start();" behavior="scroll" scrollamount="6" style="text-transform: uppercase; font-weight: bold; font-size: 21px;">
                    {{ setting('marquee_nofication') }}
                </marquee>
            </div>
        </div>
    </div>
    <div class="col-lg-1"></div>

    <div class="col-lg-1"></div>
    <div class="col-lg-10 mb-3">
        <div class="card">
            <div class="card-body filter-products">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="input-group">
                            <span class="input-group-text" id="inputGroupPrepend">
                                <i class="fa-solid fa-square-poll-horizontal" style="margin-right: 5px;"></i> @lang('product.filter_category')
                            </span>
                            <select name="filter_category" id="" class="form-control" onchange="filterProduct()">
                                <option value="">@lang('product.select_category')</option>
                                @foreach (App\Models\Category::all() as $filter_category)
                                <option value="{{ $filter_category['id'] }}">👉 {{ $filter_category['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="input-group">
                            <span class="input-group-text" id="inputGroupPrepend">
                                <i class="fa-solid fa-money-bill" style="margin-right: 5px;"></i> @lang('product.filter_price')
                            </span>
                            <select name="filter_price" id="" class="form-control" onchange="filterProduct()">
                                <option value="">@lang('product.select_price')</option>
                                <option value="low_high">👉 @lang('product.price_low_to_high')</option>
                                <option value="high_low">👉 @lang('product.price_high_to_low')</option>
                            </select>
                        </div>
                        
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="input-group">
                            <span class="input-group-text" id="inputGroupPrepend">
                                <i class="fa-solid fa-chart-column" style="margin-right: 5px;"></i> @lang('product.filter_trend')
                            </span>
                            <select name="filter_trend" id="" class="form-control" onchange="filterProduct()">
                                <option value="">@lang('product.select_trend')</option>
                                <option value="hot">🔥 @lang('product.hot')</option>
                                <option value="many_buyers">📈 @lang('product.many_buyers')</option>
                                <option value="less_buyers">📉 @lang('product.less_buyers')</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text" id="inputGroupPrepend">
                                <i class="fa-solid fa-signal" style="margin-right: 5px;"></i> @lang('product.filter_status')
                            </span>
                            <select name="filter_status" id="" class="form-control" onchange="filterProduct()">
                                <option value="">@lang('product.select_status')</option>
                                <option value="available">🟢 @lang('product.status_available')</option>
                                <option value="out_of_stock">🔴 @lang('product.status_out_of_stock')</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-1"></div>
    
    <div class="col-md-1"></div>
        <div class="col-md-10 col-12" id="products">
            <img src="/client/assets/images/svg/loading_1.svg" alt="" style="display: block; margin: 0 auto;">
        </div>
    <div class="col-md-1"></div>
</div>

<script>
    $(function() {
        filterProduct()
    })

    function calculateTotalPay(data) {
        var product_id = $(data).attr('data-product-id')
        
        $.ajax({
            type: "POST",
            url: "{{ route('product.calculate_total_pay') }}",
            data: {
                product_id,
                quantity: $("#quantity_" + product_id).val(),
                _token: "{{ csrf_token() }}"
            },
            dataType: "json",
            beforeSend: function() {
                $(".btn-purchase").attr('disabled', 'disabled')
                $(".loading").show()
            },
            success: function (response) {
                $(".btn-purchase").removeAttr('disabled')
                $(".loading").hide()

                if (response.success) {
                    Swal.fire({
                        title: "{{ __('system.swal_title_success') }}",
                        html: response.message,
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: '{{ __("system.swal_btn_close") }}'
                    })
                } else {
                    Swal.fire({
                        title: "{{ __('system.swal_title_failed') }}",
                        text: response.message,
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: '{{ __("system.swal_btn_close") }}'
                    })
                }
            }
        });
    }

    function filterProduct(p_id) {
        $.ajax({
            type: "POST",
            url: "{{ route('filter.products') }}",
            data: {
                category: $("select[name='filter_category']").val(),
                price: $("select[name='filter_price']").val(),
                trend: $("select[name='filter_trend']").val(),
                status: $("select[name='filter_status']").val(),
                _token: "{{ csrf_token() }}"
            },
            dataType: "text",
            beforeSend: function() {
                $(".loading").show()
            },
            success: function (response) {
                $("#products").html(response)
                $(".loading").hide()
            }
        });
    }

    function successPurchaseSound(){
        var volume = localStorage.getItem("volume");
        var isVolumeOn= true;

        if(volume != null && volume == "off"){
            isVolumeOn= false;
        }
        
        if(isVolumeOn){
            var audio = new Audio('public/audio/purchase_success.mp3');
            audio.play();
        }
    }

    function purchase(data) {
        var product_id = $(data).attr('data-product-id')

        $.ajax({
            type: "POST",
            url: "{{ route('product.purchase') }}",
            data: {
                product_id,
                quantity: $("#quantity_" + product_id).val(),
                _token: "{{ csrf_token() }}"
            },
            dataType: "json",
            beforeSend: function() {
                $(".btn-purchase").attr('disabled', 'disabled')
                $(".loading").show()
            },
            success: function (response) {
                $(".btn-purchase").removeAttr('disabled')
                $(".loading").hide()

                if (response.success) {
                    $("#quick_display_order_code").val(response.code)

                    var result = "";
                    
                    (response.details).forEach(d => {
                        result += `${d}\n`
                    });

                    $("#purchase_details").val(result)
                    successPurchaseSound()

                    $("#result_modal").modal('show')

                } else {

                    Swal.fire({
                        title: "{{ __('system.swal_title_failed') }}",
                        text: response.message,
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: '{{ __("system.swal_btn_close") }}'
                    })
                    
                }
            }
        });
    }

    $('#result_modal').on('hidden.bs.modal', function (e) {
        window.location.reload()
    })
</script>

@endsection