<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadFilesController extends Controller
{
    public function index(){
        $data = array(
            'title' => 'Загрузка файлов'
        );
        return view('admin.upload_files', $data);
    }

    public function upload(){
        if (isset($_FILES) && $_FILES['files']['error'][0] == 0){

            print_r(json_encode(array(
                'msg' => 'Its Ok',
                'files' => array('uploaded_file')
            ),JSON_UNESCAPED_UNICODE));


            $file_name = $_FILES['files']['name'][0];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/public/assets/img/' . $file_name;
            $tmp_file_name = $_FILES['files']['tmp_name'][0];

//            if(move_uploaded_file($tmp_file_name, $to)){
//
//            }
        }
    }
}
