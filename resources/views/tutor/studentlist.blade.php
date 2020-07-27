@extends('tutor.includes.master-tutor')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row" id="main">
                <!-- Page Heading -->
                <div class="go-title">
                    <div class="pull-right">
                    <a href="{{ route('student_create') }}" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add Student</a>
                    </div>
                    <h3>Student List</h3>
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Class</th>
                                <th>Address</th>
                                <th>DOB</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                          @foreach ($student_data as $student)
                                <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->fname }} {{ $student->lname }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->mobile }}</td>
                                <td>{{ $student->class }}</td>
                                <td>{{ $student->location }}</td>
                                <td>{{ $student->dob }}</td>

                                    <td>

                                 @if($student->status==1)
                                 <a href="{{ route('student_status',['id'=>$student->id,0]) }}" class=" btn btn-raised btn-success btn-min-width" id="delete-form-{{$student->id}}" data-id="delete-form-{{$student->id}}" onclick="return confirm('Are you sure, you want to change the status?')">Active</a>
                                @else
                               
                                <a href="{{ route('student_status',['id'=>$student->id,1]) }}" class=" btn btn-raised btn-danger btn-min-width" id="delete-form-{{$student->id}}" data-id="delete-form-{{$student->id}}" onclick="return confirm('Are you sure, you want to change the status?')">Inactive</a>
                                @endif
                                    </td>
                                <td>
                                    <a href="{{ route('student_email', $student->id)}}" 
                                       onclick="return confirm('Are you sure, you want to sand  mail to this tutor?')" class="btn btn-primary btn-xs"><i class="fa fa-send"></i> mail</a>
                                    <a href="{{ route('student_edit',$student->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                    <a onclick="return confirm('Are you sure, you want to delete this tutor?')" href="{{ route('student_delete',$student->id) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> del</a>

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