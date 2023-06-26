<?php

namespace App\Http\Livewire\Forms\BannerCentral\Slider;

use App\Models\Parlamento\Sliderinfo;
use App\Models\Parlamento\TaskActivities;
use App\Models\Task;
use App\Models\Traits\UploadImagen;
use App\Models\Traits\ValidatePhoto;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use App\Models\GetJSON;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class FormSlider extends Component
{
    use UploadImagen;
    use WithFileUploads;
    use GetJSON;
    use ValidatePhoto;

    public $photo = "";
    public $data = ['p' => null, 'href' => '#', 'h1' => null, 'description' => null];
    public $context;
    public $imageEditada;
    public $image;

    protected $listeners = ['publicListener'];
    public $bannerCentral;

    public function mount()
    {

        $this->bannerCentral = $this->parseEncode('gerirslideshow.json')['gerirslideshow'];
        $this->dispatchBrowserEvent('publicSlider', ['message' => 'As informações da pagina de inicio foi publicado com sucesso!']);
    }

    public function render()
    {
        return view('livewire.forms.banner-central.slider.form-slider');
    }

    public function removeImage()
    {
        $this->photo = "";
        $this->image = null;
        $this->dispatchBrowserEvent('activeFunctionality');
    }

    public function uploadImage(): void
    {
        $this->dispatchBrowserEvent('updated_image');
        $this->dispatchBrowserEvent('activeFunctionality');
    }

    /*    public function updatedPhoto(): void
        {
            if ($this->photo) {
                $nameImage = $this->photo->temporaryUrl();
                $this->image = $this->photo->temporaryUrl();
            } else {
                $nameImage = "";
                $this->image = null;
            }


            $this->dispatchBrowserEvent('activeFunctionality', ['temp_imge' => $nameImage]);
        }*/

    public function saveInfo()
    {
        try {
            $this->validateImage();

            $this->data['url'] = $this->photo->store('imagens/slider/noticias', 'public');
            $this->data['imgName'] = $this->photo->getFileName();
            $this->data['user_id'] = \Auth::user()->id;

            $created = Sliderinfo::create($this->data);

            TaskActivities::create([
                'primavera_email' => auth()->user()->ldap->getEmail(),
                'data_tool_info' => json_encode($this->data, true),
                'action_info' => 'Criado o item do Slider da Pagina ',
                'seccion_info' => 'Created',
                'user_id' => auth()->user()->id,
                'task_identity' => $created->id,
                'class_name' => "Livewire.Forms.Cabecalho.FormSlider"
            ]);


            $this->dispatchBrowserEvent('success-event-sub', ['message' => 'Imagem do slider gravado com sucesso!']);

            $this->emit('updatedOne');
        } catch (\Exception $d) {
            $this->dispatchBrowserEvent('message-error', ['message' => 'Não foi possivel inserir!']);
        }

    }

    public function updatedImageEditada()
    {
        $this->photo = new TemporaryUploadedFile($this->imageEditada, 'local');
        $this->image = $this->photo->temporaryUrl();
        $this->dispatchBrowserEvent('activeFunctionality', ['temp_imge' => $this->photo->temporaryUrl()]);

    }


    public function publicListener()
    {
        $this->dispatchBrowserEvent('message-public', ['message' => 'As informações da pagina de inicio foi publicado com sucesso!']);
    }


}
