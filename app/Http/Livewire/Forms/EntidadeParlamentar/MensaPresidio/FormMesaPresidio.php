<?php

namespace App\Http\Livewire\Forms\EntidadeParlamentar\MensaPresidio;

use App\Models\Deputy\Deputy;
use App\Models\External\PRIMAVERA\Funcionario;
use App\Models\GetJSON;
use App\Models\Parlamento\EntityHistory;
use App\Models\Parlamento\History;
use App\Models\Parlamento\Postdate;
use App\Models\Parlamento\Schedulessection;
use App\Models\Parlamento\Social;
use App\Models\Parlamento\SocialFunctionality;
use App\Models\Parlamento\Subscribeinner;
use App\Models\Parlamento\Tab;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormMesaPresidio extends Component
{

    use GetJSON;
    use WithFileUploads;

    protected $listeners = ['sendSuccess', 'updateMedaPresidio'];
    public $entidadeParlamentar;
    public $funcionarios = array();
    public $data = [
        'NomeDeputado' => '', 'codFuncionario' => '', 'primaveraFunc' => '', 'deputy' => '',
        'otherProfessionalQualifications' => '', 'typeWebApp' => '', 'scheduleSection_id' => '',
        'url' => '', 'imageName' => '', 'context' => '',
    ];
    public $photo;
    public $socialFunctionality = array();
    public $scheduleSections = array();
    public $icon;

    public $socialite = array();
    public $socialites = array();

    /**
     * where('Situacao', config('kinsari.SITUACAO_ACTIVO'))
     * ->where('CodEstabelecimento', config('kinsari.ESTABELECIMENTO_DEPUTADOS'))
     */
    public function mount()
    {

        $this->entidadeParlamentar = $this->parseEncode('mesadaassembleia.json')['mesadaassembleia'];
        $this->funcionarios = Funcionario::where('CodEstabelecimento', config('cian.ESTABELECIMENTO_DEPUTADOS'))
            ->where('Situacao', config('cian.SITUACAO_ACTIVO'))
            ->orderBy('Nome', 'asc')
            ->get();
        $this->socialFunctionality = SocialFunctionality::all();
        $this->scheduleSections = Schedulessection::all();

    }

    public function render()
    {
        return view('livewire.forms.entidade-parlamentar.mensa-presidio.form-mesa-presidio');
    }

    public function updatedDataCodFuncionario(): void
    {
        try {

            $this->data['primaveraFunc'] = Funcionario::with('habilitacao')->where('Codigo', $this->data['codFuncionario'])->first()->toArray();
            $this->data['NomeDeputado'] = $this->data['primaveraFunc']['Nome'];

            $this->data['deputy'] = (Deputy::where('primaryEmail', $this->data['primaveraFunc']['Email'])->first())?->toArray();

            if (!$this->data['deputy']) {
                Deputy::criarDeputyIfNotExist(Funcionario::where('Email', $this->data['primaveraFunc']['Email'])->first());
                sleep(2);
                $this->data['deputy'] = (Deputy::where('primaryEmail', $this->data['primaveraFunc']['Email'])->first())?->toArray();
                sleep(2);
            }


            $this->data['otherProfessionalQualifications'] = $this->data['deputy']['otherProfessionalQualifications'];


        } catch (\Exception $as) {

        }
    }

    public function uploadImage()
    {
        $this->dispatchBrowserEvent('upload-image-click');
    }

    public function updatedPhoto()
    {
        if ($this->photo)
            $nameImage = $this->photo->temporaryUrl();
        else
            $nameImage = "";

        $this->dispatchBrowserEvent('activeFunctionality', ['temp_image' => $nameImage]);
    }

    public function removeUpload()
    {
        unset($this->photo);
        $this->dispatchBrowserEvent('activeFunctionality');
    }

    public function saveEntityParliamentary(): void
    {
        __($this->data['typeWebApp'] == 'subscribe_inner') ? $this->savePresidentePresidio() : '';
        __($this->data['typeWebApp'] == 'tabId2') ? $this->saveVicesPresicentes() : '';
        __($this->data['typeWebApp'] == 'tabId3') ? $this->saveSecretarios() : '';
        __($this->data['typeWebApp'] == 'Deputado') ? $this->saveDeputado() : '';


        if (isset($this->socialites) > 0)
            foreach ($this->socialites as $item) {
                Social::create([
                    'href' => $item['url'],
                    'icon' => $item['icon'],
                    'user_id' => auth()->user()->id,
                    'deputy_id' => $this->data['codFuncionario']
                ]);
            }

        $this->emit('updatedElement');
    }

    public function savePresidentePresidio()
    {
        $this->data['url'] = $this->photo->store('imagens/slider/noticias', 'public');
        $this->data['imageName'] = $this->photo->getFileName();

        $subscrib = Subscribeinner::saveData($this->data);
        $history = History::saveData($subscrib, $this->data);

        EntityHistory::saveData($subscrib->toArray(), $history->toArray(),
            $this->data, 'Mesa do Presidio', 'History',
            'Subscribeinner', $subscrib->h7,
            'Presidente', 0, $subscrib->id
        );
        $this->dispatchBrowserEvent('event-success', ['message' => 'O presidente da Assembleia Nascional foi registrado com sucesso!']);
    }

    public function saveVicesPresicentes()
    {
        $this->data['url'] = $this->photo->store('imagens/slider/noticias', 'public');
        $this->data['imageName'] = $this->photo->getFileName();

        $tab = Tab::saveData($this->data, 2);
        $postdate = Postdate::saveData($this->data['dataEleito'], '' . $tab->id);

        EntityHistory::saveData($tab->toArray(), $postdate->toArray(), $this->data,
            'Mesa do Presidio', 'PostData', 'Tab', $tab->category,
            'Vices', $this->data['ordem'], $tab->id
        );

        $this->dispatchBrowserEvent('event-success', ['message' => 'A entidade vice presidente da Assembleia Nascional, foi registrado com sucesso!']);

    }

    public function saveSecretarios()
    {
        $this->data['url'] = $this->photo->store('imagens/slider/noticias', 'public');
        $this->data['imageName'] = $this->photo->getFileName();

        $tab = Tab::saveData($this->data, 3);
        $postdate = Postdate::saveData($this->data['dataEleito'], '' . $tab->id);

        EntityHistory::saveData($tab->toArray(), $postdate->toArray(), $this->data,
            'Mesa do Presidio', 'PostData', 'Tab', $tab->category,
            'Secretarios', $this->data['ordem'], $tab->id
        );

        $this->dispatchBrowserEvent('event-success', ['message' => 'A entidade secretariado da Assembleia Nascional, foi registrado com sucesso!']);
    }

    public function saveDeputado()
    {
        $this->data['url'] = $this->photo->store('imagens/slider/noticias', 'public');
        $this->data['imageName'] = $this->photo->getFileName();

        dump($this->data);
        //EntityHistory::createdDeputado($this->data,'' );
    }

    public function showModal()
    {

        $this->emit('openNewForm');
    }

    public function sendSuccess()
    {
        $this->render();
    }


    public function openFuncao()
    {
        $this->emit('openModalFuncao');
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

    public function updateMedaPresidio($attr): void
    {
        // $priFuncionario = Funcionario::where('Email',)->first()?->toArray();
        $this->data['codFuncionario'] = $attr['primavera_id'];

        // seleção da seção de apresenteação
        $innerContext = json_decode($attr['objectJson'], true, 512, JSON_THROW_ON_ERROR);

        $myData = $innerContext['myData'];
        $editContext = $innerContext['Subscribeinner'] ?? $innerContext['Tab'];
        $this->data['scheduleSection_id'] = $myData['scheduleSection_id'];
        $this->data['ordem'] = $myData['ordem'];
        $this->data['typeWebApp'] = $myData['typeWebApp'];
        $this->data['dataEleito'] = $myData['dataEleito'];
        $this->data['primaveraFunc'] = $myData['primaveraFunc'];
        $this->data['deputy'] = $myData['deputy'];
        $this->data['context'] = $myData['context'];

        //Subscribeinner, Tab
        //dd($attr, $innerContext, $editContext);

        $this->dispatchBrowserEvent('editorEditingMesaPresidio', ['contexto' => $myData['context']]);
        $this->updatedDataCodFuncionario();

        $history = $innerContext['History'] ?? null;
        $entityHistory = EntityHistory::where('id', $attr['id'])->first();

        //dd($entityHistory?->socialites->toArray());
        $this->socialites = $entityHistory?->socialites->toArray();


    }

}
