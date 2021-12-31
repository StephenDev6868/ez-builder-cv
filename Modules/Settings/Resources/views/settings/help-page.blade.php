@extends('core::layouts.app')

@section('title', __('Help page'))

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">@lang('Help page')</h1>
</div>
<div class="row">
    <div class="col-md-3">
        @include('core::partials.admin-sidebar')
    </div>
    <div class="col-md-9">
        <form role="form" method="post" action="{{ route('settings.general.update', 'help-page') }}" autocomplete="off">
            @csrf

            <div class="card">
                    <div class="card-status bg-blue"></div>
                    <div class="card-header">
                            <h4 class="card-title">@lang('Help page content')</h4>
                        </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="form-control" id="help_page" name="help_page" rows="6" placeholder="@lang('Add content for help page..')">{{ config('app.help_page') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fe fe-save mr-2"></i> @lang('Save')
                    </button>
                </div>
            </div>

        </form>

    </div>
    
</div>
@push('scripts')
    <script>
        tinymce.init({
        plugins: 'link',
        selector: '#help_page'
      });
    </script>
@endpush
@stop