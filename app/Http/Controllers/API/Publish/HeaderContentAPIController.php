<?php

namespace App\Http\Controllers\API\Publish;

use App\Http\Controllers\API\MainheaderAPIController;
use App\Http\Controllers\AppBaseController;
use App\Models\Parlamento\Mainheader;
use InfyOm\Generator\Utils\ResponseUtil;
use Response;

class HeaderContentAPIController extends AppBaseController
{

    /**
     * @return \Illuminate\Http\JsonResponse
     * @return Response
     */
    public function index()
    {

        $indexData = MainheaderAPIController::getHeaderContents();

        $dataSend = response()->json($indexData, 200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE)->content();
        //$indexDataJSON = json_encode($indexData, true);


        file_put_contents(base_path('public/json/MainHeader.json'), $dataSend);

        return $this->sendResponse($indexData, 'Aboutsections retrieved successfully');
    }

    /**
     * @return bool
     */

    public static function publish(): bool
    {
        try {

            //$local = config('cian.LOCALJSON');
            $localSorage = config('cian.STORAGEJSON');

            $indexData = MainheaderAPIController::getHeaderContents();

            $dataSend = response()->json($indexData, 200,
                ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE)->content();

            \Storage::disk('public')->put('json/MainHeader.json', $dataSend);


            return true;
        } catch (\Exception $d) {
            return false;
        }
    }
}
