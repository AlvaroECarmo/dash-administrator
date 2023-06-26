<?php

namespace App\Http\Livewire\Forms\Configuracoes;

use App\Models\JustificacaoFaltas\OutInOffice;
use App\Models\Traits\StatusProject;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class NewOutorinOffice extends Component
{
    use StatusProject;

    public $user = ['name' => '', 'department' => ''];
    public $userDirector = ['name' => '', 'department' => ''];
    public $outInOffice = [
        'observation' => '', 'dateInOffice' => '',
        'inOffice' => '', 'outOffice' => '',
        'managerName' => '', 'managerCn' => '', 'personCn' => ''
    ];
    public $eventInOrOut = ['inOffice' => '', 'outOffice' => ''];
    public $isAdmin = false;
    public $selectedName;
    public $selectedDirector;
    public $outChange;

    protected $listeners = ['autoCompliteData' => 'getDataUser'];


    public function getDataUser($obj)
    {

        if ($obj['labelName'] == 'Funcionário') {
            $this->user = $obj['user'];
            $this->outInOffice['name'] = $this->user['name'];
            $this->outInOffice['email'] = $this->user['email'];
            $this->outInOffice['personCn'] = $this->user['cn'];

        } else if ($obj['labelName'] == 'Director') {
            $this->userDirector = $obj['user'];
            $this->outInOffice['managerName'] = $this->userDirector['name'];
            $this->outInOffice['managerEmail'] = $this->userDirector['email'];
            $this->outInOffice['managerCn'] = $this->userDirector['cn'];
        }
    }


    public function mount()
    {
        $this->loader = false;
        $this->eventInOrOut['inOffice'] = true;
        $this->outChange = 'd-none';

        if (\Auth::user()->isManager() && !\Auth::user()->isAdmin()) {
            $this->outInOffice['managerName'] = \Auth::user()->ldap->getDisplayName();
            $this->outInOffice['managerEmail'] = \Auth::user()->ldap->getEmail();
        }
    }

    public function render()
    {
        return view('livewire.forms.Configuracoes.new-outorin-office');
    }

    /**
     * 'respName', 'respEmail', 'managerName', 'managerEmail',
     * 'name', 'email', 'outOffice', 'observation', 'dateInOffice'
     */
    public function saveOut(): void
    {
        $this->outInOffice['dateInOffice'] = \Date::now()->format('Y-m-d');
        $this->outInOffice['respName'] = \Auth::user()->ldap->getDisplayName();
        $this->outInOffice['respEmail'] = \Auth::user()->ldap->getEmail();


        /*dump($this->outInOffice);*/
        if ($this->eventInOrOut['outOffice']) {

            //$this->eventInOrOut['outOffice'] = $this->eventInOrOut['outOffice'] ? \Date::parse($this->eventInOrOut['outOffice'])->format('Y-m-d') : '';
            //$this->eventInOrOut['inOffice'] = $this->eventInOrOut['inOffice'] ? \Date::parse($this->eventInOrOut['inOffice'])->format('Y-m-d') : '';
            $valide = $this->validateOut();


            OutInOffice::createEventOffice($valide);
            $this->dispatchBrowserEvent('close-formManager', ['message' => config('Departments.ActionSend')]);
        } else {

            $this->validateInTheOffice();
            OutInOffice::where('managerEmail', $this->outInOffice['managerEmail'])->delete();
            $this->dispatchBrowserEvent('close-formManager', ['message' => config('Departments.ActionDelete')]);
        }

        $this->emit('renderView');

    }

    public function eventChange($value, $event): void
    {
        if ($event == 'in') {
            $this->eventInOrOut['inOffice'] = true;
            $this->eventInOrOut['outOffice'] = false;
            $this->outChange = 'd-none';

        } else {
            $this->eventInOrOut['outOffice'] = true;
            $this->outChange = 'd-block';
            $this->eventInOrOut['inOffice'] = false;
        }
    }

    public function validateOut()
    {
        return Validator::make($this->outInOffice, OutInOffice::$rules)
            ->setCustomMessages(OutInOffice::$messages)
            ->validate();
    }


    public function validateInTheOffice()
    {
        return Validator::make(['nomeFuncionario' => $this->outInOffice['managerName']], [
            'nomeFuncionario' => 'required',
        ])->setCustomMessages([
            'nomeFuncionario.required' => 'Deve indicar o nome do manager',
        ])->validate();
    }
}
