<?php

namespace App\Models;

trait GetJSON
{
    /**
     * @param $nameFile
     * @param $dirName
     * @return mixed
     *
     * é uma função responsavel para pegar o arquivo JSON das configurações
     * que está localizada na pasta public/configurações
     */
    private function parseEncode($nameFile, $dirName = 'public/configuracoes/')
    {
        $jsonMenu = file_get_contents(base_path($dirName . $nameFile));
        return json_decode($jsonMenu, true);

    }


}
