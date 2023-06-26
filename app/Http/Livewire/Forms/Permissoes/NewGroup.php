<?php

namespace App\Http\Livewire\Forms\Permissoes;


use App\Models\External\PRIMAVERA\Departamento;
use App\Models\GetJSON;
use App\Models\Parlamento\Group;
use App\Models\Parlamento\GroupsHasViews;
use App\Models\Parlamento\TaskActivities;
use Illuminate\Routing\Route;
use Illuminate\Support\Fluent;
use Livewire\Component;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\View\View;
use \Illuminate\Contracts\Foundation\Application;

class NewGroup extends Component
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
        "read" => true
    ];
    public $icon_region;
    public $route;
    public $listMenus = array();
    public $arraySelect = array();
    public $departa = array();
    public $departaKeys = array();
    public $departamento = array();
    public $selectDepartamento;
    public $personalize = false;
    public $inputName;


    public function mount(): void
    {
        $dataX = $this->parseEncode('mainmenu.json')['mainmenu'];

        $data = array_merge_recursive($this->parseEncode('mainmenu.json')['mainmenu']);
        $items = array();
        foreach ($dataX as $key => $value) {
            if ($value['url'] != '#') {
                $items[$key] = ['key' => $key, 'name' => $value['Title'], 'url' => ($value['url'] ?? null)];
            }

            if (is_array($value['elements'])) {
                foreach ($value['elements'] as $i => $y) {
                    $items[$key . ':' . $i] = ['key' => $key . ':' . $i, 'name' => $value['Title'] . ' - ' . $y['SubTitle'], 'url' => $y['url']];
                }
            }

        }
        $this->listMenus = $items;

    }


    public function render(): Factory|View|Application
    {
        return view('livewire.forms.permissoes.new-group');
    }

    public function sendInfo(): void
    {
        if (!$this->personalize) {

            foreach ($this->departaKeys as $key) {

                $nome = Departamento::where('Departamento', $key)->first()->Descricao ?? 'not found';

                $contextArra = array();
                $group = Group::create([
                    'path' => date('YmdHis') . str_replace(' ', '_', $this->data['name']),
                    'full_path' => date('YmdHis'),
                    'name' => $nome,
                    'status' => $this->data['status']
                ]);

                $contextArra['Group'] = $group->toArray();
                foreach ($this->arraySelect as $config) {

                    $u = $this->listMenus[$config];

                    $contex = GroupsHasViews::create([
                        'path' => $u['url'],
                        'group_id' => $group->id,
                        'view_id' => str_replace(':', '', $config),
                        'name_views' => $u['name'],
                        'name_group' => $group->name,
                        'crate_permission' => $this->data['create'],
                        'read_permission' => $this->data['read'],
                        'update_permission' => $this->data['update'],
                        'delete_permission' => $this->data['remove'],
                        'publishte_permission' => $this->data['publish'],
                        'status' => 1,
                        'view_id_parent' => $config
                    ]);

                    $contextArra['GroupsHasViews'][] = $contex->toArray();
                }

                TaskActivities::create([
                    'primavera_email' => auth()->user()->ldap->getEmail() ?? 'administrator@parlamento.ao',
                    'data_tool_info' => json_encode($contextArra, true),
                    'action_info' => 'Foi criado um novo grupo | ' . auth()->user()->name,
                    'seccion_info' => 'Created',
                    'user_id' => auth()->user()->id,
                    'task_identity' => $group->id,
                    'class_name' => 'Livewire.Forms.Permissoes.NewGroup',
                ]);
            }
        } else {


            $contextArra = array();
            $group = Group::create([
                'path' => date('YmdHis') . str_replace(' ', '_', $this->data['name']),
                'full_path' => date('YmdHis'),
                'name' => $this->inputName,
                'status' => $this->data['status']
            ]);

            $contextArra['Group'] = $group->toArray();
            foreach ($this->arraySelect as $config) {

                $u = $this->listMenus[$config];

                $contex = GroupsHasViews::create([
                    'path' => $u['url'],
                    'group_id' => $group->id,
                    'view_id' => str_replace(':', '', $config),
                    'name_views' => $u['name'],
                    'name_group' => $group->name,
                    'crate_permission' => $this->data['create'],
                    'read_permission' => $this->data['read'],
                    'update_permission' => $this->data['update'],
                    'delete_permission' => $this->data['remove'],
                    'publishte_permission' => $this->data['publish'],
                    'view_id_parent' => $config,
                    'status' => 1
                ]);

                $contextArra['GroupsHasViews'][] = $contex->toArray();
            }
            TaskActivities::create([
                'primavera_email' => auth()->user()->ldap->getEmail() ?? 'administrator@parlamento.ao',
                'data_tool_info' => json_encode($contextArra, true),
                'action_info' => 'Foi criado um novo grupo | ' . auth()->user()->name,
                'seccion_info' => 'Created',
                'user_id' => auth()->user()->id,
                'task_identity' => $group->id,
                'class_name' => 'Livewire.Forms.Permissoes.NewGroup',
            ]);
        }
        $this->emit('success');
        $this->dispatchBrowserEvent('send-success', ['message' => 'O grupo foi criado com sucesso!']);
        //dump($this->data, $this->arraySelect, $group);
    }

    public function departamento($is)
    {
        return (Departamento::where('Departamento', $is)->first()->Descricao ?? 'not found');
    }

}
