<tr class="p-0 m-0" style="background: #fff!important; width: 100%!important;">
    <td class="p-0 m-0">
        <table class="pb-0 m-0" style="width: 100%!important;">
            <tbody class="p-0 m-0">
            <tr style="background: #fff!important;" class="m-0 pb-0 border-bottom">
                <td>

                </td>
                <td style="width: 12%; min-width: 200px!important; " class="m-0 p-0">
                    <i style="font-size: 8px!important;" class="text-success fa fa-circle"></i>
                    <span class="font-weight-bold text-muted" style="vertical-align: center">
                          {{ Date::parse($tarefas->tastDateCreated())->format('H:i:s') }} -
                          {{ $semana[Date::parse($tarefas->tastDateCreated())->format('l')] }}
                    </span>
                </td>

                <td class="m-0  text-muted text-right pr-3" style="width: 10%; min-width: 100px!important;">
                    @if(collect($tarefas->linhasFaltasOnTask())->count() < 2)
                        <span class="badge badge-secondary">
                            {!!   collect($tarefas->linhasFaltasOnTask())->count() !!}
                        </span>
                    @else
                        <span class="badge badge-warning">
                            {!!   collect($tarefas->linhasFaltasOnTask())->count() !!}
                        </span>
                    @endif


                </td>
                <td class="m-0 text-left">
                    {{ $tarefas['pessoaNome'] }}
                </td>
                <td class="m-0 text-left pl-2" style="width: 25%">
                    {!! $tarefas->devolveDepartamento()?$tarefas->devolveDepartamento():'<span class="text-muted">Sem registro </sapn>' !!}
                </td>
                <td class="m-0 text-left pl-2" style="width: 10%">
                    <span class="badge badge-secondary">
                    {{ Date::parse($tarefas->dataPedidoJustificacao)->format('d-m-Y') }}
                    </span>
                </td>
                <td class="m-0 p-1" style="width: 170px; text-align: right">

                    @if(Auth::user()->isMemberDrAdmin() || Auth::user()->isAdmin()
                        || Auth::user()->isInterinando() || Auth::user()->isManager())
                        @if ($action){{--, 'action'=>false--}}
                        <span>
                              <a href=""
                                 class="btn text-primary btn-sm" data-toggle="tooltip"
                                 wire:click.prevent="actiction({{ $tarefas }}, 'aproved')"
                                 title="Aprovar a Justificação da Falta">
                                  <i class="fa fa-thumbs-up"></i>
                              </a>
                        </span>
                        <span>
                              <a href=""
                                 wire:click.prevent="actiction({{ $tarefas }}, 'reject')"
                                 class="btn text-danger btn-sm" data-toggle="tooltip"
                                 title="Rejeitar a Justificação da Falta">
                                  <i class="fa fa-thumbs-down"></i>
                              </a>
                        </span>
                        @endif
                    @endif
                    <a class="text-secondary btn btn-sm" data-toggle="collapse tooltip"
                       title="Observar os detalhes da justificação de falta"
                       href="#collapseThree{{$tarefas['id']}}"
                       wire:click="openDetails({{$tarefas['id']}})">
                        <i class=" @if($element['id']==$tarefas['id'])
                            text-primary fas fa-chevron-down @else
                            fas fa-chevron-left @endif"></i>
                    </a>

                </td>
            </tr>
            </tbody>
        </table>
    </td>

</tr>
