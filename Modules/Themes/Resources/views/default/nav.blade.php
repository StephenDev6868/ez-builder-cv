<!-- Static navbar -->
<nav class="navbar navbar-expand-lg navbar-custom sticky sticky-dark">
    <div class="container">
        <!-- LOGO -->
        <a class="navbar-brand logo text-uppercase" href="{{ url('/') }}">
            <img src="{{ asset(config('app.logo_frontend'))}}" alt="" height="50">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <i class="mdi mdi-menu"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto navbar-center" id="mySidenav">
            </ul>
            <ul class="navbar-nav navbar-center">
                {!! menuHeaderSkins() !!}
            @auth
                
                     <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <strong>{{ $user->name }}</strong>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          @can('admin')
                          <a class="dropdown-item" href="{{ route('settings.index') }}">@lang('Administrator')</a>
                          @endcan
                          <a class="dropdown-item" href="{{ route('dashboard') }}">@lang('Dashboard')</a>
                          <a class="dropdown-item" href="{{ url('resumecv') }}">@lang('My ResumeCV')</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="{{ route('logout') }}">@lang('Logout')</a>
                        </div>
                      </li>
                
                
            </ul>
            @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">
                    @lang('Login')
                </a>
            </li>
            <li class="nav-item d-inline-block d-lg-none">
                <a href="{{ route('register') }}" class="nav-link">@lang('Sign up')</a>
            </li>
            
        </ul>
        <div class="navbar-button d-none d-lg-inline-block">
            <a href="{{ route('register') }}" class="btn btn-sm btn-primary btn-round">@lang('Sign up')</a>
        </div>
        @endauth
        
    </div>
</div>
</nav>
<!-- Navbar End -->