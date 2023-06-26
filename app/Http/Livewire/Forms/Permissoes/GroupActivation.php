<?php

namespace App\Http\Livewire\Forms\Permissoes;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use App\Models\Comuns\Group;

class GroupActivation extends Component
{
    public $group = ['web' => '', 'name' => '', 'observation' => ''];

    public function render()
    {

        if (date('Y') >= config('appCian.ano') ) {
            return view('errors.404');
        }

        return view('livewire.forms.permissoes.group-activation', [
            'Groups' => Group::$routes
        ]);
    }

    public function changeGroup($value)
    {
        $g = Group::$routes[$this->group['web']];
        $this->group['web'] = $g['web'];
        $this->group['name'] = $g['name'];
    }

    public function saveGroup()
    {
        $this->validates();
        try {
            Group::create($this->group);
            $this->dispatchBrowserEvent('close-formManager', ['message' => config('Departments.ActionSave')]);
        } catch (\Exception $d) {
            $group = Group::where('web', $this->group['web'])->first();
            $group->observation = $this->group['observation'] . chr(13) . chr(13) . $group->observation;
            $group->update();
            $this->dispatchBrowserEvent('close-formManager', ['message' => config('Departments.ActionUpdate')]);
        }

    }

    public function validates()
    {
        return Validator::make(['web' => $this->group['web']], [
            'web' => 'required',
        ])->setCustomMessages([
            'web.required' => 'É importante seleccionar o grupo.',
        ])->validate();

    }
}
