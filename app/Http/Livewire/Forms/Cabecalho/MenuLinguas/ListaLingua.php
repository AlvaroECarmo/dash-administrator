<?php

namespace App\Http\Livewire\Forms\Cabecalho\MenuLinguas;

use App\Http\Livewire\Base\PaginatedComponent;
use App\Models\FunctionComuns;
use App\Models\Parlamento\Headercontent;

class ListaLingua extends PaginatedComponent
{
    use FunctionComuns;

    public $data = ['designation' => ''];
    protected $listeners = ['refreshPage'];

    public function render()
    {
        $itens = Headercontent::where('listLange', '!=', null)->paginate(3);
        return view('livewire.forms.cabecalho.menu-linguas.lista-lingua',
            ['headercontentList' => $itens]
        );
    }

    public function updateElement(Headercontent $data)
    {
        $this->emit('sendData', $data);
    }

    public function receiveElementToDelete(Headercontent $attribute)
    {
        $this->data = $attribute;
        $this->dispatchBrowserEvent('show-modal');
    }

    public function deleteElement()
    {
        if ($this->data) {
            $this->data->delete();
            $this->render();
            $this->dispatchBrowserEvent('send-success', ['message' => 'Dados da lingua eliminado com sucesso!']);
            $this->dispatchBrowserEvent('hide-modal');
        } else {
            $this->dispatchBrowserEvent('send-success', ['message' => 'Não foi selecionado o elemento que pretendes eliminar!']);
        }

    }

    public function refreshPage()
    {
        $this->render();
    }
}
