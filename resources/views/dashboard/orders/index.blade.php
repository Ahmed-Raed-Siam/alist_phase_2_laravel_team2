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
                            <table class="table table-bordered nowrap orders-list-table display">
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
                                    <label class="required fw-bold fs-6 mb-2">{{__('عدد المنتجات')}}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="products_number" id="products_number" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="1425"/>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <br>
                            <!--end::Input group-->

                            <br>
                            <div class="row">

                                <!--begin::Input group-->
                                <div class="col-6 fv-row mb-7">
                                    <label class="required fw-bold fs-6 mb-2">{{__('التقييم')}}</label>

                                    <div id="score-rating-create"></div>

                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="col-6 fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2">{{__('المجموع')}}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="number" name="total" id="total" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="المجموع"/>
                                    <!--end::Input-->
                                </div>
                            </div>
                            <br>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">{{__('السوبر ماركت')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select class="custom-select " data-placeholder="اخترسوبر ماركت"  name="customer_id" id='customer_id'>

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
    <!-- END: Modal-->
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
                                <span class="font-weight-bolder font-size-sm" style="margin-bottom: 15px;">{{__('عدد المنتجاتئ')}}</span>
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
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->


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
        var $url = "{{ route('orders.index') }}";
        var $createurl = "{{ route('orders.create') }}";
        var $deleteAllurl = "{{ route('orders-destroyAll') }}";
        var $deliverAllurl = "{{ route('orders-deliverAll') }}";


    </script>
    <script>
        var $path = "{{ url('/') }}";

        $('#score-rating-create').raty({
            path      : $path +'/dashboard_files/assets/images/rating', // <-- or wherever your raty images are
            scoreName      : 'evaluation'
        });
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
                $('#products_number').val('');
                $('#customer_id').val('');
                $('#evaluation').val('');
                $('#total').val('');
                $('#order_status_id').val('');
                $('#driver_id').val('');
                $("#error").hide();

            });
            $("#add_new").click(function(e) {

                if($(this).attr('id') == 'add_new'){

                    e.preventDefault();
                    $(this).html("{{ __('يثم الحفظ..')}}");
                    $.ajax({
                        data: $("#modal_add_new_form").serialize(),
                        url: "{{url('dashboard/orders') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function(data) {
                            $('#modal_add_new_form').trigger("reset");
                            $('#modal_create_new').modal('hide');
                            toastr.success('تم الحفظ بنجاح😍😍');
                            $('.orders-list-table').DataTable().ajax.reload();
                            $("#add_new").html("{{ __('حفظ') }}");
                            setTimeout(function() {
                                location.reload();
                            }, 2000)
                        },
                        error: function(data) {
                            console.log('Error:', data);
                            $("#add_new").html("{{ __('حفظ') }}");
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
                }else{
                    var record_id = $('#record_id').val();
                    e.preventDefault();
                    $(this).html("{{ __('يثم التعديل..')}}");
                    $.ajax({
                        data: $("#modal_add_new_form").serialize(),
                        url: "{{url('dashboard/orders') }}" + '/' + record_id ,
                        type: "POST",
                        method: "PUT",
                        dataType: 'json',
                        success: function(data) {
                            $('#modal_add_new_form').trigger("reset");
                            $('#modal_create_new').modal('hide');
                            toastr.success('تم التعديل بنجاح😍😍');
                            $('.orders-list-table').DataTable().ajax.reload();
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
                }


            });

            $('body').on('click', '.editRecord', function() {
                var record_id = $(this).data('id');
                $.get("{{ url('dashboard/orders') }}" + '/' + record_id + '/edit', function(data) {
                    $('#add_new').html("تعديل");
                    $('#modal-title').html('تعديل طلب');
                    $('#modal_create_new').modal('show');
                    $('#record_id').val(data.id);
                    $('#order_number').val(data.order_number);
                    $('#products_number').val(data.products_number);
                    $('#customer_id').val(data.customer_id);
                    $('#total').val(data.total);
                    $('#order_status_id').val(data.order_status_id);
                    $('#driver_id').val(data.driver_id);
                    $('#score-rating-create').raty({
                        path      : $path +'/dashboard_files/assets/images/rating', // <-- or wherever your raty images are
                        scoreName      : 'evaluation',
                        score     : data.evaluation,
                    });
                    $("#error").hide();
                    document.getElementById("add_new").id = 'edit_record';
                })
            });

            var record_id;
            $(document).on('click', '.deleteRecord', function() {
                record_id = $(this).attr('id');
                $.get("{{ url('dashboard/orders') }}" + '/' + record_id + '/edit', function(data) {

                    $('#name_delete').html(data.order_number);
                    $('#delete_modal').modal('show');
                })
            });
            $(document).on('click', '.copyRecord', function() {
                record_id = $(this).attr('id');
                    $.ajax({
                        url: "{{ url('dashboard/orders') }}" + '/' + record_id + "/order-copy",
                        type: "GET",
                        dataType: 'json',
                        success: function(data) {
                            toastr.success('تم النسخ بنجاح😍😍');
                            $('.orders-list-table').DataTable().ajax.reload();
                        },
                        error: function(data) {
                            console.log('Error:', data);
                            toastr.error('يرجى التاكد من ادخال البيانات كاملة');

                        }
                    })
            });
            $('#delete-record').click(function() {
                $.ajax({
                    type: "DELETE",
                    url: "{{url('dashboard/orders') }}" + '/' + record_id,
                    beforeSend: function() {
                        $('#delete-record').html("{{ __('يتم الحذف..') }}");
                    },
                    success: function(data) {
                        $('#delete_modal').modal('hide');
                        $('.orders-list-table').DataTable().ajax.reload();
                        toastr.success('تم الحذف بنجاح😍😍');
                        $('#delete-record').html("{{ __('حذف') }}");
                    }
                })
            });
            $('body').on('click', '.showRecord', function() {
                var record_id = $(this).data('id');
                $.get("{{ url('dashboard/orders') }}" + '/' + record_id, function(data) {
                    $('#modal_show').modal('show');
                    $('#record_id').val(data.id);
                    $('.name_span').html(data.name);
                    $('.order_number_span').html('#' + data.order_number);
                    $('.market_name_span').html(data.supermarket_name);
                    $('.qty_span').html(data.products_number);
                    $('.time_span').html(data.time);
                    $('.date_span').html(data.date);
                    $('.status_order_span').html(data.status);
                    $('.total_span').html(data.total);
                    $('#score-rating-show').raty({
                        path      : $path +'/dashboard_files/assets/images/rating', // <-- or wherever your raty images are
                        scoreName      : 'evaluation',
                        readOnly: true,
                        score     : data.evaluation,
                    });
                    $('.driver_name_span').html(data.driver);
                    $('.show-products').empty()

                })
            });

        });
    </script>

@endpush
