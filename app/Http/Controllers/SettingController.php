<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;

class SettingController extends Controller
{
    public function company_info(){
        try{
            $rows = DB::table('company_info')->get();
            return view('admin.index', ['infos' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function insertCompanyInfo (Request $request){
        try{
            if($request) {
                if ($request->id) {
                    $photo='';
                    if ($request->hasFile('logo')) {
                        $targetFolder = 'public/images/';
                        $file = $request->file('logo');
                        $pname = time() . '.' . $file->getClientOriginalName();
                        $image['filePath'] = $pname;
                        $file->move($targetFolder, $pname);
                        $photo = $targetFolder . $pname;
                    }
                    $result =DB::table('company_info')
                        ->where('id', $request->id)
                        ->update([
                            'name' => $request->name,
                            'phone' => $request->phone,
                            'address' => $request->address,
                            'email' => $request->email,
                            'hours' => $request->working,
                            'choose' => $request->choose,
                            'about' => $request->about,
                            'photo' => $photo,
                        ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data Update Successfully Done.');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
                else{
                    $rows = DB::table('company_info')->select('name')->where([
                        ['name', '=', $request->name]
                    ])->get()->count();
                    if ($rows > 0) {
                        return back()->with('errorMessage', 'Data Already Exits.');
                    } else {
                        $photo='';
                        if ($request->hasFile('logo')) {
                            $targetFolder = 'public/images/';
                            $file = $request->file('logo');
                            $pname = time() . '.' . $file->getClientOriginalName();
                            $image['filePath'] = $pname;
                            $file->move($targetFolder, $pname);
                            $photo = $targetFolder . $pname;
                        }
                        $result = DB::table('company_info')->insert([
                            'name' => $request->name,
                            'phone' => $request->phone,
                            'address' => $request->address,
                            'email' => $request->email,
                            'hours' => $request->working,
                            'choose' => $request->choose,
                            'about' => $request->about,
                            'photo' => $photo,
                        ]);
                        if ($result) {
                        return back()->with('successMessage', 'Data Insert Successfully Done.');
                    } else {
                            return back()->with('errorMessage', 'Please Try Again.');
                        }
                    }
                }
            }
            else{
                return back()->with('errorMessage', 'Please Fill Up The Form.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function getCompanyInfoById(Request $request){
        try{
            $rows = DB::table('company_info')
                ->where('id', $request->id)
                ->first();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function mainSlide(){
        try{
            $rows = DB::table('slide')->orderBy('id','desc')->paginate(20);
            return view('admin.mainSlide', ['slides' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function insertMainSlide (Request $request){
        try{
            if($request) {
                if ($request->id) {
                    if($request->hasFile('slide')) {
                        $image       = $request->file('slide');
                        $filename    = time() . '.' .$image->getClientOriginalName();
                        $image_resize = Image::make($image->getRealPath());
                        $image_resize->text('?? '.Date('Y').' Sobuj Bari - All Rights Reserved', 150, 400, function($font) {
                            $font->size(35);
                            $font->color('#FF0000');
                            $font->align('center');
                            $font->valign('center');
                            $font->angle(120);
                        });
                        $image_resize->insert(public_path('logo.jpg'), 'middle', 10, 10);
                        $image_resize->save(public_path('images/' .$filename));
                    }
                    $result =DB::table('slide')
                        ->where('id', $request->id)
                        ->update([
                            'slide' => $filename,
                        ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data Update Successfully Done.');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
                else{
                    if($request->hasFile('slide')) {
                        $image       = $request->file('slide');
                        $filename    = time() . '.' .$image->getClientOriginalName();
                        $image_resize = Image::make($image->getRealPath());
                        $image_resize->text('?? '.Date('Y').' Sobuj Bari - All Rights Reserved', 150, 400, function($font) {
                            $font->size(35);
                            $font->color('#FF0000');
                            $font->align('center');
                            $font->valign('center');
                            $font->angle(120);
                        });
                        $image_resize->insert(public_path('logo.jpg'), 'middle', 10, 10);
                        $image_resize->save(public_path('images/' .$filename));
                    }
                    $result = DB::table('slide')->insert([
                        'slide' => $filename,
                    ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data Insert Successfully Done.');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
            }
            else{
                return back()->with('errorMessage', 'Please Fill Up The Form.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function getMainSlideById(Request $request){
        try{
            $rows = DB::table('slide')
                ->where('id', $request->id)
                ->first();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function deleteSlideList(Request $request){
        try{

            if($request->id) {
                $result =DB::table('slide')
                    ->where('id', $request->id)
                    ->delete();
                if ($result) {
                    return back()->with('successMessage', 'Data Delete Successfully.');
                } else {
                    return back()->with('errorMessage', 'Please Try Again.');
                }
            }
            else{
                return back()->with('errorMessage', 'Please Try Again.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function servicesAdmin(){
        try{
            $rows = DB::table('services')->orderBy('id','desc')->get();
            return view('admin.servicesAdmin', ['services' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function insertServices (Request $request){
        try{
            if($request) {
                if ($request->id) {
                    if($request->hasFile('image')) {
                        $image       = $request->file('image');
                        $filename    = time() . '.' .$image->getClientOriginalName();
                        $image_resize = Image::make($image->getRealPath());
                        $image_resize->resize(370, 240);
                        $image_resize->save(public_path('images/' .$filename));
                    }
                    $result =DB::table('services')
                        ->where('id', $request->id)
                        ->update([
                            'title' => $request->title,
                            'description' => $request->description,
                            'image' => $filename,
                        ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data Update Successfully Done.');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
                else{
                    if($request->hasFile('image')) {
                        $image       = $request->file('image');
                        $filename    = time() . '.' .$image->getClientOriginalName();
                        $image_resize = Image::make($image->getRealPath());
                        $image_resize->resize(370, 240);
                        $image_resize->save(public_path('images/' .$filename));
                    }
                    $result = DB::table('services')->insert([
                        'title' => $request->title,
                        'description' => $request->description,
                        'image' => $filename,
                    ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data Insert Successfully Done.');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
            }
            else{
                return back()->with('errorMessage', 'Please Fill Up The Form.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function getServicesById(Request $request){
        try{
            $rows = DB::table('services')
                ->where('id', $request->id)
                ->first();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function deleteServiceList(Request $request){
        try{

            if($request->id) {
                $result =DB::table('services')
                    ->where('id', $request->id)
                    ->delete();
                if ($result) {
                    return back()->with('successMessage', 'Data Delete Successfully.');
                } else {
                    return back()->with('errorMessage', 'Please Try Again.');
                }
            }
            else{
                return back()->with('errorMessage', 'Please Try Again.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function projects(){
        try{
            $rows = DB::table('projects')->orderBy('id','desc')->paginate(20);
            return view('admin.projects', ['projects' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function insertProjects (Request $request){
        try{

            if($request) {
                if ($request->id) {
                    $row =DB::table('projects')
                        ->where('id', $request->id)
                        ->first();
                    if($request->hasFile('image')) {
                        $image       = $request->file('image');
                        $filenameImage    = 'cover'.time() . '.' .$image->getClientOriginalName();
                        $image_resize = Image::make($image->getRealPath());
                        $image_resize->resize(370, 270);
                        $image_resize->save(public_path('images/' .$filenameImage));
                    }
                    else{
                        $filenameImage =  $row->cover_phote;
                    }
                    $slider_photo = '';
                    $i =0;
                    if ($request->hasFile('slider')) {
                        $files = $request->file('slider');
                        foreach ($files as $file) {
                            $targetFolder = 'public/images/';
                            $pname = $i.time() . '.' . $file->getClientOriginalName();
                            $image_resize = Image::make($file->getRealPath());
                            $image_resize->resize(370, 200);
                            $image_resize->save(public_path('images/' .$pname));
                            $slider_photo .=  $pname.',';
                            $i++;
                        }
                    }
                    $slider_photo .= json_decode($row->slider_photo);
                    $result =DB::table('projects')
                        ->where('id', $request->id)
                        ->update([
                            'type' => $request->type,
                            'name' => $request->name,
                            'info' => $request->info,
                            'description' => $request->description,
                            'cover_phote' => $filenameImage,
                            'slider_photo' => json_encode($slider_photo),
                        ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data Update Successfully Done.');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
                else{
                    if($request->hasFile('image')) {
                        $image       = $request->file('image');
                        $filenameImage    = time() . '.' .$image->getClientOriginalName();
                        $image_resize = Image::make($image->getRealPath());
                        $image_resize->resize(370, 270);
                        $image_resize->save(public_path('images/' .$filenameImage));
                    }
                    $slider_photo = '';
                    $i =0;
                    if ($request->hasFile('slider')) {
                        $files = $request->file('slider');
                        foreach ($files as $file) {
                            $targetFolder = 'public/images/';
                            $pname = $i.time() . '.' . $file->getClientOriginalName();
                            $image_resize = Image::make($file->getRealPath());
                            $image_resize->resize(370, 200);
                            $image_resize->save(public_path('images/' .$pname));
                            $slider_photo .=  $pname.',';
                            $i++;
                        }
                    }
                    $result = DB::table('projects')->insert([
                        'type' => $request->type,
                        'name' => $request->name,
                        'info' => $request->info,
                        'description' => $request->description,
                        'cover_phote' => $filenameImage,
                        'slider_photo' => json_encode($slider_photo),
                    ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data Insert Successfully Done.');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
            }
            else{
                return back()->with('errorMessage', 'Please Fill Up The Form.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function getProjectById(Request $request){
        try{
            $rows = DB::table('projects')
                ->where('id', $request->id)
                ->first();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }

    public function deleteProjectList(Request $request){
        try{

            if($request->id) {
                $result =DB::table('projects')
                    ->where('id', $request->id)
                    ->delete();
                if ($result) {
                    return back()->with('successMessage', 'Data Delete Successfully.');
                } else {
                    return back()->with('errorMessage', 'Please Try Again.');
                }
            }
            else{
                return back()->with('errorMessage', 'Please Try Again.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function clients(){
        try{
            $rows = DB::table('clients')->paginate(50);
            return view('admin.clients', ['clients' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function insertClients (Request $request){
        try{
            if($request) {
                if ($request->id) {
                    if($request->hasFile('photo')) {
                        $image       = $request->file('photo');
                        $filenameImage    = time() . '.' .$image->getClientOriginalName();
                        $image_resize = Image::make($image->getRealPath());
                        $image_resize->resize(370, 270);
                        $image_resize->save(public_path('images/' .$filenameImage));
                    }
                    $result =DB::table('clients')
                        ->where('id', $request->id)
                        ->update([
                            'name' => $request->name,
                            'photo' => $filenameImage,
                        ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data Update Successfully Done.');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
                else{
                    if($request->hasFile('photo')) {
                        $image       = $request->file('photo');
                        $filenameImage    = time() . '.' .$image->getClientOriginalName();
                        $image_resize = Image::make($image->getRealPath());
                        $image_resize->resize(370, 270);
                        $image_resize->save(public_path('images/' .$filenameImage));
                    }
                    $result = DB::table('clients')->insert([
                        'name' => $request->name,
                        'photo' => $filenameImage,
                    ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data Insert Successfully Done.');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
            }
            else{
                return back()->with('errorMessage', 'Please Fill Up The Form.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }

    }

    public function getClientsById(Request $request){
        try{
            $rows = DB::table('clients')
                ->where('id', $request->id)
                ->first();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function deleteClientList(Request $request){
        try{

            if($request->id) {
                $result =DB::table('clients')
                    ->where('id', $request->id)
                    ->delete();
                if ($result) {
                    return back()->with('successMessage', 'Data Delete Successfully.');
                } else {
                    return back()->with('errorMessage', 'Please Try Again.');
                }
            }
            else{
                return back()->with('errorMessage', 'Please Try Again.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function users(){
        try{
            $rows = DB::table('users')->paginate(50);
            return view('admin.users', ['users' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function insertUsers (Request $request){
        try{
            if($request) {
                if ($request->id) {
                    $filenameImage = '';
                    if($request->hasFile('photo')) {
                        $image       = $request->file('photo');
                        $filenameImage    = time() . '.' .$image->getClientOriginalName();
                        $image_resize = Image::make($image->getRealPath());
                        $image_resize->resize(370, 270);
                        $image_resize->save(public_path('images/' .$filenameImage));
                    }
                    $result =DB::table('users')
                        ->where('id', $request->id)
                        ->update([
                            'name' => $request->name,
                            'phone' => $request->phone,
                            'email' => $request->email,
                            'password' => Hash::make($request->password),
                            'photo' => $filenameImage,
                            'role' => 1,
                        ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data Update Successfully Done.');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
                else{
                    $filenameImage = '';
                    if($request->hasFile('photo')) {
                        $image       = $request->file('photo');
                        $filenameImage    = time() . '.' .$image->getClientOriginalName();
                        $image_resize = Image::make($image->getRealPath());
                        $image_resize->resize(370, 270);
                        $image_resize->save(public_path('images/' .$filenameImage));
                    }
                    $result = DB::table('users')->insert([
                        'name' => $request->name,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'password' => $password = Hash::make($request->password),
                        'photo' => $filenameImage,
                        'role' => 1,
                    ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data Insert Successfully Done.');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
            }
            else{
                return back()->with('errorMessage', 'Please Fill Up The Form.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }

    }
    public function getUsersById(Request $request){
        try{
            $rows = DB::table('users')
                ->where('id', $request->id)
                ->first();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function deleteUserList(Request $request){
        try{

            if($request->id) {
                $result =DB::table('users')
                    ->where('id', $request->id)
                    ->delete();
                if ($result) {
                    return back()->with('successMessage', 'Data Delete Successfully.');
                } else {
                    return back()->with('errorMessage', 'Please Try Again.');
                }
            }
            else{
                return back()->with('errorMessage', 'Please Try Again.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function receivedEmail(){
        try{
            $rows = DB::table('received_email')->orderBy('id','desc')->paginate(50);
            return view('admin.receivedEmail', ['emails' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
}
