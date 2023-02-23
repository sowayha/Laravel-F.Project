@extends('Admin.admin_master')
@section('admin')

        
  
<div class="content_wrapper">
    <!--middle content wrapper-->
    @php
    $id = Auth::user()->id;
    $adminData = App\Models\User::find($id);
    @endphp

    <h4 class="ml-5 mt-4">اهلا,  {{ $adminData->name }}  </h4>
    <p class="ml-5">يمكنك إدارة الموقع عن طريق لوحة التحكم .
</p>

     




    <div class="middle_content_wrapper">
         
        </section>                   
    </div><!--/middle content wrapper-->
</div><!--/ content wrapper -->


@endsection








