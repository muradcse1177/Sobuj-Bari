<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class WebsiteController extends Controller
{
    public function index(){
        try{
            $info= DB::table('company_info')->first();
            $slides = DB::table('slide')->orderBy('id','desc')->get();
            $services = DB::table('services')->get();
            $type = DB::table('projects')->select('type')->groupBy('type')->get();
            $projects = DB::table('projects')->orderBy('id','desc')->take(20)->get();
            $clients = DB::table('clients')->orderBy('id','desc')->take(20)->get();
            return view('website.index',
                ['slides' => $slides, 'infos' => $info,'services' => $services,'projects' => $projects,'clients' => $clients,'types' => $type]
            );
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function about(){
        try{
            $info= DB::table('company_info')->first();
            $slides = DB::table('slide')->orderBy('id','desc')->get();
            $services = DB::table('services')->get();

            return view('website.about',
                ['slides' => $slides, 'infos' => $info,'services' => $services]
            );
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function projectDetails(Request $request){
        try{
            $rows= DB::table('projects')->where('id',$request->id)->first();
            $projects = DB::table('projects')->paginate(20);
            $slides = DB::table('slide')->orderBy('id','desc')->get();
            $slider = explode(",",json_decode($rows->slider_photo));
            array_pop($slider);
            return view('website.projectDetails',
                ['projects' => $rows,'sliders' => $slider,'ap' =>$projects,'slides' =>$slides]
            );
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function allProjects(Request $request){
        try{
            $slides = DB::table('slide')->orderBy('id','desc')->get();
            $type = DB::table('projects')->select('type')->groupBy('type')->get();
            $projects = DB::table('projects')->orderBy('id','desc')->paginate(36);
            return view('website.allProjects',
                ['slides' => $slides,'projects' => $projects,'types' => $type ]
            );
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function contact(Request $request){
        try{
            $slides = DB::table('slide')->orderBy('id','desc')->get();
            return view('website.contact',
                ['slides' => $slides]
            );
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function allServices(Request $request){
        try{
            $slides = DB::table('slide')->orderBy('id','desc')->get();
            $services = DB::table('services')->get();

            return view('website.allServices',
                ['slides' => $slides, 'services' => $services]
            );
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function service(Request $request){
        try{
            $slides = DB::table('slide')->orderBy('id','desc')->get();
            $services = DB::table('services')->get();
            $service = DB::table('services')->where('id',$request->cat)->first();

            return view('website.service',
                ['slides' => $slides, 'service' => $service, 'services' => $services]
            );
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function client(Request $request){
        try{
            $slides = DB::table('slide')->orderBy('id','desc')->get();
            $clients = DB::table('clients')->orderBy('id','desc')->paginate(60);

            return view('website.clients',
                ['slides' => $slides, 'clients' => $clients]
            );
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function sendMail(Request $request){
        try{

            $result = DB::table('received_email')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'msg' => $request->message,
            ]);
            if ($result) {
                return back()->with('successMessage', 'Mail Sent Successfully Done.');
            } else {
                return back()->with('errorMessage', 'Please Try Again.');
            }

        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
}
