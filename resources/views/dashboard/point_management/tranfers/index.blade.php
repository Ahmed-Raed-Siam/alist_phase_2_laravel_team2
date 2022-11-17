@extends('dashboard.layout.parent')
@section('title', 'Points transfers')
@section('page-title', 'Points transfers')
@section('main-title', 'Points ')
@section('sub-main-title', 'Transfers')


@section('content')
    <div class="row justify-content-center" style="margin-right: -8px;">

        <div class="container">

            {{-- <form action="{{ route('delivery.index') }}" method="get" class="d-flex mb-4">
                <input type="text" name="data" class="form-control me-2" placeholder="Search by name">


                <button type="submit" class="btn btn-secondary">Filter</button>
            </form> --}}

            <div class="row">



                <div class="table-toolbar mb-3">
                    <a href="{{ route('points-management.index') }}" class="btn btn-info">إنشاء</a>
                </div>

                {{-- <div class="table-toolbar mb-3">
                    <button style="margin-bottom: 10px" class="btn btn-primary delete_all" data-url="">حذف
                        المحدد</button>
                </div> --}}

                <table class="table">
                    <thead>
                        <tr>
                            {{-- <th width="50px"><input type="checkbox" id="master"></th> --}}
                            <th>#</th>
                            <th> المرسل</th>
                            <th> المستقبِل</th>
                            <th>النقاط المحولة </th>
                            <th>وقت التحويل</th>
                            <th>اجرائات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr id="tr_{{ $item->id }}">

                                {{-- <td><input type="checkbox" class="sub_chk" data-id="{{ $item->id }}"></td> --}}

                                <td>{{ $item->id }}</td>

                                <td>{{ $item->point_from_customer->mobile }}</td>
                                <td>{{ $item->point_to_customer->mobile }}</td>
                                <td>{{ $item->points_number}}</td>
                                <td>{{ $item->created_at}}</td>

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

    <script type="text/javascript">


        // $(document).ready(function() {
        //     $('#master').on('click', function(e) {
        //         if ($(this).is(':checked', true)) {
        //             $(".sub_chk").prop('checked', true);
        //         } else {
        //             $(".sub_chk").prop('checked', false);
        //         }
        //     });

        //     $('.delete_all').on('click', function(e) {
        //         var allVals = [];
        //         $(".sub_chk:checked").each(function() {
        //             allVals.push($(this).attr('data-id'));
        //         });

        //         if (allVals.length <= 0) {
        //             Swal.fire({
        //                 icon: 'error',
        //                 title: 'Oops...',
        //                 text: 'يجب تحديد عنصر واحد على الاقل !',

        //             })
        //         } else {
        //             // confirmDestroyMany('/dashboard/transfer-delete-many', allVals);

        //         }
        //     });

        //     $('#status').on('change', function(e) {
        //         var allVals = [];
        //         $(".sub_chk:checked").each(function() {
        //             allVals.push($(this).attr('data-id'));
        //         });

        //         if (allVals.length <= 0) {
        //             Swal.fire({
        //                 icon: 'error',
        //                 title: 'Oops...',
        //                 text: 'يجب تحديد عنصر واحد على الاقل !',

        //             })
        //         } else {
        //             updateMany(`/dashboard/delivery-update-many/${this.value}`, allVals,
        //                 '/dashboard/delivery');

        //         }
        //     })

        // });
    </script>

    <script>
        function performDestroy(id, reference) {
            confirmDestroy('/dashboard/points-transfer', id, reference);
        }
    </script>
@endsection
