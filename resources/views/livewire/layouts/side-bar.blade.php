
<div>
    <div id="kt_aside" class="aside" data-kt-drawer="true" data-kt-drawer-name="aside"
         data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
         data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
         data-kt-drawer-toggle="#kt_aside_mobile_toggle">

        <!--begin::Aside menu-->
        <div class="aside-menu flex-column-fluid">
            <!--begin::Aside Menu-->
            <div class="hover-scroll-overlay-y px-2 my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
                 data-kt-scroll-height="auto"
                 data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_header, #kt_aside_toolbar, #kt_aside_footer'}"
                 data-kt-scroll-offset="0">
                <!--begin::Menu-->
                <div class="menu menu-column menu-title-gray-800 menu-state-title-primary
                     menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold"
                     id="#kt_aside_menu" data-kt-menu="true">

                    @isset($mainMenu)
                        @foreach ($mainMenu as $item)



                            @if(auth()->user()->isAN($item))



                                @if ($item['elements'] == null)

                                <livewire:components.menu-item title="{{ $item['Title'] }}"
                                                               url="{{ $item['url'] }}"/>
                            @else
                                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">

                                    <livewire:components.menu-link title="{{ $item['Title'] }}"
                                                                   url="{{ $item['url'] }}"/>

                                    <div class="menu-sub menu-sub-accordion ">
                                        @foreach ($item['elements'] as $element)
                                            <livewire:components.menu-item title="{{$element['SubTitle']}}"
                                                                           url="{{ $element['url'] }}"/>
                                        @endforeach


                                    </div>
                                </div>
                            @endif

                            @endif

                        @endforeach
                    @endif

                </div>
                <!--end::Menu-->
            </div>

        </div>

        <div class="aside-footer flex-column-auto pb-5" id="kt_aside_footer">
            <div class="aside-user">
                <div class="aside-user d-flex align-items-sm-center justify-content-center py-5">
                    <div class="me-5">
                        <div class="symbol symbol-40px cursor-pointer"
                             data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                             data-kt-menu-placement="bottom-start"
                             data-kt-menu-overflow="true">
                            <img src="{{ $profile_image }}" alt=""/>
                        </div>
                    </div>
                    <div class="flex-row-fluid flex-wrap">
                        <div class="d-flex align-items-center flex-stack">
                            <div class="me-2">

                                <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bold lh-0">
                                    {{ auth()->user()->ldap->getDisplayName()}}
                                </a>

                                <span class="text-gray-400 fw-bold d-block fs-8">
                                    {{ auth()->user()->ldap->getDepartment() }}
                                </span>
                            </div>


                            @impersonating
                            <a href="{{route('leaveimpersonate')}}" class="mr-2"><span
                                    class="badge badge-light-primary badge-sm ">
                                    <span class="svg-icon svg-icon-2 svg-icon-gray-400  cursor-pointer">
                                      <i class="fa fa-user-lock"></i>
                                  </span>
                                </span>
                            </a>
                            @endImpersonating


                            <a wire:click="logoutRequest"><span
                                    class="badge badge-light-danger badge-sm text-dark">
                                Sair
                                <span class="svg-icon svg-icon-2 svg-icon-gray-400  cursor-pointer">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                           fill="none">
                                          <rect opacity="0.3" width="12" height="2" rx="1"
                                                transform="matrix(-1 0 0 1 15.5 11)" fill="black"/>
                                          <path
                                              d="M13.6313 11.6927L11.8756 10.2297C11.4054 9.83785 11.3732 9.12683 11.806 8.69401C12.1957 8.3043 12.8216 8.28591 13.2336 8.65206L16.1592 11.2526C16.6067 11.6504 16.6067 12.3496 16.1592 12.7474L13.2336 15.3479C12.8216 15.7141 12.1957 15.6957 11.806 15.306C11.3732 14.8732 11.4054 14.1621 11.8756 13.7703L13.6313 12.3073C13.8232 12.1474 13.8232 11.8526 13.6313 11.6927Z"
                                              fill="black"/>
                                          <path
                                              d="M8 5V6C8 6.55228 8.44772 7 9 7C9.55228 7 10 6.55228 10 6C10 5.44772 10.4477 5 11 5H18C18.5523 5 19 5.44772 19 6V18C19 18.5523 18.5523 19 18 19H11C10.4477 19 10 18.5523 10 18C10 17.4477 9.55228 17 9 17C8.44772 17 8 17.4477 8 18V19C8 20.1046 8.89543 21 10 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3H10C8.89543 3 8 3.89543 8 5Z"
                                              fill="#C4C4C4"/>
                                      </svg>
                                  </span>
                                </span>
                            </a>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
