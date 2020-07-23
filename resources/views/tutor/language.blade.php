@extends('admin.includes.master-admin')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">

                    <h3>Language Settings</h3>
                    <div class="go-line"></div>
                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        <div id="response"></div>
                                                
                        
                        <table class="table table-striped table-bordered" cellspacing="0" id="example" width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>  
                                <th>Flag</th>  
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($languageList as $key => $langlist)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{$langlist->name}}</td>
                                    <td><img src="{{url('/')}}/assets/language_list_image/language_{{$langlist->id}}.jpg" style="max-height: 50px; max-width: 50px;"></td>
                                    <td>                                        

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        
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