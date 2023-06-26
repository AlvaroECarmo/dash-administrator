<div>
    <div class="card-body pr-0 pl-0">
        <div class="row">
            <div class="col-5 col-sm-3" style="min-height: 450px">
                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                     aria-orientation="vertical">
                    <a class="nav-link active" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages"
                       role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Dashboard da DRH</a>

                    {{-- <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home"
                        role="tab" aria-controls="vert-tabs-home" aria-selected="true">Dashboard Funcionário</a>
                     <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile"
                        role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Dashboard Manager</a>--}}

                    @if (Auth::user()->isSuperAdmin())
                        {{--<a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-outinoffice"
                           role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Areas da aplicação</a>--}}
                    @endif
                </div>
            </div>
            <div class="col-7 col-sm-9">
                <div class="tab-content" id="vert-tabs-tabContent">
                    <div class="tab-pane text-left pt-0 pr-0 fade" id="vert-tabs-home" role="tabpanel"
                         aria-labelledby="vert-tabs-home-tab">
                       {{-- @livewire('listas.permissio.lista-dashboard-funcionario')--}}
                    </div>
                    <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel"
                         aria-labelledby="vert-tabs-profile-tab">
                       {{-- @livewire('listas.permissio.lista-dashboard-manager')--}}
                    </div>
                    <div class="tab-pane fade  show active" id="vert-tabs-messages" role="tabpanel"
                         aria-labelledby="vert-tabs-messages-tab">
                        {{--@livewire('listas.permissio.lista-dashboard-drh')--}}
                    </div>
                    @if (Auth::user()->isSuperAdmin())
                        <div class="tab-pane fade" id="vert-tabs-outinoffice" role="tabpanel"
                             aria-labelledby="vert-tabs-messages-tab">
                           {{-- @livewire('forms.permissoes.group-activation')--}}
                        </div>
                    @endif

                </div>
            </div>

          {{--  @livewire('forms.permissoes.new-members')--}}
        </div>
    </div>
</div>
