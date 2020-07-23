<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Blog;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
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
        $blogs=Blog::orderBy('id', 'desc')->get();
        return view('admin.blogsection',compact('blogs'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('role','main')->get();
        return view('admin.blogadd',compact('categories'));
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
            'category_id'=>'required',
            'title'=>'required',
            'content'  =>  'required',
        ]);
        $image='';
        if($request->hasFile('image')) {
          $image = $request->image->store('images'); 
         } 

        $form_data=[ 
            'categoryid'=>$request->category_id,
            'title'=>$request->title,
            'description'=>$request->content,
            'blog_image'=>$image,
            'status'=>$request->status,
        ];
        //dd( $form_data);
        Blog::create($form_data);
        Session::flash('message', 'Blog added successfully.');
        return redirect()->route('blog_list');

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
         $categories = Category::where('role','main')->get();
        $blog=Blog::findOrFail($id);
        return view('admin.blogedit',compact('blog','categories'));
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
        if($request->hasFile('image')) {
          $image = $request->image->store('images'); 
         }else{
          $image =$request->hidden_image;
        }
        $form_data=[ 
            'categoryid'=>$request->category_id,
            'title'=>$request->title,
            'description'=>$request->content,
            'blog_image'=>$image,
            'status'=>$request->status,
        ];
        //dd( $form_data);
        Blog::whereId($id)->update($form_data);
        Session::flash('message', 'Blog updated successfully.');
        return redirect()->route('blog_list');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Blog::whereId($id)->delete();
         Session::flash('message', 'Blog Deleted successfully.');
       return redirect()->route('blog_list');
    }
}
