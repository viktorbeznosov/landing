<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\People;
use App\Portfolio;
use App\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{

    public function execute(Request $request){

        if($request->isMethod('post')){
            $messages = array(
                'required' => 'Поле :attribute обязательно к заполнению',
                'email' => 'Поле :attribute должно соответствовать email'
            );

            $this->validate($request, array(
                'name' => 'required|max:250',
                'email' => 'required|email',
                'text' => 'required'
            ), $messages);
            $data = $request->all();


            $result = Mail::send('site.email', array(
                'data' => $data
            ), function ($message) use ($data){
                $mail_admin = env('MAIL_ADMIN');
                $message->from(env('MAIL_USERNAME', $data['name']));
                $message->to($mail_admin)->subject('Question');
                $message->subject('Тестируем email на Laravel');
            });

            if (Mail::failures()) {
                return redirect()->back()->with('status', 'Email not send');
            } else {
                return redirect()->route('home')->with('status', 'Email is sent');
            }

        }

        $pages = Page::all();
        $portfolios = Portfolio::get(array('name','filter','image'));
        $services = Service::where('id','<',20)->get();
        $peoples = People::take(30)->get();

        $menu = array();
        foreach ($pages as $page){
            $class = ($page->alias == 'hero_section') ? 'active' : '';
            $item = array(
                'title' => $page->name,
                'alias' => $page->alias,
                'class' => $class
            );
            $menu[] = $item;
        }
        $menu = array_merge($menu,array(
          array(
              'title' => 'Services',
              'alias' => 'service',
              'class' => ''
          ),
           array(
               'title' => 'Portfolio',
               'alias' => 'Portfolio',
               'class' => ''
           ),
           array(
               'title' => 'Team',
               'alias' => 'team',
               'class' => ''
           ),
           array(
               'title' => 'Contact',
               'alias' => 'contact',
               'class' => ''
           )
       ));

        $tags = DB::table('portfolios')->distinct()->select('filter')->get();

        $data = array(
            'menu' => $menu,
            'pages' => $pages,
            'portfolios' => $portfolios,
            'services' => $services,
            'peoples' => $peoples,
            'tags' => $tags
        );

        return view('site.index', $data);
    }

}
