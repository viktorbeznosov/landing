<?php

namespace App\Http\Controllers;

use App\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeopleAddController extends Controller
{
    public function execute(Request $request){
        if($request->isMethod('post')){
            $input = $request->except('_token');
            $messages = array(
                'required' => 'Поле :attribute обязательно к заполнению',
            );
            $validator = Validator::make($input, array(
                'name' => 'required|max:255',
                'position' => 'required',
                'text' => 'required'
            ),$messages);
            if ($validator->fails()){
                return  redirect()->route('peopleAdd')->withErrors($validator);
            }
            if($request->hasFile('image')){
                $file = $request->file('image');
                $input['image'] = 'assets/img/' . time() . '_' . $file->getClientOriginalName();
                $file->move(public_path() . '/assets/img', $input['image']);
            } else {
                $input['image'] = '';
            }
            $people = new People();
            $people->fill($input);

            if($people->save()){
                return redirect()->route('people')->with('status','Запись создана');
            }
        }

        if(view()->exists('admin.peoples_add')){
            $data = array(
                'title' => 'Добавление нового члена'
            );
            return view('admin.peoples_add', $data);
        }
        abort(404);
    }
}
