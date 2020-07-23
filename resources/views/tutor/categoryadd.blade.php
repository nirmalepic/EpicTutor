@extends('tutor.includes.master-tutor')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">

                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                        <a href="{!! url('admin/categories') !!}" class="btn btn-default btn-back"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <h3>Add Main Category</h3>
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
                            <form class="form-horizontal form-label-left" method="POST" action="{{ route('store_main_categories') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Category Display Title<span class="required">*</span>
                                    <p class="small-label">(In Any Language)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" name="name" placeholder="anything" value="{{old('name')}}" type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Category URL Slug<span class="required">*</span>
                                    <p class="small-label">(In English Must be Unique)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="slug" class="form-control col-md-7 col-xs-12" name="slug" placeholder="e.g grains-anything" value="{{old('slug')}}" type="text">
                                </div>
                            </div>

                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Category Description
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea rows="10" class="form-control" name="description" id="content1" placeholder="Enter Blog Contents" value="{{old('description')}}" ></textarea>

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
                             
                           <!--  <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="featured" id="atofea" value="1"><strong>Add to Featured</strong></label>
                                    </div>
                                </div>
                            </div> -->

                            <div class="item form-group" id="fimg">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Add Featured Image<span class="required">*</span>
                                    <p class="small-label">Must Be a Square Sized Image(400x400)</p>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file"  name="image" />
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-success btn-block">Add Category</button>
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
        bkLib.onDomLoaded(function() {
            new nicEditor({fullPanel : true}).panelInstance('content1');
        });
    </script>
@stop