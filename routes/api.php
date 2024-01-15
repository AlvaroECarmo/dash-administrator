<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use InfyOm\Generator\Utils\ResponseUtil;

/*
|--------------------------------------------------------------------------
| API Routes
|-------------------------------------------------------main_header-------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('info/{id}', function ($id) {

    try {
        $cacheKey = $id;
        $cacheTtl = 7200; // tempo de expiração do cache em segundos

        /* if (Cache::has($cacheKey)) {
             return Response::json(Cache::get($cacheKey));
         }*/

        //MainHeader
        $file = file_get_contents(base_path("public/storage/json/{$id}.json"));
        json_decode($file, true, 512, JSON_THROW_ON_ERROR);
        $data = ResponseUtil::makeResponse("Success Full", json_decode($file, true, 512, JSON_THROW_ON_ERROR));
        \Illuminate\Support\Facades\Cache::put($cacheKey, $data, $cacheTtl);
        return \Response::json($data);
    } catch (\Exception $d) {
        $indexData['header'] = [
            'Author' => "Centro de Informática",
            "Local" => "Assembleia Nacional de Angola",
            "_token" => "token not identify",
            "Authentication" => "auth not identify"
        ];
        return $indexData;
    }
});
Route::get('info/{content}/{id}', function ($content, $id) {

    $cacheKey = $id;
    $cacheTtl = 7200; // tempo de expiração do cache em segundos

    /*if (Cache::has($cacheKey)) {
        return Response::json(Cache::get($cacheKey));
    }*/

    try {
        //MainHeader
        $file = file_get_contents(base_path("public/storage/json/{$id}.json"));
        json_decode($file, true, 512, JSON_THROW_ON_ERROR);

        $data = ResponseUtil::makeResponse("Success Full", json_decode($file, true, 512, JSON_THROW_ON_ERROR));
        Cache::put($cacheKey, $data, $cacheTtl);
        return Response::json($data);


    } catch (\Exception $d) {
        $indexData['header'] = [
            'Author' => "Centro de Informática",
            "Local" => "Assembleia Nacional de Angola",
            "_token" => "token not identify",
            "Authentication" => "auth not identify"
        ];
        return $indexData;
    }

});

Route::get('_token/{id}', function () {
    $indexData['header'] = [
        'Author' => "Centro de Informática",
        "Local" => "Assembleia Nacional de Angola",
        "_token" => '',
        "Authentication" => "auth not identify"
    ];
    return $indexData;
});

Route::post('info/message', function (Request $r) {

    if ($r->domine == "https://portaladmin.parlamento.ao") {
        $detail = [
            'name' => $r->name,
            'email' => $r->email,
            'phone' => $r->phone,
            'msg' => $r->msg
        ];

        Mail::to('assembleianacional@parlamento.ao')->send(new \App\Mail\ContactMail($detail));
        sleep(10);
        return Response::json($r) ;
    } else {
        return "Not found server stmp 404";
    }
});





//Route::get('tester', [\App\Http\Controllers\Publico\API\DeputadoAPIController::class, 'todos']);
/*
Route::resource('indexdata', Publish\IndexDataAPIController::class);
Route::resource('', Publish\HeaderContentAPIController::class);
Route::resource('main_footers', Publish\FooterAPIController::class);
Route::resource('main_menu', Publish\MenuAPIController::class);

Route::resource('aboutsections', AboutsectionAPIController::class);


Route::resource('activitiessections', ActivitiessectionAPIController::class);


Route::resource('blogpags', BlogpagAPIController::class);


Route::resource('categories', CategoriesAPIController::class);


Route::resource('clearfixes', ClearfixAPIController::class);


Route::resource('contentdescriptions', ContentdescriptionAPIController::class);


Route::resource('figures', FigureAPIController::class);


Route::resource('headercontents', HeadercontentAPIController::class);


Route::resource('histories', HistoryAPIController::class);


Route::resource('imageboxes', ImageboxAPIController::class);


Route::resource('items', ItemsAPIController::class);


Route::resource('links', LinksAPIController::class);


Route::resource('listsections', ListsectionAPIController::class);


Route::resource('lowerboxes', LowerboxAPIController::class);


Route::resource('mainfooters', MainfooterAPIController::class);


Route::resource('mainheaders', MainheaderAPIController::class);


Route::resource('multipleitems', MultipleitemsAPIController::class);


Route::resource('postdates', PostdateAPIController::class);


Route::resource('postinfos', PostinfoAPIController::class);


Route::resource('posts', PostsAPIController::class);


Route::resource('schedulessections', SchedulessectionAPIController::class);


Route::resource('sliderinfos', SliderinfoAPIController::class);


Route::resource('socials', SocialAPIController::class);


Route::resource('solutionssections', SolutionssectionAPIController::class);


Route::resource('subscribeinners', SubscribeinnerAPIController::class);


Route::resource('tabs', TabAPIController::class);


Route::resource('tabbtnslis', TabbtnslisAPIController::class);


Route::resource('tabscontents', TabscontentAPIController::class);


Route::resource('mainmenus', MainmenuAPIController::class);
*/
