<?php

namespace App\Http\Livewire\Forms\Blogs\BlogInfo;

use App\Http\Livewire\Base\PaginatedComponent;
use App\Models\Parlamento\BlogPagBody;
use App\Models\Parlamento\BlogPagContents;
use App\Models\Traits\SoutTable;
use Livewire\Component;

class ListaContexto extends PaginatedComponent
{
    use SoutTable;

    protected $listeners = ['successEvent'];

    public function mount()
    {
        $this->modelName = BlogPagBody::class;
    }

    public function render()
    {
        return view('livewire.forms.blogs.blog-info.lista-contexto', [
            'blogPagBody' => BlogPagContents::with('blogPageBody')
                ->orderByDesc('id')
                ->where('menuId', '!=', null)
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


            foreach (BlogPagContents::with('blogPageBody', 'blogPageBody.banner')->where('menuId', '!=', null)->get() as $blog) {

                $indexData['data']['header']['h1'] = $blog->title;
                $indexData['data']['header']['img'] = $blog->imgCapa;
                $indexData['data']['header']['url'] = url('storage') . '/';

                $indexData['data']['body'] = $blog->blogPageBody;

                //$indexData['noticeCorrent'] = Blogpag::with('anexolists')->orderBy('order')->first();
                $dataSend = response()->json($indexData, 200, [
                    'Content-Type' => 'application/json;charset=UTF-8',
                    'Charset' => 'utf-8'
                ], JSON_UNESCAPED_UNICODE)->content();

                $pathJson = 'public/Data/Blogs/' . $blog->keyMenu . '.json';

                //$indexDataJSON = json_encode($indexData, true);
                // file_put_contents(base_path("" . $pathJson), $dataSend);
                \Storage::disk('public')->put("json/{$blog->keyMenu}.json", $dataSend);
            }

            $dataSendAll = response()->json($indexData, 200, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE)->content();

            //$configurar = config('cian.LOCALJSON');
            //file_put_contents(base_path($configurar . 'SiteContent.json'), $dataSendAll);
            $this->dispatchBrowserEvent('send-success', ['message' => 'Foi publicado as alterações no site com sucesso!']);
        } catch (\Exception $da) {
            $this->dispatchBrowserEvent('show-fails', ['message' => 'Não foi possivel publicar eventual erro!']);
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
