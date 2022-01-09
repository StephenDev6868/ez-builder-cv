@extends('core::layouts.app')

@section('title', __('Update template'))

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">@lang('Update template')</h1>
    <div class="p-1 ">
                <a href="{{ route('settings.resumecvtemplate.builder', $template) }}"><span  class="btn btn-primary">@lang('Builder')</span></a>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        @include('core::partials.admin-sidebar')
    </div>
    <div class="col-md-9">

        <form role="form" method="post" action="{{ route('settings.resumecvtemplate.update', $template->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('Name')</label>
                                <input type="text" name="name" value="{{$template->name}}" class="form-control" placeholder="@lang('Name')">
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('Categories')</label>
                                 <select name="category_id" class="form-control">
                                    @foreach ($categories as $item)
                                        <option value="{{$item->id}}"
                                         @if ($item->id == $template->category_id)
                                            selected="selected"
                                        @endif>
                                        {{$item->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('Credit')</label>
                                <input type="text" name="credit" value="{{$template->credit ?? 0}}" class="form-control" placeholder="@lang('Name')">
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label class="form-label">@lang('Thumb') (750x750)</label>
                                 <input name="thumb" type="file"><br>
                                 <img src="{{ URL::to('/') }}/storage/thumb_templates/{{ $template->thumb }}" data-value="" class="img-thumbnail" style="max-width: 100px; max-height: 100px;" />
                                <input type="hidden" name="hidden_image" value="{{ $template->thumb }}" />
                            </div>
                            <div class="form-group">
                                <label class="form-label">@lang('HTML content')</label>
                                <textarea rows="4" name="content" class="form-control">{{$template->content}}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">@lang('Style content')</label>
                                <textarea rows="4" name="style" class="form-control">{{$template->style}}</textarea>
                            </div>

                        </div>

                    </div>
                     <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-label">@lang('Active')</div>
                                <label class="custom-switch">
                                    @if ($template->active)
                                        <input type="checkbox" name="active" value="1" class="custom-switch-input" checked>
                                    @else
                                        <input type="checkbox" name="active" value="1" class="custom-switch-input" >
                                    @endif

                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">@lang('Active template')</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-label">@lang('Premium')</div>
                                <label class="custom-switch">
                                    @if ($template->is_premium)
                                        <input type="checkbox" name="is_premium"  value="1" class="custom-switch-input" checked>
                                    @else
                                        <input type="checkbox" name="is_premium" class="custom-switch-input" >
                                    @endif
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
