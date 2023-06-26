<?php

namespace App\Http\Livewire\Forms\Blogs\BlogMultimedia;

use App\Http\Livewire\Base\PaginatedComponent;
use App\Models\Multimedias;
use App\Models\Parlamento\BlogPagBody;
use App\Models\Parlamento\BlogPagContents;
use App\Models\Traits\SoutTable;

class ListaContexto extends PaginatedComponent
{
    use SoutTable;

    protected $listeners = ['sucessEvent'];
    public $tipoViewsT = 0;

    public function mount()
    {
        $this->modelName = Multimedias::class;
    }

    public function render()
    {
        $data = Multimedias::orderBy('order')->paginate(6);
        if ($this->tipoViewsT > 0)
            $data = Multimedias::where('typeMultimedia', $this->tipoViewsT)->orderBy('order')->paginate(6);

        return view('livewire.forms.blogs.blog-multimedia.lista-contexto', [
            'blogPagBody' => $data
        ]);
    }

    public function updated()
    {
        $this->dispatchBrowserEvent('activeFunctionality');
    }

    public function publishInfo()
    {

        $indexData['header'] = [
            'Author' => "Centro de Informática",
            "Local" => "Assembleia Nacional de Angola",
            "_token" => csrf_token(),
            "Authentication" => \Auth::user()->name
        ];

        try {

            $indexData['data'] = Multimedias::orderBy('order')->get();

            $dataSendAll = response()->json($indexData, 200, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE)->content();

            $configurar = config('cian.LOCALJSON');
            file_put_contents(base_path($configurar . 'MultimediaJSON.json'), $dataSendAll);

            $this->dispatchBrowserEvent('send-success', ['message' => 'Foi publicado as alterações no site com sucesso!']);
        } catch (\Exception $da) {
            $this->dispatchBrowserEvent('show-fails', ['message' => 'Não foi possivel publicar eventual erro!']);
        }
    }

    public function removeItem(Multimedias $item)
    {
        $item->delete();
        $this->dispatchBrowserEvent('send-success', ['message' => 'Foi eliminado o item com sucesso!']);
    }

    public function sucessEvent()
    {
        $this->render();
        $this->dispatchBrowserEvent('activeFunctionality');
    }

}
