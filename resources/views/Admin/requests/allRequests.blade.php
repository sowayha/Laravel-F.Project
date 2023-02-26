@extends('Admin.admin_master')
@section('admin')


 <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">


                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title"> كل الطلبات </h4><br>


                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>ID</th>
                            @if(Auth::user()->role_id == 1)
                            <th> المستخدم </th>
                            <th> التاريخ </th>
                            <th> اخر تعديل </th>

                            @endif
                            <th>نوع الخدمة</th>
                            <th> عنوان الخدمة </th>
                            <th> وصف الخدمة </th>
                            <th> التكلفة </th>
                            <th> الحالة </th>
                            <th>أجراءات</th>


                        </thead>


                        <tbody>
                        	@php($i = 1)
                        	@foreach($requests as $item)
                        <tr>

                            <td> {{ $i++}} </td>
                            @if(Auth::user()->role_id == 1)
                        <td> {{ $item->reqUser->name }} </td>
                        <td> {{ Carbon\Carbon::parse($item->created_at)->diffForHumans()  }} </td>
                        @if(! $item->updated_at )
                        <td> -------------------- </td>
                        @else

                        <td> {{ Carbon\Carbon::parse($item->updated_at)->diffForHumans()  }} </td>
                        @endif
                        @endif
                            <td> {{ $item->ser->services }} </td>
                            <td> {{ $item->title }} </td>
                            <td> {{ Str::limit($item->description , 50)}} </td>
                            <td> ${{ $item->cost}} </td>
                            <td> {{ $item->status->status}} </td>

                            @if(Auth::user()->role_id == 1)
                            <td>
                            <a href="{{ route('editReq',$item->id) }}" class="btn btn-primary sm" title="Edit Data">  <i class="fas fa-edit"></i> </a>

                            <a href="{{route('deleteReq',$item->id)}}" class="btn btn-danger sm" title="Delete Data" id="delete">  <i class="fas fa-trash-alt"></i> </a>

                            </td>
                            @else

                            <td>
   <a href="{{ route('editReqService',$item->id) }}" class="btn btn-primary sm" title="Edit Data">  <i class="fas fa-edit"></i> </a>

     <a href="{{route('deleteReqService',$item->id)}}" class="btn btn-danger sm" title="Delete Data" id="delete">  <i class="fas fa-trash-alt"></i> </a>

                            </td>
@endif
                        </tr>
                        @endforeach

                        </tbody>
                    </table>

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->



                    </div> <!-- container-fluid -->
                </div>


@endsection
