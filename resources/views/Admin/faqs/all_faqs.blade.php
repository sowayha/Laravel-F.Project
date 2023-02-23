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

                    <h4 class="card-title">كل الاسئلة</h4><br>


                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>السؤال</th> 
                            <th>الاجابة</th>
                            <th>أجراءات</th>

                        </thead>


                        <tbody>
                        	@php($i = 1)
                        	@foreach($faqs as $item)
                        <tr>
                            <td> {{ $i++}} </td>
                            <td> {{ $item->question }} </td>
                            <td> {{ $item->answer }} </td>                          

                            <td>
   <a href="{{route('editFaqs', $item->id)}}" class="btn btn-primary sm" title="Edit Data">  <i class="fas fa-edit"></i> </a>

     <a href="{{route('deleteFaqs', $item->id)}}" class="btn btn-danger sm" title="Delete Data" id="delete">  <i class="fas fa-trash-alt"></i> </a>

                            </td>

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