@extends('dashboard.layout.parent')
@section('title', 'المنتتجات')
@section('page-title', 'المنتجات')
@section('main-title', 'الرئيسية')
@section('sub-main-title', 'المنتجات')
@section('styles')
@push('styles')
<link href="{{asset('dashboard_files/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    .dt-buttons {
        float: left;
    }

    .form-select {
        float: left;

    }
</style>
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">تصدير المنتجات
                </h4>
                <a class="dt-button buttons-copy buttons-html5 btn btn-primary mr-1" href="{{route('restoreAllProudect')}}" style="float:left; margin-bottom: 20px;color:aliceblue;">استرجاع جميع المحذوفات</a>

                <div class="table-responsive">
                    <table id="file_export" class="table table-striped table-bordered display">
                        <thead>
                            <tr>
                                <th>رقم</th>
                                <th></th>
                                <th>صورة</th>
                                <th>التصنيف</th>
                                <th>اسم المنتج</th>
                                <th>التاريخ</th>
                                <th>السعر</th>
                                <th>رقم الباركود</th>
                                <th>الوحدة</th>
                                <th>هل متوفر</th>
                                <th>تفاصيل</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody style="text-align:center ;">
                            @foreach($products as $product)
                            <tr id="tr_{{ $product->id }}">
                                <td>{{$product['id']}}</td>
                                <td><input type="checkbox" class="sub_chk" data-id="{{$product->id}}"></td>

                                <td><img src="{{ $product->image_url }}" style="width: 70px;height: 70px;" alt=""></td>
                                <td>{{$product->categories['ar_name']}}</td>
                                <td>{{$product['product_name']}}</td>
                                <td>{{$product['product_date']}}</td>
                                <td>{{$product['product_price']}}</td>
                                <td>#{{$product['product_barcode']}}</td>
                                <td>{{$product['produect_unit']}}</td>
                                <td>
                                    @if($product['status'] == "Available")
                                    <i class="fa fa-check-square" style="font-size:20px;color:blue"></i>
                                    @elseif($product['status'] == "Unavailable")
                                    <i class="fa fa-window-close" style="font-size:20px;color:red"></i>
                                    @endif
                                </td>
                                <td>{{$product['product_details']}}</td>
                                <td>
                                    <a href="{{route('restoreProdect',$product->id)}}" class="btn btn-primary btn-xs fas fa-edit "></a>

                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>رقم</th>
                                <th></th>
                                <th>صورة</th>
                                <th>التصنيف</th>
                                <th>اسم المنتج</th>
                                <th>التاريخ</th>
                                <th>السعر</th>
                                <th>رقم الباركود</th>
                                <th>الوحدة</th>
                                <th>هل متوفر</th>
                                <th>تفاصيل</th>
                                <th>العمليات</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
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



@endpush
