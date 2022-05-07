@extends('templates.client')

@section('content')
<style>
    @media only screen and (max-width: 600px) {
        .nav-lt-tab {
            display: block!important;
        }
    }
</style>

<div class="row align-items-center">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
        <!-- Bg -->
        <div class="pt-20 rounded-top" style="background: url(/client/assets/images/background/profile-cover-2.png) no-repeat; background-size: cover;"></div>
        <div class="bg-white rounded-bottom smooth-shadow-sm">
            <div class="d-flex align-items-center justify-content-between pt-4 pb-6 px-4">
                <div class="d-flex align-items-center">
                    <!-- avatar -->
                    <div class="avatar-xxl avatar-indicators avatar-online me-2 position-relative d-flex justify-content-end align-items-end mt-n10">
                        <img src="/client/assets/images/avatar/avatar-1.jpg" class="avatar-xxl rounded-circle border border-4 border-white-color-40" alt="" />
                        <a href="#!" class="position-absolute top-0 right-0 me-2" data-bs-toggle="tooltip" data-placement="top" title="" data-original-title="Verified">
                            <img src="/client/assets/images/svg/checked-mark.svg" alt="" height="30" width="30" />
                        </a>
                    </div>
                    <!-- text -->
                    <div class="lh-1">
                        <h2 class="mb-0">
                            {{ Auth::user()->name }}
                            <a href="#!" class="text-decoration-none" data-bs-toggle="tooltip" data-placement="top" title="" data-original-title="Beginner"> </a>
                        </h2>
                        <p class="mb-0 d-block">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>

            <ul class="nav nav-lt-tab px-4">
                <li class="nav-item">
                    <a class="nav-link" href="#">@lang('account.profile_cash'): <b class="text-success">{{ displayCash(Auth::user()->cash) }}</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">@lang('account.profile_cash_used'): <b class="text-danger">{{ displayCash(Auth::user()->cash_used) }}</b></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">@lang('account.profile_total_order'): <b class="text-primary">{{ number_format(count(App\Models\Order::where('buyer', Auth::user()->email)->get())) }}</b></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">@lang('account.profile_created_at'): <b class="text-info">{{ date('Y-m-d H:i:s') }}</b></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">@lang('account.last_ip'): <b class="text-danger">{{ Auth::user()->last_ip }}</b></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- content -->
<div class="py-6">
    <!-- row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- card -->
            <div class="card">
                <!-- card body -->
                <div class="card-header bg-white py-4">
                    <!-- card title -->
                    <h4 style="margin-bottom: -4px;">@lang('header.activity')</h4>
                </div>

                <div class="table-responsive">
                    <table class="table text-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="1%">@lang("account.log_created_at")</th>
                                <th width="50%">@lang("account.log_content")</th>
                                <th>@lang("account.log_balance_changes")</th>
                                <th>@lang("account.log_ip")</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($logs as $log)
                            <tr>
                                <td class="align-middle bold">
                                    {{ date('Y-m-d H:i:s', strtotime($log['created_at'])) }}
                                </td>
                                <td class="align-middle">
                                    {{ $log['content'] }}
                                </td>
                                <td class="align-middle">
                                    @if ($log['balance'])
                                    
                                    @php
                                        if (Illuminate\Support\Str::contains($log['balance'], '-')) {
                                            $cash_original = explode(' - ', $log['balance'])[0];
                                            $cash_affect = explode(' - ', $log['balance'])[1];
                                            $cash_action = "-";
                                            $cash_badge = "danger";
                                            $cash_result = $cash_original - $cash_affect;
                                        } else {
                                            $cash_original = explode(' + ', $log['balance'])[0];
                                            $cash_affect = explode(' + ', $log['balance'])[1];
                                            $cash_action = "+";
                                            $cash_badge = "success";
                                            $cash_result = $cash_original + $cash_affect;
                                        }
                                    @endphp

                                    <span class="badge bg-primary">{{ displayCash($cash_original) }}</span> {{ $cash_action }} <span class="badge bg-{{ $cash_badge }}">{{ displayCash($cash_affect) }}</span> = <span class="badge bg-warning" style="color: black;">{{ displayCash($cash_result) }}</span>

                                    @else
                                    <span class="badge bg-danger">None</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    {{ $log['ip'] }}
                                </td>
                            </tr> 
                            @endforeach
                            
                            
                        </tbody>
                    </table>
                </div>

                <div class="card-body" style="padding-right: 20px!important; padding-left: 20px!important; padding: 0;">
                    {!! $logs->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection