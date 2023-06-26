<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div id="kt_content_container" class="container-fluid">
            <div class="card mb-5 mb-xxl-8">
                <div class="card-body pt-9 pb-0">
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                        <div class="me-7 mb-4">
                            <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                <img src="{{auth()->user()->avatar()}}" alt="image"/>
                                @if(auth()->check())
                                    <div class="position-absolute translate-middle bottom-0
                                        start-100 mb-6 bg-success rounded-circle h-15px w-15px">
                                    </div>
                                @else
                                    <div class="position-absolute translate-middle bottom-0
                                        start-100 mb-6 bg-secondary rounded-circle h-15px w-15px">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bolder me-1">
                                            {{ auth()->user()->name }}
                                        </a>
                                        <a href="#">
                                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                     height="24px" viewBox="0 0 24 24">
                                                    <path
                                                        d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z"
                                                        fill="#00A3FF"/>
                                                    <path class="permanent"
                                                          d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z"
                                                          fill="white"/>
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                        <a href="#"
                                           class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                            <span class="svg-icon svg-icon-4 me-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                     height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3"
                                                          d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                                          fill="black"/>
                                                    <path
                                                        d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                        fill="black"/>
                                                </svg>
                                            </span>
                                            A.N
                                        </a>
                                        <a href="#"
                                           class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                            <span class="svg-icon svg-icon-4 me-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                     height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3"
                                                          d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
                                                          fill="black"/>
                                                    <path
                                                        d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
                                                        fill="black"/>
                                                </svg>
                                            </span>
                                            {{ auth()->user()->ldap->getEmail() }}
                                        </a>
                                    </div>
                                </div>

                                <div class="d-flex my-4">

                                    <a href="{{route('profile')}}" class="btn btn-primary"
                                       data-bs-target="#kt_modal_offer_a_deal">Ajustar o meu perfil</a>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Title-->
                            <!--begin::Stats-->
                            <div class="d-flex flex-wrap justify-content-between">
                                <!--begin::Info-->
                                <div class="d-flex flex-column flex-grow-1 pe-8">
                                    <div class="d-flex flex-wrap">
                                        <div class="border border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <div class="fs-1 fw-bolder" data-kt-countup="true"
                                                 data-kt-countup-value="{{ \App\Models\Parlamento\TaskActivities::countMyTascks() }}"
                                                 data-kt-countup-prefix="">0
                                            </div>
                                            <div class="fw-bold fs-6 text-gray-400">QT Tarefas</div>
                                        </div>
                                        <div class="border border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <div class="fs-1 fw-bolder">
                                                {{ date('Y') }}
                                            </div>
                                            <div class="fw-bold fs-6 text-gray-400">Ano actual</div>
                                        </div>
                                        <div class="border border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <div class="fs-1 fw-bolder">
                                                {{date('m')}}
                                            </div>
                                            <div class="fw-bold fs-6 text-gray-400">Mês actual</div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Info-->
                                <!--begin::Progress-->
                                <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                                    <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                        <span class="fw-bold fs-6 text-gray-400">Estado do perfil</span>
                                        <span class="fw-bolder fs-6">68%</span>
                                    </div>
                                    <div class="h-5px mx-3 w-100 bg-light rounded mb-3">
                                        <div class="bg-primary rounded h-5px" role="progressbar" style="width: 68%;"
                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <!--end::Progress-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Details-->
                    <div class="separator"></div>
                    <!--begin::Navs-->
                    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">
                        <!--begin::Nav item-->
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 active"
                               href="overview.html">Recentes</a>
                        </li>

                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5"
                               href="#">Utilizadores</a>
                        </li>
                    </ul>

                </div>
            </div>


            <div class="row g-5 g-xxl-8">
                <div class="col-xl-6">


                    <div class="card mb-5 mb-xxl-8 h-100">
                        <!--begin::Body-->
                        <div class="card-body pb-0">
                            <!--begin::Top-->
                            <div class="d-flex align-items-center">
                                <!--begin::Section-->
                                <div class="d-flex align-items-center flex-grow-1">
                                    <!--begin::Symbol-->

                                    <!--end::Symbol-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-column">
                                        <a href="#" class="text-gray-800 text-hover-primary mb-1 fs-6 fw-bolder">
                                            {{ $ideoSelect['snippet']['title'] }}
                                        </a>

                                    </div>
                                    <!--end::Info-->
                                </div>

                            </div>
                            <!--end::Top-->
                            <!--begin::Bottom-->
                            <div class="pt-5">
                                <!--begin::Image-->
                                <div class="bgi-no-repeat bgi-size-cover rounded min-h-250px"
                                     style="background-image:url('{{ $ideoSelect['snippet']['thumbnails']['high']['url'] }}');"></div>


                                <!--end::Action-->
                            </div>

                            <span wire:click.prevent="publicarVideo({{ collect($ideoSelect) }})"
                                  class="badge badge-light-primary fw-bolder my-2 cursor-pointer">CLIQUE PARA PUBLICAR</span>
                            <br>
                            <span class="text-gray-400 fw-bold">{{ $ideoSelect['snippet']['description'] }}</span>
                        </div>
                        <!--end::Body-->
                    </div>


                </div>
                <div class="col-xl-6 ">
                    <div class="card mb-5 mb-xxl-8  h-100">
                        <div class="card-header align-items-center border-0 mt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="fw-bolder text-dark fs-2">Tarefas Recentes</span>
                                <span
                                    class="text-gray-400 mt-2 fw-bold fs-6">Sr. {{ auth()->user()->name }} Já realizou {{ \App\Models\Parlamento\TaskActivities::countMyTascks()}}</span>
                            </h3>
                        </div>

                        <div class="card-body pt-1 ">
                            @foreach(\App\Models\Parlamento\TaskActivities::myTaskRecentily() as $task)
                                <div class="d-flex flex-stack mb-2 item-border-hover px-3 py-2 ms-n3">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center">
                                        <img style="border-radius: 100%; width: 35px; height: 35px"
                                             src="{{ auth()->user()->getAvatarN($task->primavera_email) }}"
                                             alt="" class="w-35px me-6 img-circle">

                                        <div class="pe-2">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">
                                                {{Date::parse($task->created_at)->format('d-m-Y H:i.s') }}
                                            </a>
                                            <div class="text-gray-400 fw-bold mt-1">{{ $task->action_info }}</div>
                                        </div>
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Label-->
                                    <span class="label bg-light w-25px h-25px fs-7 fw-bolder">1</span>
                                    <!--end::Label-->
                                </div>
                            @endforeach





                            {{--<div
                                class="rounded border-primary bg-light-primary border border-dashed px-6 py-5 fw-bold fs-4">
                                <span class="text-primary me-1">Intive New .NET Collaborators</span>
                                <span class="text-gray-600">Alerta</span>
                            </div>--}}

                        </div>

                    </div>


                </div>

                <div class="col-xl-12">
                    <div class="card mb-5 mb-xxl-8">
                        <div class="card-header align-items-center border-0 mt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="fw-bolder text-dark fs-2">Lista de Utilizadores</span>
                                <span
                                    class="text-gray-400 mt-2 fw-bold fs-6">Sr. {{ auth()->user()->name }} Já realizou {{ \App\Models\Parlamento\TaskActivities::countMyTascks()}}</span>
                            </h3>
                        </div>

                        <div class="card-body pt-1">
                            @foreach($usersLis as $userBt)
                                <div class="d-flex flex-stack mb-2 item-border-hover px-3 py-2 ms-n3">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center">
                                        <img style="border-radius: 100%; width: 35px; height: 35px"
                                             src="{{ $userBt->getAvatarN($userBt->name.'@parlamento.ao') }}"
                                             alt="" class="w-35px me-6 img-circle">

                                        <div class="pe-2">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">
                                                {{ $userBt->name }}
                                            </a>
                                            <div class="text-gray-400 fw-bold mt-1">{{ $userBt->created_at }}</div>
                                        </div>
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Label-->
                                    <span class="label bg-light w-25px h-25px fs-7 fw-bolder">1</span>
                                    <!--end::Label-->
                                </div>
                            @endforeach





                            {{--<div
                                class="rounded border-primary bg-light-primary border border-dashed px-6 py-5 fw-bold fs-4">
                                <span class="text-primary me-1">Intive New .NET Collaborators</span>
                                <span class="text-gray-600">Alerta</span>
                            </div>--}}

                        </div>

                    </div>


                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
    <script>

        window.addEventListener('send-success-video', evt => {
            toastr.success(evt.detail.message)
        })


    </script>

@endpush