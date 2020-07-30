<?php

namespace App\Http\Controllers;

use App\Portfolio;
use Illuminate\Http\Request;
use App\Service;

class ServiceController extends Controller
{
    public function execute(){
        if(view()->exists('admin.services')){
            $services = Service::all();
            $data = array(
                'title' => 'Сервисы',
                'services' => $services
            );
            return view('admin.services', $data);
        }
        abort(404);
    }
}
