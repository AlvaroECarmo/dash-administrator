<?php

namespace App\Http\Controllers\Uploads;

use App\Http\Controllers\Controller;
use App\Models\video;
use Illuminate\Http\Request;

class APIFileUploadController extends Controller
{
    /**
     * @param Request $request
     * @return string
     */
    public function uploadAudio(Request $request)
    {

        $file = $request->file('audio');
        // $file->move('upload', $file->getClientOriginalName());

        //   $file->move(public_path("storage/audio/"), $file->getClientOriginalName());

        //  $file_name = $file->getClientOriginalName();

        return response()->json([
            'status' => 1,
            'request' => json_encode($file, true)
        ]);
    }



    public function uploadVideo(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:mp4,avi,wmv|max:10240', // Validação do tipo e tamanho do arquivo
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Faça o que for necessário com o arquivo, como salvar em um diretório
            $path = $file->store('videos');

            // Retorne uma resposta ou execute qualquer outra lógica necessária
            return response()->json(['success' => true, 'path' => $path]);
        }

        return response()->json(['success' => false, 'message' => 'Nenhum arquivo encontrado.']);
    }
}
