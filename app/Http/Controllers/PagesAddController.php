<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Page;

class PagesAddController extends Controller
{
    public function execute(Request $request){
        if ($request->isMethod("post")){
            $input = $request->except('_token');

            $messages = array(
                'required' => 'Поле :attribute обязательно к заполнению',
                'unique' => 'Поле :attribute должно быть уникальным'
            );
            $validator = Validator::make($input, array(
                'name' => 'required|max:255',
                'alias' => 'required|unique:pages',
                'text' => 'required',
            ),$messages);
            if($validator->fails()){
                return redirect()->route('pagesAdd')->withErrors($validator)->withInput();
            }

            if($request->hasFile('image')){
                $file = $request->file('image');
                $input['image'] = 'assets/img/' . time() . '_' . $file->getClientOriginalName();
                $file->move(public_path() . '/assets/img', $input['image']);
            }

            $page = new Page();
            $page->fill($input);
            if ($page->save()){
                return redirect('admin')->with('status','Страница добавлена');
            }

        }

        if(view()->exists('admin.pages_add')){
            $data = array(
                'title' => 'Новая стрнаница',

            );
            return view('admin.pages_add', $data);
        }
        abort(404);
    }
}
