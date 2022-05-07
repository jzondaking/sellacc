@extends('templates.admin')
@section('title', __('admin.setting_'.$view))

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.convert_price_currency') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">@lang('setting.convert_price_currency')</label>
                        <select name="convert" class="form-control">
                            <option value="usd_vnd">USD ➡️ VND</option>
                            <option value="vnd_usd">VND ➡️ USD</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">@lang('system.submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection