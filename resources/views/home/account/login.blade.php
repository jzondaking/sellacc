@extends('templates.auth')

@section('content')
<div class="card-body p-6">
    <div class="mb-4">
        <a href="{{ route('account.login') }}">
            <img src="{{ setting('logo') }}" class="mb-2" alt="" />
        </a>
        <p class="mb-6">@lang('account.auth_message')</p>
    </div>
    <!-- Form -->
    <form method="POST" action="{{ route('account.doLogin') }}">
        @csrf

        @include('templates.display_status_v1')

        <!-- Username -->
        <div class="mb-3">
            <label for="email" class="form-label">@lang('account.field_email')</label>
            <input type="email" id="email" class="form-control" name="email" placeholder="user@example.com" value="{{ old('email') }}" required="" />
        </div>
        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">@lang('account.field_password')</label>
            <input type="password" id="password" class="form-control" name="password" placeholder="**************" required="" />
        </div>
        <!-- Checkbox -->
        <div class="d-lg-flex justify-content-between align-items-center mb-3">
            <div class="form-check custom-checkbox">
                <input type="checkbox" class="form-check-input" id="rememberme" name="rememberme" />
                <label class="form-check-label" for="rememberme">@lang('account.field_remember')</label>
            </div>
        </div>
        
        @if (setting('captcha_v2_mode') == 'on')
        <div class="mb-4">
            <div class="g-recaptcha" data-sitekey="{{ setting('captcha_v2_site') }}"></div>
        </div>
        @endif

        <div>
            <!-- Button -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">@lang('account.login_submit')</button>
            </div>

            <div class="d-md-flex justify-content-between mt-4">
                <div class="mb-2 mb-md-0">
                    <a href="{{ route('account.register') }}" class="fs-5">@lang('account.register_hyper_text')</a>
                </div>
                <div>
                    <a href="#" class="text-inherit fs-5">@lang('account.forgot_hyper_text')</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection