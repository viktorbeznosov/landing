<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceAddController extends Controller
{
    public function execute(Request $request){
        if($request->isMethod('post')){
            $input = $request->except('_token');
            $messages = array(
                'required' => 'Поле :attribute обязательно к заполнению',
            );
            $validator = Validator::make($input, array(
                'name' => 'required|max:255',
                'text' => 'required',
            ),$messages);

            if ($validator->fails()){
                return  redirect()->route('servicesAdd')->withErrors($validator);
            }

            $service = new Service();
            $service->fill($input);
            if($service->save()){
                return redirect()->route('service')->with('status','Сервис сохранен');
            }
        }

        if(view()->exists('admin.service_add')){
            $data = array(
                'title' => 'Добавление сервиса'
            );
            return view('admin.service_add', $data);
        }

        abort(404);
    }
}
