@extends('core::layouts.app')
@section('title', __('Templates'))
@section('content')
<div class="row p-4">
    <div class="col-12">
        <h3>@lang('Help page')</h3>
    </div>
  </div>
  <div class="row p-4">
    <div class="col-md-12">
       {!! config('app.help_page') !!}
    </div>
  </div>
@stop

