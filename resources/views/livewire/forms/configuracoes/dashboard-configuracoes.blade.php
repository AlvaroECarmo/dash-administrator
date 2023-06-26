<div>
    <div class="card-body pr-0 pl-0">
        <div class="row">
            <div class="col-5 col-sm-3" style="min-height: 450px">
                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                     aria-orientation="vertical">
                    <a class="nav-link active" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-workList"
                       role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Fluxo de Trabalho</a>
                    <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-outinoffice"
                       role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Lista Out Of Office</a>
                </div>
            </div>
            <div class="col-7 col-sm-9">
                <div class="tab-content" id="vert-tabs-tabContent">
                    <div class="tab-pane fade show active" id="vert-tabs-workList" role="tabpanel"
                         aria-labelledby="vert-tabs-messages-tab">
                        @livewire('listas.configuracoes.lista-worklist')
                    </div>
                    <div class="tab-pane fade" id="vert-tabs-outinoffice" role="tabpanel"
                         aria-labelledby="vert-tabs-messages-tab">
                        @livewire('listas.configuracoes.lista-outorin-office')
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
