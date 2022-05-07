@extends('templates.admin')
@section('title', __('admin.setting_'.$view))

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.save_settings') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="">@lang('setting.captcha_v2_site')</label>
                        <input type="text" class="form-control" name="captcha_v2_site" value="{{ setting('captcha_v2_site') }}">
                    </div>
                    <div class="form-group">
                        <label for="">@lang('setting.captcha_v2_secret')</label>
                        <input type="text" class="form-control" name="captcha_v2_secret" value="{{ setting('captcha_v2_secret') }}">
                    </div>
                    <div class="form-group">
                        <label for="">@lang('setting.captcha_v2_mode')</label>
                        <select name="captcha_v2_mode" class="form-control">
                            <option value="on" @selected(setting('captcha_v2_mode') == 'on')>@lang('system.on')</option>
                            <option value="off" @selected(setting('captcha_v2_mode') == 'off')>@lang('system.off')</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">@lang('system.save_changes')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.save_settings') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">@lang('setting.registration_limit_per_day')</label>
                        <input type="text" class="form-control" name="registration_limit_per_day" value="{{ setting('registration_limit_per_day') }}">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">@lang('system.save_changes')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection