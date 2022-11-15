@extends('dashboard.layout.parent')
@section('title', 'Delivery Management')
@section('page-title', 'Delivery Management')
@section('main-title', 'Delivery')
@section('sub-main-title', 'Index')


@section('content')
    <div class="row justify-content-center" style="margin-right: -8px;">

        <div class="container">

            <form action="{{ route('delivery.index') }}" method="get" class="d-flex mb-4">
                <input type="text" name="data" class="form-control me-2" placeholder="Search by selected">

                <div class="form-group mb-3" style="max-height:18px ; width 25px">

                    <select name="type" id="type" class="form-control" style="width:100px">
                        <option value="1">رقم الجوال</option>
                        <option value="2"> رقم الطلب</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-secondary">Filter</button>
            </form>

            <div class="row">



                <div class="table-toolbar mb-3">
                    <a href="{{ route('delivery.create') }}" class="btn btn-info">إنشاء</a>
                </div>

                <div class="table-toolbar mb-3">
                    <button style="margin-bottom: 10px" class="btn btn-primary delete_all" data-url="">حذف المحدد</button>
                </div>

                <div class="form-group mb-3">
                    <select name="status" id="status" class="form-control">
                        <option value="">تغيير حالة الطلب</option>
                        <option value="1">جاري معالحة الطلب</option>
                        <option value="2">تم اضافة الطلب</option>
                        <option value="3">قيد التوصيل</option>
                        <option value="4">تم التوصيل</option>
                    </select>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th width="50px"><input type="checkbox" id="master"></th>
                            <th>رقم الطلب</th>
                            <th>اسم السائق</th>
                            <th>رقم الجوال</th>
                            <th>اجمالي المبلغ </th>
                            <th>الحالة </th>
                            <th>التقييم </th>
                            <th>العنوان </th>
                            <th>اجرائات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr id="tr_{{ $item->id }}">

                                <td><input type="checkbox" class="sub_chk" data-id="{{ $item->id }}"></td>

                                <td>{{ $item->order->order_number }}</td>
                                <td>{{ $item->driver->name }}</td>
                                <td>{{ $item->mobile }}</td>
                                <td>{{ $item->total_amount }}</td>
                                <td>{{ $item->status_name }}</td>
                                <td>{{ $item->evaluation }}</td>
                                <td>{{ $item->address }}</td>

                                <td>
                                    <a href="{{ route('delivery.edit', [$item->id]) }}">تعديل</a>
                                </td>

                                <td>
                                    <a href="#" class="btn btn-xs btn-danger btn-flat show_confirm"
                                        data-toggle="tooltip" title='Delete'
                                        onclick="performDestroy({{ $item->id }} , this)">حذف</a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{ asset('js/crud2.js') }}"></script>
    <script src="{{ asset('js/sweetalert.js') }}"></script>
    <script type="text/javascript">

        $(document).ready(function() {
            $('#master').on('click', function(e) {
                if ($(this).is(':checked', true)) {
                    $(".sub_chk").prop('checked', true);
                } else {
                    $(".sub_chk").prop('checked', false);
                }
            });

            $('.delete_all').on('click', function(e) {
                var allVals = [];
                $(".sub_chk:checked").each(function() {
                    allVals.push($(this).attr('data-id'));
                });

                if (allVals.length <= 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'يجب تحديد عنصر واحد على الاقل !',

                    })
                } else {

                    confirmDestroyMany('/dashboard/delivery-delete-many', allVals);

                }
            });

            $('#status').on('change' , function(e){
                var allVals = [];
                $(".sub_chk:checked").each(function() {
                    allVals.push($(this).attr('data-id'));
                });

                if (allVals.length <= 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'يجب تحديد عنصر واحد على الاقل !',

                    })
                } else {
                    updateMany(`/dashboard/delivery-update-many/${this.value}`, allVals , '/dashboard/delivery');

                }
            })

        });
    </script>

    <script>
        function performDestroy(id, reference) {
            confirmDestroy('/dashboard/delivery', id, reference);
        }
    </script>
@endsection
