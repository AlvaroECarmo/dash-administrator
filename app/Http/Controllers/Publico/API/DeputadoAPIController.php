<?php

namespace App\Http\Controllers\Publico\API;

use App\Http\Controllers\AppBaseController;
use App\Models\Parlamento\BlogPagDeputy;
use function csrf_token;
use function response;

/**
 * Class LinksController
 * @package App\Http\Controllers\Public\API
 */
class DeputadoAPIController extends AppBaseController
{

    public function todos()
    {

        $indexData['header'] = [
            'Author' => "Centro de Informática",
            "Local" => "Assembleia Nacional de Angola",
            "_token" => csrf_token(),
        ];


        foreach (BlogPagDeputy::orderBy('ordem')->get()->groupBy('localkeyMenu') as $key => $value) {

            $indexData['entities'] = BlogPagDeputy::orderBy('ordem')
                ->where('localkeyMenu', $key)
                ->get();

            \Storage::disk('public')->put("json/{$key}.json", $value);
            $dataSend = response()->json($indexData, 200, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE)->content();

            //\Storage::disk('public')->put("json/Entities.json", $dataSend);
        }


        foreach (BlogPagDeputy::orderBy('id', 'desc')->get() as $blg) {

            $indexData['entity'] = $blg;

            $dataUnick = response()->json($indexData, 200, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE)->content();
            //   \Storage::disk('public')->put("json/{$blg->object_iuu}.json", $dataUnick);
        }

        return $this->sendResponse($indexData, 'Clearfixes retrieved successfully');

    }


}
