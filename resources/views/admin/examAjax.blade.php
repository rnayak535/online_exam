<form id="" method="post" action="{{ url('admin/edit_exam') }}" class="ajax_form_submit">
                <div class="form-group">
                  <label>Enter Title <span class="text-danger">*</span></label>
                  {{ csrf_field() }}
                  <input name="title" type="text" class="form-control" value="{{ $exams->title }}" placeholder="Enter Exam Name" required="required">
                </div>
                <div class="form-group">
                  <label>Select Exam Date <span class="text-danger">*</span></label>
                  <input name="exam_date" type="date" value="{{ $exams->exam_date }}" class="form-control" required="required">
                </div>
                <div class="form-group">
                  <label>Select Exam Category <span class="text-danger">*</span></label>
                  <select name="categoryId" id="" required="required" class="form-control">
                    <option value="">Select Category</option>
                    @foreach($category as $singleCategory)
                    <option value="{{ $singleCategory['id'] }}" <?=($exams->category==$singleCategory['id'])?'selected':'';?> >{{ $singleCategory['name'] }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>