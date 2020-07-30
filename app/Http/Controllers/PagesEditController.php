<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use Illuminate\Support\Facades\Validator;

class PagesEditController extends Controller
{
    public function execute(Page $page, Request $request){
        if($request->isMethod('post')){
            $input = $request->except('_token');
            $messages = array(
                'required' => 'Поле :attribute обязательно к заполнению',
                'unique' => 'Поле :attribute должно быть уникальным'
            );
            $validator = Validator::make($input, array(
                'name' => 'required|max:255',
                'alias' => 'required|unique:pages,alias,'.$input["id"].'|max:255',
                'text' => 'required'
            ),$messages);
            if ($validator->fails()){
                return  redirect()->route('pagesEdit', $input['id'])->withErrors($validator);
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
            $page->fill($input);
            if($page->save()){
                return redirect()->route('pagesEdit', $page->id)->with('status','Страница изменена');
            }
        }
        if ($request->isMethod('delete')){
            if (file_exists(public_path($page->image)) && $page->image != ''){
                unlink(public_path($page->image));
            }
            $page->delete();
            return redirect()->route('pages')->with('status','Страница удалена');
        }
        $old = $page->toArray();
        if(view()->exists('admin.pages_edit')){
            $data = array(
                'title' => 'Редактирование страницы '. $old['name'],
                'data' => $old
            );
            return view('admin.pages_edit', $data);
        }
    }
}
