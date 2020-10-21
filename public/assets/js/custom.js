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