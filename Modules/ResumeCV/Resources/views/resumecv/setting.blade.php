@extends('core::layouts.app')
@section('title', __('Settings'))
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">@lang('Setting') - {{$item->name}}</h1>
    <div class="my-3 my-lg-0 navbar-search">
        <div class="input-group">
            <div class="p-1 ">
                <a href="{{ route('resumecv.builder', $item->code) }}" class="btn btn-sm btn-primary"><i class="far fa-window-maximize"></i> @lang('Builder')</a>
            </div>
        </div>
    </div>
</div>
<form role="form" method="post" action="{{ route('resumecv.settings.update',$item) }}" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="form-group">
                <label class="form-label">@lang('Name')</label>
                <input type="text" name="name" value="{{$item->name}}" class="form-control">
            </div>

            <div class="form-group mt-4">
                <label for="basic-url">@lang('Public link Resumecv')</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">{{ URL::to('publish') }}</span>
                  </div>
                  <input type="text" name="slug" class="form-control" id="basic-url" value="{{$item->slug}}" aria-describedby="basic-addon3">
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="">
                <button class="btn btn-primary ml-auto">@lang('Save')</button>
            </div>
        </div>
    </div>
</form>
@stop