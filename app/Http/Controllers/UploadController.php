<?php

namespace App\Http\Controllers;

use App\Models\Item; // Certifique-se de importar o modelo Item, se necessário
use Illuminate\Http\Request;
use Livewire\WithFileUploads;

class UploadController extends Controller
{
    use WithFileUploads;

    public function crop(Request $request)
    {
        $path = 'app/livewire-tmp';
        $file = $request->file('uploadfile');
        $new_image_name = 'UIMG' . date('YmdHis') . uniqid('', true) . '.jpg';
        $upload = $file->move(storage_path($path), $new_image_name);

        if ($upload) {
            return response()->json([
                'status' => 1,
                'msg' => $new_image_name,
                'name' => $new_image_name,
            ]);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong, try again later']);
        }
    }

    public function uploading(Request $request)
    {
        $path = 'app/public/editor_laraberge';
        $file = $request->file('ficheiro');
        $new_image_name = 'editor' . date('YmdHis') . uniqid('', true) . '.jpg';
        $upload = $file->move(storage_path($path), $new_image_name);

        return response()->json(['msg' => url('/') . "/storage/editor_laraberge/" . $new_image_name, 'file' => $file, 'request' => $request]);
    }

    public function uploadingCropped(Request $request)
    {
        $path = 'app/public/editor_laraberge';
        $file = $request->file('croppedImage');
        $new_image_name = 'editor' . date('YmdHis') . uniqid('', true) . '.jpg';
        $upload = $file->move(storage_path($path), $new_image_name);

        return response()->json(['msg' => url('/') . "/storage/editor_laraberge/" . $new_image_name, 'file' => $file, 'request' => $request, 'filename' => $new_image_name]);
    }


}
