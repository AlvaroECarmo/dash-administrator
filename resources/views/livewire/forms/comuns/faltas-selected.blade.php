<div>
    <table class="table table-striped table-sm table-hover table-bordered">
        <thead>
        <tr class="text-uppercase table-primary">

            <th>Data</th>
            <th class="d-none d-sm-table-cell" style="width: 15%;">Nº de Faltas</th>

            <th class="d-none d-sm-table-cell" style="width: 15%">Entrada</th>
            <th class="d-none d-sm-table-cell" style="width: 15%">Saída</th>
            <th class="d-none d-sm-table-cell" style="width: 15%">Atraso</th>
            <th class="d-none d-sm-table-cell" style="width: 20%">Tipo de Falta</th>

            {{-- <th style="min-width: 40px!important; max-width: 40px!important;" class="text-center">Acções</th>--}}
        </tr>
        </thead>
        <tbody>

        {{--@foreach($listaFInjustificadas as $faltas)
            <tr @if($faltas->faltaEmprocessamento()) style="background: rgba(52,243,135,0.16)" @endif>

                <td class="d-none d-sm-table-cell">
                    {{  Date::parse($faltas['Data'])->format('d-m-Y')  }}
                </td>
                <td class="d-none d-sm-table-cell text-right">
                    {{  $faltas->countFaltas() }}
                </td>
                <td class="d-none d-sm-table-cell text-right ">
                    @include('livewire.listas.component.data-table.time-td-format', ['time'=>$faltas['E1']])
                </td>
                <td class="d-none d-sm-table-cell text-right">
                    @include('livewire.listas.component.data-table.time-td-format', ['time'=>$faltas['S1']])
                </td>
                <td class="d-none d-sm-table-cell text-right ">
                    @include('livewire.listas.component.data-table.time-td-format', ['time'=>$faltas['Falta']])
                </td>
                <td class="d-none d-sm-table-cell">

                    @include('livewire.listas.component.data-table.small-type-td' ,['typeId'=>$faltas['Tipo']])
                </td>
            </tr>
        @endforeach
--}}
        </tbody>

    </table>
</div>
