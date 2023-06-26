<?php

namespace App\Http\Livewire\Forms\Blogs\BlogOther;

use App\Http\Livewire\Base\PaginatedComponent;
use App\Models\Parlamento\BlogPagBody;
use App\Models\Parlamento\BlogPagContents;
use App\Models\Parlamento\LinkFiles;
use App\Models\Parlamento\OtherMenu;
use App\Models\Traits\SoutTable;
use Illuminate\Support\Fluent;
use Livewire\Component;

class ListaContexto extends PaginatedComponent
{
    use SoutTable;

    public $itemMenu = array();
    public $itemSelect;
    protected $listeners = ['successEvent'];

    public function mount()
    {
        $this->modelName = BlogPagBody::class;
        $this->itemMenu = OtherMenu::orderBy('id', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.forms.blogs.blog-other.lista-contexto', [
            'blogPagBody' => BlogPagContents::with('blogPageBody')
                ->where('menuId', null)
                ->orderByDesc('id')
                ->paginate(1)
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


            foreach (BlogPagContents::with('blogPageBody', 'blogPageBody.linkFiles', 'blogPageBody.banner')
                         ->where('keyMenu', $this->itemSelect)->get() as $blog) {

                $dataInfo['data'] = $blog->toArray();
                $dataInfo['data']['header'] = [
                    "h1" => $blog->context,
                    "img" => $blog->imgCapa,
                ];


                if ($blog->blogPageBody) {

                    foreach ($blog->blogPageBody as $itensBody) {

                        $dataInfo['data']['body'][] = $itensBody->toArray();
                    }
                }


                //$dataInfo['data']['body'] = $blog->blogPageBody;

                $dataSend = response()->json($dataInfo, 200, [
                    'Content-Type' => 'application/json;charset=UTF-8',
                    'Charset' => 'utf-8'
                ], JSON_UNESCAPED_UNICODE)->content();

                $routers = $this->itemSelect . '_' . $blog->id;

                \Storage::disk('public')->put("json/{$routers}.json", $dataSend);
            }

            $dataSendAll = response()->json($indexData, 200, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE)->content();


            //"keyMenu" => "Convocatoria"
            $item = BlogPagContents::with('blogPageBody', 'blogPageBody.banner')->where('keyMenu', $this->itemSelect)->orderBy('id', 'desc')->first();

            $indexDataContenters['noticeCorrent']['header'] = [
                "h1" => $item->context,
                "img" => $item->imgCapa,
                "codeTool" => true,
            ];

            $items = BlogPagContents::with('blogPageBody', 'blogPageBody.banner')->where('keyMenu', $this->itemSelect)->orderBy('id', 'desc')->get([
                'imgCapa as img', 'context', 'id'
            ]);

            /// notices
            $indexDataContenters['notices'] = $items;

            $dataSendAllMys = response()->json($indexDataContenters, 200, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE)->content();

            \Storage::disk('public')->put("json/{$this->itemSelect}.json", $dataSendAllMys);


            $this->dispatchBrowserEvent('send-success', ['message' => 'Foi publicado as alterações no site com sucesso!']);
        } catch (\Exception $da) {

            \Storage::disk('public')->put("json/{$this->itemSelect}.json", []);
            $this->dispatchBrowserEvent('show-fails', ['message' => 'Não foi possivel publicar eventual erro! verifique se seleccionou o menu']);
        }
    }

    public function removeItem($item)
    {
        BlogPagContents::where('id', $item['id'])->delete();
        BlogPagBody::where('blogPagContentsId', $item['id'])->delete();

        $this->dispatchBrowserEvent('send-success', ['message' => 'Foi eliminado o item com sucesso!']);
    }

    public function sentCapa($attr)
    {
        $this->emit('editElement', $attr);
    }

    public function editItemElemente($attr)
    {
        // LinkFiles get Class
        $this->emit('editContext', $attr);
    }

    public function removeItemElemente($attr)
    {
        try {
            BlogPagBody::where('id', $attr['id'])->delete();
            $this->render();
        } catch (\Exception $e) {
        }
    }


    public function successEvent()
    {
        $this->render();
        $this->dispatchBrowserEvent('activeFunctionality');
    }
}
