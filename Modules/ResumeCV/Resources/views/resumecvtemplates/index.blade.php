@extends('core::layouts.app')
@section('title', __('Resumecv templates'))
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">@lang('Resumecv templates')</h1>
    <a href="{{ route('settings.resumecvtemplate.create') }}" class="btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> @lang('Create')</a>
</div>

<div class="row">
    <div class="col-md-3">
        @include('core::partials.admin-sidebar')
    </div>
    <div class="col-md-9">
        @if($data->count() > 0)
            <div class="card">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead class="thead-dark">
                            <tr>
                                <th>@lang('Image')</th>
                                <th>@lang('Name')</th>
                                <th>@lang('Category')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                            <tr>
                                <td><img src="{{ URL::to('/') }}/storage/thumb_templates/{{ $item->thumb }}" class="img-thumbnail" height="40" />
                                    
                                </td>
                                <td>
                                    <span><a href="{{ route('settings.resumecvtemplate.edit', $item) }}">{{ $item->name }}</a></span>
                                </td>
                                <td>@if(isset($item->category))
                                         <span><a href="{{ route('settings.resumecvcategories.edit', $item->category->id) }}">{{ $item->category->name }}</a></span>
                                    @else
                                        <span>@lang('None')</span>
                                    @endif
                                   
                                </td>
                                <td>
                                    @if($item->active)
                                        <span class="small text-success"><i class="fas fa-check-circle text-success"></i> @lang('Active')</span>
                                    @else
                                        <span class="small text-warning"><i class="fas fa-times-circle"></i> @lang('Not active')</span>
                                    @endif
                                    <p class="mb-2"></p>
                                    @if($item->is_premium)
                                        <span class="small text-danger"><strong>@lang('Premium')</strong></span>
                                    @else
                                        <span class="small text-success"><strong>@lang('Free')</strong></span>
                                    @endif
                                    
                                </td>
                                <td>
                                     <div class="d-flex">
                                        <div class="p-1">
                                              <a href="{{ route('settings.resumecvtemplate.edit', $item) }}"><span  class="badge badge-primary">@lang('Edit')</span></a>
                                        </div>
                                        <div class="p-1 ">
                                              <a href="{{ route('settings.resumecvtemplate.builder', $item) }}"><span  class="badge badge-dark">@lang('Builder')</span></a>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="p-1"> 
                                            <form method="post" action="{{ route('settings.resumecvtemplate.clone', $item) }}" >
                                              @csrf
                                              <button type="submit" class="badge badge-default border-0">
                                              @lang('Clone')
                                              </button>
                                            </form>
                                        </div>
                                        <div class="p-1 ">
                                                <form method="post" action="{{ route('settings.resumecvtemplate.destroy', $item) }}" onsubmit="return confirm('@lang('Confirm delete?')');">
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
        @if($data->count() == 0)
            <div class="alert alert-primary text-center">
                <i class="fe fe-alert-triangle mr-2"></i> @lang('No Templates found')
            </div>
        @endif

    </div>
    
</div>

@stop