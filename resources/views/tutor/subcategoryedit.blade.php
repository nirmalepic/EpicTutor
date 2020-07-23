@extends('tutor.includes.master-tutor')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                        <a href="{{route('list_main_categories')}}" class="btn btn-default btn-back"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <h3>Edit Sub Category</h3>
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
                        <form method="POST" action="{{route('sub_update_store',$subcategory->id)}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                            @csrf
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Main Category<span class="required">*</span>

                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="mainid" required>
                                        <option value="">Select Main Category</option>
                                        @foreach($maincat as $cat)

                                 @if($cat->id == $subcategory->parentid)
                                                <option value="{{$cat->id}}" selected>{{$cat->name}}</option>
                                            @else
                                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Category Display Name<span class="required">*</span>
                                    <p class="small-label">(In Any Language)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" name="name" value="{{$subcategory->name}}" placeholder="e.g Sports" required="required" type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Category URL Slug<span class="required">*</span>
                                    <p class="small-label">(In English Must Be Unique)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="slug" class="form-control col-md-7 col-xs-12" name="slug" value="{{$subcategory->slug}}" placeholder="e.g sports" required="required" type="text">
                                </div>
                            </div>
                            
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Category Description
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea rows="10" class="form-control" name="description" id="content1">{{$subcategory->description}}</textarea>

                                </div>
                            </div>
                                <div class="item form-group" id="fimg">
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Current Featured Image <span class="required">*</span>
                                        </label>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <img style="max-width: 250px;" src="{{ asset('storage/app/'.$subcategory->feature_image) }}" alt="No Featured Image Added">
                                        </div>
                                    </div>
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Change Featured Image<span class="required">*</span>
                                        <p class="small-label">Must Be a Square Sized Image(400x400)</p>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="hidden" name="hidden_image" value="{{$subcategory->feature_image}}">
                                        <input type="file"  name="image"/>
                                    </div>
                                </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Status
                                </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="status" class="form-control">
                                            <option value="1" @if($subcategory->status ==1 ) selected  @endif > Active  
                          </option>
                                <option @if($subcategory->status ==0 ) selected  @endif
                                  value="0" >Inactive
                                </option>

                                            </select>
                            </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-success btn-block">Update Category</button>
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