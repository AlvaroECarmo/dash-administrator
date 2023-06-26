<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <x-assets-header-css/>
    @livewireStyles
    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>
<body id="kt_body" class="auth-bg">

<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <div
            class="d-flex flex-column flex-lg-row-auto bg-primary w-100 w-sm-550px w-xl-950px positon-xl-relative order-2  order-lg-1 d-none d-sm-block"
            style="background-image: linear-gradient(to left, rgba(0,0,0,0.6) 10%,rgba(0,0,0,1) 100%),
                url({{asset('assets/icons/image-background.jpg')}}); background-position:center; background-size: 1290px 110% ">
            <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-100 w-sm-550px w-xl-950px scroll-y">
                <div class="d-flex flex-row-fluid flex-column text-left p-10 pt-lg-20">
                    <a href="https://parlamento.ao" class="py-9 pt-lg-20">
                        <img alt="Logo" src="{{ asset('assets/icons/parlamento-angola.png')  }}" class="h-75px"/>
                    </a>

                    <h1 class="fw-bolder text-white fs-2qx pb-5 pb-md-10"></h1>

                    <p class="fw-bold fs-2 text-white"></p>
                </div>

                <div class="card-body pt-6 pl-6">
                    <!--begin::Timeline-->
                    <div class="timeline-label w-xl-500px">
                        <!--begin::Item-->
                        <div class="timeline-item">
                            <!--begin::Label-->
                            <div class="timeline-label fw-bolder text-gray-800 fs-6"><i
                                    class="fa fa-folder-open text-white"></i>
                            </div>
                            <!--end::Label-->
                            <!--begin::Badge-->
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-gray-600 fs-1"></i>
                            </div>
                            <!--end::Badge-->
                            <!--begin::Text-->
                            <div class="fw-bold text-gray-700 ps-3 fs-7">Ea occaecat id ullamco sit minim adipisicing
                                amet dolor Lorem et ea consectetur. Sit ut pariatur aliqua cupidatat in nostrud pariatur
                                laboris consectetur quis ad. In aliqua enim sit officia irure mollit exercitation est.
                            </div>
                            <!--end::Text-->
                        </div>
                        <!--end::Item-->
                        <div class="timeline-item">
                            <!--begin::Label-->
                            <div class="timeline-label fw-bolder text-gray-800 fs-6"><i
                                    class="fa fa-folder-open text-primary"></i>
                            </div>
                            <!--end::Label-->
                            <!--begin::Badge-->
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-gray-600 fs-1"></i>
                            </div>
                            <!--end::Badge-->
                            <!--begin::Text-->
                            <div class="fw-bold text-gray-700 ps-3 fs-7">Ea occaecat id ullamco sit minim adipisicing
                                amet dolor Lorem et ea consectetur. Sit ut pariatur aliqua cupidatat in nostrud pariatur
                                laboris consectetur quis ad. In aliqua enim sit officia irure mollit exercitation est.
                            </div>
                            <!--end::Text-->
                        </div>

                        <div class="timeline-item">
                            <!--begin::Label-->
                            <div class="timeline-label fw-bolder text-gray-800 fs-6"><i
                                    class="fa fa-folder-open text-warning"></i>
                            </div>
                            <!--end::Label-->
                            <!--begin::Badge-->
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-gray-600 fs-1"></i>
                            </div>
                            <!--end::Badge-->
                            <!--begin::Text-->
                            <div class="fw-bold text-gray-700 ps-3 fs-7">Ea occaecat id ullamco sit minim adipisicing
                                amet dolor Lorem et ea consectetur. Sit ut pariatur aliqua cupidatat in nostrud pariatur
                                laboris consectetur quis ad. In aliqua enim sit officia irure mollit exercitation est.
                            </div>
                            <!--end::Text-->
                        </div>
                    </div>
                    <!--end::Timeline-->
                </div>

                <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">

                    <!--begin::Menu-->
                    <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1 align-items-center mb-3 mb-md-0">
                        <!--begin::Menu item-->
                        <li class="menu-item">
                            <!--begin::Menu link-->
                            <a href="#" target="_blank" class="menu-link px-3">
                                <img alt=#"
                                     src="{{ asset('assets/media/svg/social-logos/youtube.svg') }}" class="h-20px">
                            </a>
                            <!--end::Menu link-->
                        </li>
                        <!--end::Menu link-->
                        <!--begin::Menu item-->
                        <li class="menu-item">
                            <!--begin::Menu link-->
                            <a href="#" target="_blank" class="menu-link px-3">
                                <img alt="#"
                                     src="{{ asset('assets/media/svg/social-logos/github.svg') }}" class="h-20px">
                            </a>
                            <!--end::Menu link-->
                        </li>
                        <!--end::Menu link-->
                        <!--begin::Menu item-->
                        <li class="menu-item">
                            <!--begin::Menu link-->
                            <a href="#" target="_blank" class="menu-link px-3">
                                <img alt="#"
                                     src="{{ asset('assets/media/svg/social-logos/twitter.svg') }}" class="h-20px">
                            </a>
                            <!--end::Menu link-->
                        </li>
                        <!--end::Menu link-->
                        <!--begin::Menu item-->
                        <li class="menu-item">
                            <!--begin::Menu link-->
                            <a href="#" target="_blank" class="menu-link px-3">
                                <img alt="#"
                                     src="{{ asset('assets/media/svg/social-logos/instagram.svg') }}" class="h-20px">
                            </a>
                            <!--end::Menu link-->
                        </li>
                        <!--end::Menu link-->
                        <!--begin::Menu item-->
                        <li class="menu-item">
                            <!--begin::Menu link-->
                            <a href="#" target="_blank" class="menu-link px-3">
                                <img alt="#"
                                     src="{{ asset('assets/media/svg/social-logos/facebook.svg') }}" class="h-20px">
                            </a>
                            <!--end::Menu link-->
                        </li>
                        <!--end::Menu link-->

                    </ul>
                    <!--end::Menu-->
                </div>
            </div>

        </div>
         @livewire('auth.login')

    </div>

</div>

<x-assets-header-scripts/>
@livewireScripts
@stack('scripts')
</body>
</html>
