
@extends('frontend.master')
@section('frontend')




<main id="main">

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
  <div class="container">

    <ol class="mt-3">
      <li><a href="{{route('home')}}"> الرئيسة </a></li>
      <li><a href="{{ route('front.reqPage')}}"> الخدمات المطلوبة </a></li>
      <li> تفاصيل الخدمة  </li>
    </ol>
    <h2 class="title">  {{ $req->title }}  </h2>

  </div>
</section><!-- End Breadcrumbs -->

<section class="inner-page">
<div class="container d-md-flex">
   <!-- Page Content  -->







   <div id="content" class="">


   <div class="card">
  <div class="card-body">

    <button class="btn btn-outline-primary req-ser"> {{$req->ser->services}} </button>
    <h5 class="card-title"> {{$req->title}} </h5>
    <h6 class="card-text mt-5"> {{$req->description}}</h6>
    <hr class="hr" />
    <button  class="btn btn-outline-primary"> اسم المستخدم: {{$req->reqUser->name}}  </button>
    <button  class="btn btn-outline-primary"> التكلفة: ${{$req->cost}} </button>
    <button  class="btn btn-outline-primary"> الحالة: {{$req->status->status}} </button>

    <p class="req-date">{{ Carbon\Carbon::parse($req->created_at)->diffForHumans() }}</p>
  </div>


</div>
<br>




    <div class="card">
   <div class="card-body">
    <h5 class="card-title">  اضف عرضك الان </h5>
    <br>


@if (Auth::check())


@if (isset($error))
    <div class="col-sm-12">
        <div class="alert  alert-danger alert-dismissible fade show" role="alert">
          $error
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
    </div>
@endif


    <form class="mb-5" method="post" id="contactForm" name="contactForm" action="{{route('addQuote')}}">
        @csrf
        <input type="hidden" name="req_id" value="{{$req->id}}">
                <input type="hidden" name="user_id" value="{{$user->id}}">


        <div class="row">
          <div class="col-md-12 form-group mb-3">

            <input type="date" class="form-control" name="req_deadline" id="req_deadline" placeholder=" تاريخ التسليم " required>
          </div>

        </div>

        <div class="row">
          <div class="col-md-12 form-group mb-3">

            <input type="text" class="form-control" name="cost" id="cost" placeholder=" التكلفة ($) " required>
          </div>
        </div>

        <div class="row mb-5">
          <div class="col-md-12 form-group mb-3">

            <textarea class="form-control" name="message" id="message" cols="30" rows="4"  placeholder=" الرسالة " required></textarea>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-5 form-group text-center">
            <input type="submit" value=" إرسال " class="btn btn-outline-primary w-50">
            <span class="submitting"></span>

            @if(session()->has('success'))
            <div class="alert alert-dismissable alert success" style="background: white;">
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>
                    {!! session()->get('success') !!}
                </strong>
            </div>

        @endif

          </div>
        </div>
      </form>

      @else

      <hr class="hr" />
   <div class="reqLogin">
    <a href="{{ route('register') }}" class="btn btn-outline-primary">  حساب جديد </a>
    <a href="{{ route('login') }}" class="btn btn-outline-primary"> دخول </a>
   </div>
    @endif

   </div></div>
<br>



   <div >




    <h5 class="card-title">  {{$title}} </h5>
    <br>





     @foreach($quotes as $item)

     <div id="content" class="">


     <div class="card">
    <div class="card-body">

      <a href="" class="btn btn-outline-primary req-ser"> وظفني </a>
      <h5 class="card-title mt-5"> {{$item->message}} </h5>

<br>

      <hr class="hr" />
      <h5 class="btn btn-outline-primary"> اسم مقدم الخدمة:  {{$item->quoteUser->name}} </h5>
      <h5 class="btn btn-outline-primary"> التكلفة: ${{$item->cost}} </h5>
      <h5 class="btn btn-outline-primary"> تاريخ التسليم: {{$item->req_deadline}} </h5>


      <p class="req-date">{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</p>
    </div>


  </div>
  <br>
  @endforeach






 </div>
   </div>












  </div>
</section>

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container" data-aos="zoom-in">

        <div class="row">
          <div class="col-lg-6 text-center text-lg-start">
            <h3>{{$cta->title}}</h3>
            <p> {{$cta->description}}</p>
          </div>
          <div class="col-lg-6 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="{{ route('register') }}">سجل كمستخدم</a>
            <a class="cta-btn align-middle" href="{{ route('register') }}">سجل لتصبح مقدم خدمة</a>
          </div>
        </div>

      </div>
    </section><!-- End Cta Section -->

</main><!-- End #main -->


@endsection
