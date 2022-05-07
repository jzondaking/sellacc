@extends('templates.client')

@section('content')

<style>
    .bank-holder {
        border: #7e8083 solid; border-radius: 10px; padding: 10px; padding-bottom: 0; width: 23%; margin-bottom: 15px;
    }
    
    .mr-14px {
        margin-right: 14px;
    }

    .payment_logo {
        width: 20%;
    }

    @media only screen and (max-width: 912px) {
        .bank-holder {
            width: 100%;
        }

        .rowz {
            display: block;
            margin-right: 3px;
        }

        .payment_logo {
            width: 50%;
        }
    }

    .bank-holder:hover {
        background: #d2d2d2;
        cursor: pointer;
    }

    .content-box {
        background-color: #08457E; color: yellow; padding-top: 15px; padding-bottom: 15px; text-align: center; border-radius: 15px; font-size: 20px; font-weight: bold; margin-top: 20px;
    }

    .content-box h5 {
        color: #DEE6ED;
        margin-bottom: -1px;
    }

    .content-box:hover {
        cursor: pointer;
        color: #CFFD58;
    }
</style>

<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        <div class="card mb-5">
            <div class="card-body">
                <div class="choice_title">
                    <h3 style="font-weight: bold; text-align: center; margin-bottom: 15px; color: #3a34eb; text-transform: uppercase;">@lang('deposit.choice_title')</h3>
                </div>
                <div class="row rowz" style="margin-left: 3px;">
                    @foreach (App\Models\Payment::orderBy('id', 'desc')->get() as $payment)
                    <div class="col-lg-3 mr-14px text-center bank-holder" data-payment="{{ $payment['id'] }}">
                        <img src="{{ $payment['logo'] }}" style="width: 55%;">
                        <h4 class="mt-2">{{ $payment['name'] }}</h4>
                    </div>
                    @endforeach
                </div>

                <div class="row payment-card" style="display: none;">
                    <div class="col-lg-12">
                        
                        <button class="btn btn-warning" style="display: block; margin: 0 auto; margin-bottom: 20px;" onclick="$('.rowz').show(); $('.payment-card').hide(); $('.choice_title').show()">
                            <i class="fa-solid fa-circle-arrow-left" style="margin-right: 5px;"></i> @lang('deposit.back')
                        </button>

                        <img src="" id="payment_logo" style="margin: 0 auto; display: block; margin-bottom: 20px;" class="payment_logo" alt="">

                        <table class="table table-striped table-bordered" style="word-break: break-all;">
                            <tbody>
                                <tr>
                                    <td width="50%" class="bold">
                                        <i class="fa-solid fa-building-columns" style="margin-right: 5px;"></i> @lang('deposit.payment_name')
                                    </td>
                                    <td width="50%" id="payment_name">
                                        <span class="badge bg-danger">None</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%" class="bold">
                                        <i class="fa-solid fa-user" style="margin-right: 5px;"></i> @lang('deposit.owner')
                                    </td>
                                    <td width="50%" id="payment_owner">
                                        <span class="badge bg-danger">None</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%" class="bold">
                                        <i class="fa-solid fa-hashtag" style="margin-right: 5px;"></i> @lang('deposit.number_account')
                                    </td>
                                    <td width="50%" id="payment_number_account">
                                        <span class="badge bg-danger">None</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%" class="bold">
                                        <i class="fa-solid fa-earth-asia" style="margin-right: 5px;"></i> @lang('deposit.branch')
                                    </td>
                                    <td width="50%" id="payment_branch">
                                        <span class="badge bg-danger">None</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="content-box" copy-text="{{ setting('deposit_prefix') }} {{ Auth::user()->id }}">
                            <h5>@lang("deposit.content")</h5>
                            {{ setting('deposit_prefix') }} {{ Auth::user()->id }} <i class="fa-solid fa-copy" style="margin-left: 5px;"></i>
                        </div>
                        
                        <div class="alert alert-danger mt-4" id="payment_note">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3"></div>
</div>

<script>
    $("div[copy-text]").on('click', function() {
        copyText($(this).attr('copy-text'))

        Swal.fire({
            title: "{{ __('system.swal_title_success') }}",
            text: "{{ __('system.copied') }}",
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: '{{ __("system.swal_btn_close") }}'
        })
    })

    $("div[data-payment]").on('click', function() {
        var id = $(this).data('payment')
        
        $.ajax({
            type: "POST",
            url: "{{ route('deposit.payment_details') }}",
            data: {
                id,
                _token: "{{ csrf_token() }}"
            },
            dataType: "json",
            beforeSend: function() {
                $(".loading").show()
            },
            success: function (response) {
                $("#payment_name").html(response.data.name)
                $("#payment_owner").html(response.data.owner)
                $("#payment_number_account").html(response.data.number_account)
                $("#payment_note").html(response.data.note)
                $("#payment_logo").removeAttr('src').attr('src', response.data.logo)
                
                if (response.data.branch) {
                    $("#payment_branch").html(response.data.branch)
                }

                $(".loading").hide()
                $(".rowz").hide()
                $(".choice_title").hide()

                $(".payment-card").show()
            }
        });
    })
</script>
@endsection