<?php

namespace App\Http\Livewire\Forms\BannerCentral\Slider;

use App\Models\Parlamento\Sliderinfo;
use App\Models\Parlamento\TaskActivities;
use Livewire\Component;

class ItemSlider extends Component
{
    protected $activeVal = '';
    protected $dataSlider = array();
    protected $title = '';
    protected $data = ['h1' => '', 'url' => '', 'p' => '', 'id' => '', 'href' => '', 'user_id' => ''];

    public function mount($activeVal = '', $title = '', $data = ['h1' => '', 'url' => '', 'p' => '', 'id' => '', 'href' => '', 'user_id' => ''])
    {
        $this->activeVal = $activeVal;
        $this->title = $title;
        $this->data = $data;
    }

    public function render()
    {
        return view('livewire.forms.banner-central.slider.item-slider', ['activeVal' => $this->activeVal, 'title' => $this->title, 'data' => $this->data]);
    }


    public function deleteItem($attribute)
    {

        $deleted = Sliderinfo::find($attribute)->delete();
        $this->dispatchBrowserEvent('success-event-sub', ['message' => 'O Item foi eliminado com sucesso!']);
        TaskActivities::create([
            'primavera_email' => auth()->user()->ldap->getEmail(),
            'data_tool_info' => json_encode($this->data, true),
            'action_info' => 'Eliminado o item do Slider da Pagina ' ,
            'seccion_info' => 'Created',
            'user_id' => auth()->user()->id,
            'task_identity' => $attribute,
            'class_name' => "Livewire.Forms.Cabecalho.ItemSlider"
        ]);
        $this->emit('updatedOne');

    }
}
