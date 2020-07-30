<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Portfolio;

class PortfolioAddController extends Controller
{
    public function execute(Request $request){
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
                return  redirect()->route('portfolioAdd')->withErrors($validator);
            }

            $portfolio = new Portfolio();
            if($request->hasFile('image')){
                $file = $request->file('image');
                $input['image'] = 'assets/img/' . time() . '_' . $file->getClientOriginalName();
                $file->move(public_path() . '/assets/img', $input['image']);
            } else {
                $input['image'] = '';
            }
            $portfolio->fill($input);

            if($portfolio->save()){
                return redirect()->route('portfolio')->with('status','Портфолио создано');
            }
        }

        if (view()->exists('admin.portfolio_add')){

            $data = array(
                'title' => 'Добавление портфолио'
            );
            return view('admin.portfolio_add', $data);

        }

        abort(404);
    }
}
