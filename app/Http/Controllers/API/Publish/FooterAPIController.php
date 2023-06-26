<?php

namespace App\Http\Controllers\API\Publish;

use App\Http\Controllers\API\MainfooterAPIController;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\JsonResponse;
use Response;


class FooterAPIController extends AppBaseController
{
    /**
     * @return JsonResponse
     * @return  Response;
     */
    public function index()
    {
        $indexData['mainFooter'] = MainfooterAPIController::mainFooter();


        $dataSend = response()->json($indexData, 200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE)->content();
        //$indexDataJSON = json_encode($indexData, true);


        file_put_contents(base_path('public/json/MainFooter.json'), $dataSend);

        return $this->sendResponse($indexData, 'Aboutsections retrieved successfully');

    }
}
