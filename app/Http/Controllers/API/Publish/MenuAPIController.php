<?php

namespace App\Http\Controllers\API\Publish;


use App\Http\Controllers\API\MainmenuAPIController;
use App\Http\Controllers\AppBaseController;
use http\Exception;
use File;

class MenuAPIController extends AppBaseController
{
    /**
     * @return void
     */
    public static function extracted(): array
    {
        $data["mainMenu"] = MainmenuAPIController::menuMain();
        $dataFull["mainMenu"] = MainmenuAPIController::menuMainfull();

        $dataSend = response()->json($data, 200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE)->content();
        //$indexDataJSON = json_encode($indexData, true);
            //as
        $dataSendFull = response()->json($dataFull, 200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE)->content();



        \Storage::disk('public')->put('json/MainMenu.json', $dataSend);
        \Storage::disk('public')->put('json/MainMenuFull.json', $dataSendFull);
        return $data;
    }

    public function index()
    {
        $data = self::extracted();
        return $this->sendResponse($data, 'Contentdescriptions retrieved successfully');
    }

    public static function publish()
    {
        try {
            self::extracted();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
