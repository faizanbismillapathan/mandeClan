@extends('admin.layouts.app')
@section('title',"All Default credentials | Admin Mande Clan")

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




                            {{--  <a href="{{url('admin/default-credential/create')}}" class="form-inline float-right mt--1 d-none d-md-flex">
                                       <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create a New Role</button>
                                    </a> --}}

                            <h1 class="h3 mb-3">Default credentials &nbsp;&nbsp;@if(!empty($records))({{$records->total()}})@endif</h1>
                        </div>

                        <div class="card">
                                <div class="card-body">
                                        <div class="row">
                                            <div class="col-md">
                                            {{Form::open(['url'=>['admin/default-credential'],'method'=>'GET'])}}
                                            
@if(!empty($role_names))
                                                {!!Form::select('search',$role_names,null,array('class'=>'form-control select2','placeholder'=>'Search','data-toggle'=>'select2','onchange'=>'this.form.submit()')) !!}
@endif

                                            
                                            {{Form::close()}}
                                            </div>
                                            <div class="col-md">
                                                
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    {{Form::open(['url'=>['admin/default-credential'],'method'=>'GET'])}}

                                                    <div class="input-group">

      {!!Form::text('search',Request::input('search'),array('class'=>'form-control','placeholder'=>'Search by role..','onchange'=>'this.form.submit()','autocomplete'=>'off')) !!}
               
                            <span class="input-group-append">
                  <button class="btn btn-secondary" type="button">Enter!</button>
                </span>                         
                                                    </div>
                                                     {{Form::close()}}

                                                </div>
                                            </div>                                          
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 ajax_response" style="display: none;">
        <div class="alert alert-success">
      <b id="success_message" style="padding: 8px"></b>
     
    </div>
   </div>
                                

                                    <table class="table table-striped table-hover table-sm table-bordered table-responsive" >
                                        <thead>
                                            <tr>
                                                <th width="35%">Role</th>
                                                <th width="25%">Name</th>
                                                <th width="25%">Mobile</th>                                
                                                <th width="25%">Email</th>                                
                                                 <th width="15%">Action</th>                         
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                             


                                            @if(!empty($records))
                                            @foreach($records as $index => $data)
       {{--  {!! Form::model($data,array('url' => ['admin/default-credential', $data->id],'method'=>'PATCH','class'=>'','id' =>'comman_form_id','files'=>'true')) !!}
          {{Form::close()}} --}}
                                            <tr class="deleteRow">

<td>

<span class="badge badge-light">
    @if($data->role==2)
Shop
@elseif($data->role==3)

Customer
@elseif($data->role==4)
Rider/Vehicle

@elseif($data->role==5)
Service

@endif
</span>
                                                 </td>
 <td style="color: #e91e63;text-decoration :underline; " data-toggle="tooltip" data-placement="top" title="Go to Store Panel" class=" clickable-row" data-href="{{ URL::to('seller/dashboard/'.$data->id) }}" data-underline>{{$data->id}} <br>
{{$data->name}} <br>

</td>


                                                 <td>
                                                     {{$data->name}} 
                                                 </td>
[{{-- <td>{!!Form::text('mobile',null,array('class'=>'form-control','autocomplete'=>'off','required')) !!} </td>
<td>{!!Form::text('password',null,array('class'=>'form-control numbersOnly','autocomplete'=>'off','required','maxlength'=>'4','minlength'=>'4')) !!} </td>
<td>                                                    
<input type="submit" name="Update"  class="btn btn-info">                         
</td> --}}]
                                            </tr>

                                          
                                            @endforeach
                                            @endif
                                            
                                        </tbody>
                                    </table>
 <div class="card-body">
    @if(!empty($records))
       {!! $records->appends(request()->query())->render() !!}
@endif
 </div>





                                </div>
                    </div>

                </main> 

@endsection

<!-- ................push new js link................. -->

@push('js')
 <script src="{{asset('public/js/comman.js')}}"></script>
@endpush