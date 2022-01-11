@extends('core::layouts.app')

@section('title', __('Create new template'))

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">@lang('New')</h1>
</div>
<div class="row">
    <div class="col-md-3">
        @include('core::partials.admin-sidebar')
    </div>
    <div class="col-md-9">
         <form role="form" method="post" action="{{ route('settings.resumecvtemplate.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('Name')</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="@lang('Name')">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('Categories')</label>
                                 <select name="category_id" class="form-control">
                                    @foreach ($categories as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('Credit')</label>
                                <input type="text" name="credit" value="{{ old('credit') }}" class="form-control" placeholder="@lang('Credit')">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">@lang('Thumb') (750x750)</label>
                                <input name="thumb" type="file"><br>
                            </div>
                            <div class="form-group">
                                <label class="form-label">@lang('HTML content')</label>
                                <textarea rows="4" name="content" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">@lang('Style content')</label>
                                <textarea rows="4" name="style" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-label">@lang('Active')</div>
                                <label class="custom-switch">
                                    <input type="checkbox" name="active" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">@lang('Allow active template')</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-label">@lang('Premium')</div>
                                <label class="custom-switch">
                                    <input type="checkbox" name="is_premium" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">@lang('Premium template')</span>
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <a href="{{ route('settings.resumecvtemplate.index') }}" class="btn btn-secondary">@lang('Cancel')</a>
                        <div class="ml-auto">
                            <button class="btn btn-primary" name="save_and_builder" type="submit" value="save_and_builder">@lang('Save & Builder')</button>
                            <button class="btn btn-success">@lang('Save')</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </div>

</div>


@stop
