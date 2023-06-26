<?php

namespace App\Models\Traits;

//use App\Models\JustificacaoFaltas\Anexo;
use Illuminate\Http\Request;

trait UploadImagen
{
    /**
     * @param Request $request
     * @return bool
     */
    public function dropzoneStore(Request $request): string
    {
        $image = $request->file('file');
        //  dump($request);
        try {


            $imageName = $image->getClientOriginalName();

            $justificacaoId = session("justify")['id'];
            $userName = session("justify")['pessoaNome'];

            $date = strval($justificacaoId);
            $image->move(public_path("storage/documento/" . $userName . "/" . $date . "/"), $imageName);

            $imageUpload = new Anexo();
            $imageUpload->filename = $imageName;
            $imageUpload->justificacaofalta_id = $justificacaoId;
            $imageUpload->tituloAnexo = "Comprovativos da justificação da falta";
            $imageUpload->anexo = "storage/documento/" . $userName . "/" . $date . "/" . $imageName;
            $imageUpload->save();


        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'filename' => "não foi possivel inserir o ficherio"
            ]);
        }

        return response()->json([
            'status' => 1,
            'filename' => $request
        ]);
    }

}
