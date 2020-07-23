@extends('admin.includes.master-admin')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                    <a href="{{ route('tutor_create') }}" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add Tutor</a>
                    </div>
                    <h3>Tutors<a href="" class="btn btn-primary"><strong>Pending Tutors (0)</strong></a></h3>
                    <div class="go-line"></div>
                </div>
                <!-- Page Content -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div id="response">
                            @if(Session::has('message'))
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('message') }}
                                </div>
                            @endif
                        </div>
                        <table class="table table-striped table-bordered" cellspacing="0" id="example" width="100%">
                            <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Tutor Name</th>
                                <th>Tutor Email</th>
                                <th>Phone</th>
                                <th width="10%">Address</th>
                                <th>Student spe</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                          @foreach ($tutors as $tutor)
                                <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tutor->fname }} {{ $tutor->lname }}</td>
                                <td>{{ $tutor->email }}</td>
                                <td>{{ $tutor->mobile }}</td>
                                <td>{{ $tutor->location }}</td>
                                <td>{{ $tutor->students_specify }}</td>

                                    <td>

                                 @if($tutor->status==1)
                                 <a href="{{ route('tutor_status',['id'=>$tutor->id,0]) }}" class=" btn btn-raised btn-success btn-min-width" id="delete-form-{{$tutor->id}}" data-id="delete-form-{{$tutor->id}}" onclick="return confirm('Are you sure, you want to change the status?')">Active</a>
                                @else
                               
                                <a href="{{ route('tutor_status',['id'=>$tutor->id,1]) }}" class=" btn btn-raised btn-danger btn-min-width" id="delete-form-{{$tutor->id}}" data-id="delete-form-{{$tutor->id}}" onclick="return confirm('Are you sure, you want to change the status?')">Inactive</a>
                                @endif
                                    </td>

                                <td>
                                    <a href="{{ route('tutor_email', $tutor->id)}}" 
                                       onclick="return confirm('Are you sure, you want to sand  mail to this tutor?')" class="btn btn-primary btn-xs"><i class="fa fa-send"></i> Email</a>
                                    <a href="{{ route('tutor_edit',$tutor->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                    <a onclick="return confirm('Are you sure, you want to delete this tutor?')" href="{{ route('tutor_delete',$tutor->id) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> del</a>

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
 <script type="text/javascript">
      $("document").ready(function(){
          setTimeout(function(){
          $("div.alert").remove();
      }, 5000 ); 
        }); 
    </script>
@stop