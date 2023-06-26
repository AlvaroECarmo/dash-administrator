<tr id="collapseThree{{$tarefas['id']}} m-0 p-0" style="position: relative; /*background: #5c6773*/"
    class="collapse @if($element['id']==$tarefas['id']) {{ $element['collapse']  }}@endif"
    data-parent="#accordion">

    <td class="pl-4 pr-0 pt-2 pb-0 m-0 ">
        <div class="card p-3 position-absolute "
             style="width: 100% ; left: 0px; top: 0px; max-height: 300px!important; overflow-y: auto!important;">
            <table class="border-0 m-0 p-0">
                <tbody>
                <tr>
                    <td style="width: 12%; min-width: 200px!important;  background: #fff;">
                        <span class="font-weight-bold">Datados da Justificação da Falta</span>
                        <table class="table table-sm border-0"
                               style="border: none!important; background: #fff;">
                            <thead class="p-0 m-0 border-0">
                            <tr class="p-0 m-0 table-primary">
                                <td style="width: 120px">Motiovo</td>
                                <td class="pl-3">
                                <span style="width: 120px">
                                    {{ ucfirst(mb_strtolower($tarefas['designacaoCodigoJustificacao'])) }}
                                </span>
                                </td>
                            </tr>
                            <tr class="border-bottom">
                                <td style="width: 120px">Oservação</td>
                                <td style="background: rgba(77,168,241,0.06); text-align: justify">
                                 <textarea class="form-control" name="" id="" cols="10" disabled
                                           style="background: transparent!important; border: none"
                                           rows="3">{!! $tarefas['observacoes']  !!}</textarea>
                                </td>
                            </tr>
                            </thead>
                        </table>
                        <span class="font-weight-bold " style="margin-top: 5px">
                            Detalhes da Justificação
                        </span>
                        <table class="table table-sm border-0 mb-0">
                            <thead class="table-primary text-uppercasel">
                            <tr class="pl-2 pr-2 border-bottom border-info">
                                <th class="pl-2 pr-2">Data</th>
                                <th style="width: 220px">Numero de Faltas</th>
                                <th>Tipo de falta</th>
                                <th style="width: 210px">Entrada</th>
                                <th style="width: 210px">Saida</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tarefas->linhasFaltasOnTask() as $linhas)
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
                        <br>
                        @if($tarefas->anexosList())
                            <span class="font-weight-bold " style="margin-top: 5px">
                                Anexos da justicação
                            </span>
                            <table class="table table-sm border-0">
                                <thead class="table-warning text-uppercasel">
                                <tr class="pl-2 pr-2 border-bottom border-info">
                                    <th class="pl-2 pr-2">Titulo</th>
                                    <th style="width: 50%">Anexo</th>
                                    <th style="width: 210px">Acção</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($tarefas->anexosList() as $linhas)
                                    <tr class="pl-2 pr-2 border-bottom">
                                        <td class="pl-2 pr-2">
                                            {{ $linhas['tituloAnexo'] . 'nº '. $linhas['justificacaofalta_id']}}
                                        </td>
                                        {{--
                                            <td class="pl-2 pr-2 text-right">
                                                 {{ $linhas['justificacaofalta_id'] }}
                                             </td>
                                         --}}
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
                        @else
                            <div class="">
                                <span class="font-weight-bold text-warning" style="margin-top: 5px">
                                   Sem registrado. (anexo)
                                </span>
                            </div>
                        @endif
                    </td>

                </tr>
                </tbody>
            </table>
            <span
                class="mb-2 ml-1 text-muted">{{ (collect($tarefas->linhasFaltasOnTask())->count() - 3)>0?'Total: '.collect($tarefas->linhasFaltasOnTask())->count().' clique em ver mais detales, para visualizar outras informações.':'' }}</span>
            <br>
            <div class="row">

                <a class="btn btn-sm btn-warning float-left mt-2 " style="max-width: 30px!important;"
                   data-toggle="collapse tooltip" href="#collapseThree{{$tarefas['id']}}"
                   title="Fechar os detalhes da justificalão da falta"
                   wire:click="openDetails({{$tarefas['id']}})">
                    <i class="fa fa-chevron-up"></i>
                </a>
                {{-- <a href="#" class="btn btn-sm btn-info mt-2 ml-2" style="float: left"
                    data-toggle="tooltip" title="veja mais informações da justificação da falta"
                    wire:click.prevent="openDetailsView({{ $tarefas }})">
                     ver mais..--}}{{-- <i class="fa fa-arrow-right"></i>--}}{{--
                 </a>--}}
            </div>
            <br>

        </div>
    </td>

</tr>
