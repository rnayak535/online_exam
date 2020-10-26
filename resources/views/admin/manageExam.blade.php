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
                      <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Exam Date</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                    @foreach($exams as $key => $singleExam)
                      <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $singleExam["title"] }}</td>
                        <td>{{ $singleExam["cat_name"] }}</td>
                        <td>{{ date('jS, F Y', strtotime($singleExam["exam_date"])) }}</td>
                        <td><input type="checkbox" <?=($singleExam["status"]=='1')?'checked':'';?> name="status" onclick="changeExamStatus('<?=$singleExam['id']?>');"></td>
                        <td>
                          <a href="javascript:void(0);" class="btn btn-warning" data-toggle="modal" data-target="#editExam" onclick="getEditExamModal('<?=$singleExam['id']?>');">Edit</a>
                          <a href="javascript:void(0);" class="btn btn-danger" onclick="deleteExam('<?=$singleExam['id'];?>');">Delete</a>
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Exam Date</th>
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
    function changeExamStatus(examId){
      //BASE_URL is defined in master.blade.php
      $.ajax({
        type: 'GET',
        url: BASE_URL+"/admin/change_exam_status",
        data: "examId="+examId,
        beforeSend: function(){
          
        },
        success: function(response){
          alert("Exam Status Changed successfully.");
        },
        error: function(response){
          alert("Oops please try after some time!");
          window.location.href = "{{ url('admin/manage_exam') }}";
        }
      });
    }
    // Delete Exam
    function deleteExam(examId){
       //BASE_URL is defined in master.blade.php
       var confirmit = confirm("Are you sure to delete this exam!");
       if(confirmit){
            $.ajax({
            type: 'GET',
            url: BASE_URL+"/admin/delete_exam",
            data: "examId="+examId,
            beforeSend: function(){
              
            },
            success: function(response){
              alert("Exam deleted successfully.");
              window.location.href = "{{ url('admin/manage_exam') }}";
            },
            error: function(response){
              alert("Oops please try after some time!");
              window.location.href = "{{ url('admin/manage_exam') }}";
            }
          });
       }
       
    }

    function getEditExamModal(examId){
      //BASE_URL is defined in master.blade.php
      $.ajax({
        type: 'GET',
        url: BASE_URL+"/admin/get_exam",
        data: "examId="+examId,
        beforeSend: function(){
          $("#edit-exam-body").html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw" aria-hidden="true"></i></div>');
        },
        success: function(response){
          $("#edit-exam-body").html(response);
        },
        error: function(response){
          alert("Oops please try after some time!");
          window.location.href = "{{ url('admin/manage_exam') }}";
        }
      });
    }
</script>

@endsection