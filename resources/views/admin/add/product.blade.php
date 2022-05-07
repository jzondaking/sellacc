@extends('templates.admin')
@section('title', __('admin.add_product'))

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.add_product') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">@lang('product.name')</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">@lang('product.filter_category')</label>
                                <select class="form-control select2" name="category">
                                    @foreach (App\Models\Category::orderBy('id', 'desc')->get() as $category)
                                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">@lang('product.price')</label>
                                <div class="input-group mb-3">
                                    <input type="number" step="0.01" class="form-control" name="price">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ displayCash("currency") }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">@lang('product.minimum')</label>
                                <input type="number" class="form-control" name="minimum">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">@lang('product.maximum')</label>
                                <input type="number" class="form-control" name="maximum">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">@lang('product.description')</label>
                                <textarea name="description" class="form-control" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">@lang('product.flag')</label>
                                <input type="text" class="form-control" name="flag" placeholder="Ex: VN (leave blank if not have)">
                                <span class="text-danger" style="font-style: italic;">Get 2 digit country code from <a href="https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2#Officially_assigned_code_elements" target="_blank">here</a></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">@lang('product.hot')</label>
                                <select name="hot" class="form-control">
                                    <option value="1">@lang('system.on')</option>
                                    <option value="0" selected>@lang('system.off')</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button class="btn btn-primary btn-block" type="submit">@lang('system.action_add')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('.select2').select2()
    })
</script>
@endsection