<?php

namespace App\Http\Livewire\Forms\Blogs\BlogInfo;

use App\Models\BlogPagContentsBanner;
use App\Models\NTUploadImage;
use App\Models\Parlamento\BlogPagBody;
use App\Models\Parlamento\BlogPagContents;
use App\Models\Parlamento\Mainmenu;
use App\Models\Traits\NTUploadFunctions;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use PHPUnit\Util\Filesystem;

class FormContexto extends Component
{

    use NTUploadFunctions;

    protected $listeners = ['sentCapa', 'editElement', 'editContext'];
    public $photo;

    public $event = ['id' => null, 'idContextBlog' => null];
    public $capaData = ['menuId'];
    public $conteudoData = array();

    public $itemMenuId;
    public $itemMenu = array();
    public $openOrCloseAuthForm = "d-none";
    public $contextInfoAuthForm = 'Clique adicionar o informações do autor <i class="fa fa-angle-down text-info"></i>';
    public $imageEditada;
    public $testar;

    public $dataAuth = array();

    public function mount()
    {
        $this->itemMenu = Mainmenu::with('parents')->get();
    }

    public function render()
    {
        return view('livewire.forms.blogs.blog-info.form-contexto');
    }

    public function cabaBlogPageSave()
    {

        $this->capaData['imgCapa'] = $this->photo ? $this->photo->temporaryUrl() : ($this->image ?? null);

        $this->validarInfoCapa();

        if ($this->event['id'] > 0) {

            $instaceBg = BlogPagContents::where('id', $this->event['id'])->first();

            $instaceBg->update([
                'keyMenu' => (Mainmenu::where('id', $this->capaData['menuId'])->first() ? Mainmenu::where('id', $this->capaData['menuId'])->first()->url : null),
                'title' => $this->capaData['title'],
                'context' => $this->capaData['context'] ?? null,
                'object_iuu' => json_encode($this->capaData, true),
                'user_id' => auth()->user()->id,
                'menuId' => $this->capaData['menuId']
            ]);
            if ($this->photo != null)
                $instaceBg->update(['imgCapa' => $this->photo->store('blog/capa/' . $this->capaData['menuId'], 'public')]);


        } else {
            BlogPagContents::create([
                'keyMenu' => (Mainmenu::where('id', $this->capaData['menuId'])->first() ? Mainmenu::where('id', $this->capaData['menuId'])->first()->url : null),
                'imgCapa' => $this->photo->store('blog/capa/' . $this->capaData['menuId'], 'public'),
                'title' => $this->capaData['title'],
                'context' => $this->capaData['context'] ?? null,
                'object_iuu' => json_encode($this->capaData, true),
                'user_id' => auth()->user()->id,
                'menuId' => $this->capaData['menuId']
            ]);
        }
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

        $dataBlogBody = null;
        if ($this->event['idContextBlog'] > 0) {
            $dataBlogBody = BlogPagBody::where('id', $this->event['idContextBlog'])->update([
                'keyMenu' => $this->capaData['menuId'],
                'title' => $this->conteudoData['titleContext'],
                'context' => $this->conteudoData['context'] ?? null,
                'object_iuu' => json_encode($this->conteudoData, true),
                'blogPagContentsId' => $idContent->id,
                'user_id' => auth()->user()->id,
            ]);
        } else {
            $dataBlogBody = BlogPagBody::create([
                'keyMenu' => $this->capaData['menuId'],
                'title' => $this->conteudoData['titleContext'],
                'context' => $this->conteudoData['context'] ?? null,
                'object_iuu' => json_encode($this->conteudoData, true),
                'blogPagContentsId' => $idContent->id,
                'user_id' => auth()->user()->id,
            ]);
        }

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
            'context.required' => 'É importante que digites o conteudo referente a esse tema ou titulo inserido anteriomente...',
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
            'context' => 'required',
        ])->setCustomMessages([
            'auth.required' => 'É importante indicar o nome do autor ...',
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


    public function openSegestoesView()
    {
        $this->dispatchBrowserEvent('open-subview-modal');
    }

    public function editElement($attr)
    {
        $this->capaData['title'] = $attr['title'];
        $this->capaData['context'] = $attr['context'];
        $this->capaData['menuId'] = $attr['menuId'];
        $this->image = \Storage::url($attr['imgCapa']);
        $this->dispatchBrowserEvent('activeFunctionality', ['temp_image' => \Storage::url($attr['imgCapa'])]);
        $this->event['id'] = $attr['id'];
    }

    /**
     * @param $attr
     * @return void
     *
     *
     *  'keyMenu' => $this->capaData['menuId'],
     * 'title' => $this->conteudoData['titleContext'],
     * 'context' => $this->conteudoData['context'] ?? null,
     * 'object_iuu' => json_encode($this->conteudoData, true),
     * 'blogPagContentsId' => $idContent->id,
     * 'user_id' => auth()->user()->id,
     */
    public function editContext($attr)
    {
        $this->capaData['menuId'] = $attr['blogPagContentsId'];
        $this->conteudoData['titleContext'] = $attr['title'];
        $this->event['idContextBlog'] = $attr['id'];
        $this->dispatchBrowserEvent('editorEditing', ['contexto' => $attr['context']]);
        $this->capaData['menuId'] = BlogPagContents::where('id', $attr['blogPagContentsId'])->orderBy('id', 'desc')->first()->menuId ?? null;
    }

    public function updatedImageEditada()
    {

        $this->photo = new TemporaryUploadedFile($this->imageEditada, 'local');
        ///dump($this->photo, $this->testar);
        $this->image = $this->photo->temporaryUrl();
        $this->dispatchBrowserEvent('activeFunctionality', ['temp_image' => $this->photo->temporaryUrl()]);
    }
}
