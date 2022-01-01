@extends('core::layouts.app')
@section('title', __('Change password'))
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">@lang('Change password')</h1>
</div>
<div class="row">
    <div class="col-md-12">
        <form role="form" method="post" action="{{ route('changepassword.update') }}" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs">
                        <li class="nav-item active">
                            <a class="nav-link" href="#tab_password" data-toggle="tab">
                                @lang('Change Password')
                            </a>
                        </li>
                    </ul>
                </div>
                
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_password">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Old Password')</label>
                                        <input type="password" class="form-control" name="old_password" placeholder="@lang('Old Password')">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">@lang('Password')</label>
                                        <input type="password" class="form-control" name="password" placeholder="@lang('Password')">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-label">@lang('Confirm password')</label>
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="@lang('Confirm password')">
                                    </div>
                                    <div class="alert alert-info">
                                        @lang('Type new password if you would like to change current password.')
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