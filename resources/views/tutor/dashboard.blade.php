@extends('tutor.includes.master-tutor')

@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <h3>Tutor Dashboard! </h3>
<div class="row">
        <div class="dashboard-header-area col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-dashboard-product-head">
                    <div class="dashboard-product-image col-md-4">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="dashboard-product-type col-md-8">
                       Students!
                        <span class="product-quantity">{{ \App\User::where('role','student')->count() }}</span>
                    </div>
                    <div class="border-bottom"></div>
                    <div class="bottom-link">
                        <a class="detail-link clearfix btn-block" href="{{url('admin/student')}}">
                            <span class="pull-left">View All</span>
                            <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-dashboard-product-head">
                    <div class="dashboard-product-image col-md-4">
                        <i class="fa fa-group"></i>
                    </div>
                    <div class="dashboard-product-type col-md-8">
                       Classes!
                        <span class="product-quantity">{{ \App\User::where('role','teacher')->count() }}</span>
                    </div>
                    <div class="border-bottom"></div>
                    <div class="bottom-link">
                        <a class="detail-link clearfix btn-block" href="{{url('admin/teacher')}}">
                            <span class="pull-left">View All</span>
                            <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-dashboard-product-head">
                    <div class="dashboard-product-image col-md-4">
                        <i class="fa fa-group"></i>
                    </div>
                    <div class="dashboard-product-type col-md-8">
                       Assignments!
                        <span class="product-quantity">{{ \App\User::where('role','teacher')->count() }}</span>
                    </div>
                    <div class="border-bottom"></div>
                    <div class="bottom-link">
                        <a class="detail-link clearfix btn-block" href="{{url('admin/teacher')}}">
                            <span class="pull-left">View All</span>
                            <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-dashboard-product-head">
                    <div class="dashboard-product-image col-md-4">
                        <i class="fa fa-group"></i>
                    </div>
                    <div class="dashboard-product-type col-md-8">
                        Fee Receipt!
                        <span class="product-quantity">{{ \App\User::where('role','teacher')->count() }}</span>
                    </div>
                    <div class="border-bottom"></div>
                    <div class="bottom-link">
                        <a class="detail-link clearfix btn-block" href="{{url('admin/teacher')}}">
                            <span class="pull-left">View All</span>
                            <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="single-dashboard-product-head">
                    <div class="dashboard-product-image col-md-4">
                        <i class="fa fa-group"></i>
                    </div>
                    <div class="dashboard-product-type col-md-8">
                        Tests!
                        <span class="product-quantity">{{ \App\User::where('role','teacher')->count() }}</span>
                    </div>
                    <div class="border-bottom"></div>
                    <div class="bottom-link">
                        <a class="detail-link clearfix btn-block" href="{{url('admin/teacher')}}">
                            <span class="pull-left">View All</span>
                            <span class="pull-right"><i class="fa fa-chevron-circle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>

            
            </div>
        </div>






{{--<h3>Usefull Links </h3>


        
        <div class="row">
            <div class="sct_right dashboard-header-area col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                    <!--[if !IE]>start dashboard menu<![endif]-->
                    <div class="dashboard_menu_wrapper row">
                            <ul class="dashboard_menu">
                                    <div class="col-md-2">
                                            <div class="bor-1"><a href="{!! url('/settings') !!}" class="d1"><span>General Setting</span></a></div>
                                    </div>
                                    <div class="col-md-2">
                                            <div class="bor-1"><a href="{!! url('/users/list') !!}" class="d2"><span>Admin User Management</span></a></div>
                                    </div>
                                    <div class="col-md-2">
                                            <div class="bor-1"><a href="{!! url('/customers') !!}" class="d3"><span>Customer Managment</span></a></div>
                                    </div>
				<div class="col-md-2">
                                            <div class="bor-1"><a href="{!! url('/categories') !!}" class="d10"><span>Categories</span></a></div>
                                    </div>
                                    <div class="col-md-2">
                                            <div class="bor-1"><a href="{!! url('/products') !!}" class="d13"><span>Products Management</span></a></div>
                                    </div>
                                    <div class="col-md-2">
                                            <div class="bor-1"><a href="{!! url('/tools') !!}" class="d5"><span>SEO Tools and Settings</span></a></div>
                                    </div>
<div class="col-md-2">
                                            <div class="bor-1"><a href="{!! url('/pagesettings') !!}" class="d15"><span>Page Settings</span></a></div>
                                    </div>
<div class="col-md-2">
                                            <div class="bor-1"><a href="{!! url('/sliders') !!}" class="d64"><span>Sliders Management</span></a></div>
                                    </div>
				<div class="col-md-2">
                                             <div class="bor-1"><a href="{!! url('/tools') !!}" class="d62"><span>Social Management</span></a></div>
                                    </div>
<div class="col-md-2">
                                            <div class="bor-1"><a href="{!! url('/testimonial') !!}" class="d68"><span>Testimonial</span></a></div>
                                    </div>	
                                    
<div class="col-md-2">
                                            <div class="bor-1"><a href="#" class="d4"><span>Location Management</span></a></div>
                                    </div>

                                    <div class="col-md-2">
                                            <div class="bor-1"><a href="#" class="d6"><span>Email Settings and Templates</span></a></div>
                                    </div>
                                    <div class="col-md-2">
                                            <div class="bor-1"><a href="#" class="d7"><span>Ads Management</span></a></div>
                                    </div>
                                    <div class="col-md-2">
                                            <div class="bor-1"><a href="#" class="d71"><span>Advertisements Enquries</span></a></div>
                                    </div>
                                    <div class="col-md-2">
                                            <div class="bor-1"><a href="#" class="d8"><span>Payment Management</span></a></div>
                                    </div>
                                    <div class="col-md-2">
                                            <div class="bor-1"><a href="#" class="d9"><span>Inquiry Box</span></a></div>
                                    </div>
                                    
                                    div class="col-md-2">
                                            <div class="bor-1"><a href="#" class="d16"><span>Inquiry Box</span></a></div>
                                    </div>hhhhhhhhjyu
                                    <div class="col-md-2">
                                            <div class="bor-1"><a href="#" class="d12"><span>Trade Leads Management</span></a></div>
                                    </div>
                                    
                                    
                                    
                                    <div class="col-md-2">
                                            <div class="bor-1"><a href="#" class="d17"><span>Career &amp; Franchise </span></a></div>
                                    </div>
                                    <div class="col-md-2">
                                            <div class="bor-1"><a href="#" class="d52"><span>Excel Import</span></a></div>
                                    </div>
                                    <div class="col-md-2">
                                            <div class="bor-1"><a href="#" class="d51"><span>Excel Export</span></a></div>
                                    </div>
                                    <div class="col-md-2">
                                            <div class="bor-1"><a href="#" class="d61"><span>Currency Management</span></a></div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                            <div class="bor-1"><a href="#" class="d63"><span>Google Management</span></a></div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                            <div class="bor-1"><a href="#" class="d65"><span>Member Package Management</span></a></div>
                                    </div>
                                    <div class="col-md-2">
                                            <div class="bor-1"><a href="#" class="d66"><span>Company Statistics</span></a></div>
                                    </div>
                                    <div class="col-md-2">
                                            <div class="bor-1"><a href="#" class="d67"><span>User Statistics</span></a></div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                            <div class="bor-1"><a href="#" class="d69"><span>Trade Shows Manage</span></a></div>
                                    </div>
                                    <div class="col-md-2">
                                            <div class="bor-1"><a href="#" class="d70"><span>Success Stories</span></a></div>
                                    </div>
                                    <div class="col-md-2">
                                            <div class="bor-1"><a href="#" class="d72"><span>Staff Member Management</span></a></div>
                                    </div>
                                    <div class="col-md-2">
                                            <div class="bor-1"><a href="#" class="d11"><span>Approval Center</span></a></div>
                                    </div>
                            </ul>
                    </div>
                    <!--[if !IE]>end dashboard menu<![endif]--> 

            </div>
        </div>--}}


        
        
        
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

@stop

@section('footer')
    
@stop
