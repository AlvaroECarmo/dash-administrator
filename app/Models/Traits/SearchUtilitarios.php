<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait SearchUtilitarios
{
    public $openSearch;
    public $termoPesquisaForm = '';
    public $termoPesquisa = "";


    public function pesquisaTermo()
    {
        if (Str::length($this->termoPesquisaForm) > 2) {
            $this->termoPesquisa = $this->termoPesquisaForm;

        } else {
            $this->termoPesquisa = '';
        }
    }

    public function updatedtermoPesquisaForm()
    {
        $termoTamanho = Str::length($this->termoPesquisaForm);
        if ($termoTamanho > 2) {
            $this->termoPesquisa = $this->termoPesquisaForm;
        } else {
            if ($termoTamanho <> 0) {
                session()->flash('pesquisaError', 'O termo de pesquisa deve ter mais que 2 carateres.');
            }
            $this->termoPesquisa = '';

        }

        $this->emit('termoPesquisa', ['termoPesquisaForm' => $this->termoPesquisa]);
    }

    public function openSearch()
    {
        $this->openSearch = 'navbar-search-open';
    }

    public function closeSearch()
    {
        $this->openSearch = '';
    }


}
