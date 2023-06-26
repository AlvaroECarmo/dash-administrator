<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['prevent-back-history', 'auth']], function () {
    Route::view('/cabecalho', 'CoreDashboards.Cabecalhos.DashGerirCabecalho')->name('getCabecalhos')->middleware('an');
    Route::view('/linguas', 'CoreDashboards.Cabecalhos.DashGerirLinguas')->name('getLinguas')->middleware('an');
    Route::view('/menu-principal', 'CoreDashboards.Cabecalhos.DashGerirMenu')->name('getMenuPrincipal')->middleware('an');
});

Route::group(['middleware' => ['prevent-back-history', 'auth']], function () {

    Route::view('/definicao-composicao', 'CoreDashboards.BannerCentral.DashDefinicaoComposicao')->name('getDefinicaoComposeicao')->middleware('an');
    Route::view('/menu-legislativo', 'CoreDashboards.BannerCentral.DashGerirMenuLegislativo')->name('getMenuLegislativo')->middleware('an');
    Route::view('/slider-show', 'CoreDashboards.BannerCentral.DashGerirSliderShow')->name('getSliderShow')->middleware('an');
    Route::view('/videos-portal', 'CoreDashboards.BannerCentral.DashGerirVideos')->name('getVideos')->middleware('an');
});


Route::group(['middleware' => ['prevent-back-history', 'auth']], function () {

    Route::view('/perfil-deputado', 'CoreDashboards.EntidadesParlamentares.DashGerirDeputado')->name('getDeputado')->middleware('an');
    Route::view('/artigos-publicacao', 'CoreDashboards.EntidadesParlamentares.DashGerirPublicacoes')->name('getPublicacao')->middleware('an');
    Route::view('/mesa-presidio', 'CoreDashboards.EntidadesParlamentares.DashMesaPresidio')->name('getMesaPresidio')->middleware('an');
});

Route::group(['middleware' => ['prevent-back-history', 'auth']], function () {

    Route::view('/grupo-parlamentar', 'CoreDashboards.RodapeSite.DashGrupoParlamentar')->name('getGrupParlamentar')->middleware('an');
    Route::view('/central-informacao', 'CoreDashboards.RodapeSite.DashCentraliNformacoes')->name('getCentralInformacao')->middleware('an');
    Route::view('/contacto-adminstrativo', 'CoreDashboards.RodapeSite.DashContactosAdministrativos')->name('getContactoAdmin')->middleware('an');
    Route::view('/logos', 'CoreDashboards.RodapeSite.DashLogsInsignas')->name('getLogos')->middleware('an');
    Route::view('/perfil', 'auth.profile')->name('profile')->middleware('an');

    Route::view('/noticias', 'CoreDashboards.BannerCentral.DashGerirNoticia')->name('noticias')->middleware('an');
    Route::view('/blogInfomation', 'CoreDashboards.blogs.DashBlogInfomation')->name('blogInfomation')->middleware('an');

    Route::view('/blogMultimedia', 'CoreDashboards.blogs.DashBlogMultimedia')->name('blogMultimedia')->middleware('an');
    Route::view('/deputados', 'CoreDashboards.blogs.DashBlogEntidades')->name('profileDeputies')->middleware('an');

    Route::post('Audiotorage', [\App\Http\Controllers\Uploads\APIFileUploadController::class, 'uploadAudio'])->name('audio.store');
    Route::post('uploadVideo', [\App\Http\Controllers\Uploads\APIFileUploadController::class, 'uploadVideo'])->name('video.store');

    Route::view('/Grupos', 'CoreDashboards.permitions.DashGroups')->name('config.groups')->middleware('an');
    Route::view('/membrosGrupo', 'CoreDashboards.permitions.DashGroupMembers')->name('config.groupsMembers')->middleware('an');

    Route::view('outros-perfis', 'CoreDashboards.EntidadesParlamentares.DashOutraEntidades')->name('outrosPerfis')->middleware('an');


    Route::get('apiDepartamento', [\App\Http\Controllers\API\Search\SeachDepartamento::class, 'search'])->name('api.department')->middleware('an');
    Route::get('apiFuncionario', [\App\Http\Controllers\API\Search\SearchFuncionario::class, 'search'])->name('api.funcionario')->middleware('an');

    Route::post('/imagesStore', [\App\Http\Controllers\ImageAPIController::class, 'store'])->name('image.store')->middleware('an');
    Route::post('crop', [\App\Http\Controllers\UploadController::class, 'crop'])->name('crop')->middleware('an');


    Route::post('/editorwordspress', [\App\Http\Controllers\UploadController::class, 'uploading'])->name('sendimage')->middleware('an');
    Route::post('/editorwordspresscropped', [\App\Http\Controllers\UploadController::class, 'uploadingCropped'])->name('sendCropped')->middleware('an');

    Route::get('/apiyoutube', [\App\Http\Controllers\API\Search\SearchYoutubeAPI::class, 'index'])->name('api.youtube')->middleware('an');
    Route::get('/myYoute', [\App\Http\Controllers\API\Search\SearchYoutubeAPI::class, 'seraching'])->name('api.myYoute')->middleware('an');

    Route::view('/OutrasPaginas', 'CoreDashboards.blogs.DashBlogOther')->name('OutrasPaginas')->middleware('an');


    Route::get('apiDepartamento', [\App\Http\Controllers\API\Search\SeachDepartamento::class, 'search'])->name('api.department')->middleware('auth');
    Route::get('apiFuncionario', [\App\Http\Controllers\API\Search\SearchFuncionario::class, 'search'])->name('api.funcionario')->middleware('auth');

    Route::post('/imagesStore', [\App\Http\Controllers\ImageAPIController::class, 'store'])->name('image.store');
    Route::post('crop', [\App\Http\Controllers\UploadController::class, 'crop'])->name('crop');


    Route::post('/dropzoneUpload', [\App\Http\Controllers\ImageAPIController::class, 'zoneUpload'])->name('drop.store');
});

