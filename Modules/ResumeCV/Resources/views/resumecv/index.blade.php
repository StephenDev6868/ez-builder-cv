@extends('core::layouts.app')
@section('title', __('ResumeCV'))
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-2">
    <div>
        <h1 class="h3 mb-4 text-gray-800">@lang('My ResumeCV')</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        @if($data->count() > 0)
            <div class="card">
                <div class="table-responsive">
                     <table class="table card-table table-vcenter text-nowrap">
                        <thead class="thead-dark">
                            <tr>
                                <th>@lang('Name')</th>
                                <th>@lang('Public link')</th>
                                <th>@lang('Views')</th>
                                <th>@lang('Date Info')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>            
                            @foreach($data as $item)
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
                                <td>
                                     <div class="d-flex">
                                        <div class="p-1 ">
                                              <a href="{{ route('resumecv.builder', $item->code) }}"><span  class="badge badge-primary">@lang('Builder')</span></a>
                                        </div>
                                         <div class="p-1 ">
                                              <a href="{{ URL::to('resumecv/download',$item->code) }}"><span  class="badge badge-success">@lang('Download PDF')</span></a>
                                        </div>
                                        <div class="p-1"> 
                                            <form method="post" action="{{ route('resumecv.clone', $item) }}" >
                                              @csrf
                                              <button type="submit" class="badge badge-default border-0">
                                              @lang('Clone')
                                              </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="p-1 ">
                                              <a href="{{ route('resumecv.setting', $item->code) }}"><span  class="badge badge-secondary">@lang('Settings')</span></a>
                                        </div>
                                        <div class="p-1 ">
                                                <form method="post" action="{{ route('resumecv.delete', $item) }}" onsubmit="return confirm('@lang('Confirm delete?')');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="badge badge-danger border-0">
                                                        @lang('Delete')
                                                    </button>
                                                </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        <div class="mt-4">
            {{ $data->appends( Request::all() )->links() }}
        </div>
    </div>
    
</div>

<div class="row">
  <div class="col-lg-12">
    @if($data->count() == 0)
    <div class="text-center">
      <div class="error mx-auto mb-3"><i class="far fa-file-alt"></i></div>
      <p class="lead text-gray-800">@lang('No ResumeCV Found')</p>
      <p class="text-gray-500">@lang("You don't have any ResumeCV").</p>
      <a href="{{ url('alltemplates')}}" class="btn btn-primary">
        <span class="text">@lang('New ResumeCV')</span>
      </a>
    </div>
    @endif
  </div>
</div>

@stop