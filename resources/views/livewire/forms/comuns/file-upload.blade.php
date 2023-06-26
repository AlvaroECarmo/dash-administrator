<div class="row" wire:ignore.self style="max-height: 300px!important; overflow-y:auto ; overflow-x: hidden">
    <div class="col-md-12 m-0 p-0">
        <div class="">
            <div class="pl-2 pr-2">
                <h3 class="card-title"><i class="fa fa-paperclip"></i> Anexos</h3>
                <div id="actions" class="float-right">
                    <div class="">
                        <div class="btn-group w-100">
                            <span class="btn btn-success col fileinput-button btn-sm">
                                <i class="fas fa-plus"></i>
                                <span></span>
                            </span>
                            <button type="button" class="btn btn-primary col start btn-sm" hidden>
                                <i class="fas fa-upload"></i>
                                <span></span>
                            </button>
                            <button type="reset" class="btn btn-warning col cancel btn-sm">
                                <i class="fas fa-times-circle"></i>
                                <span></span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="" wire:ignore>
                <div class="col-lg-12 d-flex align-items-center mb-1 mr-0 ml-0">
                    <div class="fileupload-process w-100">
                        <div id="total-progress" class="progress progress-striped active" role="progressbar"
                             style="height: 1px"
                             aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                            <div class="progress-bar progress-bar-success" style="width:10%;"
                                 data-dz-uploadprogress></div>
                        </div>
                    </div>
                </div>
                <div class="table table-striped files m-0" id="previews">
                    <div id="template" class="row mt-2 align-items-end" style="vertical-align: bottom;">

                        <div class="col-auto">
                            <span class="preview"><img src="data:," alt="" hidden data-dz-thumbnail/></span>
                        </div>
                        <div class="col-11 d-flex align-items-center ">

                            <div class="row" style="overflow: hidden; text-overflow: ellipsis; width:98%;
                                 border:1px; white-space:nowrap; ">
                                {{--<div class="col-6 m-0 p-0">
                                    <input type="text" class="form-control form-control-sm">
                                </div>--}}
                                <div class="col-12 m-0 p-0">
                                    <span class="lead ml-2" data-dz-name></span>
                                    (<span data-dz-size></span>)
                                </div>

                                <div class="col-12 d-flex align-items-end mt-1 p-0 m-0">
                                    <div class="progress progress-striped active w-100" role="progressbar"
                                         aria-valuemin="0"
                                         style="height: 1px"
                                         aria-valuemax="100" aria-valuenow="0">
                                        <div class="progress-bar progress-bar-success" style="width:5%;"
                                             data-dz-uploadprogress></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-auto d-flex align-items-end float-right ">
                            &nbsp;{{-- Manter o espaçamento--}} &nbsp; &nbsp; &nbsp; &nbsp;
                            <div class="btn-group">
                                <button class="btn btn-primary start btn-sm" type="button" hidden>
                                    <i class="fas fa-arrow-up"></i>
                                    <span></span>
                                </button>
                                <button data-dz-remove class="btn btn-warning cancel btn-block btn-sm text-sm" hidden>
                                    <i class="fas trash fa-times-circle"></i>
                                    <span></span>
                                </button>

                                <button data-dz-remove class="btn btn-danger  delete btn-sm float-right">
                                    <i class="fas fa-times"></i>
                                    <span></span>
                                </button>
                            </div>
                        </div>

                        <strong
                            class="error text-danger text-sm pl-3 font-weight-normal" data-dz-errormessage>
                        </strong>


                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            {{--<div class="pl-2 pr-2">
                Carregar os comprovativos, da justificação de falta.
            </div>--}}
        </div>
        <!-- /.card -->

    </div>
</div>

