<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function verifyUsers(Request $request){
        try{
            if($request->login == "login"){
                $email = $request->email;
                $password = $request->password;
                $rows = DB::table('users')
                    ->where('email', $email)
                    ->get()->count();
                if ($rows > 0) {
                    $rows = DB::table('users')
                        ->where('email', $email)
                        ->first();
                    if (Hash::check($password, $rows->password)) {
                        $role = $rows->role;
                        Session::put('user_info', $rows);
                        Cookie::queue('user_id', $rows->id, time()+31556926 ,'/');
                        Cookie::queue('role', $rows->role, time()+31556926 ,'/');
                        Cookie::queue('user_name', $rows->name, time()+31556926 ,'/');

                        if($role == 1){
                            Cookie::queue('admin', $rows->id, time()+31556926 ,'/');
                            return redirect()->to('/m_acc');
                        }
                        else{
                            return redirect()->to('login');
                        }
                    }
                    else{
                        return back()->with('errorMessage', 'Incorrect Password!!');
                    }
                } else {
                    return back()->with('errorMessage', 'User Not Exits!!');
                }
            }
            else{
                return back()->with('errorMessage', 'Please Fill Up The Form');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function logout(){
        Cookie::queue(Cookie::forget('user','/'));
        Cookie::queue(Cookie::forget('role','/'));
        Cookie::queue(Cookie::forget('user_name','/'));
        session()->forget('user_info');
        session()->flush();
        return redirect()->to('/');
    }
    public function project_name(){
        try{
            $row = DB::table('project_name')
                ->select('*','project_name.name as p_name','project_name.id as p_id')
                ->join('company_name','company_name.id','=','project_name.company_id')
                ->orderBy('project_name.id','desc')
                ->paginate(50);
            return view('admin.projectName', ['names' => $row]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function insertProjectName(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('project_name')
                        ->where('id', $request->id)
                        ->update([
                            'company_id' => $request->company,
                            'name' => $request->name,
                        ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data updated successfully');
                    } else {
                        return back()->with('errorMessage', 'Please try again.');
                    }
                }
                else {
                    $rows = DB::table('project_name')
                        ->select('id')
                        ->where([
                            ['company_id', '=', $request->company],
                            ['name', '=', $request->name],
                        ])
                        ->distinct()->get()->count();
                    if ($rows > 0) {
                        return back()->with('errorMessage', ' Data already exits.');
                    } else {
                        $result = DB::table('project_name')->insert([
                            'company_id' => $request->company,
                            'name' => $request->name,
                        ]);
                        if ($result) {
                            return back()->with('successMessage', 'Data inserted successfully.');
                        } else {
                            return back()->with('errorMessage', 'Please try again.');
                        }
                    }
                }
            }
            else{
                return back()->with('errorMessage', 'Please Fill Up The Form');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function getProjectNameById(Request $request){
        try{
            $rows = DB::table('project_name')
                ->where('id', $request->id)
                ->first();;
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function deleteProjectName(Request $request){
        try{
            if($request->id) {
                $result =DB::table('project_name')
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
    public function m_acc(){
        try{
            $row = DB::table('m_acc')
                ->select('*','company_name.name as c_name','project_name.name as p_name','m_acc.id as m_id')
                ->join('company_name','company_name.id','=','m_acc.company')
                ->join('project_name','project_name.id','=','m_acc.project')
                ->orderBy('m_acc.date','desc')
                ->paginate(50);
            return view('admin.m_acc', ['accountings' => $row]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function getAllCompany(){
        try{
            $rows = DB::table('company_name')->get();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function getAllProject(Request $request){
        try{
            $rows = DB::table('project_name')->where('company_id',$request->id)->get();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function insertM_acc(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('m_acc')
                        ->where('id', $request->id)
                        ->update([
                            'company' => $request->company,
                            'project' => $request->project,
                            'type' => $request->type,
                            'purpose' => $request->purpose,
                            'reference' => $request->reference,
                            'amount' => $request->amount,
                            'date' => $request->date,
                            'person' => $request->person,
                        ]);
                    if ($result) {
                        return back()->with('successMessage', 'সফল্ভাবে সম্পন্ন্য হয়েছে।');
                    } else {
                        return back()->with('errorMessage', 'আবার চেষ্টা করুন।');
                    }
                }
                else {
                    $rows = DB::table('m_acc')
                        ->select('id')
                        ->where([
                            ['company', '=', $request->company],
                            ['project', '=', $request->project],
                            ['type', '=', $request->type],
                            ['purpose', '=', $request->purpose],
                            ['amount', '=', $request->amount],
                            ['date', '=', $request->date],
                            ['person', '=', $request->person],
                        ])
                        ->distinct()->get()->count();
                    if ($rows > 0) {
                        return back()->with('errorMessage', ' নতুন ডাটা দিন');
                    } else {
                        $result = DB::table('m_acc')->insert([
                            'company' => $request->company,
                            'project' => $request->project,
                            'type' => $request->type,
                            'purpose' => $request->purpose,
                            'reference' => $request->reference,
                            'amount' => $request->amount,
                            'date' => $request->date,
                            'person' => $request->person,
                        ]);
                        if ($result) {
                            return back()->with('successMessage', 'সফল্ভাবে সম্পন্ন্য হয়েছে।');
                        } else {
                            return back()->with('errorMessage', 'আবার চেষ্টা করুন।');
                        }
                    }
                }
            }
            else{
                return back()->with('errorMessage', 'ফর্ম পুরন করুন।');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function getM_accReportByDate (Request $request){
        $row = DB::table('m_acc')
            ->select('*','company_name.name as c_name','project_name.name as p_name','m_acc.id as m_id')
            ->join('company_name','company_name.id','=','m_acc.company')
            ->join('project_name','project_name.id','=','m_acc.project')
            ->where('company',$request->company)
            ->where('project',$request->project)
            ->whereBetween('date',array($request->from_date,$request->to_date))
            ->orderBy('date', 'Desc')->paginate(50);
        return view('admin.m_acc', ['accountings' => $row,'from_date'=>$request->from_date,'to_date'=>$request->to_date]);
    }
    public function getM_accListById(Request $request){
        try{
            $rows = DB::table('m_acc')
                ->where('id', $request->id)
                ->first();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
}
