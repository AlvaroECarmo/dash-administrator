<?php

namespace App\Http\Livewire\Forms\Permissoes;

use App\Http\Livewire\Base\PaginatedComponent;
use App\Models\Parlamento\Group;
use App\Models\Parlamento\GroupsHasViews;

class ListaGroup extends PaginatedComponent
{

    public $openDetails;
    public $data = array();
    public $activactInfo = 'Show All';
    public $seachWord;

    protected $listeners = ['success'];

    public function boot()
    {

    }

    public function mount()
    {

    }

    public function render()
    {

        return view('livewire.forms.permissoes.lista-group', [
            'listaGrupos' => Group::paginate(7),
        ]);
    }

    public function openDetalhes($attr)
    {
        if ($this->openDetails != $attr) {
            $this->openDetails = $attr;
        } else {
            $this->openDetails = 0;
        }

    }

    public function carregar($attr)
    {
        $this->data[$attr['id']] = [
            "id" => $attr['id'],
            "crate_permission" => $attr['crate_permission'],
            "read_permission" => $attr['read_permission'],
            "update_permission" => $attr['update_permission'],
            "delete_permission" => $attr['delete_permission'],
            "publishte_permission" => $attr['publishte_permission'],
        ];
    }

    public function clickedFirst($attr)
    {

        $instance = $this->data[$attr['id']];
        $ds = GroupsHasViews::where('id', $attr['id'])->update([
            "crate_permission" => $instance['crate_permission'],
            "read_permission" => $instance['read_permission'],
            "update_permission" => $instance['update_permission'],
            "delete_permission" => $instance['delete_permission'],
            "publishte_permission" => $instance['publishte_permission'],
        ]);
    }

    public function openDelete($attr)
    {

        Group::where('id', $attr['id'])->delete();

        GroupsHasViews::where('group_id', $attr['id'])->delete();
        $this->dispatchBrowserEvent('send-success', ['message' => 'O grupo foi removido com sucesso!']);
    }

    public function randClass()
    {
        return 'badge-light-warning';
    }

    public function delectEvent(GroupsHasViews $attr)
    {
        $attr->delete();
        $this->dispatchBrowserEvent('send-success', ['message' => 'O Menu foi removido com sucesso!']);
    }

    public function success()
    {
        $this->render();
    }
}
