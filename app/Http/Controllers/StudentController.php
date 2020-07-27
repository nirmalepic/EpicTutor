<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Student;
use App\Mail\Email;
use Mail;
use Auth;

class StudentController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tutor_id=auth()->user()->id;
         $student_data=User::with('studentData')->where('tutor_id',$tutor_id)->get();
        //dd($student_data);
        return view('tutor.studentlist',compact('student_data'));
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
         'classname'=>'required',
        ]);
         $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890!$%^&!$%^&');
          $password = substr($random, 0, 8);
          $password_enc = bcrypt($password);
         $tutor_id=auth()->user()->id;

         $form_data=array(
            'fname' =>$request->name,
            'tutor_id' =>$tutor_id,
            'class' =>$request->classname,
            'email' =>$request->email,
            'mobile' =>$request->mobile, 
            'status' =>$request->status,
            'password' =>$password_enc, 
            'dob' =>$request->dob,
            'role' =>'student',
            'location' =>$request->address,  
            'city' =>$request->city,  
            'pincode' =>$request->pincode,       
         );
       
       // Get Tutor data
        $tutor_data = User::where('id',$tutor_id)->first();
         //dd( $form_data,$tutor_data);
        User::create($form_data);
        $student_mailId = $request->email;
        //dd($tutor_data,$student_mailId);
            $data = array(
                'parameter'=>'student_register',
                'student_name'=>$request->name,
                'student_email' => $request->email,
                'student_mobile' => $request->mobile,
                'student_password' => $password,
                'tutor_name'=>$tutor_data->fname,
                'tutor_email' => $tutor_data->email,
                'tutor_mobile' => $tutor_data->mobile,
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
        $student = User::findOrFail($id);
        return view('tutor.studentedit', compact('student'));
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
        $form_data=array(
            'fname' =>$request->name,
            'class' =>$request->classname,
            'email' =>$request->email,
            'mobile' =>$request->mobile, 
            'status' =>$request->status,
            'dob' =>$request->dob,
            'location' =>$request->address,  
            'city' =>$request->city,  
            'pincode' =>$request->pincode,       
         );
        User::whereId($id)->update($form_data);
        Session::flash('message', 'Student is Update Successfully.');
        return redirect()->route('student_list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $student = User::findOrFail($id);
         $student->delete();
        return redirect()->route('student_list');
    }
     public function changeStatus(Request $request,$id,$status)
    {
        User::whereId($id)->update(['status' => $status]);
        return redirect()->route('student_list');
    }
    public function emailStudent($id){
         $student = User::findOrFail($id);
        return view('tutor.studentsendemail', compact('student'));

    }
    public function sendEmailStudent(Request $request){
        
         $request->validate([
         'student_name'=>'required',
         'to'=>'required|email',
         'subject'=>'required',
         'message'=>'required',
        ]);
          $student_mailId = $request->to;
         
            $data = array(
                'parameter'=>'tutor_send_to_student',
                'student_name'=>$request->student_name,
                'subject'=>$request->subject,
                'message' => $request->message,
               
                );
         //dd($data, $tutor_mailId);
        Mail::to($student_mailId)->send(new Email($data));
        Session::flash('message', 'Email Successfully. sent to student');
        return redirect()->route('student_list');
    }
}
