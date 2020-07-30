<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;
use Illuminate\Support\Facades\Validator;

class PortfolioEditController extends Controller
{
    public function execute(Request $request, Portfolio $portfolio){

        if ($request->isMethod("post")){
            $input = $request->except('_token');
            $messages = array(
                'required' => 'Поле :attribute обязательно к заполнению',
            );
            $validator = Validator::make($input, array(
                'name' => 'required|max:255',
                'filter' => 'required',
            ),$messages);
            if ($validator->fails()){
                return  redirect()->route('portfolioEdit', $portfolio->id)->withErrors($validator);
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

            $portfolio->fill($input);

            if($portfolio->save()){
                return redirect()->route('portfolioEdit', $portfolio->id)->with('status','Запись сохранена');
            }

        }

        if($request->isMethod("delete")){
            if (file_exists(public_path($portfolio->image)) && $portfolio->image != ''){
                unlink(public_path($portfolio->image));
            }
            $portfolio->delete();
            return redirect()->route('portfolio')->with('status', 'Портфолио удалено');
        }

        if (view()->exists('admin.portfolio_edit')){
            $data = array(
                'title' => 'Портфолио',
                'portfolio' => $portfolio
            );

            return view('admin.portfolio_edit', $data);
        }

        abort(404);
    }
}
