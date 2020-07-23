@extends('admin.includes.master-admin')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                        <a href="{!! url('admin/tutor') !!}" class="btn btn-default btn-back"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <h3>Edit Tutor</h3>
                    <div class="go-line"></div>
                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if(Session::has('message'))
                            <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ Session::get('message') }}
                            </div>
                        @endif
                          @if ($errors->any())
                        <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                        </div>
                        @endif
                        <div id="response"></div>
                        <form method="POST" action="{{route('tutor_update',$tutor->id)}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                            @csrf
                            
                        <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" name="name" placeholder="Name" value="{{$tutor->fname}} {{$tutor->lname}}" type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" name="email" placeholder="Email" value="{{$tutor->email}}" type="email">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Mobile<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" name="mobile" placeholder="Mobile" value="{{$tutor->mobile}}" type="text">
                                </div>
                            </div>
                               <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Student Specification<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" name="studentspecify" placeholder="Student Specification" value="{{$tutor->students_specify}}" type="text">
                                </div>
                            </div>
                              
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Status
                                </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="status" class="form-control">
                                            <option value="1" @if($tutor->status ==1 ) selected  @endif > Active  
                          </option>
                                <option @if($tutor->status ==0 ) selected  @endif
                                  value="0" >Inactive
                                </option>

                                            </select>
                            </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-success btn-block">Update Tutor</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@stop

@section('footer')

@stop