<?php

namespace App\Http\Livewire\Forms\Blogs\BlogInfo;

use App\Http\Livewire\Base\PaginatedComponent;
use App\Models\Parlamento\BlogPagBody;
use App\Models\Parlamento\BlogPagContents;
use App\Models\Traits\NTDefaultFunctions;
use App\Models\Traits\SoutTable;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use phpDocumentor\Reflection\Types\Integer;

class ListaCapas extends PaginatedComponent
{

    use SoutTable;
    use WithFileUploads;

    protected $listeners = ['changeItemMenu', 'successEvent', 'sendEventList'];
    public $menuItemContentId;
    public $event = ['serchble' => ''];
    public $postfoto;
    public $localRelative;

    //public $capas = array();

    public function mount()
    {
        $this->modelName = BlogPagContents::class;

    }

    public function render()
    {
        if (auth()->user()->isImpersonated() || auth()->user()->isSuperAdmin()) {
            if (Str::length($this->event['serchble']) > 2)
                $capasY = BlogPagContents::orderByDesc('id')
                    ->search($this->event['serchble'])
                    ->where('menuId', '!=', null)
                    ->paginate(5);
            else
                $capasY = BlogPagContents::orderByDesc('id')
                    ->where('menuId', '!=', null)
                    ->paginate(5);
        } else {
            if (Str::length($this->event['serchble']) > 2)
                $capasY = BlogPagContents::orderByDesc('id')
                    ->search($this->event['serchble'])
                    ->where('user_id', auth()->user()->id)
                    ->where('menuId', '!=', null)
                    ->paginate(5);
            else
                $capasY = BlogPagContents::orderByDesc('id')
                    ->where('user_id', auth()->user()->id)
                    ->where('menuId', '!=', null)
                    ->paginate(5);
        }

        return view('livewire.forms.blogs.blog-info.lista-capas', [
            'capas' => $capasY
        ]);
    }

    public function changeItemMenu($id)
    {
        $this->menuItemContentId = $id;
        //   $this->capas = BlogPagContents::where('menuId', $this->menuItemContentId)->orderBy('ordem')->get();
        $this->dispatchBrowserEvent('imageFuncionality');
    }

    public function publishAll()
    {

        $indexData['header'] = [
            'Author' => "Centro de Informática",
            "Local" => "Assembleia Nacional de Angola",
            "_token" => csrf_token(),
            "Authentication" => \Auth::user()->name
        ];

        foreach (BlogPagContents::with('blogPageBody')->get() as $blog) {

            $indexData[$blog->keyMenu]['header']['h1'] = $blog->title;
            $indexData[$blog->keyMenu]['header']['img'] = $blog->imgCapa;
            $indexData[$blog->keyMenu]['header']['url'] = url('storage') . '/';

            $indexData[$blog->keyMenu]['body'] = $blog->blogPageBody;

        }

        //$indexData['noticeCorrent'] = Blogpag::with('anexolists')->orderBy('order')->first();


        $dataSend = response()->json($indexData, 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE)->content();

        //$indexDataJSON = json_encode($indexData, true);

        file_put_contents(base_path('public/json/SiteContent.json'), $dataSend);
        $this->dispatchBrowserEvent('send-success', ['message' => 'Foi publicado as alterações no site com sucesso!']);

        // exec('cd C:\Projectos\parlamento_ao && npm run build');
        return $indexData;


    }

    public function removeElement(BlogPagContents $attr)
    {
        $attr->delete();

        $this->dispatchBrowserEvent('success-send', ['message' => 'O item foi removido como sucesso!']);
        $this->dispatchBrowserEvent('activeFunctionality');
        $this->render();

    }

    public function successEvent()
    {
        /* if ($this->menuItemContentId > 0)
             $this->capas = BlogPagContents::where('menuId', $this->menuItemContentId)->orderBy('ordem')->get();
         else
             $this->capas = BlogPagContents::orderBy('ordem')->get();*/
    }

    public function sendEventList()
    {
        if ($this->menuItemContentId > 0)
            $this->capas = BlogPagContents::where('menuId', $this->menuItemContentId)->orderBy('ordem')->get();
        else
            $this->capas = BlogPagContents::orderBy('ordem')->get();
    }

    public function publicMyCapa($event, $attr)
    {
        $this->emit('sentCapa', $attr);
    }

    public function editElement($attr)
    {
        $this->emit('editElement', $attr);
    }


    public function updatedPostfoto()
    {
        $this->localRelative = $this->postfoto->store('blog/capa/editor' . date('HisYms'));
    }

}
