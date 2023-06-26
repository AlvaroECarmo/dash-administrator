<?php

namespace App\Http\Controllers\API\Search;

use App\Http\Controllers\Controller;

class BaseSeach extends Controller
{
    public static function explodeWord($frase): string
    {
        $palavras = explode(" ", $frase);
        $pesquisa = '';
        $palavrasIgnorar = ['de'];

        foreach ($palavras as $palavra) {
            if (!in_array($palavra, $palavrasIgnorar, true)) {
                $pesquisa .= '%' . $palavra;
            }
        }

        return $pesquisa;
    }

}
