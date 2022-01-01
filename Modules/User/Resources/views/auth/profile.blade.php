@extends('core::layouts.app')
@section('title', __('Account Settings'))
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">@lang('Setting Account')</h1>
</div>
<div class="row">
    <div class="col-md-12">
        <form role="form" method="post" action="{{ route('accountsettings.update') }}" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#tab_user_info" data-toggle="tab">
                                @lang('Your Info')
                            </a>
                        </li>
                    </ul>
                </div>
                
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_user_info">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Your Name')</label>
                                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="@lang('Your name')">
                                    </div>
                                    
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Mobile Phone')</label>
                                        <input type="text" name="mobile_phone" value="{{ $user->mobile_phone }}" class="form-control" placeholder="@lang('Mobile Phone')">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Email')</label>
                                        <input type="email" value="{{ $user->email }}" class="form-control disabled" placeholder="E-mail" disabled>
                                        <small class="help-block">@lang("E-mail can't be changed")</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">@lang('High school name')</label>
                                        <input type="text" name="high_school_name" value="{{ $user->high_school_name }}" class="form-control" placeholder="@lang('High school name')">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Gender')</label>
                                        <select name="gender" class="form-control" id="">
                                            <option value="male" @if($user->gender == 'male') {{'selected'}} @endif>@lang('Male')</option>
                                            <option value="female"  @if($user->gender == 'female') {{'selected'}} @endif>@lang('Female')</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Grade')</label>
                                        <select name="grade" class="form-control" id="">
                                            <option value="grade_one" @if($user->grade == 'grade_one') {{'selected'}} @endif>@lang('Grade one')</option>
                                            <option value="grade_two" @if($user->grade == 'grade_two') {{'selected'}} @endif>@lang('Grade two')</option>
                                            <option value="grade_three" @if($user->grade == 'grade_three') {{'selected'}} @endif>@lang('Grade three')</option>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-block">
                    <i class="fe fe-save mr-2"></i> @lang('Save settings')
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop