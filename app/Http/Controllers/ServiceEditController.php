<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;

class ServiceEditController extends Controller
{
    public function execute(Request $request, Service $service){
        if($request->isMethod('post')){
            $input = $request->except('_token');
            $service->fill($input);
            $service->save();
            return redirect()->route('servicesEdit', $service->id)->with('status','Сервис сохранен');
        }

        if($request->isMethod('delete')){
            $service->delete();
            return redirect()->route('service')->with('status','Сервис удален');
        }

        if(view()->exists('admin.service_edit')){
            $data = array(
                'title' => 'Редактирование сервиса',
                'service' => $service
            );
            return view('admin.service_edit', $data);
        }

        abort(404);
    }
}
