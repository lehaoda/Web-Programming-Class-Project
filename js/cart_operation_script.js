//Add to Cart/Added button in Products page
//when click, if exist in cart, then show Added button, 
//else show Add to Cart button and insert into SQL
function add_to_cart(obj){
  if(obj.name!="" && obj.name!=null){
    $.ajax({
        url: 'cart_operation.php',
        type: 'POST',
        data: {
          'check' : 1,
          'title' : obj.name,
        },
        success: function(response){
          if(response == 1){
            //delete from sql
            $.ajax({
              url: 'cart_operation.php',
              type: 'POST',
              data: {
                'delete' : 1,
                'title' : obj.name,
              },
              success: function(response){
                //button format
                $(obj).removeClass();
                $(obj).addClass("btn btn-primary");
                obj.text="Add to Cart";
              }
            });
          }
          else{
            //add to sql
            $.ajax({
              url: 'cart_operation.php',
              type: 'POST',
              data: {
                'insert' : 1,
                'title' : obj.name,
              },
              success: function(response){
                //button format
                $(obj).removeClass();
                $(obj).addClass("btn btn-secondary");
                obj.text="Added";
              }
            });
          }
        }
      });
  }
}


//delete button in cart page
function remove_from_cart(obj){
  if(obj.name!="" && obj.name!=null){
    $.ajax({
        url: 'cart_operation.php',
        type: 'POST',
        data: {
          'check' : 1,
          'title' : obj.name,
        },
        success: function(response){
          if(response == 1){
            //delete from sql
            $.ajax({
              url: 'cart_operation.php',
              type: 'POST',
              data: {
                'delete' : 1,
                'title' : obj.name,
              },
              success: function(response){
                //button format
                alert("removed from cart");
                location.reload();
              }
            });
          }

        }
      });
  }
}


//quantity updare in cart page
function update_quantity(obj){
  //alert($(obj).val());
  //alert(obj.name);
  if(obj.name!="" && obj.name!=null){
    $.ajax({
        url: 'cart_operation.php',
        type: 'POST',
        data: {
          'check' : 1,
          'title' : obj.name,
        },
        success: function(response){
          if(response == 1){
            //delete from sql
            $.ajax({
              url: 'cart_operation.php',
              type: 'POST',
              data: {
                'udpate_quantity' : 1,
                'title' : obj.name,
                'quantity' : $(obj).val(),
              },
              success: function(response){
                //button format
                //alert("updated");
                location.reload();
              }
            });
          }

        }
      });
  }

}


//check out button click, in cart page
function checkout(){
  $.ajax({
    url: 'cart_operation.php',
    type: 'POST',
    data: {
      'checkout' : 1,
    },
    success: function(response){
      alert("checked out");
      //alert(response);
      location.reload();
    }
  });
}


