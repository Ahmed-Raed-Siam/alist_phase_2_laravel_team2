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

        .toast-top-right {
            top: 12px;
            left: 12px;
            right: auto;
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
            <div class="col-md-9 col-lg-9">
                <div class="card">
                    <div class="card-header bg-info">
                        <h5 class="m-b-0 text-white"> يوجد في السله (<span id="item_number">{{$itemsNum}}</span>) منتجات</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table product-overview">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('تفاصيل المنتج')}}</th>
                                    <th>{{__('السعر')}}</th>
                                    <th>{{__('الكمية')}}</th>
                                    <th style="text-align:center">{{__('السعر')}}</th>
                                    <th style="text-align:center"></th>
                                </tr>
                                </thead>
                                <tbody class="cart-products">
                                @foreach($items as $item)
                                <tr id="product-{{$item->id}}">
                                    <td width="150"><img src="{{$item->product->image_url}}" alt="iMac" height="80" width="80"></td>
                                    <td width="550">
                                        <h5 class="font-500">{{$item->product->product_name}}</h5>
                                        <p>{{$item->product->categories['ar_name']}}</p>
                                    </td>
                                    <td>${{$item->product->product_price}}</td>
                                    <td width="70">
                                        <input type="text" class="form-control" name="quantity{{$item->product->id}}" id="quantity{{$item->product->id}}" data-product="{{$item->product->id}}" data-cart="{{$item->id}}"value = "{{$item->quantity}}">
                                    </td>
                                    <td width="150" align="center" class="font-500" ><span id="price{{$item->product->id}}">${{$item->product->product_price * $item->quantity}}</span></td>
                                    <td align="center">
                                        <a href="javascript:void(0)" class="text-inverse deleteRecord" data-toggle= "modal" id= "{{$item->id}}" title="حذف" data-toggle="tooltip" data-original-title="حذف"><i class="ti-trash text-dark"></i></a>
                                        <a href="javascript:void(0)" class="text-inverse editRecord" id= "{{$item->id}}" data-product_id="{{$item->product->id}}"title="تعديل" data-toggle="tooltip" data-original-title="تعديل"><i class="ti-marker-alt text-dark"></i></a>
                                    </td>

                                </tr>
                                @endforeach
                                @if($itemsNum == 0)
                                    <tr >
                                        <td style="text-align: center"></td>
                                        <td style="text-align: center"></td>
                                        <td style="text-align: center">
                                            <p>لا يوجد بيانات</p>
                                        </td>

                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            <hr>
                            <div class="d-flex no-block align-items-center">
                                <button class="btn btn-dark btn-outline" onclick=document.location.href="{{route('products-cart')}}"><i class="fas fa-arrow-left"></i> {{__('استمر في التسوق')}}</button>
                                <div class="ml-auto">
                                    <button class="btn btn-danger " id="delete-cart-btn" data-toggle="modal"data-target="@if($itemsNum > 0)#modals-delete-all @else #modals-select @endif"><i class="fas fa-trash"></i>{{__("حذف السله")}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-3 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{__('ملخص السلة')}}</h5>
                        <hr>
                        <small>{{__('المجموع')}}</small>
                        <h2 id="total">${{$total}}</h2>
                        <hr>
                        <button class="btn btn-success" data-toggle="modal" id="add-order"data-target="@if($itemsNum > 0)#modal_create_new @else #modals-select @endif"><i class="fa fa fa-shopping-cart"></i>{{__('أنشأ الطلب')}}</button>
                    </div>
                </div>

            </div>
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
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
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
    <div class="modal fade" tabindex="-1" aria-hidden="true" id="modal_create_new">
        <div class="modal-dialog mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">{{__('أنشاء طلب')}}</h5>
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
                            <!--end::Input group-->
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
    <div class="modal fade" tabindex="-1" id="modals-delete-all">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('حذف السلة')}}</h5>

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
                    <p>{{__('السلة فارغة!!')}}</p>
                </div>

                <div class="modal-footer">
                    <button type="reset" class="btn btn-light me-3" data-modal-create-new-action="cancel" data-dismiss="modal" id="close">
                        {{__('الغاء')}}</button>
                </div>
            </div>
        </div>
    </div>
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
            $("#add_new").click(function(e) {
                    e.preventDefault();
                    $(this).html("{{ __('يثم الحفظ..')}}");
                    $.ajax({
                        data: $("#modal_add_new_form").serialize(),
                        url: "{{url('dashboard/orders-product') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function(data) {
                            $('#modal_add_new_form').trigger("reset");
                            $('#modal_create_new').modal('hide');
                            toastr.success('تم الحفظ بنجاح😍😍');
                            $('.orders-list-table').DataTable().ajax.reload();
                            $("#add_new").html("{{ __('حفظ') }}");
                            setTimeout(function() {
                                window.location.href = "{{url('dashboard/orders-product') }}";
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

            });

            $(document).on('click', '.editRecord', function() {
                var product_id = $(this).data('product_id');
                var cart_id = $(this).attr('id');
                var quantity = $('#quantity'+ $(this).data('product_id')).val();

                $.ajax({
                    data:{quantity: quantity, product_id: product_id , cart_id:cart_id},
                    url: "{{url('dashboard/cart-update') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#total').html(data.total);
                        $('#price'+ product_id).html(data.price);
                        toastr.success('تم التعديل بنجاح😍😍');
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
                $.get("{{ url('dashboard/cart') }}" + '/' + record_id + '/show', function(data) {
                    $('#total').html(data.total);
                    $('#name_delete').html(data.name);
                    $('#delete_modal').modal('show');
                })
            });
            $("#delete").click(function(e) {
                record_id = $(this).attr('id');
                $.get("{{ url('dashboard/cart-delete') }}", function(data) {
                    $('#delete_modal').modal('hide');
                    $('.cart-products').empty();
                    $('#total').html(data.total);
                    $('#item_number').html(data.item_number);
                    toastr.success('تم الحذف بنجاح😍😍');
                    $('.cart-products').append(`<tr >
                                        <td style="text-align: center"></td>
                                        <td style="text-align: center"></td>
                                        <td style="text-align: center">
                                            <p>لا يوجد بيانات</p>
                                        </td>

                                    </tr>`)
                    var deleteAllButton = document.getElementById('delete-cart-btn');
                    deleteAllButton.setAttribute("data-target", "#modals-select");

                    var orderButton = document.getElementById('add-order');
                    orderButton.setAttribute("data-target", "#modals-select");

                })
            });
            $('#delete-record').click(function() {
                $.ajax({
                    type: "DELETE",
                    url: "{{url('dashboard/cart') }}" + '/' + record_id,
                    beforeSend: function() {
                        $('#delete-record').html("{{ __('يتم الحذف..') }}");
                    },
                    success: function(data) {
                        $('#delete_modal').modal('hide');
                        $('#product-' + data.cart_id).hide();
                        $('#total').html(data.total);
                        $('#item_number').html(data.item_number);
                        if(data.item_number == 0){
                            $('.cart-products').append(`<tr >
                                        <td style="text-align: center"></td>
                                        <td style="text-align: center"></td>
                                        <td style="text-align: center">
                                            <p>لا يوجد بيانات</p>
                                        </td>

                                    </tr>`)
                            var deleteAllButton = document.getElementById('delete-cart-btn');
                            deleteAllButton.setAttribute("data-target", "#modals-select");

                            var orderButton = document.getElementById('add-order');
                            orderButton.setAttribute("data-target", "#modals-select");


                        }
                        toastr.success('تم الحذف بنجاح😍😍');
                        $('#delete-record').html("{{ __('حذف') }}");
                    }
                })
            });
        });
    </script>


@endpush
