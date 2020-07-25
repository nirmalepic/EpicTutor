<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/ 
Route::get('/', function () {
    return redirect('admin');
});
Route::get('/admin', function () {	
    return view('admin.index');
});
Route::get('/login', function () {
    return redirect('admin');
});
Route::get('/tutor/register', function () {
     return view('front.register');
    
});

Route::get('/tutor/login', function () {
     return view('front.login');
    
});
Route::get('/tutor', function () {	
    return view('front.index');
});
Route::group(['middleware' => ['guest']], function () { 
 Route::post('/tutor/login', 'TutorController@index')->name('tutor_login');
 Route::post('/tutor/register', 'TutorController@tutorRegister')->name('tutor_register');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
   Route::get('/tutor/dashboard', 'TutorController@tutorDashboard')->name('tutor_dashboard');
});
//Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
//tutor
	Route::get('/tutor', 'TutorController@index')->name('tutor_list');
	Route::get('/tutor/create', 'TutorController@create')->name('tutor_create');
	Route::post('/tutor/store', 'TutorController@store')->name('tutor_store');
	Route::get('/tutor/status/{id}/{status}/', 'TutorController@changeStatus')->name('tutor_status');
	Route::get('/tutor/destroy/{id}/', 'TutorController@destroy')->name('tutor_delete');
	Route::get('/tutor/edit/{id}/', 'TutorController@edit')->name('tutor_edit');
	Route::post('/tutor/update/{id}/', 'TutorController@update')->name('tutor_update');
	Route::get('/tutor/email/{id}/', 'TutorController@emailTutor')->name('tutor_email');
	Route::post('/tutor/sendemail/', 'TutorController@sendEmailTutor')->name('send_tutor_email');
	Route::get('/student', 'TutorController@studentDetails')->name('student_list');
	Route::get('/teacher', 'TutorController@teacherDetails')->name('teacher_list');
   //blog
	Route::get('/blog', 'BlogController@index')->name('blog_list');
	Route::get('/blog/create', 'BlogController@create')->name('blog_create');
	Route::post('/blog/store', 'BlogController@store')->name('blog_store');
	Route::get('/blog/{id}/edit', 'BlogController@edit')->name('blog_edit');
	Route::post('/blog/{id}/update', 'BlogController@update')->name('blog_update');
	Route::get ('/blog/{id}/delete', 'BlogController@destroy')->name('delete_blog');


	Route::post('/service/titles', 'ServiceSectionController@titles');
	Route::resource('/service', 'ServiceSectionController');

	Route::post('/testimonial/titles', 'TestimonialController@titles');
	Route::resource('/testimonial', 'TestimonialController');
	Route::resource('/services', 'ServiceController');
//Category
	Route::get('/categories', 'CategoryController@index')->name('list_main_categories');
	Route::post('/catagories/save', 'CategoryController@store')->name('store_main_categories');
	Route::get('category/create', 'CategoryController@create')->name('create_category');
	Route::get('/category/{id}/edit', 'CategoryController@edit')->name('category_edit');
    Route::post('/catagory/{id}/update', 'CategoryController@update')->name('update_category');
    Route::get('/catagories/{id}/delete', 'CategoryController@destroy')->name('delete_category');

	Route::resource('/subcategory', 'SubCategoryController');
	Route::get('/subcategory/create', 'SubCategoryController@create')->name('sub_create');
	Route::post('subcategory/store', 'SubCategoryController@store')->name('sub_cate_store');
	Route::get('subcategory/{id}/edit', 'SubCategoryController@edit')->name('sub_edit_store');
	Route::post('subcategory/{id}/update', 'SubCategoryController@update')->name('sub_update_store');
	Route::get('/subcatagory/{id}/delete', 'SubCategoryController@destroy')->name('delete_sub_category');
	Route::get('/getsubcatagory', 'SubCategoryController@getSubCategory')->name('get_sub_category');
//  settings
	Route::get('/settings', 'SettingsController@index')->name('settings_list');
	Route::post('/updatecolor', 'SettingsController@themecolor');
    Route::post('settings/title', 'SettingsController@title');
	Route::post('settings/payment', 'SettingsController@payment');
	Route::post('settings/about', 'SettingsController@about');
	Route::post('settings/address', 'SettingsController@address');
	Route::post('settings/footer', 'SettingsController@footer');
	Route::post('settings/logo', 'SettingsController@logo');
	Route::post('settings/favicon', 'SettingsController@favicon');
	Route::post('settings/background', 'SettingsController@background');
	Route::get('language-settings', 'SettingsController@setlanguage');
	Route::post('settings/language', 'SettingsController@language');
	

//slider
	Route::get('/sliders', 'SliderController@index')->name('slider_list');
	Route::get('slider/create', 'SliderController@create')->name('slider_create');
	Route::get('slider/store', 'SliderController@store')->name('slider_store');
//banner
	Route::get('/banner/add', 'PageSettingsController@addbanner');
	Route::get('/banner/{id}/delete', 'PageSettingsController@bannerdelete');
	Route::get('/banner/{id}/edit', 'PageSettingsController@banneredit');
	Route::post('/banner/{id}/update', 'PageSettingsController@bannerupdate');
	Route::post('/banner/save', 'PageSettingsController@bannersave');
//faq
	Route::get('/faq/add', 'PageSettingsController@addfaq');
	Route::get('faq/{id}/delete', 'PageSettingsController@faqdelete');
	Route::get('faq/{id}/edit', 'PageSettingsController@faqedit');
	Route::post('faq/{id}/update', 'PageSettingsController@faqupdate');
	Route::post('pagesettings/faqsave', 'PageSettingsController@faqsave');
	Route::post('banner/large', 'PageSettingsController@largebanner');
//pagesettings
	Route::post('pagesettings/about', 'PageSettingsController@about');
	Route::post('pagesettings/faq', 'PageSettingsController@faq');
	Route::post('pagesettings/contact', 'PageSettingsController@contact');
	Route::resource('/pagesettings', 'PageSettingsController');
   
	Route::get('ads/status/{id}/{status}', 'AdvertiseController@status');

	
});
Route::prefix('tutor')->group(function () {
	Route::get('/student', 'StudentController@index')->name('student_list');
	Route::get('/student/create', 'StudentController@create')->name('student_create');
	Route::post('/student/store', 'StudentController@store')->name('student_store');
	Route::get('/student/status/{id}/{status}/', 'StudentController@changeStatus')->name('student_status');
	Route::get('/student/destroy/{id}/', 'StudentController@destroy')->name('student_delete');
	Route::get('/student/edit/{id}/', 'StudentController@edit')->name('student_edit');
	Route::post('/student/update/{id}/', 'StudentController@update')->name('student_update');
	Route::get('/student/email/{id}/', 'StudentController@emailTutor')->name('student_email');
	Route::post('/student/sendemail/', 'StudentController@sendEmailTutor')->name('send_student_email');
	});
