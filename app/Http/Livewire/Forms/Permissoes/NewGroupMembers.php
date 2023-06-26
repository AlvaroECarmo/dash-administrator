<?php

namespace App\Http\Livewire\Forms\Permissoes;

use App\Models\External\PRIMAVERA\Funcionario;
use App\Models\GetJSON;
use App\Models\Parlamento\Group;
use App\Models\Permitions\GroupsHasUsers;
use Livewire\Component;

class NewGroupMembers extends Component
{
    use GetJSON;

    public $cabecalho = ['statuSelector' => null, 'iconSelector' => null, 'datetime' => null];
    public $data = [
        'id' => '',
        'name' => null,
        'status' => false,
        "create" => false,
        "remove" => false,
        "update" => false,
        "publish" => false,
        "read" => true,
    ];

    public $funcionario = array();
    public $icon_region;
    public $route;
    public $listGroups = array();
    public $valueSelectE = array();

    public function mount(): void
    {

        $this->listGroups = Group::all();

    }

    public function render()
    {

        return view('livewire.forms.permissoes.new-group-members');
    }

    public function funcionario($e)
    {
        return Funcionario::where('Email', $e)->first()->Nome ?? 'not found';
    }

    public function sendInfo()
    {
        $names = " | ";
        foreach ($this->funcionario as $emails) {
            $nm = Funcionario::where('Email', $emails)->first()->Nome ?? 'Not found';
            $names .= ', ' . $nm;

            $grus = $this->valueSelectE;

            $dataTY = Group::where('id', $grus)->first();

            $d = GroupsHasUsers::create([
                'user_email' => $emails,
                'group_id' => $dataTY['id'],
                'read_permition' => 1,
                'write_permition' => 1,
                'name' => $dataTY['name'],
                'status' => $this->data['status'],
                'description' => " | " . auth()->user()->id . " Chave do responsavel que lhe insireu no crupo",

            ]);

            // TaskActivities::create([
            //     'primavera_email' => auth()->user()->ldap->getEmail() ?? 'administrator@parlamento.ao',
            //     'data_tool_info' => json_encode($d, true),
            //     'action_info' => 'Add | ' . __($nm ?? 'Laravel Admin'),
            //     'seccion_info' => 'Created',
            //     'user_id' => auth()->user()->id,
            //     'task_identity' => $grus['id'],
            //     'class_name' => 'Livewire.Forms.Permissoes.NewGroupMembers',
            // ]);

        }

        $this->dispatchBrowserEvent('send-success', ['massage' => $names . ' foram inseridos no grupo com sucesso!']);
        $this->emit('sucessFull');
    }
}
