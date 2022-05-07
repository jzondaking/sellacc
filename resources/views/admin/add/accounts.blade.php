@extends('templates.admin')
@section('title', __('admin.add_accounts'))

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.add_accounts', [ $product['id'] ]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">@lang('product.accounts')</label>
                        <textarea name="accounts" class="form-control" cols="30" rows="10" placeholder="1 account / line"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">
                            @lang('system.action_add')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>    
</div>
@endsection