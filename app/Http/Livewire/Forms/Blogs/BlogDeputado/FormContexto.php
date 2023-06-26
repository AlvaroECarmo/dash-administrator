<?php

namespace App\Http\Livewire\Forms\Blogs\BlogDeputado;

use App\Models\BlogPagContentsBanner;
use App\Models\Deputy\Deputy;
use App\Models\External\PRIMAVERA\Funcionario;
use App\Models\FunctionComuns;
use App\Models\Parlamento\BlogPagBody;
use App\Models\Parlamento\BlogPagContents;
use App\Models\Parlamento\BlogPagDeputy;
use App\Models\Parlamento\Mainmenu;
use App\Models\Parlamento\Social;
use App\Models\Traits\NTUploadFunctions;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\TemporaryUploadedFile;

class FormContexto extends Component
{
    use FunctionComuns;
    use NTUploadFunctions;

    protected $listeners = ['sentCapa', 'editDataDeputy'];
    public $imageEditada;

    public $action = ['updatekey' => null, 'deputy' => null, ''];
    public $otherProfessionalQualifications;
    public $icon;
    public $socialites = array();
    public $socialite = array();
    public $capaData = ['menuId' => null];
    public $conteudoData = array();
    public $pagecofig = array();
    public $data = array();
    public $itemMenuId;
    public $itemMenu = array();
    public $deputies = array();
    public $openOrCloseAuthForm = "d-none";
    public $contextInfoAuthForm = 'Clique adicionar outras opiniões <i class="fa fa-angle-down text-info"></i>';
    public $iteration;

    public $dataAuth = array();

    public function mount()
    {
        $this->itemMenu = Mainmenu::where('elements', 212)->get();
        $this->deputies = Funcionario::with('partido', 'partido.parties')
            ->whereIn('CodEstabelecimento', [config('cian.ESTABELECIMENTO_DEPUTADOS'), '005'])
            //  ->where('Situacao', config('cian.SITUACAO_ACTIVO'))
            ->orderBy('Nome', 'asc')
            ->get();
    }

    public function updatedPagecofigEmail()
    {
        try {
            $deputy = Deputy::where('primaryEmail', $this->pagecofig['Email'])->first();
            if ($deputy) {
                $this->data = $deputy->toArray() ?? null;
                $this->data['title'] = "Histórico";
                $this->otherProfessionalQualifications = $this->data['otherProfessionalQualifications'];
                $this->dispatchBrowserEvent('updated-textarea', ['infoData' => $this->data['otherProfessionalQualifications']]);
            } else {
                Deputy::criarDeputyIfNotExist(Funcionario::where('Email', $this->pagecofig['Email'])->first());

                $deputy = Deputy::where('primaryEmail', $this->pagecofig['Email'])->first();
                $this->data = $deputy->toArray() ?? null;
                $this->data['title'] = "Histórico";
                $this->otherProfessionalQualifications = $this->data['otherProfessionalQualifications'];
                $this->dispatchBrowserEvent('updated-textarea', ['infoData' => $this->data['otherProfessionalQualifications']]);
            }
        } catch (\Exception $e) {
            //$agora = $this->sanitizeString(\Date::now());
            //$this->dispatchBrowserEvent('show-fails', ['message' => 'O Sistema não consegue localizar as informações do deputado']);
            //\Storage::disk('public')->put("error/error.text", $dataUnick);
        }

        //  dump($this->data);
    }

    public function render()
    {
        return view('livewire.forms.blogs.blog-deputado.form-contexto');
    }


    public function editorInfo()
    {
       // dump('Ola');
    }

    public function addSocialite()
    {
        $this->validarRedes();
        $this->socialites[$this->socialite['icon']] = $this->socialite;
    }

    public function validarRedes()
    {
        $validado = Validator::make($this->socialite, [
            'icon' => 'required',
            'url' => 'required|min:10',
        ])->setCustomMessages([
            'icon.required' => 'É importante selecionar o icon da rede social...',
            'url.required' => 'É importante que o usuario introduza a url ou link de rede social selecionado...',
            'url.min' => 'É importante que coloques o links devidamente uma url não deve ter monos de 10 carateres...',
        ]);


        if ($validado->fails()) {
            $this->dispatchBrowserEvent('event-error', ['message' => $validado->getMessageBag()->first()]);
            $validado->validate();
        }
    }

    public function eliminarSocialite($attr)
    {
        unset($this->socialites[$attr]);
    }

    public function cabaBlogPageSave()
    {
        $this->data['imgCapa'] = $this->image ?? ($this->photo ? $this->photo->temporaryUrl() : null);
        $this->data['localkeyMenu'] = Mainmenu::where('id', $this->capaData['menuId'])->first()->url ?? null;

        $this->validarInfoCapa();

        if ($this->action['updatekey'] == null) {
            $this->validateDuplicate();
        }


        if ($this->action['updatekey'] == null)
            $blogDeputy = BlogPagDeputy::create([
                'keyMenu' => $this->data['fullName'],
                'imgCapa' => $this->photo->store("{$this->sanitizeString($this->data['fullName'])}/img", 'public'),
                'title' => $this->data['shortName'],
                'context' => $this->data['otherProfessionalQualifications'],
                'email' => $this->data['primaryEmail'],
                'object_iuu' => $this->sanitizeString($this->data['fullName']) . "_" . $this->data['id'],
                'user_id' => auth()->user()->id,
                'localkeyMenu' => $this->data['localkeyMenu'],
                'entityType' => 'BlogPagDeputy'
            ]);
        else {
            $blogDeputy = BlogPagDeputy::where('id', $this->action['updatekey'])->first();
            $blogDeputy->update([
                'keyMenu' => $this->data['fullName'],
                'title' => $this->data['shortName'],
                'context' => $this->data['otherProfessionalQualifications'],
                'email' => $this->data['primaryEmail'],
                'object_iuu' => $this->sanitizeString($this->data['fullName']) . "_" . $this->action['deputy'],
                'user_id' => auth()->user()->id,
                'localkeyMenu' => $this->data['localkeyMenu'],
                'entityType' => 'BlogPagDeputy'
            ]);

            if ($this->photo)
                $blogDeputy->update(['imgCapa' => $this->photo->store("{$this->sanitizeString($this->data['fullName'])}/img", 'public')]);


            Social::where('aboutSection', $this->action['updatekey'])->where('deputy_id', $this->action['deputy'])->delete();
            //dump(Social::where('aboutSection', $this->action['updatekey'])->where('deputy_id', $this->action['deputy'])->get());

            //$this->action['deputy'] = null;
            //$this->action['updatekey'] = null;

        }


        if (isset($this->socialites) > 0 && $blogDeputy)
            foreach ($this->socialites as $item) {
                Social::create([
                    'href' => $item['url'],
                    'icon' => $item['icon'],
                    'aboutSection' => $blogDeputy->id,
                    'user_id' => auth()->user()->id,
                    'deputy_id' => $this->data['id'],
                ]);
            }

        $this->emit('successEventDeputy');
        $this->dispatchBrowserEvent('success-send', ['message' => 'O cabeçalho da pagina foi inserido com sucesso! ']);
    }

    private function validarInfoCapa()
    {

        $validado = Validator::make($this->data, [
            'primaryEmail' => 'required|min:1',
            'imgCapa' => 'required',
            'shortName' => 'required',
            'fullName' => 'nullable',
            'otherProfessionalQualifications' => 'required',
            'localkeyMenu' => 'required',
        ])->setCustomMessages([
            'Email.required' => 'É importante que seleciones o deputado para o perfil...',
            'imgCapa.required' => 'É importante que seleciones uma imagem adequada para o perfil do deputado..',
            'shortName.required' => 'É importante que digites o nome parlamentar...',
            'localkeyMenu.required' => 'É importante que seleciones o menu a inserir...'
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

        $idContent = BlogPagContents::where('id', $this->capaData['id'])->orderBy('id', 'desc')->first() ?? null;
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
        $this->dispatchBrowserEvent('activeFunctionality');


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
            $this->contextInfoAuthForm = 'Clique ignorar outras opiniões <i class="fa fa-angle-up text-info"></i>';
        } else {
            $this->openOrCloseAuthForm = "d-none";
            $this->contextInfoAuthForm = 'Clique adicionar outras opiniões <i class="fa fa-angle-down text-info"></i>';
        }
    }

    public function sentCapa($attr)
    {
        $this->capaData['id'] = $attr['id'];
    }


    public function openSegestoesView()
    {
        $this->dispatchBrowserEvent('open-subview-modal');
    }

    public function editDataDeputy($data)
    {

        $this->action['updatekey'] = $data['id'];
        $this->action['deputy'] = Deputy::where('primaryEmail', $data['email'])->first()->id ?? null;
        $this->dispatchBrowserEvent('activeFunctionality', ['temp_image' => \Storage::url($data['imgCapa'])]);
        $this->image = \Storage::url($data['imgCapa']);
        // $this->photo = \Storage::url($data['imgCapa']);

        $this->capaData['menuId'] = Mainmenu::where('url', $data['localkeyMenu'])->first()->id ?? null;


        $this->data['shortName'] = $data['title'];

        $this->data['fullName'] = $data['keyMenu'];

        // data.otherProfessionalQualifications
        $this->data['otherProfessionalQualifications'] = $data['context'];

        $this->data['primaryEmail'] = $data['email'];
        $this->pagecofig['Email'] = $data['email'];

        foreach ($data['socials'] as $item) {
            $this->socialites[$item['icon']] = ['url' => $item['href'], 'icon' => $item['icon'], 'deputy_id' => $item['deputy_id']];
            $this->action['deputy'] = $item['deputy_id'];
        }

        $this->dispatchBrowserEvent('editorEditingDeputados', ['contexto' => $data['context']]);
        $this->dispatchBrowserEvent('topContentIFEdit');
        // dump($data);
        //dump(Social::where('aboutSection', $this->action['updatekey'])->where('deputy_id', $this->action['deputy'])->get());
    }


    /**
     * @return void
     * 'object_iuu' => $this->sanitizeString($this->data['fullName']) . "_" . $this->data['id'],
     * 'user_id' => auth()->user()->id,
     * 'localkeyMenu' => $this->data['localkeyMenu'],
     *
     *   'column_1' => 'required|unique:TableName,column_1,' . $this->id . ',id,colum_2,' . $this->column_2 . ',colum_3,' . $this->column_3,
     */
    public function validateDuplicate()
    {
        $localkeyMenu = $this->data['localkeyMenu'];
        $object_iuu = $this->sanitizeString($this->data['fullName']) . "_" . $this->data['id'];


        $isBlogPagDeputy = BlogPagDeputy::where('localkeyMenu', $localkeyMenu)
            ->where('object_iuu', $this->sanitizeString($this->data['fullName']) . "_" . $this->data['id'])
            ->first();

        if ($isBlogPagDeputy) {
            $this->data['object_iuu'] = "";
        } else {
            $this->data['object_iuu'] = $this->sanitizeString($this->data['fullName']) . "_" . $this->data['id'];
        }


        $validado = Validator::make($this->data, [
            'object_iuu' => 'required',
        ])->setCustomMessages([
            'object_iuu.required' => 'A informação do deputado está duplicada na mesma legislatura ...',
        ]);

        if ($validado->fails()) {
            $this->dispatchBrowserEvent('show-fails', ['message' => $validado->getMessageBag()->first()]);

        }
        $validado->validate();

    }

    public function updatedImageEditada()
    {

        $this->photo = new TemporaryUploadedFile($this->imageEditada, 'local');
        ///dump($this->photo, $this->testar);
        $this->image = $this->photo->temporaryUrl();
        $this->dispatchBrowserEvent('activeFunctionality', ['temp_image' => $this->photo->temporaryUrl()]);
    }
}
