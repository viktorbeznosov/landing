<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Response;

class PageController extends Controller
{

    public function execute($alias = false){
        if(!$alias){
            abort(404);
        }

        if(view()->exists('site.page')){
            $page = Page::where('alias', strip_tags($alias))->first();
            $data = array(
                'title' => $page->name,
                'page' => $page
            );

            return view('site.page', $data);
        }
    }

}
