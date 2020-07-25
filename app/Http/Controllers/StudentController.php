<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Mail\Email;
use Mail;
use Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students=User::where('role','student')->orderBy('id','desc')->get();
        return view('tutor.studentlist',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tutor.studentadd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
         'name'=>'required|string',
         'email'=>'required|email|unique:users',
         'mobile'=>'required|numeric|unique:users',
         'class'=>'required',
        ]);
         $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890!$%^&!$%^&');
          $password = substr($random, 0, 8);
          $password_enc = bcrypt($password);
         $form_data=array(
            'fname' =>$request->name,
            'email' =>$request->email,
            'mobile' =>$request->mobile,
            'class' =>$request->classname,  
            'address' =>$request->classname,  
            'city' =>$request->classname,  
            'pincode' =>$request->classname,  
            'status' =>$request->status,
            'password' =>$password_enc,         
            'role' =>'student',
         );
        User::create($form_data);
        
        $tutor_mailId = $request->email;
            $data = array(
                'parameter'=>'student_register',
                'student_name'=>$request->name,
                'student_email' => $request->email,
                'student_mobile' => $request->mobile,
                'student_password' => $password,
                );
        Mail::to($student_mailId)->send(new Email($data));
        Session::flash('message', 'New Student Added Successfully.');
        return redirect()->route('student_list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
