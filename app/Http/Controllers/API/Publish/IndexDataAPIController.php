<?php

namespace App\Http\Controllers\API\Publish;

use App\Http\Controllers\API\AboutsectionAPIController;
use App\Http\Controllers\API\ActivitiessectionAPIController;
use App\Http\Controllers\API\BlogpagAPIController;
use App\Http\Controllers\API\SchedulessectionAPIController;
use App\Http\Controllers\API\SliderinfoAPIController;
use App\Http\Controllers\API\SolutionssectionAPIController;
use App\Http\Controllers\AppBaseController;
use Response;

class IndexDataAPIController extends AppBaseController
{
    public function __construct()
    {

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @return Response
     */
    public function index()
    {
        return $this->sendResponse(self::extracted(), 'Aboutsections retrieved successfully');
    }

    public static function extracted(): array
    {
        $indexData['SliderInfo'] = SliderinfoAPIController::sliderInfo();
        $indexData['activitiesSection'] = ActivitiessectionAPIController::activitiesSection();
        $indexData['aboutSection'] = AboutsectionAPIController::aboutsection();
        $indexData['schedulesSection'] = SchedulessectionAPIController::schedulesSection();
        $indexData['blogPag'] = BlogpagAPIController::blogPag();
        $indexData['solutionsSection'] = SolutionssectionAPIController::solutionsSection();


        $dataSend = response()->json($indexData, 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE)->content();

        //$indexDataJSON = json_encode($indexData, true);

        file_put_contents(base_path('public/json/IndexData.json'), $dataSend);
        return $indexData;
    }

    public static function publish()
    {
        try {
            self::extracted();
            exec('cd C:\Projectos\parlamento_ao && npm run build');
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }


}
