<form id="" method="post" action="{{ url('admin/edit_student') }}" class="ajax_form_submit">
    <div class="form-group">
        <label>Enter Name <span class="text-danger">*</span></label>
        {{ csrf_field() }}
        <input name="name" type="text" class="form-control" value="{{ $student->name }}" placeholder="Enter student name" required="required">
    </div>
    <div class="form-group">
        <label>Enter E-mail <span class="text-danger">*</span></label>
        <input name="email" type="email" class="form-control" value="{{ $student->email }}" placeholder="Enter student email" required="required">
    </div>
    <div class="form-group">
        <label>Enter Mobile No <span class="text-danger">*</span></label>
        <input name="mobile_no" type="number" class="form-control" value="{{ $student->mobile_no }}" placeholder="Enter mobile number" required="required">
    </div>
    <div class="form-group">
        <label>Select DOB <span class="text-danger">*</span></label>
        <input type="date" name="dob" placeholder="Enter DOB" value="{{ $student->dob }}" required="required" class="form-control">
    </div>
    <div class="form-group">
        <label>Select Exam<span class="text-danger">*</span></label>
        <select name="exam" id="" required="required" class="form-control">
        <option value="">Select exam</option>
        @foreach($exams as $singleExam)
        <option value="{{ $singleExam['id'] }}" <?=($student->exam == $singleExam["id"])?'selected':''; ?>>{{ $singleExam['title'] }}</option>
        @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Enter Password <span class="text-danger">*</span></label>
        <input type="password" name="password" placeholder="Enter password" value="{{ $student->password }}" required="required" class="form-control">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Add </button>
    </div>
</form>