// Save New Category
$(document).on('submit', '#addNewCategory', function(event){
  event.preventDefault();
    var surl = $(this).attr("action");
    var formData = new FormData(this);
    $.ajax({
      type: 'POST',
      url: surl,
      contentType: false,
      cache: false,
      processData:false,
      data: formData,
      beforeSend: function(){

      },
      success: function(response){
        var responseData = JSON.parse(response);
        alert("Category added successfully");
        window.location.href = responseData.reloadUrl;
      },
      error: function(response){
        alert("Oops please try after some time!");
        var responseData = JSON.parse(response);
        window.location.href = responseData.reloadUrl;
      }
    });
    
});

// Edit Category submit 
$(document).on('submit', '#editCategoryForm', function(event){
  event.preventDefault();
    var surl = $(this).attr("action");
    var formData = new FormData(this);
    $.ajax({
      type: 'POST',
      url: surl,
      contentType: false,
      cache: false,
      processData:false,
      data: formData,
      beforeSend: function(){

      },
      success: function(response){
        alert("Category updated successfully");
        // console.log(response);
        response = JSON.parse(response);
        window.location.href = response.reloadUrl;
      },
      error: function(response){
        alert("Oops please try after some time!");
        // console.log(response);
        response = JSON.parse(response);
        window.location.href = response.reloadUrl;
      }
    });
    
});

// Multiple form submit 
$(document).on('submit', '.ajax_form_submit', function(event){
  var form = this;
  event.preventDefault();
    var surl = $(this).attr("action");
    var formData = new FormData(this);
    $.ajax({
      type: 'POST',
      url: surl,
      contentType: false,
      cache: false,
      processData:false,
      data: formData,
      beforeSend: function(){
        $(form).find(':submit').html($(form).find(':submit').text()+'<i class="fa fa-spinner fa-spin ml-1"></i>');      
      },
      success: function(response){
        // console.log(response);
        response = JSON.parse(response);
        alert(response.message);
        if(response.status != 'false'){
           window.location.href = response.reloadUrl;
        } 
      },
      error: function(response){
        // console.log(response);
        response = JSON.parse(response);
        alert(response.message);
        window.location.href = response.reloadUrl;
      }
    });
    
});

// Works for delete crud operation
function deleteOperation(ele){
  var recordId = $(ele).data('id');
  var deleteUrl = $(ele).data('url');
  var confirmMessage = $(ele).data('msg');
  var confirmation = confirm(confirmMessage);
  if(confirmation){
    $.ajax({
        type: 'GET',
        url: deleteUrl,
        data: "recordId="+recordId,
        beforeSend: function(){
          $(ele).html($(ele).text()+'<i class="fa fa-spinner fa-spin ml-1"></i>');
        },
        success: function(response){
          response = JSON.parse(response);
          alert(response.message);
          window.location.href = response.reloadUrl;
        },
        error: function(response){
          response = JSON.parse(response);
          alert("Oops please try after some time!");
          window.location.href = response.reloadUrl;
        }
      });
  }
}

