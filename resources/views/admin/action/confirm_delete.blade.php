@extends('templates.admin')
@section('title', __('system.confirm_delete'))

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <p>@lang("system.confirm_delete_message")</p>
                <a class="btn btn-danger" href="?confirm=true&redirect={{ $request->query("redirect") }}">
                    @lang("system.action_delete")
                </a>
            </div>
        </div>
    </div>
</div>
@endsection