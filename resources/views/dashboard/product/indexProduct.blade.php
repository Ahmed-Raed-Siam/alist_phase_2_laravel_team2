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

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">نظرة عامة ع المنتجات

            </h4>
            <div class="d-flex align-items-center">
                {{$date}}
            </div>

        </div>

    </div>

</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">تصدير المنتجات

                    <div class="dropdown" style="float: left;">
                        <button class="dropdown-toggle btn btn-primary mr-1" style="float: left;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="{{route('showDeleletProduct')}}">المحذوفات</a></li>
                            <li><a class="dropdown-item delete_all" href="#">حذف جميع المنتجات</a></li>
                        </ul>
                    </div>
                    <a class="dt-button buttons-copy buttons-html5 btn btn-primary mr-1" href="{{route('products.create')}}" style="float:left; margin-bottom: 20px;color:aliceblue;">اضافة منتج +</a>

                </h4>

                @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div><br />
                @endif
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
                                    <form class="delete" action="{{route('products.destroy',$product->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-xs fas fa-trash-alt " type="submit"></button>
                                    </form>
                                    <a href="{{route('products.edit',$product->id)}}" class="btn btn-primary btn-xs fas fa-edit"></a>

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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script src="{{asset('dashboard_files/dist/js/pages/datatable/datatable-advanced.init.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>


<script>
    $('.delete').click(function(event) {
        $this = $(this);
        event.preventDefault();
        Swal.fire({

            title: 'هل أنت واثق من الحذف ؟',
            text: "لن تكون قادر على استرجاعها !",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#309524',
            cancelButtonColor: '#d33',
            confirmButtonText: 'نعم احذفها!',
            cancelButtonText: 'إلغاء'
        }).then((result) => {
            if (result.value) {
                url = $($this).attr('action');
                data = $($this).serialize();
                $.post(url, data, function(response) {

                    Swal.fire(
                        'تم الحذف !',
                        'تم حذف ملفك',
                        'بنجاح'

                    ), location.reload();

                });

            };
        })

    });
</script>

<script type="text/javascript">
    $(document).ready(function() {

        $('.delete_all').on('click', function(e) {
            var allVals = [];
            $('.sub_chk:checked').each(function() {
                allVals.push($(this).attr('data-id'));
            });

            if (allVals.length <= 0) {
                alert("الرجاء اختيار عناصر ");
            } else {
                var check = confirm("هل أنت متأكد أنك تريد حذف هذا الصف؟");
                if (check == true) {
                    var join_selected_values = allVals.join(",");

                    $.ajax({
                        url: "productsDeleteAll",
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: 'ids=' + join_selected_values,
                        success: function(data) {
                            console.log(data);
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {
                                    $(this).parents("tr").remove();
                                });
                                alert(data['success']);
                            } else if (data['success']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function(data) {
                            alert(data.responseText);
                        }
                    });

                    $.each(allVals, function(index, value) {
                        $('table tr').filter("[data-row-id='" + value + "']").remove();
                    });
                }
            }
        });
    });
</script>
@endpush
