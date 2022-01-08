@extends('core::layouts.app')
@section('title', __('Invite & Coupon'))
@section('content')
    {{-- Example Dashboard --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">@lang('Invite & Coupon')</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form role="form" method="post" action="" autocomplete="off">
                <div class="card">
                    <div class="card-header">
                        <h1 class="h3 mt-2 mb-0 text-gray-800">@lang('Share your link')</h1>
                        <p class="text-muted mt-3">
                            @lang('Copy your personal referral link and share it with your friend and followers')
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-label font-weight-bold" style="font-size: 12.5px;">@lang('REFERRAL LINK')</label>
                                    <input type="text" name="name" value="{{ $linkInvite }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label font-weight-bold" style="font-size: 12.5px;">@lang('Click to copy')</label>
                                    <button type="button" class="btn btn-dark btn-block">
                                        <i class="fe fe-save mr-2"></i> @lang('Copy')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row" style="margin-top: 50px">
        <div class="col-md-12">
            <form role="form" method="post" action="{{ route('getCredit') }}">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h1 class="h3 mt-2 mb-0 text-gray-800">@lang('Enter your coupon')</h1>
                        <p class="text-muted mt-3">
                            @lang('Enter your coupon for get more credits')
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="form-label font-weight-bold" style="font-size: 12.5px;">@lang('COUPON')</label>
                                    <input type="text" name="code" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label font-weight-bold" style="font-size: 12.5px;">@lang('GET CREDITS')</label>
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fe fe-save mr-2"></i> @lang('Submit')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
