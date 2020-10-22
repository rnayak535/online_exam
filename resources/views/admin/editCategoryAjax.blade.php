<form id="editCategoryForm" method="post" action="{{ url('admin/edit_category') }}">
                <div class="form-group">
                  <label>Category Name <span class="text-danger">*</span></label>
                  {{ csrf_field() }}
                  <input type="hidden" name="EditcategoryId" value="{{ $category->id }}">
                  <input name="name" type="text" class="form-control" placeholder="Enter Category Name" value="{{ $category->name }}" required="required">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>