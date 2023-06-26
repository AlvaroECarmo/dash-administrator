<?php

namespace App\Http\Livewire\Forms\Blogs\BlogMultimedia;

use App\Http\Controllers\API\Search\SearchYoutubeAPI;
use App\Models\AuthorMultimedia;
use App\Models\BlogPagContentsBanner;
use App\Models\Multimedias;
use App\Models\Parlamento\BlogPagBody;
use App\Models\Parlamento\BlogPagContents;
use App\Models\Parlamento\Mainmenu;
use App\Models\Traits\NTUploadFunctions;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Fluent;
use Livewire\Component;

class FormContexto extends Component
{
    use NTUploadFunctions;

    protected $listeners = ['sentCapa'];
    public $photo;

    public $tipoViews = 3;

    public $contextVideo;
    public $urlImage;
    public $iteration = 1;

    public $video;
    public $videoActual;

    public $capaData = ['menuId'];
    public $conteudoData = array();

    public $itemMenuId;
    public $itemMenu = array();
    public $openOrCloseAuthForm = "d-none";
    public $contextInfoAuthForm = 'Clique adicionar o informações do autor <i class="fa fa-angle-down text-info"></i>';

    public $audioRender;
    public $audioActual;

    public $dataAuth = array();
    public $dataContext = array();
    public $videoImportId;
    public $videoImportName;

    public $progress = 0;

    public function mount()
    {
        $this->itemMenu = Mainmenu::all();
    }

    public function render()
    {
        return view('livewire.forms.blogs.blog-multimedia.form-contexto');
    }

    public function updatedVideoImportId()
    {
        $this->dataContext['title'] = $this->videoImportName;
        $this->dataContext['context'] = $this->videoImportName;
    }

    public function cabaBlogPageSave()
    {

        $this->capaData['imgCapa'] = $this->photo ? $this->photo->temporaryUrl() : null;

        $this->validarInfoCapa();


        BlogPagContents::create([
            'keyMenu' => (Mainmenu::where('id', $this->capaData['menuId'])->first() ? Mainmenu::where('id', $this->capaData['menuId'])->first()->url : null),
            'imgCapa' => $this->photo->store('blog/capa/' . $this->capaData['menuId'], 'public'),
            'title' => $this->capaData['title'],
            'context' => $this->capaData['context'] ?? null,
            'object_iuu' => json_encode($this->capaData, true),
            'user_id' => auth()->user()->id,
            'menuId' => $this->capaData['menuId']
        ]);

        //Mainmenu::where('id', $this->capaData['menuId'])->
        $this->emit('successEvent');
        $this->dispatchBrowserEvent('success-send', ['message' => 'O cabeçalho da pagina foi inserido com sucesso! ']);
    }

    private function validarInfoCapa()
    {

        $validado = Validator::make($this->capaData, [
            'menuId' => 'required|min:1',
            'imgCapa' => 'required',
            'title' => 'required',
        ])->setCustomMessages([
            'menuId.required' => 'É importante que seleciones as informações do menu a inserir a nova Capa...',
            'imgCapa.required' => 'É importante que seleciones uma imagem adequada para a Capa do modulo do site..',
            'title.required' => 'É importante que digites o titulo da nova capa a ser inserida...',
        ]);


        if ($validado->fails()) {
            $this->dispatchBrowserEvent('show-fails', ['message' => $validado->getMessageBag()->first()]);
            $validado->validate();
        }

    }


    /// outras informações ...
    public function updatedItemMenuId()
    {
        $this->emit('changeItemMenu', $this->itemMenuId);
    }

    public function saveInfoBody()
    {

        $this->validarInfoContext();

        $idContent = BlogPagContents::where('menuId', $this->capaData['menuId'])->orderBy('id', 'desc')->first() ?? null;
        if (!$idContent) {
            // conteudo da capa n
            $this->dispatchBrowserEvent('show-fails', ['message' => 'Não foi possivel encontrar o contreudo da capa! ']);
            return;
        }


        $dataBlogBody = BlogPagBody::create([
            'keyMenu' => $this->capaData['menuId'],
            'title' => $this->conteudoData['titleContext'],
            'context' => $this->conteudoData['context'] ?? null,
            'object_iuu' => json_encode($this->conteudoData, true),
            'blogPagContentsId' => $idContent->id,
            'user_id' => auth()->user()->id,
        ]);

        // vamos inserir as informações do author
        if ($this->openOrCloseAuthForm != "d-none") {
            $this->validateInfoAuthor();

            BlogPagContentsBanner::create([
                'auth' => $this->dataAuth['auth'],
                'context' => $this->dataAuth['context'],
                'blogPagContentsId' => $dataBlogBody->id,
            ]);

        }

        $this->dispatchBrowserEvent('success-send', ['message' => 'Adicionado o conteudo da pagina com sucesso!']);


    }

    private function validarInfoContext()
    {
        $this->conteudoData['menuId'] = isset($this->capaData['menuId']);

        $validado = Validator::make($this->conteudoData, [
            'menuId' => 'required|min:1',
            'titleContext' => 'required',
            'context' => 'required',
        ])->setCustomMessages([
            'menuId.required' => 'É importante que seleciones as informações do menu a inserir a nova Capa...',
            'context.required' => 'É importante que insiras conteudo referente a esse tema ou titulo inserido anteriomente...',
            'titleContext.required' => 'É importante que digites o titulo da nova capa a ser inserida...',
        ]);


        if ($validado->fails()) {
            $this->dispatchBrowserEvent('show-fails', ['message' => $validado->getMessageBag()->first()]);
            $validado->validate();
        }

    }

    public function validateInfoAuthor()
    {
        $validado = Validator::make($this->dataAuth, [
            'auth' => 'required',
            'context' => 'required|max:200',
        ])->setCustomMessages([
            'auth.required' => 'É importante indicar o nome do autor ...',
            'context.max' => 'Excedeu o limite de informação a ser inserido ...',
            'context.required' => 'É importante preencher as informações associada ao autor...',
        ]);

        if ($validado->fails()) {
            $this->dispatchBrowserEvent('show-fails', ['message' => $validado->getMessageBag()->first()]);

        }
        $validado->validate();
    }

    public function openOrCloseAuthForm()
    {
        if ($this->openOrCloseAuthForm == "d-none") {
            $this->openOrCloseAuthForm = null;
            $this->contextInfoAuthForm = 'Clique ignorar o informações do autor <i class="fa fa-angle-up text-info"></i>';
        } else {
            $this->openOrCloseAuthForm = "d-none";
            $this->contextInfoAuthForm = 'Clique adicionar o informações do autor <i class="fa fa-angle-down text-info"></i>';
        }
    }

    public function sentCapa($attr)
    {
        $this->capaData['menuId'] = $attr['menuId'];
    }


    // outras funções

    public function updatedVideoImport()
    {

        $pos = strpos($this->videoImport, "watch?v=");
        $url = $this->videoImport;
        $context = mb_substr($this->videoImport, __($pos + 8), __(\Str::length($this->videoImport) + 1));

        $this->contextVideo = $context;
    }

    public function updatedTipoViews()
    {
        $this->dispatchBrowserEvent('upload-event');
        $this->dispatchBrowserEvent('activeFunctionality');

    }

    public function updatedUrlImage()
    {
        $this->dispatchBrowserEvent('activeFunctionality');
    }

    public function removeImageUrl()
    {
        $this->urlImage = null;
        $this->dispatchBrowserEvent('activeFunctionality');
    }


    public function updatedAudioRender()
    {
        $element = $this->audioRender->store('multimedia/audio', 'public');
        $this->audioActual = \Storage::url($element);
        $this->dispatchBrowserEvent('rendAudio', ['audio' => $this->audioActual]);
    }

    public function updatedVideo()
    {


        $dataElement = $this->video->store('multimedia/video', 'public');

        $this->videoActual = Storage::url($dataElement);

        $this->dispatchBrowserEvent('rendVideo', ['video' => $this->videoActual]);
    }


    public function updateProgress(){

    }



    public function createdVideoInterno()
    {

        $instanceData = [
            'titleContext' => $this->dataContext['title'],
            'introdutionContext' => $this->dataContext['context'] ?? null,
            'contextFull' => $this->dataContext['fullContext'] ?? null,
            'user_id' => auth()->user()->id,
            'typeMultimedia' => $this->tipoViews
        ];

        if ($this->tipoViews == 1) {
            $instanceData['urlFile'] = $this->videoActual;
        }

        if ($this->tipoViews == 2) {

            $i = SearchYoutubeAPI::singlevideo($this->videoImportId);
            $cot = (new Fluent((new Fluent((new Fluent((new Fluent((new Fluent($i->items))['0']))['snippet']))['thumbnails']))['high']))['url'];

            $instanceData['urlFile'] = $this->videoImportId;
            $instanceData['urlSternal'] = $cot;
        }

        if ($this->tipoViews == 3) {
            $instanceData['urlFile'] = \Storage::url($this->photo->store('multimedia/image', 'public'));
        }

        if ($this->tipoViews == 4) {
            $instanceData['urlFile'] = $this->urlImage;
        }

        if ($this->tipoViews == 5) {
            $instanceData['urlFile'] = $this->audioActual;
        }


        $multimendi = Multimedias::create($instanceData);

        if ($this->openOrCloseAuthForm != "d-none") {
            AuthorMultimedia::create([
                'fullName' => $this->dataAuth['auth'],
                'titleContext' => $this->dataAuth['context'],
                'Multimedias_id' => $multimendi->id,
                'Multimedias_id' => $multimendi->id,
                'user_id' => auth()->user()->id,

            ]);
        }


        $this->dispatchBrowserEvent('success-send', ['message' => 'O time da multimedia foi criado sucesso!']);

        $this->emit('sucessEvent');

    }

}
