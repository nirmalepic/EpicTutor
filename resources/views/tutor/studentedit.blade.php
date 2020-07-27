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
                    <h3>Edit Student </h3>
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
                            <form method="POST" action="{{route('student_update',$student->id)}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                            @csrf
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name<span class="required" >*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" name="name" value="{{ $student->fname }} {{ $student->lname }}" type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dob">Date of Birth<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input  class="form-control col-md-7 col-xs-12" name="dob" value="{{ $student->dob }}" type="date" id="datepicker">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="email" class="form-control col-md-7 col-xs-12" name="email" value="{{ $student->email }}" type="email">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mobile">Mobile<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="mobile" class="form-control col-md-7 col-xs-12" name="mobile" value="{{ $student->mobile }}" type="text">
                                </div>
                            </div>
                               <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="classname">Class<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <select class="form-control"  name="classname">
                                    <option value="" hidden="hidden">Select Class Name</option>
                                    <option value="PLAY GROUP" @if($student->class == 'PLAY GROUP') selected  @endif> PLAY GROUP</option>
                                    <option value="NURSERY" @if($student->class == 'NURSERY') selected  @endif> NURSERY</option>
                                    <option value="LKG" @if($student->class == 'LKG') selected  @endif> LKG</option>
                                    <option value="UKG" @if($student->class == 'UKG') selected  @endif> UKG</option>
                                    
                                        <option value="I" @if($student->class == 'I') selected  @endif> I</option>
                                        <option value="II" @if($student->class == 'II') selected  @endif> II</option>
                                        <option value="III" @if($student->class == 'III') selected  @endif> III</option>
                                        <option value="IV" @if($student->class == 'IV') selected  @endif> IV</option>
                                        <option value="V" @if($student->class == 'V') selected  @endif> V</option>
                                        <option value="VI" @if($student->class == 'VI') selected  @endif> VI</option>
                                        <option value="VII" @if($student->class == 'VII') selected  @endif> VII</option>
                                        <option value="VIII" @if($student->class == 'VIII') selected  @endif> VIII</option>
                                        <option value="IX" @if($student->class == 'IX') selected  @endif> IX</option>
                                        <option value="X" @if($student->class == 'X') selected  @endif> X</option>
                                        <option value="XI" @if($student->class == 'XI') selected  @endif> XI</option>
                                        <option value="XII" @if($student->class == 'XII') selected  @endif> XII</option>
                                    
                                </select>
                                </div>
                            </div>

                           
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Address
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="address" class="form-control col-md-7 col-xs-12" name="address"  value="{{ $student->location }}" type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">City
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="city" class="form-control col-md-7 col-xs-12" name="city" value="{{ $student->city }}" type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pincode
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="pincode" class="form-control col-md-7 col-xs-12" name="pincode" value="{{ $student->pincode }}" type="text">
                                </div>
                            </div>

                             <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Status
                                </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="status" class="form-control">
                                            <option value="1" @if($student->status ==1 ) selected  @endif > Active  
                          </option>
                                <option @if($student->status ==0 ) selected  @endif
                                  value="0" >Inactive
                                </option>

                                            </select>
                            </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-success btn-block">Update Student</button>
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