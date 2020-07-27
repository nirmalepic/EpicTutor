@extends('tutor.includes.master-tutor')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">

                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                        <a href="{!! url('tutor/student') !!}" class="btn btn-default btn-back"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <h3>Add Student</h3>
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
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                        </div>
                        @endif
                        <div id="response"></div>
                            <form class="form-horizontal form-label-left" method="POST" action="{{ route('student_store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" name="name" placeholder="Name" value="{{old('name')}}" type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dob">Date of Birth<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  class="form-control col-md-7 col-xs-12" name="dob" placeholder="DOB" value="{{old('dob')}}" type="date" id="datepicker">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="email" class="form-control col-md-7 col-xs-12" name="email" placeholder="Email" value="{{old('email')}}" type="email">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mobile">Mobile<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="mobile" class="form-control col-md-7 col-xs-12" name="mobile" placeholder="Mobile" value="{{old('mobile')}}" type="text">
                                </div>
                            </div>
                               <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="classname">Class<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <select class="form-control"  name="classname">
                                    <option value="" hidden="hidden">Select Class Name</option>
                                    <option value="PLAY GROUP"> PLAY GROUP</option>
                                    <option value="NURSERY"> NURSERY</option>
                                    <option value="LKG"> LKG</option>
                                    <option value="UKG"> UKG</option>
                                    
                                        <option value="I"> I</option>
                                        <option value="II"> II</option>
                                        <option value="III"> III</option>
                                        <option value="IV"> IV</option>
                                        <option value="V"> V</option>
                                        <option value="VI"> VI</option>
                                        <option value="VII"> VII</option>
                                        <option value="VIII"> VIII</option>
                                        <option value="IX"> IX</option>
                                        <option value="X"> X</option>
                                        <option value="XI"> XI</option>
                                        <option value="XII"> XII</option>
                                    
                                </select>
                                </div>
                            </div>

                           
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Address
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="address" class="form-control col-md-7 col-xs-12" name="address" placeholder="Address" value="{{old('address')}}" type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">City
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="city" class="form-control col-md-7 col-xs-12" name="city" placeholder="City" value="{{old('city')}}" type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pincode
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="pincode" class="form-control col-md-7 col-xs-12" name="pincode" placeholder="pincode" value="{{old('pincode')}}" type="text">
                                </div>
                            </div>

                             <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Status
                                </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="status" class="form-control">
                                            <option value="1" selected>Yes</option>
                                            <option value="0" >No</option>
                                            </select>
                            </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-success btn-block">Add Student</button>
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
    <script type="text/javascript">
      $("document").ready(function(){
          setTimeout(function(){
          $("div.alert").remove();
      }, 5000 ); 
        }); 
    </script>
   
@stop