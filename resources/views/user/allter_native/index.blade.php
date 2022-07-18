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
                                <h4 class="card-title"> بيانات الدواء البديل</h4>
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
                                            <th> اسم التجاري الدواء </th>
                                            <th>الاسم العلمي الدواء</th>
                                            <th>الشعار</th>
                                            <th>البلد المصنع</th>
                                            <th>السعر </th>
                                            <th>الكمية</th>
                                            <th>تاريخ  الانتاج</th>
                                            <th> تاريخ الانتهاء</th>
                                            <th>الحالة</th>
                                            <th>الإجراءات</th>
                                        </tr>
                                        </thead>   
                                        <tbody>
                                            @if($MedicationArry and count($MedicationArry)>0)
                                            
                                            @foreach($MedicationArry as $Medication)  
                                                <tr>
                                                    <td>{{$Medication['trade_name']}}</td>
                                                    <td>{{$Medication['scientific_name']}}</td>
                                                    <td><img style="width: 150px; height: 100px;" src="{{get_url_image($Medication['photo'])}}"></td>
                                                    <td>{{$Medication['made_in']}}</td>
                                                    <td>{{$Medication['pric']}}</td>
                                                    <td>{{$Medication['quntity']}}</td>
                                                    <td>{{$Medication['production_date']}}</td>
                                                    <td>{{$Medication['expiry_date']}}</td>
                                                    <td>{{$Medication['status']}}</td>
                                                    {{-- <td>{{$pharamcy->c}}</td> --}}
                                                
                                                    <td>
                                                        <div class="btn-group" role="group"
                                                             aria-label="Basic example">
                                                             <a href="{{route('user.allter_native.show',$Medication['medication_id'])}}"
                                                                class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                                               عرض الدواء الرئيسي   
                                                            </a>  
                                                            <a href="{{route('user.allter_native.edit',$Medication['id'])}}" class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>

                                                            <a href="" onclick="event.preventDefault();
                                                            document.getElementById('form').submit();" class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1"> حذف </a>
                                                              
                                                            <form id="form" action="{{route('user.allter_native.delete',$Medication['id'])}}" method="POST" class="d-none">
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
                                                @endif  
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