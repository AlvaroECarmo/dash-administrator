{{-- -------------------------------------------------------------- --}}
{{-- Componente : Widget - Dashboard                                --}}
{{-- Versão 1.0                                                     --}}
{{--                                                                --}}
{{-- EVENTOS:                                                       --}}
{{--    atualizaContagem: Evento poll para atualizar contagem       --}}
{{-- PARAMETROS:                                                    --}}
{{--    $contagem: Contagem do widget                               --}}
{{--    $titulo: Titulo do widget                                   --}}
{{--    $icon: Icone do widget (ex. 'fa fa-user')                   --}}
{{--    $url: Url do widget                                         --}}
{{--    $textoUrl: Texto do url                                     --}}
{{--                                                                --}}
{{-- -------------------------------------------------------------- --}}
<div class="col-lg-3 col-6">
    <div class="small-box bg-info">
        <div class="inner">
            <h3 wire:poll.30000ms="atualizaContagem">{{$contagem}}</h3>

            <p>{{$titulo}}</p>
        </div>
        <div class="icon">
            <i class="{{$icon}}"></i>
        </div>
        <a href="{{$url}}" class="small-box-footer">
            {{$textoUrl}} <i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>
</div>
