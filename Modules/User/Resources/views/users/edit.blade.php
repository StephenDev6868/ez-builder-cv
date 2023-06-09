@extends('core::layouts.app')

@section('title', __('Update user'))

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">@lang('Update')</h1>
</div>
<div class="row">
    <div class="col-md-3">
        @include('core::partials.admin-sidebar')
    </div>
    <div class="col-md-9">
        <form role="form" method="post" action="{{ route('settings.users.update', $user) }}">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">@lang('Name')</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="@lang('Name')">
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
                                <input type="email" name="email" value="{{ $user->email }}" class="form-control" placeholder="@lang('E-mail')">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">@lang('Password')</label>
                                <input type="password" name="password" value="" class="form-control" placeholder="@lang('Password')">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">@lang('Confirm password')</label>
                                <input type="password" name="password_confirmation" value="" class="form-control" placeholder="@lang('Password')">
                            </div>
                        </div>
                        <div class="col-md-4">
                             <div class="form-group">
                                <label class="form-label">@lang('Role User')</label>
                                <select name="role" class="form-control" id="user_role_select">
                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>@lang('User')</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>@lang('Admin')</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
                                <label class="form-label">@lang('High school name')</label>
                                <input type="text" name="high_school_name" value="{{ $user->high_school_name }}" class="form-control" placeholder="@lang('High school name')">
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
                    <div class="row" id="row_package_user">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('Number Users Invited')</label>
                                <input type="text" name="user_invited" value="{{ $user->userHistoryInvite()->count() }}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">@lang('Credits')</label>
                                <input type="text" name="credit" value="{{ $user->credit ?? 0}}" class="form-control">
                            </div>
                        </div>
                    </div>


                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <a href="{{ route('settings.users.index') }}" class="btn btn-secondary">@lang('Cancel')</a>
                        <button class="btn btn-success ml-auto">@lang('Update user')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
      <script src="{{ Module::asset('user:js/user.js') }}" ></script>
@endpush
@stop
