@extends('dashboard.layout.parent')
@section('title')
    {{$location_title}}
@stop

@section('main-title')
    {{__('الرئيسية')}}
@stop
@section('sub-main-title')
    {{$location_title}}
@stop
@push('styles')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
    <link href="{{ asset('dashboard_filesassets/libs/raty-js/lib/jquery.raty.css') }}" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        html[dir=rtl] .custom-control {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
        .toast-top-right {
            top: 12px;
            left: 12px;
            right: auto;
        }
        .dataTables_filter label{
            margin-bottom: 0;
        }
        .dataTables_filter input{
            height: calc(2em + 0.5rem + 2px);
            padding: 0.25rem 0.5rem;
        }
    </style>
@endpush
@section('content')

    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-12 col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center m-b-30">
                            <h4 class="card-title">{{$location_title}}</h4>

                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered nowrap orders-product-list-table display">
                                <thead>
                                <tr>
                                    <th><div class="custom-control custom-checkbox"> <input class="custom-control-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div></th>
                                    <th>#</th>
                                    <th>{{__('رقم الطلبية')}}</th>
                                    <th>{{__('السوبر ماركت')}}</th>
                                    <th>{{__('عدد المنتجات')}}</th>
                                    <th>{{__('التاريخ')}}</th>
                                    <th>{{__('الوقت')}}</th>
                                    <th>{{__('التقييم')}}</th>
                                    <th>{{__('أجمالي الطلبية')}}</th>
                                    <th>{{__('الحالة')}}</th>
                                    <th>{{__('السائق')}}</th>
                                    <th></th>
                                </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->

        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>

    <div class="modal fade" tabindex="-1" aria-hidden="true" id="modal_create_new">
        <div class="modal-dialog mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">{{__('أضافة طلب')}}</h5>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <!--begin::Form-->
                    <form id="modal_add_new_form" class="form" action="javascript:void(0)">
                        <!--begin::Scroll-->
                        <input type="hidden" name="id" id="record_id">
                        <!--begin::Alert-->
                        <div class="alert alert-danger bg-light-danger flex-column flex-sm-row p-5 mb-10 " id="error"style="display: none">

                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                <!--begin::Title-->
                                <h4 class="fw-bold">انتبه!</h4>
                                <!--end::Title-->
                                <!--begin::Content-->
                                <span id="error-span"></span>
                                <!--end::Content-->
                            </div>
                            <!--end::Wrapper-->

                        </div>
                        <!--end::Alert-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                            <div class="row">
                                <!--begin::Input group-->
                                <div class="col-6 fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">{{__('رقم الطلبية')}}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="order_number" id="order_number" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="#5156"/>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="col-6 fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">{{__('التقييم')}}</label>
                                    <!--end::Label-->
                                    <div id="score-rating-create"></div>

                                </div>
                                <!--end::Input group-->
                            </div>
                            <br>
                            <!--end::Input group-->

                            <br>
                            <div class="row">
                                <table class="table product-overview">
                                    <thead>
                                    <tr>
                                        <th>{{__('تفاصيل المنتج')}}</th>
                                        <th>{{__('السعر')}}</th>
                                        <th>{{__('الكمية')}}</th>
                                        <th style="text-align:center"><a href="javascript:void(0)" class="text-inverse show_add_product" data-id="" id= "show_add_product" title="اضافة" data-toggle="tooltip" data-original-title="اضافة"><i class="ti-plus text-dark"></i></a></th>

                                    </tr>
                                    </thead>
                                    <tbody class="cart-products">

                                    </tbody>
                                </table>

                            </div>
                            <br>
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">{{__('السوبر ماركت')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select class="custom-select " data-placeholder="اختر سوبر ماركت"  name="customer_id" id='customer_id'>

                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->supermarket_name }}</option>
                                    @endforeach
                                </select>
                                <!--end::Input-->
                            </div>

                            <br>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">{{__('حالة الطلب')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select class="custom-select " data-placeholder="اختر حالة"  name="order_status_id" id='order_status_id'>

                                    @foreach ($order_cases as $case)
                                        <option value="{{ $case->id }}">{{ $case->name }}</option>
                                    @endforeach
                                </select>
                                <!--end::Input-->
                            </div>

                            <br>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">{{__('السائق')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select class="custom-select " data-placeholder="اختر سائق" name="driver_id" id='driver_id'>

                                    @foreach ($delivers as $deliver)
                                        <option value="{{ $deliver->id }}">{{ $deliver->name }}</option>
                                    @endforeach
                                </select>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Scroll-->

                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Modal body-->

                <div class="modal-footer">
                    <button type="reset" class="btn btn-light me-3" data-modal-create-new-action="cancel" data-dismiss="modal">
                        {{__('الغاء')}}</button>
                    <button type="submit" class="btn btn-primary" id="add_new"  data-modal-create-new-action="submit">
                        <span class="indicator-label">{{__('حفظ')}}</span>
                    </button>

                </div>
            </div>
        </div>
    </div>
    <!--end::Modal - Add task-->
    <div class="modal fade" tabindex="-1" aria-hidden="true" id="modal_add_product">
        <div class="modal-dialog mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">{{__('أضافة منتج')}}</h5>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <!--begin::Form-->
                    <form id="modal_add_product_form" class="form" action="javascript:void(0)">
                        <!--begin::Scroll-->
                        <input type="hidden" name="order_id" id="order_id">
                        <!--begin::Alert-->
                        <div class="alert alert-danger bg-light-danger flex-column flex-sm-row p-5 mb-10 " id="error-product"style="display: none">

                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                <!--begin::Title-->
                                <h4 class="fw-bold">انتبه!</h4>
                                <!--end::Title-->
                                <!--begin::Content-->
                                <span id="error-span-product"></span>
                                <!--end::Content-->
                            </div>
                            <!--end::Wrapper-->

                        </div>
                        <!--end::Alert-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                            <div class="row">

                                <!--begin::Input group-->
                                <div class="col-6 fv-row mb-7">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">{{__('المنتج')}}</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select class="custom-select " data-placeholder="اختر سوبر ماركت"  name="product_id" id='product_id'>

                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                    </div>

                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="col-6 fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">{{__('الكمية')}}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="number" min="1" name="qty" id="qty" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="0"/>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <br>
                            <!--end::Input group-->

                        </div>
                        <!--end::Scroll-->

                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Modal body-->

                <div class="modal-footer">
                    <button type="reset" class="btn btn-light me-3" data-modal-create-new-action="cancel" data-dismiss="modal">
                        {{__('الغاء')}}</button>
                    <button type="submit" class="btn btn-primary" id="add_product"  data-modal-create-new-action="submit">
                        <span class="indicator-label">{{__('حفظ')}}</span>
                    </button>

                </div>
            </div>
        </div>
    </div>
    <!--end::Modal - Add task-->


    <!-- begin::Modal - delete record -->
    <div class="modal fade" tabindex="-1" id="delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('حذف ')}}</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <p>{{__('هل انت متاكد من حذف الطلب رقم')}} (<span id="name_delete"></span>)</p>
                </div>

                <div class="modal-footer">
                    <button type="reset" class="btn btn-light me-3" data-modal-create-new-action="cancel" data-dismiss="modal">
                        {{__('الغاء')}}</button>
                    <button type="submit" class="btn btn-primary" id="delete-record"  data-modal-create-new-action="submit">
                        <span class="indicator-label">{{__('حذف')}}</span>

                    </button>

                </div>
            </div>
        </div>
    </div>
    <!-- END: Modal-->

    <!-- begin::Modal - delete record -->
    <div class="modal fade" tabindex="-1" id="modals-delete-all">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('حذف المحدد')}}</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <p>{{__(' هل انت متاكد؟')}}</p>
                </div>

                <div class="modal-footer">
                    <button type="reset" class="btn btn-light me-3" data-modal-create-new-action="cancel" data-dismiss="modal">
                        {{__('الغاء')}}</button>
                    <button type="submit" class="btn btn-primary" data-modal-create-new-action="submit" data-toggle="modal"
                            data-target="#modals-delete-all" id="delete">
                        <span class="indicator-label">{{__('حذف')}}</span>

                    </button>

                </div>
            </div>
        </div>
    </div>
    <!-- END: Modal-->

    <!-- begin::Modal - delete record -->
    <div class="modal fade" tabindex="-1" id="modals-select">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تحديد</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <p>{{__('الرجاء تحديد عنصر على الأقل!!')}}</p>
                </div>

                <div class="modal-footer">
                    <button type="reset" class="btn btn-light me-3" data-modal-create-new-action="cancel" data-dismiss="modal" id="close">
                        {{__('الغاء')}}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- begin::Modal - delete record -->
    <div class="modal fade" tabindex="-1" id="modals-deliver-all">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('تسليم المحدد')}}</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <p>{{__(' هل انت متاكد؟')}}</p>
                </div>

                <div class="modal-footer">
                    <button type="reset" class="btn btn-light me-3" data-modal-create-new-action="cancel" data-dismiss="modal">
                        {{__('الغاء')}}</button>
                    <button type="submit" class="btn btn-primary" data-modal-create-new-action="submit" data-toggle="modal"
                            data-target="#modals-deliver-all" id="deliver">
                        <span class="indicator-label">{{__('تاكيد')}}</span>

                    </button>

                </div>
            </div>
        </div>
    </div>
    <!-- END: Modal-->
    <!-- END: Modal-->
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!--end::Modal - show-->
    <div class="modal fade" tabindex="-1" aria-hidden="true" id="modal_show">
        <div class="modal-dialog modal-dialog-centered mw-650px modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">{{__('تفاصيل الطلب')}}</h5>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <input type="hidden" name="id" id="record_id">
                    <div class="row">


                        <div class="col-sm-3" style="padding-right:2px">
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-sm" style="margin-bottom: 15px;">{{__('رقم الطلب')}}</span>
                                <span class="font-weight-bolder font-size-h5">
                                                    <span class="order_number_span" style="font-weight: bold;"></span></span>
                            </div>
                        </div>

                        <div class="col-sm-3" style="padding-right:2px">
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-sm" style="margin-bottom: 15px;">{{__('الأسم')}}</span>
                                <span class="font-weight-bolder font-size-h5">
                                                    <span class="name_span"></span></span>
                            </div>
                        </div>
                        <div class="col-sm-3" style="padding-right:2px">
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-sm" style="margin-bottom: 15px;">{{__('أسم السوبر ماركت')}}</span>
                                <span  class="font-weight-bolder font-size-h5">
                                                    <span class="market_name_span"></span>
                                                </span>
                            </div>

                        </div>

                        <div class="col-sm-3" style="padding-right:2px">
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-sm" style="margin-bottom: 15px;">{{__('التقييم')}}</span>
                                <span  class="font-weight-bolder font-size-h5">
                                                    <div id="score-rating-show"></div>
                                                </span>
                            </div>

                        </div>


                    </div>
                    <hr/>

                    <div class="row">

                        <div class="col-sm-3" style="padding-right:2px">
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-sm" style="margin-bottom: 15px;">{{__('عدد المنتجات')}}</span>
                                <span  class="font-weight-bolder font-size-h5">
                                                    <span class="qty_span"></span>
                                                </span>
                            </div>

                        </div>
                        <div class="col-sm-3" style="padding-right:2px">
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-sm" style="margin-bottom: 15px;">{{__('المجموع')}}</span>
                                <span  class="font-weight-bolder font-size-h5">
                                                    <span class="total_span"></span>
                                                </span>
                            </div>

                        </div>
                        <div class="col-sm-3" style="padding-right:2px">
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-sm" style="margin-bottom: 15px;">{{__('حالة الطلب')}}</span>
                                <span class="font-weight-bolder font-size-h5">
                                                    <span class="status_order_span"></span></span>
                            </div>
                        </div>

                        <div class="col-sm-3" style="padding-right:2px">
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-sm" style="margin-bottom: 15px;">{{__('أسم السائق')}}</span>
                                <span  class="font-weight-bolder font-size-h5">
                                                    <span class="driver_name_span"></span>
                                                </span>
                            </div>
                        </div>



                    </div>

                    <hr/>

                    <div class="row">


                        <div class="col-sm-3" style="padding-right:2px">
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-sm" style="margin-bottom: 15px;">{{__('التاريخ')}}</span>
                                <span  class="font-weight-bolder font-size-h5">
                                                    <span class="date_span"></span>
                                                </span>
                            </div>

                        </div>
                        <div class="col-sm-3" style="padding-right:2px">
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-sm" style="margin-bottom: 15px;">{{__('الوقت')}}</span>
                                <span  class="font-weight-bolder font-size-h5">
                                                    <span class="time_span"></span>
                                                </span>
                            </div>

                        </div>

                    </div>
                    <hr/>
                    <div class="row">
                        <table class="table product-overview">
                            <thead>
                            <tr>
                                <th>{{__('تفاصيل المنتج')}}</th>
                                <th>{{__('السعر')}}</th>
                                <th>{{__('الكمية')}}</th>
                                <th>{{__('السعر')}}</th>
                            </tr>
                            </thead>
                            <tbody class="show-products">

                            </tbody>
                        </table>
                    </div>
                    <hr/>

                </div>
                <!--end::Modal body-->

                <div class="modal-footer">
                    <button type="reset" class="btn btn-light me-3" data-modal-create-new-action="cancel" data-dismiss="modal">
                        {{__('الغاء')}}</button>
                </div>
            </div>
        </div>

    </div>
    <!--end::Modal - show-->

@endsection
@push('script')
    <script src="{{asset('dashboard_files/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>

    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <script src="{{asset('dashboard_files/dist/js/pages/datatable/datatable-advanced.init.js')}}"></script>
    <script src="{{asset('dashboard_files/dist/js/pages/datatable/datatable-advanced.init.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('dashboard_files/dist/js/custom.min.js')}}"></script>
    <script src="{{asset('dashboard_files/assets/libs/raty-js/lib/jquery.raty.js')}}"></script>
    <script src="{{asset('dashboard_files/assets/extra-libs/raty/rating-init.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="{{ asset('dashboard_files/dist/js/orders.js') }}?<?php time() ?>"></script>

    <script>
        var $url = "{{ route('orders-product.index') }}";
        var $createurl = "{{ route('orders-product.create') }}";
        var $deleteAllurl = "{{ route('orders-product-destroyAll') }}";
        var $deliverAllurl = "{{ route('orders-product-deliverAll') }}";
        var $carturl = "{{ route('cart') }}";
    </script>
    <script>
        var $path = "{{ url('/') }}";

        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#modal_create_new').on('hidden.bs.modal', function () {
                if($('#edit_record').length){
                    document.getElementById("edit_record").id = 'add_new';
                }
                $('#add_new').html("حفظ");
                $('#modal-title').html('أضافة طلب');
                $('#record_id').val('');
                $('#order_number').val('');
                $('#evaluation').val('');
                $('#order_status_id').val('');
                $('#driver_id').val('');
                $('#customer_id').val('');
                $('#show_add_product').attr('data-id','');
                $("#error").hide();

            });
            $('.show_add_product').click(function(e) {
                $('#modal_create_new').modal('hide');
                $('#modal_add_product').modal('show');
                $('#order_id').val($(this).attr('data-id'));
                $("#error-product").hide();
            });

            $("#add_product").click(function(e) {

                var product_id = $('#product_id').val();
                e.preventDefault();
                $(this).html("{{ __('يثم الحفظ..')}}");
                $.ajax({
                    data: $("#modal_add_product_form").serialize(),
                    url: "{{url('dashboard/order-product-add') }}" ,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {

                        if(data.exists == false){
                            toastr.error('المنتج مضاف بالفعل');
                            $("#add_product").html("{{ __('حفظ')}}");
                        }else{
                            $('#modal_add_product_form').trigger("reset");
                            toastr.success('تم الحفظ بنجاح😍😍');
                            $('#modal_add_product').modal('hide');

                        }
                        $('.orders-product-list-table').DataTable().ajax.reload();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $("#add_product").html("{{ __('حفظ') }}");

                        toastr.error('يرجى التاكد من ادخال البيانات كاملة');
                        var string = "";
                        $.each(data.responseJSON.errors, function (key, value) {
                            string = string + value[0] + "<br><br>";
                            $("#error-span-product").html(string);
                        });
                        $("#error-product").show();

                        e.preventDefault();
                    }
                })
            });
            $("#add_new").click(function(e) {

                    var record_id = $('#record_id').val();
                    e.preventDefault();
                    $(this).html("{{ __('يثم التعديل..')}}");
                    $.ajax({
                        data: $("#modal_add_new_form").serialize(),
                        url: "{{url('dashboard/orders-product') }}" + '/' + record_id ,
                        type: "POST",
                        method: "PUT",
                        dataType: 'json',
                        success: function(data) {
                            $('#modal_add_new_form').trigger("reset");
                            $('#modal_create_new').modal('hide');
                            toastr.success('تم التعديل بنجاح😍😍');
                            $('.orders-product-list-table').DataTable().ajax.reload();
                        },
                        error: function(data) {
                            console.log('Error:', data);
                            $("#edit_record").html("{{ __('تعديل') }}");
                            toastr.error('يرجى التاكد من ادخال البيانات كاملة');
                            var string = "";
                            $.each(data.responseJSON.errors, function (key, value) {
                                string = string + value[0] + "<br><br>";
                                $("#error-span").html(string);
                            });
                            $("#error").show();

                            e.preventDefault();
                        }
                    })
            });

            $('body').on('click', '.editRecord', function() {
                var record_id = $(this).data('id');
                $.get("{{ url('dashboard/orders-product') }}" + '/' + record_id + '/edit', function(data) {
                    $('#add_new').html("تعديل");
                    $('#modal-title').html('تعديل طلب');
                    $('#modal_create_new').modal('show');
                    $('.cart-products').empty()
                    $('#score-rating-create').raty({
                        path      : $path +'/dashboard_files/assets/images/rating', // <-- or wherever your raty images are
                        scoreName      : 'evaluation',
                        score     : data.order.evaluation,
                    });
                    $('#record_id').val(data.order.id);
                    $('#order_number').val(data.order.order_number);
                    $('#evaluation').val(data.order.evaluation);
                    $('#order_status_id').val(data.order.order_status_id);
                    $('#driver_id').val(data.order.driver_id);
                    $('#customer_id').val(data.order.customer_id);
                    for(i in data.items) {
                        item = data.items[i]
                        $('.cart-products').append(`<tr id="product-">
                                            <td width="550">
                                                <h5 class="font-500">${item.product.product_name}</h5>
                                            </td>
                                            <td><span id="price">$${item.product.product_price}</span></td>
                                            <td width="120">
                                                <input type="text" class="form-control" name="quantity" id="quantity${item.product.id}" value="${item.qty}">
                                            </td>
                                            <td align="center">
                                                <a href="javascript:void(0)" class="text-inverse editRecordCart" id= "${item.order_id}" data-product_id="${item.product.id}" title="تعديل" data-toggle="tooltip" data-original-title="تعديل"><i class="ti-marker-alt text-dark"></i></a>
                                                <a href="javascript:void(0)" class="text-inverse deleteRecordCart" id= "${item.order_id}" data-product_id="${item.product.id}" title="حذف" data-toggle="tooltip" data-original-title="حذف"><i class="ti-trash text-dark"></i></a>

                                            </td>
                                        </tr>`)
                    }

                    $('#show_add_product').attr('data-id',data.order.id);
                    $("#error").hide();
                    document.getElementById("add_new").id = 'edit_record';
                })
            });
            $(document).on('click', '.editRecordCart', function() {
                var product_id = $(this).data('product_id');
                var order_id = $(this).attr('id');
                var quantity = $('#quantity'+ $(this).data('product_id')).val();

                $.ajax({
                    data:{quantity: quantity, product_id: product_id , order_id:order_id},
                    url: "{{url('dashboard/order-product-update') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#total').html(data.total);
                        $('#price'+ product_id).html(data.price);
                        $('.orders-product-list-table').DataTable().ajax.reload();
                        toastr.success('تم التعديل بنجاح😍😍');
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        toastr.error('يرجى التاكد من ادخال البيانات كاملة');


                        e.preventDefault();
                    }
                })
            });
            $(document).on('click', '.deleteRecordCart', function() {
                var product_id = $(this).data('product_id');
                var order_id = $(this).attr('id');

                $.ajax({
                    data:{product_id: product_id , order_id:order_id},
                    url: "{{url('dashboard/order-product-delete') }}",
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        if(data.empty == true){
                            toastr.error('الطلب به منتج واحد فقط');
                        }else{
                            $('.cart-products').empty()
                            for(i in data.items) {
                                item = data.items[i]
                                $('.cart-products').append(`<tr id="product-">
                                            <td width="550">
                                                <h5 class="font-500">${item.product.product_name}</h5>
                                            </td>
                                            <td><span id="price">$${item.product.product_price}</span></td>
                                            <td width="120">
                                                <input type="text" class="form-control" name="quantity" id="quantity${item.product.id}" value="${item.qty}">
                                            </td>
                                            <td align="center">
                                                <a href="javascript:void(0)" class="text-inverse editRecordCart" id= "${item.order_id}" data-product_id="${item.product.id}" title="تعديل" data-toggle="tooltip" data-original-title="تعديل"><i class="ti-marker-alt text-dark"></i></a>
                                                <a href="javascript:void(0)" class="text-inverse deleteRecordCart" id= "${item.order_id}" data-product_id="${item.product.id}" title="حذف" data-toggle="tooltip" data-original-title="حذف"><i class="ti-trash text-dark"></i></a>

                                            </td>
                                        </tr>`)
                            }
                            $('.orders-product-list-table').DataTable().ajax.reload();
                            toastr.success('تم الحذف بنجاح😍😍');
                        }

                    },
                    error: function(data) {
                        console.log('Error:', data);
                        toastr.error('يرجى التاكد من ادخال البيانات كاملة');


                        e.preventDefault();
                    }
                })
            });

            var record_id;
            $(document).on('click', '.deleteRecord', function() {
                record_id = $(this).attr('id');
                $.get("{{ url('dashboard/orders-product') }}" + '/' + record_id + '/edit', function(data) {

                    $('#name_delete').html(data.order.order_number);
                    $('#delete_modal').modal('show');
                })
            });
            $('#delete-record').click(function() {
                $.ajax({
                    type: "DELETE",
                    url: "{{url('dashboard/orders-product') }}" + '/' + record_id,
                    beforeSend: function() {
                        $('#delete-record').html("{{ __('يتم الحذف..') }}");
                    },
                    success: function(data) {
                        $('#delete_modal').modal('hide');
                        $('.orders-product-list-table').DataTable().ajax.reload();
                        toastr.success('تم الحذف بنجاح😍😍');
                        $('#delete-record').html("{{ __('حذف') }}");
                    }
                })
            });
            $(document).on('click', '.copyRecord', function() {
                record_id = $(this).attr('id');
                $.ajax({
                    url: "{{ url('dashboard/orders-product') }}" + '/' + record_id + "/order-copy",
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        toastr.success('تم النسخ بنجاح😍😍');
                        $('.orders-product-list-table').DataTable().ajax.reload();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        toastr.error('يرجى التاكد من ادخال البيانات كاملة');

                    }
                })
            });
            $('body').on('click', '.showRecord', function() {
                var record_id = $(this).data('id');
                $.get("{{ url('dashboard/orders-product') }}" + '/' + record_id, function(data) {
                    $('#modal_show').modal('show');
                    $('#record_id').val(data.id);
                    $('.name_span').html(data.name);
                    $('.order_number_span').html('#' +data.order_number);
                    $('.market_name_span').html(data.supermarket_name);
                    $('.evaluation_span').html(data.evaluation);
                    $('.qty_span').html(data.total_items);
                    $('.time_span').html(data.time);
                    $('.date_span').html(data.date);
                    $('.status_order_span').html(data.status);
                    $('.total_span').html('$' +data.total);
                    $('#score-rating-show').raty({
                        path      : $path +'/dashboard_files/assets/images/rating', // <-- or wherever your raty images are
                        scoreName      : 'evaluation',
                        readOnly: true,
                        score     : data.evaluation,
                    });
                    $('.driver_name_span').html(data.driver);
                    $('.show-products').empty()
                    for(i in data.items) {
                        item = data.items[i]
                        $('.show-products').append(`<tr id="product-">
                                            <td width="550">
                                                <h5 class="font-500">${item.name}</h5>
                                            </td>
                                            <td><span id="price">$${item.price}</span></td>
                                            <td width="120">
                                                 <span id="quantity">${item.qty}</span>
                                            </td>
                                            <td><span id="price">$${item.price * item.qty}  </span></td>

                                        </tr>`)
                    }
                })
            });
        });
    </script>

@endpush
