@extends('templates.admin')
@section('title', __('admin.setting_'.$view))

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.save_settings') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">@lang('setting.website_name')</label>
                        <input type="text" class="form-control" name="website_name" value="{{ setting('website_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="">@lang('setting.logo')</label>
                        <input type="text" class="form-control" name="logo" value="{{ setting('logo') }}">
                    </div>
                    <div class="form-group">
                        <label for="">@lang('setting.favicon')</label>
                        <input type="text" class="form-control" name="favicon" value="{{ setting('favicon') }}">
                    </div>
                    <div class="form-group">
                        <label for="">@lang('setting.keywords')</label>
                        <input type="text" class="form-control" name="keywords" value="{{ setting('keywords') }}">
                    </div>
                    <div class="form-group">
                        <label for="">@lang('setting.description')</label>
                        <input type="text" class="form-control" name="keywords" value="{{ setting('description') }}">
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="">@lang('setting.client_title')</label>
                        <input type="text" class="form-control" name="client_title" value="{{ setting('client_title') }}">
                    </div>
                    <div class="form-group">
                        <label for="">@lang('setting.client_image_banner')</label>
                        <input type="text" class="form-control" name="client_image_banner" value="{{ setting('client_image_banner') }}">
                    </div>
                    <div class="form-group">
                        <label for="">@lang('setting.client_title_banner')</label>
                        <input type="text" class="form-control" name="client_title_banner" value="{{ setting('client_title_banner') }}">
                    </div>
                    <div class="form-group">
                        <label for="">@lang('setting.client_description_banner')</label>
                        <input type="text" class="form-control" name="client_description_banner" value="{{ setting('client_description_banner') }}">
                    </div>
                    <div class="form-group">
                        <label for="">@lang('setting.marquee_nofication')</label>
                        <input type="text" class="form-control" name="marquee_nofication" value="{{ setting('marquee_nofication') }}">
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="">@lang('setting.deposit_prefix')</label>
                        <input type="text" class="form-control" name="deposit_prefix" value="{{ setting('deposit_prefix') }}">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">@lang('system.save_changes')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.set_lang') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="">@lang('setting.website_langauge_currency')</label>
                        <select name="lang" class="form-control">
                            <option value="vi" @selected(\App::isLocale('vi'))>Vietnam - VI - VND ₫</option>
                            <option value="en" @selected(\App::isLocale('en'))>English - EN - Dollar $</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">@lang('setting.website_timezone')</label>
                        <input type="text" class="form-control" name="timezone" value="{{ env('APP_TIMEZONE') }}">
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