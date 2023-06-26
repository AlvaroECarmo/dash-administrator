<?php

namespace App\Http\Livewire\Forms\Blogs\BlogOther;

use App\Models\BlogPagContentsBanner;
use App\Models\NTUploadImage;
use App\Models\Parlamento\BlogPagBody;
use App\Models\Parlamento\BlogPagContents;
use App\Models\Parlamento\LinkFiles;
use App\Models\Parlamento\Mainmenu;
use App\Models\Parlamento\OtherMenu;
use App\Models\Traits\NTUploadFunctions;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use PHPUnit\Util\Filesystem;
use \Session;
use Illuminate\Support\Arr;

class FormContexto extends Component
{

    use NTUploadFunctions;

    protected $listeners = ['sentCapa', 'editElement', 'editContext'];
    public $photo;
    public $file;
    public $event = ['id' => null, 'idContextBlog' => null];
    public $capaData = ['menuId'];
    public $conteudoData = array();
    public $arrayFile = array();
    public $itemMenuId;
    public $itemMenu = array();
    public $openOrCloseAuthForm = "d-none";
    public $contextInfoAuthForm = 'Clique adicionar o informações do autor <i class="fa fa-angle-down text-info"></i>';
    public $imageEditada;
    public $testar;
    public bool $permitionSelect = false;

    public $dataAuth = array();

    public function mount()
    {
        $this->itemMenu = OtherMenu::orderBy('id', 'desc')->get();
    }


    public function selectdMenu()
    {
        if ($this->permitionSelect)
            $this->permitionSelect = false;
        else
            $this->permitionSelect = true;
        $this->render();
    }

    public function render()
    {
        return view('livewire.forms.blogs.blog-other.form-contexto');
    }


    public function updateTaskOrder($list)
    {
        //dump($list);
        foreach ($list as $item) {

            $localData = $this->convertToObject($item['value']);

            //  dump($localData['normalKey'], $localData['parentKey'].'.'.   $item['order']);
            LinkFiles::find($localData['normalKey'])->update(['order' => $item['order'] ]);
            $this->arrayFile = LinkFiles::where('parentId', $localData['parentKey'])->orderBy('order')->get();
        }
    }

    private function convertToObject($string): array
    {
        $array = json_decode(str_replace("'", '"', $string), true);
        return Arr::dot($array);
    }

    /**
     * @param LinkFiles $attr
     * @return void
     *
     * Delete file to link files
     */

    public function deleteFile(LinkFiles $attr)
    {

        $attr->delete();

        $this->dispatchBrowserEvent('success-send', ['message' => 'Foi removido o arquivo...']);
    }

    public function cabaBlogPageSave()
    {


        $this->capaData['imgCapa'] = $this->photo ? $this->photo->temporaryUrl() : ($this->image ?? null);

        $isFile = ($this->file ? $this->file->store('blog/capa/' . $this->capaData['menuId'], 'public') : null);

        if (!$this->permitionSelect)
            OtherMenu::create([
                'context' => $this->capaData['menuId'],
                'url' => $this->capaData['menuId'],
                'type' => 404
            ]);


        $this->validarInfoCapa();

        if ($this->event['id'] > 0) {

            $instaceBg = BlogPagContents::where('id', $this->event['id'])->first();

            $instaceBg->update([
                'keyMenu' => $this->capaData['menuId'],
                'title' => $this->capaData['title'],
                'context' => $this->capaData['context'] ?? null,
                'object_iuu' => json_encode($this->capaData, true),
                'user_id' => auth()->user()->id,
                'anexo' => $isFile
            ]);
            if ($this->photo != null)
                $instaceBg->update(['imgCapa' => $this->photo->store('blog/capa/' . $this->capaData['menuId'], 'public')]);
        } else {

            BlogPagContents::create([
                'keyMenu' => $this->capaData['menuId'],
                'imgCapa' => $this->photo->store('blog/capa/' . $this->capaData['menuId'], 'public'),
                'title' => $this->capaData['title'],
                'context' => $this->capaData['context'] ?? null,
                'object_iuu' => json_encode($this->capaData, true),
                'user_id' => auth()->user()->id,
                'anexo' => $isFile
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
            'menuId.required' => 'Deve selecionar as informações do menu a inserir a nova Capa...',
            'imgCapa.required' => 'Deve selecionar uma imagem adequada para a Capa do modulo do site..',
            'title.required' => 'Deve escrever o titulo para nova capa a ser inserida...',
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


        $idContent = BlogPagContents::where('id', $this->capaData['menuId'])->orderBy('id', 'desc')->first() ?? null;

        if (!$idContent) {
            // conteudo da capa n
            $this->dispatchBrowserEvent('show-fails', ['message' => 'Não foi possivel encontrar o conteúdo da capa! ']);
            return;
        }

        $dataBlogBody = null;
        if ($this->event['idContextBlog'] > 0) {

            $dataBlogBody = BlogPagBody::where('id', $this->event['idContextBlog'])->first();

            $dataBlogBody->update([
                'keyMenu' => $this->capaData['menuId'],
                'title' => $this->conteudoData['titleContext'],
                'context' => $this->conteudoData['context'] ?? null,
                'object_iuu' => json_encode($this->conteudoData, true),
                'blogPagContentsId' => $idContent->id,
                'user_id' => auth()->user()->id,
            ]);

            Session::put("instanceData", $dataBlogBody);
        } else {

            $dataBlogBody = BlogPagBody::create([
                'keyMenu' => $this->capaData['menuId'],
                'title' => $this->conteudoData['titleContext'],
                'context' => $this->conteudoData['context'] ?? null,
                'object_iuu' => json_encode($this->conteudoData, true),
                'blogPagContentsId' => $idContent->id,
                'user_id' => auth()->user()->id,
            ]);
            Session::put("instanceData", $dataBlogBody);
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

        $this->dispatchBrowserEvent('success-send', ['message' => 'Adicionado o conteúdo da pagina com sucesso!']);
        $this->dispatchBrowserEvent('upload_image_drop_zone');
    }

    private function validarInfoContext()
    {
        $this->conteudoData['menuId'] = isset($this->capaData['menuId']);

        $validado = Validator::make($this->conteudoData, [
            'menuId' => 'required',
            'titleContext' => 'required',
            'context' => 'required',
        ])->setCustomMessages([
            'menuId.required' => 'Deve selecionar as informações do menu a inserir para nova Capa...',
            'context.required' => 'Deve escrever o conteúdo referente a esse tema ou titulo inserido anteriomente...',
            'titleContext.required' => 'Deve escrever o titulo da nova capa a ser inserida...',
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
            'auth.required' => 'Deve selecionar o nome do autor ...',
            'context.required' => 'Deve preencher as informações associada ao autor...',
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
            $this->contextInfoAuthForm = 'Clique para ignorar a informação do autor <i class="fa fa-angle-up text-info"></i>';
        } else {
            $this->openOrCloseAuthForm = "d-none";
            $this->contextInfoAuthForm = 'Clique para inserir a informação do autor <i class="fa fa-angle-down text-info"></i>';
        }
    }

    public function sentCapa($attr)
    {
        // capaData.menuId
        $this->capaData['menuId'] = $attr['id'];
    }


    public function openSegestoesView()
    {
        $this->dispatchBrowserEvent('open-subview-modal');
    }

    public function editElement($attr)
    {
        $this->capaData['title'] = $attr['title'];
        $this->capaData['context'] = $attr['context'];
        $this->capaData['menuId'] = $attr['keyMenu'];
        $this->image = \Storage::url($attr['imgCapa']);
        $this->dispatchBrowserEvent('activeFunctionality', ['temp_image' => \Storage::url($attr['imgCapa'])]);
        $this->event['id'] = $attr['id'];
        $this->permitionSelect = true;
    }

    /**
     * @param $attr
     * @return void
     *
     *
     * 'keyMenu' => $this->capaData['menuId'],
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
        $this->arrayFile = LinkFiles::where('parentId', $attr['id'])->orderBy('order')->get();

        // dump($this->arrayFile?->toArray());

    }

    public function updatedImageEditada()
    {

        $this->photo = new TemporaryUploadedFile($this->imageEditada, 'local');

        $this->image = $this->photo->temporaryUrl();
        $this->dispatchBrowserEvent('activeFunctionality', ['temp_image' => $this->photo->temporaryUrl()]);
    }
}
