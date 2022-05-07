@extends('templates.admin')
@section('title', __('admin.manage_categories'))

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang("admin.add_category")</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.add_category') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">@lang('category.icon')</label>
                        <input type="text" name="icon" class="form-control" placeholder="https://example.com/icon.svg">
                    </div>
                    <div class="form-group">
                        <label for="">@lang('category.name')</label>
                        <input type="text" name="name" class="form-control" placeholder="Ex: Netflex Accounts">
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
                <h3 class="card-title">@lang("admin.manage_categories")</h3>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th width="1%">#</th>
                            <th width="1%">@lang('category.icon')</th>
                            <th width="40%">@lang('category.name')</th>
                            <th>@lang('category.created_at')</th>
                            <th>@lang('system.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $o)
                            
                        <tr>
                            <td class="bold text-primary">
                                {{ $o['id'] }}
                            </td>
                            <td class="align-middle">
                                <img src="{{ $o['icon'] }}" alt="" style="width: 30px;">
                            </td>
                            <td class="bold text-danger">
                                {{ $o['name'] }}
                            </td>
                            <td class="bold">
                                {{ date('Y-m-d H:i:s', strtotime($o['created_at'])) }}
                            </td>
                            <td class="align-middle">
                                <a class="btn btn-primary" href="{{ route("admin.edit_row", [ 'categories', $o['id'], 'admin.edit.category' ]) }}">
                                    @lang("system.action_edit")
                                </a>
                                <a href="{{ route('admin.delete_row', [ "categories", $o['id'], "redirect" => route("admin.manage_categories") ]) }}" class="btn btn-danger">
                                    @lang("system.action_delete")
                                </a>
                            </td>
                            
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                {!! $categories->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
</div>


@endsection