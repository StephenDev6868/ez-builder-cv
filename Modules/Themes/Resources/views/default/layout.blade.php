<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @includeWhen(config('app.GOOGLE_ANALYTICS'), 'core::partials.google-analytics')
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{ __(config('app.name')) }} &mdash; {{ config('app.SITE_SLOGAN') }}</title>
        <meta name="description" content="{{ config('app.SITE_DESCRIPTION') }}">
        <meta name="keywords" content="{{ config('app.SITE_KEYWORDS') }}">
        <link rel="shortcut icon" href="{{ asset(config('app.logo_favicon')) }}">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,600,700&display=swap">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="{{ Module::asset('themes:default/css/bootstrap.min.css') }}"  />
        <link rel="stylesheet" type="text/css" href="{{ Module::asset('themes:default/css/materialdesignicons.min.css') }}"  />
        <link rel="stylesheet" type="text/css" href="{{ Module::asset('themes:default/css/pe-icon-7-stroke.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ Module::asset('themes:default/fonts/icomoon/style.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ Module::asset('themes:default/owlcarousel2/assets/owl.carousel.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ Module::asset('themes:default/owlcarousel2/assets/owl.theme.default.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ Module::asset('themes:default/css/style.css') }}"  />

        @stack('head')
    </head>
    <body data-spy="scroll" data-target="#navbarCollapse">
        @if (session('success'))
        <div class="alert alert-success border-radius-none">
            <i class="fas fa-check-circle text-success mr-2"></i> {!! session('success') !!}
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger border-radius-none">
            <i class="fas fa-times text-danger mr-2"></i> {!! session('error') !!}
        </div>
        @endif
        @yield('content')
        @if(config('app.ads_footer_layout_themes'))
         <section class="mb-4">
             <div class="container">
                 <div class="row">
                     <div class="ads-home-page">
                        {{ config('app.ads_footer_layout_themes') }}
                     </div>
                 </div>
             </div>
         </section>
         @endif
        <!-- START FOOTER -->
        <section class="py-4 footer_bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-5 col-sm-6">
                        <p class="mb-0 f_400">@lang('Copyright') © {{ now()->year }} @lang('Design by') <a href="{{ url('/') }}">{{ __(config('app.name')) }}</a></p>
                    </div>
                    
                    <div class="col-lg-6 col-md-4 col-sm-12">
                        <ul class="list-unstyled f_menu text-right">
                            {!! menuBottomSkins(['pagewebsites' => $pagewebsites]) !!}
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- END FOOTER -->
        <script src="{{ Module::asset('themes:default/js/jquery.min.js') }}"></script>
        <script src="{{ Module::asset('themes:default/js/bootstrap.bundle.min.js') }}"></script>
         <script src="{{ Module::asset('themes:default/owlcarousel2/owl.carousel.min.js') }}"></script>
        <script src="{{ Module::asset('themes:default/js/jquery.easing.min.js') }}"></script>
        <script src="{{ Module::asset('themes:default/js/jquery.mb.YTPlayer.js') }}"></script>
        <script src="{{ Module::asset('themes:default/js/contact.init.js') }}"></script>
        <script src="{{ Module::asset('themes:default/js/counter.init.js') }}"></script>
        @stack('scripts')
        <script src="{{ Module::asset('themes:default/js/app.js') }}"></script>
        
    </body>
</html>