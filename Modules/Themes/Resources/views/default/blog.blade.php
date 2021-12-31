@extends('themes::default.layout')
@section('content')
@include('themes::default.nav')

<div class="employer-header bg-light blog-detail-header">
    <div class="container">
        <div class="clearfix">
            <div class="text-center">
              <div class="employer-info-detail">
                  <div class="title-wrapper">
                      <h1 class="employer-title text-center">{{ $blog->title }}</h1>
                  </div>
                  <div class="employer-metas mt-3">
                      <div class="employer-location">
                          <a href="{{ route('blogs', ['category_id' => $blog->category->id]) }}">{{ $blog->category->name }}</a>
                      </div>
                      <div class="employer-location">
                          {{ \Carbon\Carbon::parse($blog->created_at)->toFormattedDateString() }}
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row pt-4">
        <div class="col-md-12">
           <div class="blog-content">
                    {!! $blog->content !!}
            </div>
        </div>
    </div>
</div>
@stop
