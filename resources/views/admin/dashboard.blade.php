@extends('templates.admin')
@section('title', __('admin.dashboard'))

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $statistic['total_users'] }}</h3>
                <p>@lang('admin_dashboard.total_users')</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ route("admin.manage_users") }}" class="small-box-footer">
                @lang('admin.manage_users') <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $statistic['total_clones'] }}</h3>
                <p>@lang('admin_dashboard.total_clones')</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ route("admin.manage_users") }}" class="small-box-footer">
                @lang('admin.manage_users') <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $statistic['total_customers'] }}</h3>
                <p>@lang('admin_dashboard.total_customers')</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ route("admin.manage_users") }}" class="small-box-footer">
                @lang('admin.manage_users') <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $statistic['today_registrations'] }}</h3>
                <p>@lang('admin_dashboard.today_registrations')</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ route("admin.manage_users") }}" class="small-box-footer">
                @lang('admin.manage_users') <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-success elevation-1">
                <i class="fas fa-archive"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">@lang("admin_dashboard.total_account_instock")</span>
                <span class="info-box-number">
                    {{ number_format($statistic['accounts_instock']) }}
                </span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-danger elevation-1">
                <i class="fas fa-archive"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">@lang("admin_dashboard.total_account_sold")</span>
                <span class="info-box-number">
                    {{ number_format($statistic['accounts_sold']) }}
                </span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-primary elevation-1">
                <i class="fas fa-money-bill"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">@lang("admin_dashboard.today_revenue")</span>
                <span class="info-box-number">
                    {{ displayCash($statistic['today_revenue']) }}
                </span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-warning elevation-1">
                <i class="fas fa-money-bill"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">@lang("admin_dashboard.month_revenue")</span>
                <span class="info-box-number">
                    {{ displayCash($statistic['month_revenue']) }}
                </span>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang("admin_dashboard.log_table")</h3>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th width="1%">@lang("account.log_created_at")</th>
                            <th>@lang("account.log_user")</th>
                            <th width="40%">@lang("account.log_content")</th>
                            <th>@lang("account.log_balance_changes")</th>
                            <th>@lang("account.log_ip")</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($statistic['logs'] as $log)
                        <tr>
                            <td style="font-weight: bold;">
                                {{ date('Y-m-d H:i:s', strtotime($log['created_at'])) }}
                            </td>
                            <td>
                                <input class="form-control form-control-sm" value="{{ $log['user'] }}" readonly>
                            </td>
                            <td>
                                {{ $log['content'] }}
                            </td>
                            <td>
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

                                <span class="badge badge-primary">{{ displayCash($cash_original) }}</span> {{ $cash_action }} <span class="badge bg-{{ $cash_badge }}">{{ displayCash($cash_affect) }}</span> = <span class="badge bg-warning" style="color: black;">{{ displayCash($cash_result) }}</span>

                                @else
                                <span class="badge badge-danger">None</span>
                                @endif
                            </td>
                            <td>
                                {{ $log['ip'] }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                {!! $statistic['logs']->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
</div>


@endsection