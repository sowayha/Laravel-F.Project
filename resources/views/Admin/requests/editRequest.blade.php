@extends('Admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="page-content">
<div class="container-fluid mt-3">

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title"> تعديل الخدمة </h4><br>

                        @if(count($errors))
                @foreach ($errors->all() as $error)
                <p class="alert alert-danger alert-dismissible fade show"> {{ $error}} </p>
                @endforeach

            @endif

            <form method="post" action="{{route('updateReqService')}}" >  
                @csrf


                <input type="hidden" name="id" value="{{ $req->id }}">


         <div class="row mb-3">
        <label for="example-text-input" class="col-sm-2 col-form-label">تغيير الخدمة </label>
        <div class="col-sm-10">
        <select name="service_id" class="form-select" aria-label="Default select example">
            <option selected="{{ $req->service_id }}" disabled selected>Choose Service</option>
            @foreach($service as $ser)
            <option value="{{ $ser->id}}">{{ $ser->id == $ser->service_id ? 'Selected' : '' }} {{ $ser->services }}</option>
            @endforeach
            </select>
               </div>
            </div>
            <!-- end row -->

            
            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label"> اسم الخدمة </label>
                <div class="col-sm-10">
                    <input name="title" class="form-control" type="text" value="{{$req->title}}"  id="example-text-input">
                </div>
            </div>
            <!-- end row -->

              <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label"> وصف الخدمة </label>
                <div class="col-sm-10">
                    <input name="description" class="form-control" type="text" value="{{$req->description}}"  id="example-text-input">
                </div>
            </div>
            <!-- end row -->

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label"> التكلفة ($)</label>
                <div class="col-sm-10">
                    <input name="cost" class="form-control" type="text" value="{{$req->cost}}"  id="example-text-input">
                </div>
            </div>
            <!-- end row -->

            <div class="row mb-3">
        <label for="example-text-input" class="col-sm-2 col-form-label"> الحالة  </label>
        <div class="col-sm-10">
        <select name="status_id" class="form-select" aria-label="Default select example">
            <option  disabled selected>Choose Status</option>
            @foreach($status as $stat)
            <option value="{{ $stat->id}}">{{ $stat->id == $stat->stat_id ? '' : '' }} {{ $stat->status }}</option>
            @endforeach
            </select>
               </div>
            </div>
            <!-- end row -->

           
           
            <br>





              

<input type="submit" class="btn btn-primary  waves-effect waves-light" value="تحديث">
            </form>



        </div>
    </div>
    <br>
</div> <!-- end col -->



</div>



</div>
</div>

@endsection