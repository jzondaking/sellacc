@extends('templates.admin')
@section('title', __('admin.edit_user', [ 'id' => $row['id'] ]))

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">@lang("admin.user_basic")</h3>
            </div>
            
            <form action="{{ route("admin.save_user", [ $row['id'] ]) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">@lang("account.field_name")</label>
                                <input type="text" class="form-control" value="{{ $row['name'] }}" name="name">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">@lang("account.profile_cash")</label>
                                <div class="input-group mb-3">
                                    <input type="number" step="0.01" class="form-control" value="{{ $row['cash'] }}" name="cash">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ displayCash("currency") }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">@lang("account.profile_cash_used")</label>
                                <div class="input-group mb-3">
                                    <input type="number" step="0.01" class="form-control" value="{{ $row['cash_used'] }}" name="cash_used">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ displayCash("currency") }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">@lang("account.last_ip")</label>
                        <input type="text" class="form-control" value="{{ $row['last_ip'] }}" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="">@lang("account.field_email")</label>
                        <input type="email" class="form-control" value="{{ $row['email'] }}" name="email">
                    </div>

                    <div class="form-group">
                        <label for="">@lang("admin.role")</label>
                        <select class="form-control" name="role">
                            <option value="member" @selected($row['role'] == "member")>@lang("system.member_role")</option>
                            <option value="admin" @selected($row['role'] == "admin")>@lang("system.admin_role")</option>
                        </select>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">@lang("system.save_changes")</button>
                </div>

            </form>
        </div>
    
    </div>

    <div class="col-md-6">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">@lang("admin.user_cash")</h3>
            </div>
    
            <form action="{{ route("admin.cash_user", [ $row['id'] ]) }}" method="POST">
                @csrf
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <label for="">@lang("admin.cash_type")</label>
                                <select name="type" class="form-control">
                                    <option value="plus">➕</option>
                                    <option value="minus">➖</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="form-group">
                                <label for="">@lang("admin.cash_value")</label>
                                <input type="number" step="0.01" class="form-control" name="value">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">@lang("system.submit")</button>
                </div>

            </form>
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
                            <th width="50%">@lang("account.log_content")</th>
                            <th>@lang("account.log_balance_changes")</th>
                            <th>@lang("account.log_ip")</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @php
                            $logs = App\Models\Log::where('user', $row['email'])->orderBy('id', 'desc')->paginate(15);
                        @endphp

                        @foreach ($logs as $log)
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
                {!! $logs->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
</div>
@endsection