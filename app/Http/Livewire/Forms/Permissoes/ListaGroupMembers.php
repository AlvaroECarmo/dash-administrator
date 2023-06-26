<?php

namespace App\Http\Livewire\Forms\Permissoes;

use App\Http\Livewire\Base\PaginatedComponent;
use App\Models\External\PRIMAVERA\Funcionario;
use App\Models\Parlamento\GroupsHasViews;
use App\Models\Permitions\GroupsHasUsers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ListaGroupMembers extends PaginatedComponent
{
    public $openDetails;
    public $data = array();
    public $activactInfo = 'Show All';
    public $seachWord;
    public $utilizador;

    protected $listeners = ['sucessFull'];

    public function render()
    {
        $func = Funcionario::/*with('groupsInternal')*/
            whereIn('Email', GroupsHasUsers::distinct()->get(['user_email as Email']))
            ->paginate(7);

        return view('livewire.forms.permissoes.lista-group-members', [
            'funcionario' => $func,
        ]);
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

    public function openDetalhes($attr)
    {
        if ($this->openDetails != $attr) {
            $this->openDetails = $attr;
        } else {
            $this->openDetails = 0;
        }

    }

    public function permitionMode($attr)
    {
        return GroupsHasViews::where('group_id', $attr['group_id'])->get();
    }

    public function delectFunciotion($attr)
    {

        //dump($attr);
        GroupsHasUsers::where('id', $attr['id'])->delete();
        $this->dispatchBrowserEvent('send-success', ['message' => 'O ' . $attr['user_email'] . ' foi removido no ' . $attr['name']]);
        $this->render();
    }

    public function sucessFull()
    {
        $this->render();
    }

    public function impersonate($attrs)
    {

        $user = User::where('email', str_replace('@parlamento.ao', '', $attrs))->first();

        if ($user) {
            Auth::user()->impersonate($user);
            $this->redirect(route('home'));
        } else {
            $this->dispatchBrowserEvent('errorMessage', ['message' => 'Não foi criado no sistema o utilizador que pretendes acessar']);
        }

    }

    public function openDelete()
    {

        $this->dispatchBrowserEvent('errorMessage', ['message' => 'Erro no momento não foi adicionado esta funcionalidade.']);

    }

}
