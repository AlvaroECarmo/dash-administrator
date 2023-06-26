<tr>
    <td class="">
        <div style="overflow: hidden; text-overflow: ellipsis; width:98%;
                                 border:1px; white-space:nowrap; ">
            {{ $linhas['name'] }}
        </div>
    </td>
    <td class="">
        <div style="overflow: hidden; text-overflow: ellipsis; width:98%;
                                 border:1px; white-space:nowrap; ">
            {{ $linhas['department'] }}
        </div>

    </td>
    <td class="">
        {!! $linhas['isAdmin']?'<span>Adiministrador</span>':'<span class="text-muted">Participante</span>' !!}
    </td>
    <td class="text-right">
        <a class="text-secondary btn-sm text-primary " data-toggle="tooltip"
           style="cursor: pointer" wire:click.prevent="changeMember({{ $linhas }})"
           title="Eliminar a justificação com o seu fluxo">
            <i class="far fa-edit"></i>
        </a>
        <a class="text-secondary btn-sm text-danger " data-toggle="tooltip"
           style="cursor: pointer" wire:click.prevent="delectMember({{ $linhas }})"
           title="Eliminar a justificação com o seu fluxo">
            <i class="far fa-trash-alt"></i> </a>
    </td>

</tr>
