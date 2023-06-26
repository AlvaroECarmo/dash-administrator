<?php


namespace App\Models\External\MINFIN;


use App\Models\External\PRIMAVERA\Funcionario;
use GuzzleHttp\Client;

class MinfinAPI
{

    public static function obterAgente($codigoAgente = null,$numDocumento = null)
    {
        if (is_null($codigoAgente) and is_null($numDocumento))
        {
            return null;
        }

        if (!is_null($codigoAgente))
        {
            $query = [
                'tipoDocumento' => 'COD_AGENTE',
                'numeroDocumento' => $codigoAgente,
                'vinculo' => 'ATIVOS',
            ];
        }
        else
        {
            $query = [
                'tipoDocumento' => 'NIF',
                'numeroDocumento' => $numDocumento,
                'vinculo' => 'ATIVOS',
            ];
        }

        $response = self::invocaAPIMinfin(config('Minfin.ObterAgente'), $query);
        $res = (string) $response->getBody();
        $res = json_decode($res);
        dump($res);


    }
    public static function listarAgentesUO()
    {

        $query = [
            'unidadeOrcamental' => config('Minfin.unidadeOrcamental'),
            'unidadePagadora' => config('Minfin.unidadePagadora'),
        ];
        $response = self::invocaAPIMinfin(config('Minfin.ListagemGeralAgentes'), $query);

        $res = (string) $response->getBody();
        $res = json_decode($res); // Using this you can access any key like below
        $agentes = $res->ListarAgente->Agente;

//dump($res);
        $collection = ListaAgenteOU::hydrate((array)$agentes);

        foreach ($collection as $agente)
        {
            ListaAgenteOU::criaSeNaoExistir($agente);
        }

        Funcionario::correspondenciaMinfin();

        //$collection = $collection->flatten();
        dump($collection->count());
       // dump($collection);
    }

    private static function invocaAPIMinfin($operacao, $query)
    {
        $client = new Client(['base_uri' => config('Minfin.base_url')]);

        $response = $client->request('GET', $operacao,
            ['query' => $query,
                'auth'=>[
                    config('Minfin.authentication.user'),
                    config('Minfin.authentication.password')
                ]
            ]);

        return $response;
    }
}
