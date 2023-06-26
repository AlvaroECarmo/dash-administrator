<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
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

    if ($r['domine'] === "https://portaladmin.parlamento.ao") {
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
