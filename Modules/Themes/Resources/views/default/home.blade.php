@extends('themes::default.layout')


@section('content')
@include('themes::default.nav')
 <!-- END HOME -->
 <section class="bg-home bg-light" id="home">
    <div class="container">
        <div class="row justify-content-md-center text-center">
          <div class="col-md-auto content-col-center">
            <h1 class="home-title">@lang('Use the best resume maker as your guide')</h1>
            <p>@lang('Getting that dream job can seem like an impossible task. We’re here to change that. Give yourself a real advantage with the best online resume maker')</p>
            <a href="{{ route('templates') }}" class="btn btn-primary">@lang('Create Resume Online')</a>
            <div class="mt-5 img-home-page">
                <img src="{{ asset('img/resume_home-page.png')}}" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
    
</section>

<!-- END HOME -->


    <!-- START HOW IT WORK -->
    <section class="section pt-5" id="how-it-work">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h2 class="mb-0">@lang('How Create Resume-CV Online')</h2>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-4">
                    <div class="work-box text-center p-3">
                        <div class="arrow">
                            <img src="{{ Module::asset('themes:default/images/arrow-1.png') }}" alt="">
                        </div>
                        <div class="work-count">
                            <p class="mb-0">1</p>
                        </div>
                        <div class="work-icon">
                            <i class="pe-7s-file"></i>
                        </div>
                        <h5 class="mt-4">@lang('Select a template')</h5>
                        <p class="text-muted mt-3">
                           @lang('Choose from a selection of recruiter-approved layout designs for different job types')
                        </p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="work-box text-center p-3">
                        <div class="arrow">
                            <img src="{{ Module::asset('themes:default/images/arrow-2.png') }}" alt="">
                        </div>
                        <div class="work-count">
                            <p class="mb-0">2</p>
                        </div>
                        <div class="work-icon">
                            <i class="pe-7s-pen"></i>
                        </div>
                        <h5 class="mt-4">@lang('Optimize Your Content')</h5>
                        <p class="text-muted mt-3">
                            @lang('And adding or removing a specific section based on your needs is no problem and you get layout and content suggestions so that your resume looks perfect')
                        </p>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="work-box text-center p-3">
                        <div class="work-count">
                            <p class="mb-0">3</p>
                        </div>
                        <div class="work-icon">
                            <i class="pe-7s-user"></i>
                        </div>
                        <h5 class="mt-4">@lang('Publish or Download PDF')</h5>
                        <p class="text-muted mt-3">
                            @lang('Once your content is finished, you can publish link or dowwnload PDF. Your latest version is saved and you can always go back to make edits.')
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- END HOW IT WORK -->
    
    <!-- START WHY -->
    <section class="section bg-light" id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-box text-center">
                        <h2 class="mb-0">@lang('Why Should Use') {{ config('app.name')}}?</h2>
                    </div>
                </div>
            </div>


            <div class="row align-items-center mt-5">
                <div class="col-lg-6">
                    <div class="nav flex-column nav-pills mt-4">
                        <a class="nav-link">
                            <div class="p-3">
                                <div class="media">
                                    <div class="services-title">
                                        <i class="pe-7s-note2"></i>
                                    </div>
                                    <div class="media-body pl-4">
                                        <h5 class="mb-2 f-18 services-title mt-2">@lang('Create Resume or CV')</h5>
                                        <p class="mb-0">@lang('Aenean sollicitudin, lorem quis bibendum auctor')</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="nav-link">
                            <div class="p-3">
                                <div class="media">
                                    <div class="services-title">
                                        <i class="pe-7s-paper-plane"></i>
                                    </div>
                                    <div class="media-body pl-4">
                                        <h5 class="mb-2 f-18 services-title mt-2">@lang('Easy Publish Resume or CV')</h5>
                                        <p class="mb-0">@lang('Aenean sollicitudin, lorem quis bibendum auctor')</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="nav-link">
                            <div class="p-3">
                                <div class="media">
                                    <div class="services-title">
                                        <i class="pe-7s-call"></i>
                                    </div>
                                    <div class="media-body pl-4">
                                        <h5 class="mb-2 services-title mt-2">@lang('Happy Support')</h5>
                                        <p class="mb-0">@lang('Aenean sollicitudin, lorem quis bibendum auctor')</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="nav flex-column nav-pills mt-4">
                        <a class="nav-link">
                            <div class="p-3">
                                <div class="media">
                                    <div class="services-title">
                                        <i class="pe-7s-safe"></i>
                                    </div>
                                    <div class="media-body pl-4">
                                        <h5 class="mb-2 services-title mt-2">@lang('Your data is safe')</h5>
                                        <p class="mb-0">@lang('Your data is kept private and protected')</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                         <a class="nav-link">
                            <div class="p-3">
                                <div class="media">
                                    <div class="services-title">
                                        <i class="pe-7s-cloud-download"></i>
                                    </div>
                                    <div class="media-body pl-4">
                                        <h5 class="mb-2 services-title mt-2">@lang('Easy print and export PDF')</h5>
                                        <p class="mb-0">@lang('Save and print your perfect resume With PDF')</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="nav-link">
                            <div class="p-3">
                                <div class="media">
                                    <div class="services-title">
                                        <i class="pe-7s-rocket"></i>
                                    </div>
                                    <div class="media-body pl-4">
                                        <h5 class="mb-2 services-title mt-2">@lang('Tips from recruiters')</h5>
                                        <p class="mb-0">@lang('Create amazing resumes based on expert knowledge and hiring practices gathered from actual recruiters.')</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        
                    </div>
                </div>
               
            </div>

        </div>
    </section>
    <!-- END WHY -->

     <!-- START COUNTER -->
    <section class="section pt-5">
        <div class="container">
            <div class="row" id="counter">
                <div class="col-lg-5">
                    <div class="counter-info mt-4">
                        <h3>@lang('Trusted by 10,000+ user')</h3>
                        <p class="text-muted mt-4">@lang('Discover why more than 10,000 user choose') {{ __(config('app.name')) }}.</p>
                        <div class="mt-4">
                            <a href="{{ route('login') }}" class="btn btn-primary">@lang('Login Now')  <i class="mdi mdi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="counter-box mt-4">
                                <div class="media box-shadow bg-white p-4 rounded">
                                    <div class="counter-icon mr-3">
                                        <i class="mdi mdi-emoticon-outline text-primary h2"></i>
                                    </div>
                                    <div class="media-body pl-2">
                                        <h3 class="counter-count"> <span class="counter-value" data-count="10000">0</span>
                                            +</h3>
                                        <h5 class="mt-2 mb-0 f-17">@lang('User')</h5>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="counter-box mt-4">
                                <div class="media box-shadow bg-white p-4 rounded">
                                    <div class="counter-icon mr-3">
                                        <i class="mdi mdi-flag text-primary h2"></i>
                                    </div>
                                    <div class="media-body pl-2">
                                        <h3 class="counter-count"> <span class="counter-value" data-count="24">0</span>
                                        </h3>
                                        <h5 class="mt-2 mb-0 f-17">@lang('Languages')</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-1">
                        <div class="col-lg-6">
                            <div class="counter-box mt-4">
                                <div class="media box-shadow bg-white p-4 rounded">
                                    <div class="counter-icon mr-3">
                                        <i class="pe-7s-note2 text-primary h2"></i>
                                    </div>
                                    <div class="media-body pl-2">
                                        <h3 class="counter-count"> <span class="counter-value"
                                                data-count="100">0</span> +
                                        </h3>
                                        <h5 class="mt-2 mb-0 f-17">@lang('Resumes')</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="counter-box mt-4">
                                <div class="media box-shadow bg-white p-4 rounded">
                                    <div class="counter-icon mr-3">
                                        <i class="mdi mdi-timer text-primary h2"></i>
                                    </div>
                                    <div class="media-body pl-2">
                                        <h3 class="counter-count"> <span class="counter-value" data-count="5">0</span> +
                                        </h3>
                                        <h5 class="mt-2 mb-0 f-17">@lang('Years of expe'). </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END COUNTER -->
    
@stop
