@extends('core::layouts.app')

@section('title', __('Manage Ads'))

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">@lang('Manage Ads')</h1>
</div>
<div class="row">
    <div class="col-md-3">
        @include('core::partials.admin-sidebar')
    </div>
    <div class="col-md-9">
        <form role="form" method="post" action="{{ route('settings.general.update', 'ads') }}" autocomplete="off">
            @csrf

            <div class="card">
                    <div class="card-status bg-blue"></div>
                    <div class="card-header">
                            <h4 class="card-title">@lang('Manage Ads')</h4>
                        </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">@lang('Footer Layout Of Themes')</label>
                                <textarea class="form-control"name="ads_footer_layout_themes" rows="6" placeholder="@lang('Add your script Google ads, tag <img> banner or any vendor ads..')">{{ config('app.ads_footer_layout_themes') }}</textarea>
                            </div>
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