@extends('core::layouts.app')
@section('title', __('History credit'))
@section('content')
    {{-- Example Dashboard --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">@lang('History credits')</h1>
    </div>

    <div class="row">
        @if($data->count() > 0)
            <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead class="thead-dark">
                            <tr>
                                <th>@lang('ID')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Type')</th>
                                <th>@lang('Done At')</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td>
                                            {{ $item->id }}
                                        </td>
                                        <td>
                                            @if($item->status == 1)
                                                <i class="fas fa-plus-circle text-success"></i>
                                            @else
                                                <i class="fas fa-minus-circle text-danger"></i>
                                            @endif
                                        </td>
                                        <td style="font-weight: bolder;">
                                            <span class="text-warning">
                                                {{ $item->amount }}
                                            </span> credits
                                        </td>
                                        <td>
                                            @if($item->type == 1)
                                                <span class="badge badge-pill badge-primary">@lang('Referral')</span>
                                            @elseif($item->type == 2)
                                                <span class="badge badge-pill badge-info">@lang('Coupon')</span>
                                            @elseif($item->type == 4)
                                                <span class="badge badge-pill badge-success">@lang('Register')</span>
                                            @else
                                                <span class="badge badge-pill badge-secondary">@lang('Builder Resumecv')</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{$item->done_at}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="mt-4">
            {{ $data->appends( Request::all() )->links() }}
        </div>
        @if($data->count() == 0)
            <div class="alert alert-primary text-center">
                <i class="fe fe-alert-triangle mr-2"></i> @lang('No history credit found')
            </div>
        @endif
    </div>
@stop
