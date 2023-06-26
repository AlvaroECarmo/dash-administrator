<div class="" style="transition: margin-left 4s;">

    <div class="historico"
         style="position: absolute; width: 100%; height: 100% ;  z-index: 100; background-color: rgba(0,0,0,.3)" {{ $open?'':'hidden' }}>
        <div class="card">
            <div class="row p-2 " style="">

                <div class="col-md-12">
                    <!-- The time line -->
                    <div class="timeline">
                        <!-- timeline time label -->
                        <div class="time-label " style=" z-index: 100">
                            <a class="btn btn-danger btn-sm pl-2 pr-2" style="cursor:pointer;"
                               wire:click.prevent="closeHistory"><i class="fas fa-times"></i> Fechar Detalhes
                            </a>
                        </div>

                        <div class="">
                            <i class="fab fa-buffer bg-blue"></i>
                            <div class="timeline-item ">
                                <span class="time"><i
                                        class="fas fa-clock "></i> {{ (date('H') + 1) .date(':i:s') }}</span>
                                <h3 class="timeline-header">
                                    <span href="#" class="text-black">DADOS DA JUSTIFICAÇÃO DE FALTA</span>
                                </h3>

                                <div class="card-body">
                                    <table class="table table-sm border-0"
                                           style="border: none!important; background: #fff;">
                                        <thead class="p-0 m-0 border-0">
                                        <tr class="p-0 m-0 table-success">
                                            <td style="width: 120px">Funcionário</td>
                                            <td class="pl-3">
                                                <span style="width: 120px">
                                                    {{ ucwords(mb_strtolower($tarefas['pessoaNome'])) }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="p-0 m-0 border-bottom">
                                            <td style="width: 120px">Motiovo</td>
                                            <td class="pl-3">
                                                <span style="width: 120px">
                                                    {{ ucfirst(mb_strtolower($tarefas['designacaoCodigoJustificacao'])) }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 120px">Oservação</td>
                                            <td style="background: rgba(77,168,241,0.06); text-align: justify">
                                                    <textarea class="form-control" name="" id="" cols="10" disabled
                                                              style="background: transparent!important; border: none"
                                                              rows="3">{!! $tarefas['observacoes']  !!}</textarea>
                                            </td>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="">
                            <i class="fas fa-tasks  bg-blue"></i>
                            <div class="timeline-item ">
                                <span class="time"><i
                                        class="fas fa-clock "></i> {{ (date('H') + 1) .date(':i:s') }}</span>
                                <h3 class="timeline-header">
                                    <span href="#" class="text-black text-uppercase">Detalhes da Justificação</span>
                                </h3>

                                <div class="card-body">
                                    <table class="table table-sm border-0">
                                        <thead class="table-primary text-uppercasel">
                                        <tr class="pl-2 pr-2 border-bottom border-info">
                                            <th class="pl-2 pr-2">Data</th>
                                            <th style="width: 220px">Numero de Faltas</th>
                                            <th>Tipo de falta</th>
                                            <th>Entrada</th>
                                            <th>Saida</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($tarefe as $linhas)
                                            <tr class="pl-2 pr-2 border-bottom">
                                                <td class="pl-2 pr-2">{{ $linhas['dataFalta'] }}</td>
                                                <td class="pl-2 pr-2 text-right">{{ $linhas['numFaltas'] }}</td>
                                                <td class="pl-2 pr-2">
                                                    @include('livewire.listas.component.data-table.small-type-td' ,['typeId'=>$linhas['tipo']])
                                                </td>
                                                <td class="pl-2 pr-2 text-right">
                                                    @include('livewire.listas.component.data-table.time-td-format', ['time'=>$linhas['entrada'] ])
                                                </td>
                                                <td class="pl-2 pr-2 text-right">
                                                    @include('livewire.listas.component.data-table.time-td-format', ['time'=>$linhas['saida'] ])
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>


                            </div>
                        </div>
                        <div class="">
                            <i class="fa fa-paperclip bg-blue"></i>
                            <div class="timeline-item ">
                                <span class="time"><i
                                        class="fas fa-clock "></i> {{ (date('H') + 1) .date(':i:s') }}</span>
                                <h3 class="timeline-header">
                                    <span href="#" class="text-black text-uppercase">Anexos da Justificação</span>
                                </h3>

                                <div class="card-body">
                                    <table class="table table-sm border-0">
                                        <thead class="table-warning text-uppercasel">
                                        <tr class="pl-2 pr-2 border-bottom border-info">
                                            <th class="pl-2 pr-2">Titulo</th>
                                            <th style="width: 160px">Nº Justificação</th>
                                            <th>Anexo</th>
                                            <th>acção</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($anexos as $linhas)
                                            <tr class="pl-2 pr-2 border-bottom">
                                                <td class="pl-2 pr-2">
                                                    {{ $linhas['tituloAnexo'] }}
                                                </td>
                                                <td class="pl-2 pr-2 text-right">
                                                    {{ $linhas['justificacaofalta_id'] }}
                                                </td>
                                                <td class="pl-2 pr-2">
                                                    <i class="fa fa-paperclip"></i> &nbsp;
                                                    {{  $linhas['FileName'] }}
                                                </td>
                                                <td class="pl-2 pr-2 text-right">

                                                    <a class="text-primary text-right" download
                                                       href="{{ asset($linhas['anexo']) }}"> <i
                                                            class="fa fa-download"></i> Baixar o arquivo
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>

        window.addEventListener('show-history', event => {
            // @this.set('justificao', event.detail.justificacao);
        @this.set('open', true);
        });
    </script>
@endpush
