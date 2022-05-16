@extends('layouts.user')

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
                                <h4 class="card-title" id="basic-layout-form"> إضافة متجر </h4>
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
                                    <form class="form" action="{{route('user.pharmacy.update',$pharmacy->id)}}"
                                          method="POST"
                                          enctype="multipart/form-data">
                                        @method('put')
                                        @csrf
                                        <input name="id" value="{{$pharmacy->id}}" type="hidden">
                                        <div class="form-group">
                                            <div class="text-center">
                                                <img
                                                    src="{{get_url_image($pharmacy->photo)}}"
                                                    class="rounded-circle  height-150" alt="صورة القسم  ">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label> شعار التجار </label>
                                            <label id="projectinput7" class="file center-block">
                                                <input type="file" id="file" name="photo">
                                                <span class="file-custom"></span>
                                            </label>
                                            @error('photo')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-body">

                                            <h4 class="form-section"><i class="ft-home"></i> بيانات الصيدلية </h4>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> اسم الصيدلية </label>
                                                        <input type="text" value="{{$pharmacy->name}}" id="name"
                                                               class="form-control"
                                                               placeholder=" "
                                                               name="name">
                                                        @error("name")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            
                                            </div>


                                            <div class="row">
                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label for="projectinput1">1 رقم الهاتف </label>
                                                        <input type="text" id="mobile1"
                                                            value="{{$pharmacy->mobile1}}"
                                                               class="form-control"
                                                               placeholder="  " name="mobile1">

                                                        @error("mobile1")
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label for="projectinput1">  2رقم الهاتف </label>
                                                        <input type="text" id="mobile2"
                                                               class="form-control"
                                                               value="{{$pharmacy->mobile2}}"
                                                               placeholder="" name="mobile2">

                                                        @error("mobile2")
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label for="projectinput1">التواصل الاجتماعي </label>
                                                        <input type="text" id="social"
                                                              value="{{$pharmacy->social_media}}"
                                                               class="form-control"
                                                               placeholder="" name="social">

                                                        @error("social")
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> العنوان  </label>
                                                        <input type="text" id="pac-input"
                                                               class="form-control"
                                                               value="{{$pharmacy->address}}"
                                                               placeholder="  " name="address">
                                                        @error("address")
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>


                                            </div>


                                            <div class="row">
                                                <div class="col-md-6 ">
                                                    <div class="form-group">
                                                        <label for="projectinput1">الرخصة</label>
                                                        <input type="file" id="pdf"
                                                               class="form-control"
                                                               placeholder="  " name="pdf">

                                                        @error("pdf")
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>

                                            </div>


                                            
                                           {{-- <div class="row">
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
                                            </div> --}}

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



   
