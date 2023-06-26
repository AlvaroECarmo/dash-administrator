<?php

namespace App\Http\Livewire\Auth;

use App\Models\NTUploadImage;
use App\Models\Parlamento\Profile;
use Illuminate\Support\Facades\Storage;
use Lcobucci\JWT\Exception;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileForm extends NTUploadImage
{

    public $myPoto = "/assets/media/149071.png";
    public $texte_info;
    public $data = ['description' => ''];
    public $userProfile = ['id' => null];

    public function mount()
    {
        $this->userProfile = Profile::where('primavera_email', auth()->user()->ldap->getEmail())->first();

        if ($this->userProfile) {
            $this->myPoto = Storage::url($this->userProfile->image_profile);
            $this->texte_info = $this->userProfile->data_tool_info;
        }
    }

    public function render()
    {
        return view('livewire.auth.profile-form');
    }

    public function saveInfo()
    {


        $url = "imagens/profile/" . auth()->user()->name;
        if ($this->photo) {
            $atualLink = $this->photo->store($url, 'public');
            $content = [
                'primavera_email' => auth()->user()->ldap->getEmail(),
                'data_tool_info' => $this->texte_info,
                'image_profile' => $atualLink,
                'user_id' => auth()->user()->id
            ];
        } else {
            $content = [
                'primavera_email' => auth()->user()->ldap->getEmail(),
                'data_tool_info' => $this->texte_info,
                'user_id' => auth()->user()->id
            ];
        }

        if (isset($this->userProfile['id']) > 0)
            $this->userProfile->update($content);
        else
            Profile::create($content);

        $this->dispatchBrowserEvent('event-success', ['message' => 'Foi actualizado com sucesso!']);
    }

    public function updatedPhoto()
    {
        $this->myPoto = $this->photo->temporaryUrl();
    }

    public function addClassEdit()
    {
        $this->data['classDocument'] = 'docs_ckeditor_classic';
        $this->dispatchBrowserEvent('set-editor-document', ['element_id' => 'contextEditor']);

    }

}
