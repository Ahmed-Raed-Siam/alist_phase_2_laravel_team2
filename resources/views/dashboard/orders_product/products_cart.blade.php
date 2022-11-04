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
    <link href="{{asset('dashboard_files/assets/libs/magnific-popup/dist/magnific-popup.css')}}" rel="stylesheet">

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

    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row el-element-overlay">
            @foreach($products as $product)
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="el-card-item">
                        <div class="el-card-avatar el-overlay-1"> <img src="{{$product->image_url}}" style="height: 280px;width: 100%" alt="user" />
                            <div class="el-overlay">
                                <ul class="list-style-none el-info">
                                    <li class="el-item"><a class="btn default btn-outline image-popup-vertical-fit el-link" href="{{$product->image_url}}"><i class="sl-icon-magnifier"></i></a></li>
                                    <li class="el-item"><a class="btn default btn-outline el-link add-cart" data-qty="1" data-cart="{{ $product->id }}" title="أضافة للسلة"><i class="sl-icon-bag"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="d-flex no-block align-items-center">
                            <div class="m-l-15">
                                <h4 class="m-b-0">{{$product->product_name}}</h4>
                                <span class="text-muted">{{$product->categories['ar_name']}}</span>
                            </div>
                            <div class="ml-auto m-r-15">
                                <button type="button" class="btn btn-dark btn-circle">${{$product->product_price}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach


        </div>
        @if(empty($product))
            <p style="text-align: center">لا يوجد منتجات</p>
        @endif
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
    <script src="{{asset('dashboard_files/assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('dashboard_files/assets/libs/magnific-popup/meg.init.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="{{ asset('dashboard_files/dist/js/orders.js') }}?<?php time() ?>"></script>

    <script>

        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(".add-cart").click(function(e) {
                var product_id = $(this).data('cart');;
                var quantity = $(this).data('qty');

                $.ajax({
                        data:{quantity: quantity, product_id: product_id},
                        url: "{{url('dashboard/cart') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function(data) {
                            $('#modal_add_new_form').trigger("reset");
                            $('#modal_create_new').modal('hide');
                            toastr.success('تم الأضافة بنجاح😍😍');
                        },
                        error: function(data) {
                            console.log('Error:', data);
                            toastr.error('يرجى التاكد من ادخال البيانات كاملة');


                            e.preventDefault();
                        }
                    })


            });


        });
    </script>


@endpush
