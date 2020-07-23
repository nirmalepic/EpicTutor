<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Session;

class SubCategoryController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::where('role','main')->get();
        $subs = Category::with('parentId')->where('role','sub')->get();
        return view('admin.categories',compact('categories','subs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('role','main')->get();
        return view('admin.subcategoryadd',compact('categories'));
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
         'mainid'=>'required',
         'name'=>'required|unique:categories',
         'slug'=>'required',
         'description'=>'required',

        ]);
         $image = ''; 
        if($request->hasFile('image')) {
          $image = $request->image->store('images'); 
         }
        $form_data=array(
            'parentid' =>$request->mainid,
            'name' =>$request->name,
            'slug' =>$request->slug,   
            'description' =>$request->description,   
            'feature_image' =>$image,    
            'status' =>$request->status,   
            'role' =>'sub',   
         );
        Category::create($form_data);
        Session::flash('message', 'New Sub Category Added Successfully.');
        return redirect()->route('list_main_categories');
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
         $maincat = Category::where('role','main')->get();
         $subcategory = Category::findOrFail($id);
         return view('admin.subcategoryedit',compact('subcategory','maincat'));
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
        $form_data = array(
            'parentid' =>$request->mainid,
            'name'             =>   $request->name,
            'description'      =>   $request->description,
            'feature_image'    =>   $image,
            'slug'             =>   $request->slug,
            'status'           =>   $request->status,

        );
        Category::whereId($id)->update($form_data);
        Session::flash('success', 'Sub Categories updated successfully.');
        return redirect()->route('list_main_categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::whereId($id)->delete();
       return redirect()->route('list_main_categories');
    }
      public function getSubCategory(Request $request)
    {
      $subcategories = Category::where('parentid',$request->id)->where('role','sub')->get();
            if($subcategories != ''){
            foreach($subcategories as $d){
            echo '<option value="'.$d['id'].'">'.$d['name'].'</option>';
            }
         }
                 
    }
}
