@extends('layouts.master')
@section('title','Manage Students')
@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Students</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Students</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Title</h3>
                <div class="card-tools">
                    <button class="btn btn-info" data-toggle="modal" data-target="#addNewStudent">Add New</button>
                </div>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-striped table-hover datatable">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>DOB</th>
                        <th>Exam</th>
                        <th>Exam Date</th>
                        <th>Result</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                        <td>#</td>
                        <td>Name</td>
                        <td>DOB</td>
                        <td>Exam</td>
                        <td>Exam Date</td>
                        <td>Result</td>
                        <td>Status</td>
                        <td>Action</td>
                    </tbody>
                    <tfoot>
                      <tr>
                      <th>#</th>
                        <th>Name</th>
                        <th>DOB</th>
                        <th>Exam</th>
                        <th>Exam Date</th>
                        <th>Result</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                </table>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->

      <!-- Modal -->
      <!-- Add Exam Modal -->
      <div class="modal fade" id="addNewStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add New Student</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="" method="post" action="{{ url('admin/add_new_student') }}" class="ajax_form_submit">
                <div class="form-group">
                  <label>Enter Name <span class="text-danger">*</span></label>
                  {{ csrf_field() }}
                  <input name="name" type="text" class="form-control" placeholder="Enter student name" required="required">
                </div>
                <div class="form-group">
                  <label>Enter E-mail <span class="text-danger">*</span></label>
                  <input name="email" type="email" class="form-control" placeholder="Enter student email" required="required">
                </div>
                <div class="form-group">
                  <label>Enter Mobile No <span class="text-danger">*</span></label>
                  <input name="mobile_no" type="number" class="form-control" placeholder="Enter mobile number" required="required">
                </div>
                <div class="form-group">
                  <label>Select DOB <span class="text-danger">*</span></label>
                  <input type="date" name="dob" placeholder="Enter DOB" required="required" class="form-control">
                </div>
                <div class="form-group">
                  <label>Select Exam<span class="text-danger">*</span></label>
                  <select name="exam" id="" required="required" class="form-control">
                    <option value="">Select exam</option>
                    @foreach($exams as $singleExam)
                    <option value="{{ $singleExam['id'] }}">{{ $singleExam['title'] }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Enter Password <span class="text-danger">*</span></label>
                  <input type="password" name="password" placeholder="Enter password" required="required" class="form-control">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Add <i class="fa fa-spinner fa-spin ml-1"></i></button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Edit exam modal -->
      <div class="modal fade" id="editExam" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update Exam</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="edit-exam-body">
              
            </div>
          </div>
        </div>
      </div>

  </div>

<!-- Javascript -->
<script>
    
</script>

@endsection