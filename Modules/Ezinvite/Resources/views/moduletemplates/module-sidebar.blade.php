<li class="nav-item {{ (request()->is('invite-coupon')) ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('invite-coupon') }}">
        <i class="fas fa-share-alt"></i>
        <span>@lang('Invite & Coupon')</span></a>
</li>
