@can('admin')
    <li class="nav-item {{ (request()->is('coupons')) || (request()->is('coupons/*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('coupons.index') }}" >
            <i class="fas fa-search-dollar"></i>
            <span>@lang('Coupon')</span>
        </a>
    </li>
@endcan
