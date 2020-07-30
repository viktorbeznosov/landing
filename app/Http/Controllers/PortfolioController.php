<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use App\Portfolio;

class PortfolioController extends Controller
{
    public function execute(){
        if(view()->exists('admin.portfolios')){
            $portfolios = Portfolio::all();
            $data = array(
                'title' => 'Портфолио',
                'portfolios' => $portfolios
            );
            return view('admin.portfolios', $data);
        }
        abort(404);
    }
}
