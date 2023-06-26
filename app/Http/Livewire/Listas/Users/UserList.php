<?php

namespace App\Http\Livewire\Listas\Users;

use App\Http\Livewire\Base\PaginatedComponent;
use App\Models\Constantes\Perfil;
use App\Models\Parlamento\Roles;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;


class UserList extends PaginatedComponent
{
    use WithFileUploads;

    public $estado = ['perfil'=>''];

    // Indica se está no modo edição ou inserção
    public $showEditModal = false;

    // Utilizador que está a ser editado
    public $user = null;

    public $userIdBeingRemoved = null;

    public $photo = null;

    public $roles = null;

    public $pdfGerado = null;

    public $termoPesquisaForm = '';
    public $termoPesquisa = '';

    public function mount()
    {
        //$this->roles = Roles::all();

    }

    public function pesquisaTermo()
    {
        if (Str::length($this->termoPesquisaForm) > 2)
        {
            $this->termoPesquisa = $this->termoPesquisaForm;
        }
        else
        {
            $this->termoPesquisa = '';
        }
    }

    public function updatedtermoPesquisaForm()
    {
        $termoTamanho = Str::length($this->termoPesquisaForm);
        if ($termoTamanho > 2)
        {
            $this->termoPesquisa = $this->termoPesquisaForm;
        }
        else
        {
            if ($termoTamanho <> 0) {
                session()->flash('pesquisaError', 'O termo de pesquisa deve ter mais que 2 carateres.');
            }
            $this->termoPesquisa = '';
        }
    }
    public function render()
    {

        if (STR::length($this->termoPesquisa)>2)
            $utilizadores = User::search($this->termoPesquisa)->paginate(10);
        else
            $utilizadores = User::latest()->paginate(10);

        return view('livewire.listas.users.user-list',['utilizadores'=>$utilizadores]);
    }

    /**
     * Quando botão 'Novo utilizador' é clicado, mostra o formulário Modal
     */
    public function novoUtilizador()
    {
        $this->inicializaComponente();

        $this->dispatchBrowserEvent('show-form');
    }

    /**
     * Quando o botão 'Gravar' do formulário é clicado, valida os dados e cria o novo utilizador
     */
    public function criaUtilizador()
    {

        if ($this->photo){
            $this->validaFotoPerfil();
        }

        // Valida os dados do formulário
        $utilizadorValidado = $this->validaUtilizador();

        // Cria o novo utilizador e atribui o seu Perfil
        // TODO: Criar utilizador e Role
        $utilizadorValidado['password'] = bcrypt($utilizadorValidado['password']);

        try {
            $utilizadorCriado = User::create($utilizadorValidado);

            $utilizadorCriado->assignRole($utilizadorValidado['perfil']);

            $this->inicializaComponente();

            // Fecha o formulário Modal
            $this->dispatchBrowserEvent('hide-form',['message'=>'Utilizador criado com sucesso!']);
        }
        catch (\Exception $e)
        {
            $this->dispatchBrowserEvent('mostra-erro',['message'=>'Não foi possível criar o novo utilizador...']);
        }
    }

    /**
     * Mostra o formulário modal de edição do utilizador
     */
    public function editaUtilizador(User $user)
    {
        $this->showEditModal = true;
        $this->estado = $user->toArray();

        $this->user = $user;

        $role = $user->getRoleNames()->first();

        Arr::set($this->estado, 'perfil', $role);

        $this->dispatchBrowserEvent('show-form');
    }

    /**
     * Atualiza os dados do utilizador que foi editado
     */
    public function atualizaUtilizador()
    {
        // Valida os dados do formulário
        $utilizadorValidado = $this->validaUtilizadorEdicao();

        // Cria o novo utilizador e atribui o seu Perfil
        // TODO: Criar utilizador e Role
        if( !empty($utilizadorValidado['password']) )
        {
            $utilizadorValidado['password']=bcrypt($utilizadorValidado['password']);
        }

        try {

            if($this->photo)
            {
                Storage::disk('avatars')->delete($this->user->avatar);
                Arr::set($utilizadorValidado,'avatar',$this->photo->store('/','avatars'));
            }

            $this->user->updateUtilizador($utilizadorValidado);

            $this->inicializaComponente();

            // Fecha o formulário Modal
            $this->dispatchBrowserEvent('hide-form',['message'=>'Utilizador atualizado com sucesso!']);
        }
        catch (\Exception $e)
        {
            $this->dispatchBrowserEvent('mostra-erro',['message'=>'Não foi possível guardar as alterações...']);
        }

    }

    /**
     * @param $userId
     *
     * Mostra o formulário de confirmação de remoção de utilizador
     */
    public function confirmaRemocaoUtilizador($userId)
    {
        $this->userIdBeingRemoved = $userId;
        $this->dispatchBrowserEvent('show-delete-form');
    }

    /**
     * @param $userId
     *
     * Remove o utilizador com o ID $userId
     */
    public function removeUtilizador($userId)
    {
        try {
            User::findOrFail($userId)->delete();

            $this->userIdBeingRemoved = null;

            //$this->verificaBugPagina();
;
            $this->dispatchBrowserEvent('hide-delete-form', ['message' => 'Utilizador removido com sucesso!']);
        }
        catch(\Exception $e)
        {
            $this->dispatchBrowserEvent('hide-delete-form', ['message' => 'Não foi possível remover o utilizador!','error'=>true]);
        }
    }

    public function listagemUtilizadores()
    {
        $utilizadores = User::all();
        $html =  View::make('Reports.user-report', compact('utilizadores'))->render();
        $pdf = PDF::setPaper('letter','portrait')->loadHtml($html);

        $pdf->save('storage/Reports/RelatorioUtilizadores.pdf');
        $this->pdfGerado = asset('storage/Reports/RelatorioUtilizadores.pdf');

       // $pdf->download('RelatorioUtilizadores.pdf');
    }

    /** ************************************************************************************
     *                                  MÉTODOS PRIVADOS
     ************************************************************************************** */

    private function validaUtilizador()
    {
        return Validator::make($this->estado, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'perfil' => 'required',
            'avatar' => '',
        ])->setCustomMessages([
            'name.required' => 'Deve indicar o nome do utilizador',
            'email.required' => 'Deve indicar o email do utilizador',
            'email.email' => 'Deve indicar um email válido',
            'email.unique' => 'Esse email já está registado na base de dados',
            'password.required' => 'Deve indicar uma palavra passe',
            'password.confirmed' => 'A palavra passe de confirmação não é igual à palavra passe',
            'perfil.required' => 'Deve inidicar o perfil do utilizador',
        ])->validate();
    }
    private function validaUtilizadorEdicao()
    {
        return Validator::make($this->estado, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->user->id,
            'password' => 'sometimes|confirmed',
            'perfil' => 'required',
        ])->setCustomMessages([
            'name.required' => 'Deve indicar o nome do utilizador',
            'email.required' => 'Deve indicar o email do utilizador',
            'email.email' => 'Deve indicar um email válido',
            'email.unique' => 'Esse email já está registado na base de dados',
            'password.required' => 'Deve indicar uma palavra passe',
            'password.confirmed' => 'A palavra passe de confirmação não é igual à palavra passe',
            'perfil.required' => 'Deve inidicar o perfil do utilizador'
        ])->validate();
    }

    public function validaFotoPerfil()
    {
        Validator::make(['avatar'=>$this->photo], [
            'avatar' => 'image',
        ])->setCustomMessages([
            'avatar.image' => 'O arquivo deve ser uma imagem',
        ])->validate();

        Arr::set($this->estado,'avatar', $this->photo->store('/','avatars'));
    }
    private function inicializaComponente()
    {
        // Inicializa o estado do formulário
        $this->estado = ['perfil' => ''];
        $this->showEditModal = false;
        $this->user = null;
        $this->photo = null;
        $this->pdfGerado = null;
    }

    public function impersonate( User $user)
    {
        Auth::user()->impersonate($user);
        $this->redirect(route('home'));
    }

    private function verificaBugPagina()
    {
        $paginaAtual = $this->page;

        $contagemItems = User::paginate(10)->total();

        if ($paginaAtual > $contagemItems/10)
        {
            $this->page--;
        }

    }

}
