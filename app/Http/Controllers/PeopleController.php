<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use App\People;

class PeopleController extends Controller
{
    public function execute(){
        if(view()->exists('admin.peoples')){
            $peoples = People::all();
            $data = array(
                'title' => 'Команда',
                'peoples' => $peoples
            );
            return view('admin.peoples', $data);
        }
        abort(404);
    }
}
