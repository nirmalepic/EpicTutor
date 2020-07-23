<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Mail\Email;
use Mail;

class TutorController extends Controller
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
        $tutors=User::where('role','tutor')->orderBy('id','desc')->get();
        //dd($tutors);
        return view('admin.tutorlist',compact('tutors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tutoradd');
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
         'name'=>'required',
         'email'=>'required|email|unique:users',
         'mobile'=>'required|numeric|unique:users',
        ]);
         $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890!$%^&!$%^&');
          $password = substr($random, 0, 8);
         $form_data=array(
            'fname' =>$request->name,
            'email' =>$request->email,
            'mobile' =>$request->mobile,
            'students_specify' =>$request->studentspecify,  
            'status' =>$request->status,   
            'password' =>$password,   
            'role' =>'tutor',   
         );
        User::create($form_data);
        
        $tutor_mailId = $request->email;
            $data = array(
                'parameter'=>'tutor_register',
                'tutor_name'=>$request->name,
                'tutor_email' => $request->email,
                'tutor_mobile' => $request->mobile,
                'tutor_password' => $password,
                );
        Mail::to($tutor_mailId)->send(new Email($data));
        Session::flash('message', 'New Tutor Added Successfully.');
        return redirect()->route('tutor_list');

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
        $tutor = User::findOrFail($id);
        return view('admin.tutoredit', compact('tutor'));
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
            'email' =>$request->email,
            'mobile' =>$request->mobile,
            'students_specify' =>$request->studentspecify,  
            'status' =>$request->status,    
            'role' =>'tutor',   
         );
        User::whereId($id)->update($form_data);
        Session::flash('message', 'Tutor Update Successfully.');
        return redirect()->route('tutor_list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tutor = User::findOrFail($id);
        $tutor->delete();
        return redirect()->route('tutor_list');
    }
     /**
     * Change User Status
     * 
     */
    public function changeStatus(Request $request,$id,$status)
    {
        User::whereId($id)->update(['status' => $status]);
        return redirect()->route('tutor_list');
    }
    public function emailTutor($id){
         $tutor = User::findOrFail($id);
        return view('admin.tutorsendemail', compact('tutor'));

    }
    public function sendEmailTutor(Request $request){
        
         $request->validate([
         'tutor_name'=>'required',
         'to'=>'required|email',
         'subject'=>'required',
         'message'=>'required',
        ]);
          $tutor_mailId = $request->to;
         
            $data = array(
                'parameter'=>'admin_send_to_tutor',
                'tutor_name'=>$request->tutor_name,
                'subject'=>$request->subject,
                'message' => $request->message,
               
                );
         //dd($data, $tutor_mailId);
        Mail::to($tutor_mailId)->send(new Email($data));
        Session::flash('message', 'Email Successfully. sent to tutor');
        return redirect()->route('tutor_list');
    }
    public function studentDetails(){
      $students=User::where('role','student')->orderBy('id','desc')->get();
        return view('admin.studentlist',compact('students'));
    }
    public function teacherDetails(){
       $teachers=User::where('role','teacher')->orderBy('id','desc')->get();
       return view('admin.teacherlist',compact('teachers'));
    }
}
