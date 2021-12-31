<li class="nav-item {{ (request()->is('accountsettings')) ? 'active' : '' }}">
	<a class="nav-link" href="{{ url('accountsettings') }}">
		<i class="fa fa-user"></i>
		<span>@lang('My profile')</span></a>
</li>
<li class="nav-item {{ (request()->is('resumecv*')) ? 'active' : '' }}">
	<a class="nav-link" href="{{ route('resumecv.index') }}">
		<i class="far fa-file-alt"></i>
		<span>@lang('My ResumeCV')</span></a>
</li>

<li class="nav-item {{ (request()->is('alltemplates*')) ? 'active' : '' }}">
	<a class="nav-link" href="{{ url('alltemplates')}}">
		<i class="far fa-window-maximize"></i>
		<span>@lang('Templates')</span></a>
</li>

<li class="nav-item {{ (request()->is('help*')) ? 'active' : '' }}">
	<a class="nav-link" href="{{ url('help')}}">
		<i class="fas fa-question-circle"></i>
		<span>@lang('Help')</span></a>
</li>