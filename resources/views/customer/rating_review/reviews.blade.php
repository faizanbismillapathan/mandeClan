@extends('customer.layouts.app')
@section('title',"Create New Review| customer Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
@endsection

<!-- ................Add css link................. -->

@push('style')
       <link rel="stylesheet" href="{{asset('public/css/bootstrap-fileupload.css')}}">

@endpush

<!-- ................body................. -->
@section('innercontent')


<main class="content">
    <div class="container-fluid p-0">
        <div class="clearfix">
            <a href="{{url('customer/reviews')}}" class="form-inline float-right mt--1 d-none d-md-flex">
                <button class="btn btn-info"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Back</button>
            </a>

            <h1 class="h3 mb-3"><b>Create Reviews</b></h1>

        </div>
        <div class="card">

            <div class="card-body">

               {!!Form::open(['url'=>['customer/store_review_add'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}


               <div class="row ">

               <div class="form-group col-md-5 ">
                  <label for="inputEmail4">Select Rating</label>

                  {{Form::hidden('rating',null,array('id'=>'start'))}}   
                  <div class="container_rat">
                      <ul id="starRating" data-stars="5">
                      </ul>
                  </div>
        <input type="hidden" name="suborder_id" value="{{$suborder_id}}">

              </div>





        <div class="form-group col-md-8">
          <label for="inputPassword4">Store description</label>
          {!! Form::textarea('reviews',null,['class'=>'form-control textarea', 'rows' => 6, 'cols' => 50,'id'=>'']) !!}
      </div>
       <div class="form-group col-md-4 ">
               <div class="form-group author-img-bx">

                <label>Attachment</label>             
                
                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new img-thumbnail" style="width: 180px; height: 120px;">
                       <img src="{{ asset('public/img/no-image.png')}}" alt="dd" />
                   </div>
                   <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 180px; max-height: 120px; line-height: 20px;"></div>
                   <div class="row">
                       <div class="col-md-12">
                          <button type="button" class="btn btn-secondary" style="padding: 0px; background-color: #fff;"><span class="btn btn-default btn-file">
                            <span class="btn btn-secondary fileupload-new">Choose image</span>
                            <span  class="btn btn-secondary fileupload-exists">Change</span>

                            {{ Form::file('attachment',null, ['class' => 'form-control','required']) }}</span>

                            <a class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a></button>

                        </div>

                    </div>
                </div>
            </div>
            
        </div>

 </div>   

      <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>   Submit</button>



      <a class="btn" href="{{url('customer/order-history')}}" style="background-color: #9e9b9b;color: #fff"><i class="fas fa-times"></i>  Cancel</a>
  </div>              
            
  {{Form::close()}}
</div>
</div>

</main>
@endsection

<!-- ................push new js link................. -->

@push('js')
<script type="text/javascript" src="{{ asset('public/js/bootstrap-fileupload.min.js') }}"></script>

<script src="{{asset('public/js/validation.js')}}"></script>

<script src="{{asset('public/basic-ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace( 'reviews');
</script>


<script>
  (function ($) {
    $.fn.starRating = function (options) {
        var settings = $.extend({
            stars: 5,
            current: 0,
            callback: function (value) {
            },
            static: false
        }, options);

        var $ul = this;
        var $li = $('<li class="star"><i class="fa fa-star"></i></li>');

        if ($ul.hasClass('starrating-init')) {
            return;
        }

        if (this.attr('data-current')) {
            settings.current = this.attr('data-current');
        }

        if (this.attr('data-stars')) {
            settings.stars = this.attr('data-stars');
        }

        if (this.attr('data-static')) {
            settings.static = (this.attr('data-static') === '1' || this.attr('data-static') === 'true') ? true : settings.static;
        }

        for (var i = 0; i < settings.stars; i++) {
            var $clone = $li.clone();
            if (settings.current && i < settings.current) {
                $clone.addClass('active')
            }

            $ul.append($clone);
        }
        this.addClass('starrating-init');

        if (!settings.static) {
            $ul.find('li').on('click', function () {
                if ($(this).hasClass('last')) {
                    $ul.find('li.active').removeClass('active last');
                    settings.callback(0);
                    return;
                }
                $ul.find('li.active').removeClass('active last');
                $(this).addClass('active last');
                $(this).prevAll().addClass('active');

                var selected = $ul.find('li.active').length;
                settings.callback(selected);
            }).hover(function () {
                $ul.addClass('hover');
                $(this).addClass('hover');
                $(this).prevAll().addClass('hover');
            }, function () {
                $ul.removeClass('hover');
                $(this).removeClass('hover');
                $(this).prevAll().removeClass('hover');
            });
        }

        return this;
    };
}(jQuery));
</script> 
<script>
    (function( $ ) {
        $('#starRating').starRating({
           callback: function (value) {
       // alert('You Just Clicked: '+value);
       $("#start").val(value)
   }})
    }(jQuery))
</script>

@endpush