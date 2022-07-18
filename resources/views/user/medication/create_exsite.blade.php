\@extends('layouts.user')

@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form"> إضافة دواء </h4>
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
                                <div class="card-body">
                                    <form class="form" action="{{route('user.medication.store.exists')}}"
                                          method="POST"
                                          enctype="multipart/form-data">
                                        @csrf
                                       

                                        <div class="form-body">

                                            <h4 class="form-section"><i class="ft-home"></i> بيانات الدواء </h4>

                                            


                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label for="projectinput1">الكمية</label>
                                                        <input type="number" id="quntity"
                                                               class="form-control"
                                                               placeholder="" name="quntity">

                                                        @error("quntity")
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label for="projectinput1">السعر</label>
                                                        <input type="number" id="price"
                                                               class="form-control"
                                                               placeholder="" name="price">

                                                        @error("price")
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2"> أختر القسم  </label>
                                                            <select onchange="load_medication(value)" name="categories_id" class="select2 form-control">
                                                                <optgroup label=" من فضلك أختر القسم ">
                                                                    <option>اختر</option>
                                                                    @if($catgorys && $catgorys-> count() > 0)
                                                                        @foreach($catgorys as $catgory)
                                                                            <option
                                                                                value="{{$catgory->id }}">{{$catgory->name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error('categories_id')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2"> أخترالدواء  </label>
                                                            <select name="medication_id" id="medications" class="select2 form-control">
                                                                <option>اختر</option>
                                                                @isset($data['medication'])
                                                                 @foreach($data['medication'] as $m)
                                                                    <option
                                                                 {{ $medication_id == $m->id ? "selected" : "" }} value="{{ $m->id }}">{{ $m->trade_name }}
                                                                     </option>
                                                                  @endforeach
                                                                @endisset
                                                            </select>
                                                            @error('medication_id')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
    
    
                                                </div>

                                               


                                            </div>
 

                                            <div class="row">
                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> تاريخ الانتاج  </label>
                                                        <input type="date" id="production_date"
                                                               class="form-control"
                                                               placeholder="  " name="production_date">

                                                        @error("production_date")
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label for="projectinput1">تاريخ الانتهاء</label>
                                                        <input type="date" id="expiry_date"
                                                               class="form-control"
                                                               placeholder="  " name="expiry_date">

                                                        @error("expiry_date")
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>                                        

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mt-1">
                                                    <input type="checkbox" value="1"
                                                           name="active"
                                                           id="switcheryColor4"
                                                           class="switchery" data-color="success"
                                                           checked/>
                                                    <label for="switcheryColor4"
                                                           class="card-title ml-1">الحالة </label>

                                                    @error("active")
                                                    <span class="text-danger"> </span>
                                                    @enderror
                                                </div>
                                            
                                         </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput2"> أختر الصيدلية  </label>
                                                    <select name="mypharmacy_id" class="select2 form-control">
                                                        <optgroup label=" من فضلك أختر الصيدلية ">
                                                            @if($mypharmacys && $mypharmacys-> count() > 0)
                                                                @foreach($mypharmacys as $mypharmacy)
                                                                    <option
                                                                        value="{{$mypharmacy->id }}">{{$mypharmacy->name}}</option>
                                                                @endforeach
                                                            @endif
                                                        </optgroup>
                                                    </select>
                                                    @error('mypharmacy_id')
                                                    <span class="text-danger"> {{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                           
                                           </div>
                                              
                                         
                                        

                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1"
                                                    onclick="history.back();">
                                                <i class="ft-x"></i> تراجع
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> حفظ
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
</div>

@endsection

@push('scripts')

@include('layouts.js.load_medications')


@endpush



   
