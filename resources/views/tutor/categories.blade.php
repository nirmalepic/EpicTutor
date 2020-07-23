@extends('tutor.includes.master-tutor')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">

                <!-- Page Heading -->
                <div class="go-title">
                    <h3>Categories</h3>

                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div id="res">
                            @if(Session::has('message'))
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('message') }}
                                </div>
                            @endif
                        </div>
                        <!-- /.start -->
                        <div class="col-md-12">
                            <ul class="nav nav-tabs tabs-left">
                                <li class="active"><a href="#maincat" data-toggle="tab" aria-expanded="false"><strong>Main Category</strong></a>
                                <li><a href="#subcat" data-toggle="tab" aria-expanded="true"><strong>Sub Category</strong></a>
                                {{--<li><a href="#childcat" data-toggle="tab" aria-expanded="true"><strong>Child Category</strong></a>
                                </li>--}}
                            </ul>
                        </div>

                        <div class="col-xs-12" style="padding: 0">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="maincat">
                                    <div class="go-title">
                                        <div class="pull-right">
                                            <a href="{{route('create_category')}}" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add Main Category</a>
                                        </div>
                                        <h3>Main Category</h3>
                                        <div class="go-line"></div>
                                    </div>
                                    <!-- Page Content -->
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <table class="table table-striped table-bordered" cellspacing="0" id="example" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Image</th>
                                                    <th>Url Slug</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @if($categories !='')
                                                @foreach($categories as $category)
                                                    <tr>
                                                        <td>{{$category->name}}
                                                        </td>
                                                        <td>{{$category->description}}</td>
                                                        <td><img src="{{ asset('storage/app/'.$category->feature_image) }}" width="50" height="50"></td>
                                                        <td>{{$category->slug}}</td>
                                                        <td align="center">
                                @if($category->status)
      
                                <button type="submit" class="btn btn-raised btn-success btn-min-width">Active</button>
                                @else
                               <button type="submit" class="btn btn-raised btn-warning btn-min-width">Deactive</button>
                                @endif
            
                            </td>
                                                        <td>
                                                            <a href="{{ route('category_edit',$category->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>
<a  href="{{ route('delete_category',$category->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> Remove</a><br>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="subcat">
                                    <div class="go-title">
                                        <div class="pull-right">
                                            <a href="{{route('sub_create')}}" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add Sub Category</a>
                                        </div>
                                        <h3>Sub Category</h3>
                                        <div class="go-line"></div>
                                    </div>
                                    <!-- Page Content -->
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <table class="table table-striped table-bordered" cellspacing="0" id="example2" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Image</th>
                                                    <th>Url Slug</th>
                                                    <th>Main Category</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                
                                                @foreach($subs as $sub)
                                                    <tr>
                        <td>{{$sub->name}} </td>
                     <td>{{$sub->description}}</td>
            <td><img src="{{ asset('storage/app/'.$sub->feature_image) }}" width="50" height="50"></td>
                    <td>{{$sub->slug}}</td>
                    <td>{{$sub->parentId->name}}</td>
                <td align="center">
                                @if($sub->status)
      
                                <button type="submit" class="btn btn-raised btn-success btn-min-width">Active</button>
                                @else
                               <button type="submit" class="btn btn-raised btn-warning btn-min-width">Deactive</button>
                                @endif
            
                            </td>
                                                        <td>
         <a href="{{route('sub_edit_store',$sub->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>
    <a  href="{{ route('delete_sub_category',$sub->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> Remove</a><br>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                                
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="tab-pane" id="childcat">
                                    <div class="go-title">
                                        <div class="pull-right">
                                            <a href="{!! url('admin/childcategory/create') !!}" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add Child Category</a>
                                        </div>
                                        <h3>Child Category</h3>
                                        <div class="go-line"></div>
                                    </div>
                                    <!-- Page Content -->
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <table class="table table-striped table-bordered" cellspacing="0" id="example3" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>Category Name</th>
                                                    <th>Main Category</th>
                                                    <th>Sub Category</th>
                                                    <th width="20%">Url Slug</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                {{--@foreach($child as $data)
                                                    <tr>
                                                        <td>{{$data->name}}
                                                            @if($data->featured == 1)
                                                                <label class="label label-primary">Featured</label>
                                                            @endif
                                                        </td>
                                                        <td>{{$data->mainid->name}}</td>
                                                        <td>{{$data->subid->name}}</td>
                                                        <td>{{$data->slug}}</td>
                                                        <td>

                                                            <a href="childcategory/{{$data->id}}/edit" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>
                                                            <a href="javascript:;" data-href="{{url('/')}}/admin/categories/delete/{{$data->id}}" data-toggle="modal" data-target="#confirm-delete"class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Remove</a><br>

                                                        </td>
                                                    </tr>
                                                @endforeach--}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.end -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->



    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
                <div class="modal-body">
                    <p>You are about to delete this Category, Everything will be deleted under this Category.</p>
                    <p>Do you want to proceed?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-danger btn-ok">Delete</a>
            
                </div>
            </div>
        </div>
    </div>

@stop

@section('footer')
@stop