@extends('core::layouts.app')
@section('title', __('Dashboard'))
@section('content')
{{-- Example Dashboard --}}
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">@lang('Dashboard')</h1>
</div>
<div class="row">
    <div class="col-md-6">
        <a href="{{route('resumecv.index')}}" class="text-decoration-none">
            <div class="card shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-gray-600 text-uppercase mb-1">
                                @lang('Total ResumeCV')
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-600">{{$total_resume}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6">
        <a href="{{route('resumecv.index')}}" class="text-decoration-none">
            <div class="card shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-gray-600 text-uppercase mb-1">@lang('Total Views ResumeCV')
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-600">{{$total_views}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-eye fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    
</div>

<div class="row">
    <div class="col-md-12">
        @if($data_10_first->count() > 0)
            <div class="mt-4 mb-4">
                <h1 class="h3 mb-0 text-gray-800">@lang('My ResumeCV')</h1>
            </div>
            <div class="card">
                <div class="table-responsive">
                     <table class="table card-table table-vcenter text-nowrap">
                        <thead class="">
                            <tr>
                                <th>@lang('Name')</th>
                                <th>@lang('Public link')</th>
                                <th>@lang('Views')</th>
                                <th>@lang('Date Info')</th>
                            </tr>
                        </thead>
                        <tbody>            
                            @foreach($data_10_first as $item)
                            <tr>
                                <td>
                                    <span><a href="{{ route('resumecv.builder', $item->code) }}">{{ $item->name }}</a></span>
                                </td>
                                <td>
                                    <div class="public-link"><small><a href="{{ URL::to('publish',$item->slug) }}" target="_blank" class="text-dark">{{ URL::to('publish') }}/{{$item->slug}}</a></small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-info badge-pill">{{$item->view_count}} @lang('views')</span>
                                </td>
                                <td>
                                <div class="small text-muted">
                                        @lang('Created'): {{$item->created_at->format('M j, Y')}}<br>
                                        @lang('Modified'): {{$item->updated_at->format('M j, Y')}}
                                </div>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    
    </div>
    
</div>
{{-- End Example Dashboard --}}

@stop