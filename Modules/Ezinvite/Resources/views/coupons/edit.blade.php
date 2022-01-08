@extends('core::layouts.app')
@section('title', __('Coupons'))
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">@lang('Edit')</h1>
    </div>
    <div class="row">
        <div class="col-md-3">
            @include('core::partials.admin-sidebar')
        </div>
        <div class="col-md-9">
            <form role="form" method="post" action="{{ route('coupons.edit', $coupon->getKey()) }}">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('Coupon code')</label>
                                    <input type="text" name="code" value="{{ optional($coupon)->code }}" class="form-control" placeholder="@lang('Coupon code')">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('Credit')</label>
                                    <input type="text" name="credit" value="{{ optional($coupon)->credit }}" class="form-control" placeholder="@lang('Credit')">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('Limit')</label>
                                    <input type="text" name="limit" value="{{ optional($coupon)->limit }}" class="form-control" placeholder="@lang('Limit')">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('Expiration Date')</label>
                                    <input type="text" name="expiration_date" value="{{ optional($coupon)->expiration_date }}" class="form-control" placeholder="@lang('Expiration Date')">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex">
                            <a href="{{ route('coupons.index') }}" class="btn btn-secondary">@lang('Cancel')</a>
                            <button class="btn btn-primary ml-auto">@lang('Update coupon')</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

