<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function imageUpload($image, $folder = 'candidates', $file_url = null)
    {
        if($file_url !== null){
            $file = 'storage/'.$file_url;
            if (File::exists(public_path($file))) {
                File::delete($file);
            }
        }
//        dd('controller', $file);
        $destinationPath = 'storage/uploads/'.$folder;
        $file = 'election'.date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $file);

        $filename = 'uploads/'.$folder.'/'.$file;
        return $filename;
    }
}
