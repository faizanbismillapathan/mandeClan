@extends('admin.layouts.app')
@section('title',"Email Setting | Admin Mande Clan")

<!-- ................custom css................. -->

@section('customStyle')
@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

<!-- ................body................. -->
@section('innercontent')

<main class="content">
    <div class="container-fluid p-0">

        <div class="clearfix">

            <h1 class="h3 mb-3">Mail Settings</h1>
        </div>

        <div class="card">
            <div class="card-body">
                        {!!Form::open(['url'=>['admin/mail-setting'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

             <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Sender Name:</label>
                    {!!Form::text('MAIL_FROM_NAME',env('MAIL_FROM_NAME'),array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required')) !!} 
                </div>


                <div class="form-group col-md-4">
                    <label for="inputEmail4">Mail Driver: (ex. smtp,sendmail,mail)</label>
                    {!!Form::text('MAIL_DRIVER',env('MAIL_DRIVER'),array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required')) !!} 
                </div>


                <div class="form-group col-md-4">
                    <label for="inputEmail4">Mail Address: (ex. user@info.com)</label>
                    {!!Form::text('MAIL_FROM_ADDRESS',env('MAIL_FROM_ADDRESS'),array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required')) !!} 
                </div>


                <div class="form-group col-md-4">
                    <label for="inputEmail4">Mail Host: (ex. smtp.gmail.com)</label>
                    {!!Form::text('MAIL_HOST',env('MAIL_HOST'),array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required')) !!} 
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail4">Mail PORT: (ex. 467,587,2525)</label>
                    {!!Form::text('MAIL_PORT',env('MAIL_PORT'),array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required')) !!} 
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail4">Mail Username: (info@gmail.com)</label>
                    {!!Form::text('MAIL_USERNAME',env('MAIL_USERNAME'),array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required')) !!} 
                </div>


                <div class="form-group col-md-4">
                    <label for="inputEmail4">Mail Password:</label>
                    {!!Form::text('MAIL_PASSWORD',env('MAIL_PASSWORD'),array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required')) !!} 
                </div>


                <div class="form-group col-md-4">
                    <label for="inputEmail4">Mail Encryption: (ex. TLS,SSL,OR Leave blank)</label>
                    {!!Form::text('MAIL_ENCRYPTION',env('MAIL_ENCRYPTION'),array('class'=>'form-control','placeholder'=>'','autocomplete'=>'off','required')) !!} 
                </div>

            </div>
            <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i>  Update</button>


             {{Form::close()}}

        </div>
    </div>
</div>

</main> 

@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/comman.js')}}"></script>
@endpush