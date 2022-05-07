@extends('templates.client')

@section('content')
<div class="row">
    <div class="col-lg-4"></div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                @csrf
                <form method="POST" action="{{ route('account.doChangePassword') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">@lang('account.old_password')</label>
                        <input type="password" name="old" class="form-control" placeholder="***************" value="{{ old('old') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="textInput">@lang('account.new_password')</label>
                        <input type="password" name="new" class="form-control" placeholder="***************" value="{{ old('new') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="textInput">@lang('account.confirm_password')</label>
                        <input type="password" name="confirm" class="form-control" placeholder="***************" value="{{ old('confirm') }}">
                    </div>
                    <div>
                        <button class="btn btn-primary" type="submit">
                            <i class="fa-solid fa-lock"></i> @lang('account.submit_change_password')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4"></div>
</div>
@endsection