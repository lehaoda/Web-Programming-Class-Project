$('document').ready(function(event){

//file browser change, preview the source image.
$('#fileupload').on('change',function(){
  var $filesource=$("#fileupload").val();

  if(this.files && this.files[0]){
    var reader = new FileReader();
    reader.onload = function (e){
      $('#fileupload').prev().attr('src', e.target.result);
    }
    reader.readAsDataURL(this.files[0]);
  }
});


//udpate 
$("#form_edit").on('submit', (function(event) {
  var $title = $("#title").text(); 
  event.preventDefault();
  $.ajax({
    url: "edit_item_admin_operation.php?title="+$title,
    type: "POST",
    data:  new FormData(this),
    contentType: false,
    cache: false,
    processData:false,
    success: function(response){
      alert(response);
    },
    error : function(event){
      alert(event);
    }        
  });
}));


//insert
$("#form_insert").on('submit', (function(event) {
  //alert($("#title").val());
  event.preventDefault();
  $.ajax({
    url: "edit_item_admin_operation.php",
    type: "POST",
    data:  new FormData(this),
    contentType: false,
    cache: false,
    processData:false,
    success: function(response){
      alert(response);
      window.location.replace('products.php');
    },
    error : function(event){
      alert("error");
      //alert(event);
    }        
  });
}));


});