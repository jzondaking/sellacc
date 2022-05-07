@extends('templates.admin')
@section('title', __('admin.edit_category'))

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang("admin.add_category")</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.save_category', [ $row['id'] ]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">@lang('category.icon')</label>
                        <input type="text" name="icon" class="form-control" value="{{ $row['icon'] }}" placeholder="https://example.com/icon.svg">
                    </div>
                    <div class="form-group">
                        <label for="">@lang('category.name')</label>
                        <input type="text" name="name" class="form-control" value="{{ $row['name'] }}" placeholder="Ex: Netflex Accounts">
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