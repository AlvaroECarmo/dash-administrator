<?php

namespace App\Http\Livewire\Forms\Permissoes;

use App\Models\External\AD\AD;
use App\Models\External\IDONIC\Pessoa;
use App\Models\Comuns\Group;
use App\Models\Comuns\GroupMember;
use Illuminate\Support\Str;
use Livewire\Component;

class NewMembers extends Component
{
    public $loader = true;
    public $group = ['web' => '', 'name' => '', 'observation' => ''];
    public $user = ['name' => '', 'department' => ''];
    public $users = array();
    public $isAdmin = false;
    public $observation;
    public $selectedName;
    public $editingFlag = false;

    protected $listeners = ['executeViews' => 'openView', 'autoCompliteData' => 'getDataUser', 'openEditing' => 'openEditing'];

    public function openEditing($data)
    {
        // $this->observation = $data['observation'];
        $this->editingFlag = true;
        $this->user = $data;
        $this->group = $data['group'];
        $this->isAdmin = $data['isAdmin'] == 0 ? false : true;
        $this->observation = $data['observation'];
        // dump($data);
        $this->dispatchBrowserEvent('show-form-in');
    }

    public function mount()
    {
        try {
            Group::create(Group::$routes['DashBoardDrh']);
        } catch (\Exception $e) {

        }

        $this->loader = false;
    }

    public function getDataUser($user)
    {
        $this->user = $user['user'];
    }

    public function render()
    {

        return view('livewire.forms.permissoes.new-members');

    }

    public function openView($element)
    {
        try {
            $data = Group::where('web', $element)->first();
            if ($data)
                $this->group = $data->toArray();
            else {
                $this->dispatchBrowserEvent('message-alert-2', ['message' => 'Não foi encontrado a área de trabalho requirido, contacta o suber Adminin do sistema']);
                return;
            }
            $this->dispatchBrowserEvent('show-form');
        } catch (\Exception $d) {

        }
    }


    public function novoMembro()
    {
        if (!$this->user['name']) {
            session()->flash('errorEmpty', 'é importante escrever o nome do funcionário');
            return;
        }


        $data['auth'] = \Auth::user()->ldap->getEmail();
        $data['authName'] = \Auth::user()->ldap->getDisplayName();
        $data['groupId'] = $this->group['id'];
        $data['department'] = $this->user['department'];
        $data['cn'] = $this->user['cn'];
        $data['email'] = $this->user['email'];
        $data['name'] = $this->user['name'];
        $data['isAdmin'] = $this->isAdmin;
        $data['observation'] = $this->observation;

        if ($this->editingFlag) {
            GroupMember::find($this->user['id'])->update([
                'isAdmin' => $this->isAdmin,
                'observation' => $this->observation
            ]);

            $this->dispatchBrowserEvent('close-formManager', ['message' => config('Departments.ActionUpdate')]);
        } else {

            GroupMember::create($data);
            $this->dispatchBrowserEvent('close-formManager', ['message' => config('Departments.ActionSend')]);
        }


        $this->emit('renderView');
    }

}
