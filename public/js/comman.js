$(function() {

var location=window.location.origin;
var pathname= window.location.pathname;
var foldername=window.location.pathname.split("/")[1];

var url_loc = window.location.href; 

var base_url=location+pathname+'/';
var base_url111=location+'/'+foldername+'/';

// console.log(location,'location')
// console.log(pathname,'pathname')
// console.log(foldername,'foldername')
// console.log(url_loc,'url_loc')
// console.log(base_url+'delete')

// console.log(base_url111,'base_url111')

// .....................................foldername

 $(".click_disbled").click(function(){


   var data=$(this).attr('data');
   console.log(base_url+'delete')

   var clickDisbled = $(this);

 var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
swal({
  title: 'Are you sure?',
  text: "You want to delete this record! ",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
},
     function() {
                  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});

    $.ajax({
           type:"POST",
           
           url:base_url+'delete',
           data:{_token: CSRF_TOKEN, id:data},
           dataType:'JSON',
        
            
            complete: function(){
        
                     clickDisbled.parents('.deleteRow').fadeOut(1500);
                
             swal(
      'Deleted!',
      'Your record has been deleted.',
      'success'
    );
             },

             error: function (data) {

console.log(data)

             }


        });
  });
  });




// .........................base_url

})


 function updateToggle(userid) {
    // alert(window.location.origin+window.location.pathname+"/status_update")

 var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


       $.ajax({
           type:"post",
           url:window.location.origin+window.location.pathname+"/status_update",
           data:{_token: CSRF_TOKEN, user_id:userid},
           dataType:'JSON',
           dataType: 'json',
           success:function(res){ 

  var data= "your status is "+res;       


                  var message = data;
                  var title = $('#toastr-title').val() || '';
                  if (res=='Deactive') {
                    var type = 'error';
                  }else if(res=='Active'){
                        var type = 'success';
                  }
                  toastr[type](message, title, {
                    positionClass: $('input[name="toastr-position"]:checked').val(),
                    closeButton: 'true',
                    progressBar:'true',
                    newestOnTop: 'true',
                    rtl: $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl',
                    timeOut: $('#toastr-duration').val()
                  });
               
         }
       });
    };
