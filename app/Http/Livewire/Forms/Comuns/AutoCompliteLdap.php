<?php

namespace App\Http\Livewire\Forms\Comuns;

use App\Models\External\AD\AD;
use Illuminate\Support\Str;
use Livewire\Component;

class AutoCompliteLdap extends Component
{
    public $group = ['web' => '', 'name' => '', 'observation' => ''];
    public $user = ['name' => '', 'department' => ''];
    public $users = array();
    public $selectedName;
    public $labelName;
    public $mb3;


    public function mount($labelName, $mb3 = false)
    {
        $this->mb3 = $mb3;
        $this->labelName = $labelName;
    }

    public function render()
    {
        return view('livewire.forms.comuns.auto-complite-ldap');
    }

    public function getUserAd($userName): void
    {
        try {
            $this->user = AD::getUserAD($userName);
            $this->users[$this->user['name']] = $this->user['name'];

            if ($userName == "")
                $this->users = array();

            if ($this->user['name'] == null)
                $this->users = array();

            if (Str::length($userName) > 8) {
                $this->users = array();
                $this->users[$this->user['name']] = $this->user['name'];
            }

            if ($this->selectedName != "" && $this->user['name'] == $this->selectedName) {
                $this->users = array();
            }

        } catch (\Exception $d) {

        }
    }

    public function changeKeyEvent()
    {
        $this->selectedName = $this->user['name'];
        $this->users = array();
        $this->emit('autoCompliteData', ['user' => $this->user, 'labelName' => $this->labelName]);
    }

    public function nomeprocessado($name)
    {
        $this->selectedName = $name;
        $this->user = AD::getUserAD($name);
        $this->users = array();
        $this->emit('autoCompliteData', ['user' => $this->user, 'labelName' => $this->labelName]);


    }

    public function closeListing()
    {
        $this->user = ['name' => '', 'department' => ''];
        $this->users = array();
    }

}
