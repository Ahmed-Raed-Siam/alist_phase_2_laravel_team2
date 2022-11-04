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
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <style>

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
                            <table class="table table-bordered nowrap order-cases-list-table display">
                                <thead>
                                <tr>
                                    <th><div class="custom-control custom-checkbox"> <input class="custom-control-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div></th>
                                    <th>#</th>
                                    <th>{{__('الاسم')}}</th>
                                    <th>{{__('الوصف')}}</th>
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
                    <h5 class="modal-title" id="modal-title">{{__('أضافة حالة')}}</h5>
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

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">{{__('الاسم')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="name" id="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="الاسم"/>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">{{__('الوصف')}}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <textarea class="form-control form-control-solid mb-3 mb-lg-0" name="description" id="description" cols="30" rows="5"
                                ></textarea>
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
                    <p>{{__('هل انت متاكد من حذف')}} (<span id="name_delete"></span>)</p>
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
    <!-- END: Modal-->
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

        <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script src="{{ asset('dashboard_files/dist/js/orders.js') }}?<?php time() ?>"></script>

        <script>
            var $url = "{{ route('order-cases.index') }}";
            var $deleteAllurl = "{{ route('order-cases-destroyAll') }}";

        </script>
        <script>

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
                    $('#modal-title').html('أضافة حالة');
                    $('#record_id').val('');
                    $('#name').val('');
                    $('#description').val('');
                    $("#error").hide();

                });
                $("#add_new").click(function(e) {

                    if($(this).attr('id') == 'add_new'){

                        e.preventDefault();
                        $(this).html("{{ __('يثم الحفظ..')}}");
                        $.ajax({
                            data: $("#modal_add_new_form").serialize(),
                            url: "{{url('dashboard/order-cases') }}",
                            type: "POST",
                            dataType: 'json',
                            success: function(data) {
                                $('#modal_add_new_form').trigger("reset");
                                $('#modal_create_new').modal('hide');
                                toastr.success('تم الحفظ بنجاح😍😍');
                                $('.order-cases-list-table').DataTable().ajax.reload();
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
                            url: "{{url('dashboard/order-cases') }}" + '/' + record_id ,
                            type: "POST",
                            method: "PUT",
                            dataType: 'json',
                            success: function(data) {
                                $('#modal_add_new_form').trigger("reset");
                                $('#modal_create_new').modal('hide');
                                toastr.success('تم التعديل بنجاح😍😍');
                                $('.order-cases-list-table').DataTable().ajax.reload();
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
                    $.get("{{ url('dashboard/order-cases') }}" + '/' + record_id + '/edit', function(data) {
                        $('#add_new').html("تعديل");
                        $('#modal-title').html('تعديل حالة');
                        $('#modal_create_new').modal('show');
                        $('#record_id').val(data.id);
                        $('#name').val(data.name);
                        $("#error").hide();
                        $('#description').val(data.description);
                        document.getElementById("add_new").id = 'edit_record';
                    })
                });

                var record_id;
                $(document).on('click', '.deleteRecord', function() {
                    record_id = $(this).attr('id');
                    $.get("{{ url('dashboard/order-cases') }}" + '/' + record_id + '/edit', function(data) {

                        $('#name_delete').html(data.name);
                        $('#delete_modal').modal('show');
                    })
                });
                $('#delete-record').click(function() {
                    $.ajax({
                        type: "DELETE",
                        url: "{{url('dashboard/order-cases') }}" + '/' + record_id,
                        beforeSend: function() {
                            $('#delete-record').html("{{ __('يتم الحذف..') }}");
                        },
                        success: function(data) {
                            $('#delete_modal').modal('hide');
                            $('.order-cases-list-table').DataTable().ajax.reload();
                            toastr.success('تم الحذف بنجاح😍😍');
                            $('#delete-record').html("{{ __('حذف') }}");
                        }
                    })
                });
            });
        </script>

    @endpush
