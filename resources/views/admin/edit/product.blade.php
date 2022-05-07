@extends('templates.admin')
@section('title', __('admin.edit_product'))

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.save_product', [ $row['id'] ]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">@lang('product.name')</label>
                                <input type="text" class="form-control" name="name" value="{{ $row['name'] }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">@lang('product.filter_category')</label>
                                <select class="form-control select2" name="category">
                                    @foreach (App\Models\Category::orderBy('id', 'desc')->get() as $category)
                                    <option value="{{ $category['id'] }}" @selected($row['category_id'] == $category['id'])>{{ $category['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">@lang('product.price')</label>
                                <div class="input-group mb-3">
                                    <input type="number" step="0.01" class="form-control" value="{{ $row['price'] }}" name="price">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ displayCash("currency") }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">@lang('product.minimum')</label>
                                <input type="number" class="form-control" name="minimum" value="{{ $row['minimum'] }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">@lang('product.maximum')</label>
                                <input type="number" class="form-control" name="maximum" value="{{ $row['maximum'] }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">@lang('product.description')</label>
                                <textarea name="description" class="form-control" cols="30" rows="5">{{ $row['description'] }}</textarea>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">@lang('product.flag')</label>
                                <input type="text" class="form-control" name="flag" placeholder="Ex: VN" value="{{ $row['flag'] }}">
                                <span class="text-danger" style="font-style: italic;">Get 2 digit country code from <a href="https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2#Officially_assigned_code_elements" target="_blank">here</a></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">@lang('product.hot')</label>
                                <select name="hot" class="form-control">
                                    <option value="1" @selected($row['hot'] == 1)>@lang('system.on')</option>
                                    <option value="0" @selected($row['hot'] == 0)>@lang('system.off')</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button class="btn btn-success btn-block" type="submit">@lang('system.save_changes')</button>
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