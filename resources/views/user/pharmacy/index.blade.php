@extends('layouts.user')

@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> حسابي </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                
                            <li class="breadcrumb-item active"> حسابي
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- DOM - jQuery events table -->
            <section id="dom">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">بيانات الصيدلية</h4>
                                <a class="heading-elements-toggle"><i
                                        class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                            @include('user.includes.alerts.success')
                            @include('user.includes.alerts.errors')

                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <table
                                        class="table display nowrap table-striped table-bordered scroll-horizontal">
                                        <thead>
                                        <tr>
                                            <th> اسم الصيدلية </th>
                                            <th>الشعار</th>
                                            <th>الرخصة</th>
                                            <th>العنوان</th>
                                            <th>تفاصيل العنوان</th>
                                            <th>التواصل الاجتماعي</th>
                                            <th>الهاتف 1</th>
                                            <th>الهاتف 2</th>
                                            <th>الحالة</th>
                                            <th>الإجراءات</th>
                                        </tr>
                                        </thead>   
                                        <tbody>
                                            @isset($pharamcys)
                                            @foreach($pharamcys as $pharamcy)  
                                                <tr>
                                                    <td>{{$pharamcy->name}}</td>
                                                    <td><img style="width: 150px; height: 100px;" src="{{get_url_image($pharamcy->photo)}}"></td>
                                                    <td><a href="{{get_url_pdf($pharamcy->pdf_path)}}">تنزيل</a></td>
                                                    <td>{{$pharamcy->address}}</td>
                                                    <td>{{$pharamcy->adderss_details}}</td>
                                                    <td>{{$pharamcy->social_media}}</td>
                                                    <td>{{$pharamcy->mobile1}}</td>
                                                    <td>{{$pharamcy->mobile2}}</td>
                                                    <td>{{$pharamcy->getActive()}}</td>
                                                    {{-- <td>{{$pharamcy->c}}</td> --}}
                                                
                                                    <td>
                                                        <div class="btn-group" role="group"
                                                             aria-label="Basic example">
                                                            <a href="{{route('user.pharmacy.edit',$pharamcy->id)}}" class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>


                                                            <a href="" onclick="event.preventDefault();
                                                            document.getElementById('form').submit();" class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1"> حذف </a>
                                                              
                                                            <form id="form" action="{{route('user.pharmacy.delete',$pharamcy->id)}}" method="POST" class="d-none">
                                                                @method('delete')
                                                                @csrf
                                                            </form>

                                                            {{-- <a href="{{route('user.pharmacy.show',$pharamcy->id)}}"
                                                                class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                                                عرض الادوية      
                                                            </a>      --}}

                                                          {{-- <a href=""
                                                                class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                                                 @if($vendors->active == 0)
                                                                     تفعيل
                                                                     @else
                                                                     الغاء تفعيل
                                                                 @endif
                                                             </a>
                                                            --}}
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endisset  
                                        </tbody> 
                                    </table>
                                    <div class="justify-content-center d-flex">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

    
@endsection