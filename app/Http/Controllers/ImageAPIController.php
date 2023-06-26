<?php

namespace App\Http\Controllers;
use Session;
use App\Models\Parlamento\LinkFiles;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;




class ImageAPIController extends Controller
{
    use WithFileUploads;

    /*
     * @param \Illuminate\Http\Request $request
     */

/*A função "armazenamento de funções públicas" recebe uma solicitação HTTP ($request) contendo um arquivo chamado "upload". O objetivo da função é mover o arquivo para uma pasta específica no servidor, cujo caminho é definido como "public/storage/documento/editor/AAAA_MM_DD", onde "AAAA_MM_DD" é a data atual.
O nome original do arquivo é obtido através do método getClientOriginalName(), e o arquivo é movido para a pasta especificada utilizando o método move() da classe UploadedFile.
Depois que o arquivo é movido com sucesso, a função retorna uma resposta JSON contendo a URL do arquivo e o nome do arquivo original como contexto. Caso ocorra alguma exceção, a função retorna uma mensagem de erro.
Note que a função está escrita em PHP, e algumas das funções utilizadas (como "response()") dependem do framework Laravel.*/
    public function store(Request $request)
    {
        try {
            $file = $request->file('upload');

            $imageName = $file->getClientOriginalName();
            $file->move(public_path("storage/documento/editor/" . date('Y_m_d') . "/"), $imageName);
            $url = url('') . "/storage/documento/editor/" . date('Y_m_d') . "/" . $imageName;

            return response()->json([
                'url' => $url,
                'context' => $imageName,
            ]);
        } catch (\Exception $d) {
            return response()->json([
                'url' => "error"
            ]);
        }
    }


    /*
     * @param \Illuminate\Http\Request $request
     */
    public function zoneUpload(Request $request)
    {

        $file = $request->file('file');

        try {

            $dataInstance = Session::get("instanceData");
            $imageName = date('Ymd_His'). "_". $request->file('file')->getClientOriginalName();

            $file->move(public_path("storage/dropzone/image/" . date('Y_m_d') . "/"), $imageName);
            $url = url('') . "/storage/dropzone/image/" . date('Y_m_d') . "/" . $imageName;



            LinkFiles::create([
                'fileName'=> $imageName,
                'path' =>  $url,
                'dataObject'=> json_encode($dataInstance),
                'context'=>$dataInstance->context,
                'order'=>1992,
                'parentId'=>$dataInstance->id,
                'parentName'=>$dataInstance->title,
                'user_id'=> auth()->user()->id
            ]);



        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'filename' => "não foi possivel inserir o fichero"
            ]);
        }

        return response()->json([
            'status' => true,
            'filename' => $imageName
        ]);

    }


}
