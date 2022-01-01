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
    const TINYCME_UPLOAD_BLOG_IMAGE = "{{ route('settings.content-admin.upload_image') }}";
    const CSRF_TOKEN = "{{ csrf_token() }}";
</script>
<script>
  (function($) {
  "use strict";

  var config = {
    toolbar: 'styleselect visualblocks fullscreen image media link codesample',
    plugins: 'visualblocks fullscreen image link codesample media',
    selector: '#help_page',
    height: '500px'
  };

  if(typeof TINYCME_UPLOAD_BLOG_IMAGE === 'string' && typeof CSRF_TOKEN === 'string') {
    config.images_upload_handler = function (blobInfo, success, failure) {
      var xhr, formData;

      xhr = new XMLHttpRequest();
      xhr.withCredentials = false;
      xhr.open('POST', TINYCME_UPLOAD_BLOG_IMAGE);

      xhr.upload.onprogress = function (e) {
        progress(e.loaded / e.total * 100);
      };

      xhr.onload = function() {
        var json;

        if (xhr.status === 403) {
          failure('HTTP Error: ' + xhr.status, { remove: true });
          return;
        }

        if (xhr.status < 200 || xhr.status >= 300) {
          failure('HTTP Error: ' + xhr.status);
          return;
        }

        json = JSON.parse(xhr.responseText);

        if (!json || typeof json.location != 'string') {
          failure('Invalid JSON: ' + xhr.responseText);
          return;
        }

        success(json.location);
      };

      xhr.onerror = function () {
        failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
      };

      formData = new FormData();
      formData.append('file', blobInfo.blob(), blobInfo.filename());
      formData.append('_token', CSRF_TOKEN);

      xhr.send(formData);
    }
  }

  tinymce.init(config);

})(jQuery);


</script>
@endpush

@stop