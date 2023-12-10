@extends('frontend.layouts.app')
@section('title',"Online Shopping site in US: Shop Online for Mobiles, Books, Watches, Shoes and More - mandeclan.com")
<!-- ................Add meta ................ -->


@section('meta')
@endsection

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
       .showWhenCityNot{
    display: block !important;
}

 @media (max-width: 480px) {
    .showWhenCityNot{
    display: none !important;
    }
  }
 .first-navbar .btn.btn-light ,.mande-main-category.padding{
        display: none !important;
    }
      .mande-main-category{
        display: none!important;
    }
    .padding{
        padding: 20px;
    }
    
    .product-list .addons .span {
    font-size: 12px;
    color: #008000;
    border: 1px solid #008000;
        padding: 2px 4px;
    border-radius: 4px;
}


    /*Adil Css*/
    
    
    
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

divCoupon {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
/**/

</style>
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body................. -->
@section('innercontent')

<div class="category-listing-div card-detail-page addToCards pt-3" >
    <div class="container" id="myViewCart" onbeforeunload="HandleBackFunctionality()">
<!--  -->
@include('frontend.view_cart_list')
</div>
</div>
<!--  -->
<div class="mobile-device">
    <h4 class="logo">Mande-Clan</h4>
    <h4 class="h4">Buy Online Marketplace from Online Marketplace Shop Near by You</h4>
    <div class="center">
        <button class="btn btn-raised btn-light">Download Today</button>
    </div>
    <div class="app-link-img">
        <img src="{{url('/')}}/public/frontend/img/goggle-play-store.png">
        <img src="{{url('/')}}/public/frontend/img/apple-store.png">
    </div>
    <div class="mobile-footer">
        <p>All rights reserved @ 2019 Mande Clan</p>
    </div>
</div>                             

</body>
@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/comman.js')}}"></script>


<script type="text/javascript">

var perfEntries = performance.getEntriesByType("navigation");

if (perfEntries[0].type === "back_forward") {
    location.reload(true);
}




//     window.onpopstate = function(event) {

//         alert('1')
//   // alert("location: " + document.location + ", state: " + JSON.stringify(event.state));
//   // const urlParams = new URLSearchParams(window.location.search);
//   // const myParam = urlParams.get('myParam');
//   // //update model accordingly

//   // location.reload()

// };

// window.addEventListener('popstate', e => {    console.log(e.state);})




// history.pushState({page: 1}, "title 1", "?page=1");
// history.pushState({page: 2}, "title 2", "?page=2");
// history.replaceState({page: 3}, "title 3", "?page=3");
// history.back(); // alerts "location: http://example.com/example.html?page=1, state: {"page":1}"
// history.back(); // alerts "location: http://example.com/example.html, state: null
// history.go(2);  // alerts "location: http://example.com/example.html?page=3, state: {"page":3}
// window.onhashchange = function() {
//   alert("pop");

// // }
//     $(window).on('pushState', function(event) {
//  alert("pop");
// });

//     $(window).on('pushstate', function(event) {
//     alert("push");
// }); // This one pushes u to forward page through history...


// $(window).on('popstate', function(event) {
//   alert("You are going to back page. Can work that?");
// });
// window.onpopstate = function() {alert(1);}; history.pushState({}, '');


          $(document).ready(function() {

   //    $(window).on('popstate', function() {
   //    location.reload(true);
   // });

  

        $('.addToCards').on('click','.addtocard',function(){

            var id=$(this).attr('data');
            
            $("#counter-div"+id).show();
            $("#addtocard"+id).hide();

$("#theCount"+id).text(1);
$("#theCountVal"+id).val(1);

alert("{{url('addcartitembyajax')}}?item_id="+id+"&quantity="+1)


            $.ajax({
           type:"GET",
           url:"{{url('addcartitembyajax')}}?item_id="+id+"&quantity="+1,
           beforeSend: function(){
              $("#loader").show();
           },
           success:function(res){ 
                // console.log(res);
              // $("#mydiv"+id).load(location.href + " #mydiv"+id);

 $('#changecartcounter').text('');
              $('#changecartcounter').text(res.counter);           },
           complete:function(data){
                $("#loader").hide();
           }
         });


            });
// ..........................

       $('#modal_delete').on('click',function(){
        

            $.ajax({
           type:"GET",
           url:"{{url('removecarts')}}",
           beforeSend: function(){
              $("#loader").show();
           },
           success:function(res){ 
               var getUrl = "{{url('/'.Session::get('locality_url'))}}";  
     window.location.href = getUrl;

        },
           complete:function(data){
                $("#loader").hide();
           }
         });


            });

// .................

        $('.addToCards').on('click','.permanantyremoveitem',function(){

            var item_id = $(this).attr('data_id');

// $("#counter-div"+item_id).hide();
// $("#addtocard"+item_id).show();
// var quantity = parseInt(priquantity) + 1;

            var priquantity = $(this).parents('.parent_cls').find('.theCount').text();


$("#theCount"+item_id).text(0);
$(this).parents('.parent_cls').find('.qty-input').val(0);

var seturl = "{{url('removecartproduct')}}?item_id="+item_id;

 $.ajax({
           type:"GET",
           url:seturl,
           beforeSend: function(){
              $("#loader").show();
            },
           success:function(res){ 
                // console.log(res,'res');
           
              $('#changecartcounter').text('');
              $('#changecartcounter').text(res.counter);

              location.reload();

           },
           complete:function(data){
            $("#loader").hide();
           }
         });


})
// .......................................................................
        $('.addToCards').on('click','.changeitemquantity',function(){


        var attribute = $(this).attr('data'); 
            var item_id = $(this).attr('data_id');
            var element = $(this).parent().closest('form').serialize();

            var priquantity = $(this).parents('.parent_cls').find('.theCount').text();

           console.log(priquantity,'priquantity')




         if(attribute == 'addition'){

            if(parseInt(priquantity) < 10 )
{
           var quantity = parseInt(priquantity) + 1;


$("#theCount"+item_id).text(quantity);
$(this).parents('.parent_cls').find('.qty-input').val(quantity);

console.log(quantity,'quantity')

           var seturl = "{{url('updatecartviewproductajax')}}?item_id="+item_id+"&mainqty="+1;

}
         }else{


          if(priquantity != 1){

            var quantity = parseInt(priquantity) - 1;

$("#theCount"+item_id).text(quantity);
$(this).parents('.parent_cls').find('.qty-input').val(quantity);


var seturl = "{{url('updatecartviewproductajax')}}?item_id="+item_id+"&mainqty="+-1;


          }else{

// $(this).prop('disabled', true);;
// alert(item_id)
// $("#counter-div"+item_id).hide();
// $("#addtocard"+item_id).show();


// $("#theCount"+item_id).text(quantity);
// $(this).parents('.parent_cls').find('.qty-input').val(quantity);



// var seturl = "{{url('removecartproduct')}}?item_id="+item_id;

          } 


         }

                 if(parseInt(priquantity) < 10 )
{
    
         $.ajax({
           type:"GET",
           url:seturl,
           beforeSend: function(){
              $("#loader").show();
            },
           success:function(res){ 
                // console.log(res,'res');
           
             $("#myViewCart").html('');
         $("#myViewCart").html(res.loadbutton);




              $('#changecartcounter').text('');
              $('#changecartcounter').text(res.counter);
           },
           complete:function(data){
            $("#loader").hide();
           },
           error:function(err){
           console.log(err)
           }
         });

     }
      });
 });

      </script>
@endpush


