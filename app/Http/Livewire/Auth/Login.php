<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    public $cont = 0;
    public $MAC = null;
    public $IP;
    public $closeContent = false;
    public $mostrarSenha = false;

    protected $rules = [
        'email' => 'required',
        'password' => 'required',
    ];

    protected $messages = [
        'email.required' => 'Deve introduzir um email.',
        'email.email' => 'Deve introduzir um email válido.',
        'password.required' => 'Deve introduzir uma palavra passe.',
    ];

    public function mount(): void
    {

    }

    public function render()
    {

        return view('livewire.auth.login');
    }

    public function updatedemail()
    {
        $this->validateOnly('email');
    }

    public function updatedpassword()
    {
        $this->validateOnly('password');
    }

    public function loginUser()
    {

        Session::pull('error');
        $this->validate();
        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->intended('home');
        }
        $this->password = '';
        Session::put('error', 'Não foi possível efetuar login');

        ++$this->cont;
        if ($this->cont >= 4) {

            $this->MAC = $MAC = strtok(exec('getmac'), ' ');
            $this->IP = $_SERVER['REMOTE_ADDR'];

            $this->render();

            sleep(12000);
            $this->cont = 0;
            $this->render();
        }
    }

    public function logoutUser()
    {

        Auth::logout();

        return redirect('login');
    }

    public function reportarEmail()
    {
        if (!$this->closeContent) {
            $this->password = "defautlogin";
            $this->closeContent = true;
        } else {
            $this->closeContent = false;
            $this->password = null;
        }
        $this->render();

    }

    public function redirectPortal(): void
    {
        $this->redirect('https://parlamento.ao');
    }

    public function enviarEmailLogi(): void
    {
        sleep(5);
        $this->password = null;
        $this->closeContent = false;
        $this->dispatchBrowserEvent('sucessEmail', ['massage' => 'O seu pedido para restaurar a senha foi enviado com sucesso!']);
    }

    public function passwordEyes()
    {
        if ($this->mostrarSenha) {
            $this->mostrarSenha = false;
        } else {
            $this->mostrarSenha = true;
        }

    }
}
