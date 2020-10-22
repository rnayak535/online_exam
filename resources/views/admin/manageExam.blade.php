@extends('layouts.master')
@section('title','Manage Exam')
@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Exam</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Exam</li>
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
                    <button class="btn btn-info" data-toggle="modal" data-target="#addNewExam">Add New</button>
                </div>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-striped table-hover datatable">
                    <thead>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Exam Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Exam Date</th>
                        <th>Status</th>
                        <th>Action</th>
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
      <div class="modal fade" id="addNewExam" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add New Exam</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="" method="post" action="{{ url('admin/add_new_exam') }}" class="ajax_form_submit">
                <div class="form-group">
                  <label>Enter Title <span class="text-danger">*</span></label>
                  {{ csrf_field() }}
                  <input name="title" type="text" class="form-control" placeholder="Enter Exam Name" required="required">
                </div>
                <div class="form-group">
                  <label>Select Exam Date <span class="text-danger">*</span></label>
                  <input name="exam_date" type="date" class="form-control" required="required">
                </div>
                <div class="form-group">
                  <label>Select Exam Category <span class="text-danger">*</span></label>
                  <select name="categoryId" id="" required="required" class="form-control">
                    <option value="">Select Category</option>
                    @foreach($category as $singleCategory)
                    <option value="{{ $singleCategory['id'] }}">{{ $singleCategory['name'] }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Add</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>


  </div>

<!-- Javascript -->
<script>
    
</script>

@endsection