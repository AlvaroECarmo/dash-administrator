<?php

namespace App\Http\Livewire\Forms\Cabecalho\MenuPrincipal;

use App\Http\Controllers\API\Publish\MenuAPIController;
use App\Http\Livewire\Base\PaginatedComponent;
use App\Models\FunctionComuns;
use App\Models\Parlamento\Mainmenu;

class ListaMenu extends PaginatedComponent
{
    use FunctionComuns;

    public $nameSeach;
    public $nameInterno;
    protected $listeners = ['updatedOne'];

    public function render()
    {

        $name = $this->nameInterno;

        $listMenu = Mainmenu::with('elements')->where('elements', null)
            ->where('context', 'LIKE', "%{$this->nameSeach}%")
            ->whereHas('elements', function ($q) use ($name) {
                if ($name) {
                    return $q->where('context', 'LIKE', "%{$name}%");
                }
                else {
                    return $q;
                }
            })
            ->orderBy('ordem')
            ->get();
        return view('livewire.forms.cabecalho.menu-principal.lista-menu', ['listMenu' => $listMenu]);
    }

    public function editingThenParent(Mainmenu $element)
    {
        $this->emit('sendMainMenu', $element);
    }

    public function deleteThenParent(Mainmenu $element)
    {
        $element->delete();
        $this->dispatchBrowserEvent('send-success', ['message' => 'Registo removido com sucesso!']);
    }

    public function updateTaskOrder($list)
    {
        foreach ($list as $item) {
            Mainmenu::find($item['value'])->update(['ordem' => $item['order']]);
        }
    }


}
