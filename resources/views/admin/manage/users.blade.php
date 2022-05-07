@extends('templates.admin')
@section('title', __('admin.manage_users'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang("admin.manage_users")</h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="@lang("admin.find_user")">
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
                            <th width="1%">@lang("admin.uid")</th>
                            <th>@lang("admin.display_name")</th>
                            <th>@lang("admin.email")</th>
                            <th>@lang("account.profile_cash")</th>
                            <th>@lang("account.profile_cash_used")</th>
                            <th>@lang("account.profile_total_order")</th>
                            <th>@lang("admin.role")</th>
                            <th>@lang("account.profile_created_at")</th>
                            <th>@lang("system.action")</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        
                        <tr>
                            <td class="bold text-primary">
                                {{ $user['id'] }}
                            </td>
                            <td class="bold">
                                {{ $user['name'] }}
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" value="{{ $user['email'] }}" readonly>
                            </td>
                            <td class="bold text-success">
                                {{ displayCash($user['cash']) }}
                            </td>
                            <td class="bold text-danger">
                                {{ displayCash($user['cash_used']) }}
                            </td>
                            <td class="bold text-primary">
                                {{ number_format(count(App\Models\Order::where('buyer', $user['email'])->get())) }}
                            </td>
                            <td class="bold">
                                {{ displayRole($user['role']) }}
                            </td>
                            <td class="italic">
                                {{ date('Y-m-d H:i:s', strtotime($user['created_at'])) }}
                            </td>
                            <td>
                                <a class="btn btn-primary" href="{{ route("admin.edit_row", [ 'users', $user['id'], 'admin.edit.user' ]) }}">
                                    @lang("system.action_edit")
                                </a>

                                <a class="btn btn-danger" href="{{ route("admin.delete_row", [ 'users', $user['id'], "redirect" => route("admin.manage_users") ]) }}">
                                    @lang("system.action_delete")
                                </a>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                {!! $users->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
</div>


@endsection