@extends('templates.admin')
@section('title', __('admin.manage_payments'))

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang("admin.add_payment")</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.add_payment') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">@lang('payment.logo')</label>
                        <input type="text" name="logo" class="form-control" placeholder="https://example.com/logo.svg">
                    </div>
                    <div class="form-group">
                        <label for="">@lang('payment.name')</label>
                        <input type="text" name="name" class="form-control" placeholder="Ex: MoMo E-Wallet">
                    </div>
                    <div class="form-group">
                        <label for="">@lang('payment.number_account')</label>
                        <input type="text" name="number_account" class="form-control" placeholder="Ex: jzondev@email.com | 91820129341">
                    </div>
                    <div class="form-group">
                        <label for="">@lang('payment.owner')</label>
                        <input type="text" name="owner" class="form-control" placeholder="Ex: PHAM DUC THANH">
                    </div>
                    <div class="form-group">
                        <label for="">@lang('payment.branch')</label>
                        <input type="text" name="branch" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">@lang('payment.note')</label>
                        <input type="text" name="note" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">@lang('system.action_add')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang("admin.manage_payments")</h3>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th width="1%">#</th>
                            <th>@lang('payment.name')</th>
                            <th>@lang('category.created_at')</th>
                            <th>@lang('system.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $o)
                            
                        <tr>
                            <td class="bold text-primary">
                                {{ $o['id'] }}
                            </td>
                            <td class="bold">
                                <img src="{{ $o['logo'] }}" alt="" style="width: 30px; margin-right: 5px;">
                                {{ $o['name'] }}
                            </td>
                            <td>
                                {{ date('Y-m-d H:i:s', strtotime($o['created_at'])) }}
                            </td>
                            <td>
                                <a href="{{ route('admin.delete_row', [ "payments", $o['id'], "redirect" => route("admin.manage_payments") ]) }}" class="btn btn-danger">
                                    @lang("system.action_delete")
                                </a>
                            </td>
                            
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                {!! $payments->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
</div>


@endsection