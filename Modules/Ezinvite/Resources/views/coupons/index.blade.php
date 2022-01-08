@extends('core::layouts.app')
@section('title', __('Coupons'))
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">@lang('Coupon')</h1>
        <div class="btn">
            <a href="{{ route('coupons.create') }}" class="btn btn-sm btn-success shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> @lang('Create')
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            @include('core::partials.admin-sidebar')
        </div>
        <div class="col-md-9">
            @if($data->count() > 0)
                <div class="card mb-3">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead class="thead-dark">
                            <tr>
                                <th>@lang('Coupon code')</th>
                                <th>@lang('Credit')</th>
                                <th>@lang('Limit')</th>
                                <th>@lang('Expiration Date')</th>
                                <th>@lang('Created At')</th>
                                <th>@lang('Updated At')</th>
                                <th>@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td>
                                        {{ $item->code }}
                                    </td>
                                    <td>
                                        {{ $item->credit }}
                                    </td>
                                    <td>
                                        {{ $item->limit }}
                                    </td>
                                    <td>{{ $item->expiration_date }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="p-1 ">
                                                <a href="{{ route('coupons.show', $item->getKey()) }}" class="btn btn-sm btn-primary">@lang('Edit')</a>
                                            </div>

                                            <div class="p-1 ">
                                                <form method="post" action="{{ route('coupons.delete', $item->getKey()) }}" onsubmit="return confirm('@lang('Confirm delete?')');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fe fe-trash"></i> @lang('Delete')
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
            {{ $data->appends( Request::all() )->links() }}
            @if($data->count() == 0)
                <div class="alert alert-primary text-center">
                    <i class="fe fe-alert-triangle mr-2"></i> @lang('No coupons found')
                </div>
            @endif
        </div>
    </div>
@stop
