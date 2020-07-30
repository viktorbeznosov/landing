<?php

namespace App\Http\Controllers;

use App\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeopleEditController extends Controller
{
    public function execute(Request $request, People $people){
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
                return  redirect()->route('peopleEdit', $people->id)->withErrors($validator);
            }
            if($request->hasFile('image')){
                $file = $request->file('image');
                $input['image'] = 'assets/img/' . time() . '_' . $file->getClientOriginalName();
                $file->move(public_path() . '/assets/img', $input['image']);
                if (file_exists(public_path($input['old_image'])) && $input['old_image'] != ''){
                    unlink(public_path($input['old_image']));
                }
            } else {
                $input['image'] = $input['old_image'];
            }
            $people->fill($input);

            if($people->save()){
                return redirect()->route('peopleEdit', $people->id)->with('status','Запись сохранена');
            }
        }

        if($request->isMethod('delete')){
            if (file_exists(public_path($people->image)) && $people->image != ''){
                unlink(public_path($people->image));
            }
            $people->delete();
            return redirect()->route('people')->with('status','Запись удалена');
        }

        if(view()->exists('admin.peoples_edit')){
            $data = array(
                'title' => 'Редактирвание члена команды',
                'people' => $people
            );
            return view('admin.peoples_edit', $data);
        }
        abort(404);
    }
}
