<?php

namespace App\Http\Livewire\Forms\RodapeSite\Notificacao;

use App\Http\Livewire\Base\PaginatedComponent;
use App\Models\Parlamento\Notify;
use Livewire\Component;

class ListaNotify extends PaginatedComponent
{

    protected $listeners = ['sucessFrom'];

    public function render()
    {

        $pa = Notify::paginate(10);

        return view('livewire.forms.rodape-site.notificacao.lista-notify', [
            'notify' => $pa
        ]);
    }

    public function publicarInfo($attr)
    {
        $dataSend = response()->json($attr, 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE)->content();

        \Storage::disk('public')->put('json/Notificacao.json', $dataSend);
        $this->dispatchBrowserEvent('showSuccess', ['message' => 'Foi publicado a notificação com sucesso!']);
    }

    public function removaPublica($attrs)
    {
        $dataSend = response()->json("", 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE)->content();

        \Storage::disk('public')->put('json/Notificacao.json', $dataSend);
        $this->dispatchBrowserEvent('showSuccess', ['message' => 'Foi Removido a publicação a notificação com sucesso!']);
    }

    public function deletar($attr)
    {
        Notify::where('id', $attr['id'])->delete();
        $this->dispatchBrowserEvent('showSuccess', ['message' => 'Foi Eliminado a notificação com sucesso!']);
    }

    public function wireEditting($attr)
    {
        $this->emit('editWires', $attr);
    }

    public function sucessFrom()
    {
        $this->render();
    }
}
