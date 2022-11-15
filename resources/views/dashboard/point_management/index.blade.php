@extends('dashboard.layout.parent')
@section('title', 'Points Management')
@section('page-title', 'Points Management')
@section('main-title', 'Points')
@section('sub-main-title', 'Index')


@section('content')
    <div class="row justify-content-center" style="margin-right: -8px;">

        <div class="container">

            <form action="{{ route('points-management.index') }}" method="get" class="d-flex mb-4">
                <input type="text" name="shop_owner_name" class="form-control me-2" placeholder="Search by name">
                <button type="submit" class="btn btn-secondary">Filter</button>
            </form>

            <div class="row">



                <div class="table-toolbar mb-3">
                    <a href="{{ route('customer.create') }}" class="btn btn-info"> انشاء زبون جديد</a>
                </div>




                <table class="table">
                    <thead>
                        <tr>
                            {{-- <th width="50px"><input type="checkbox" id="master"></th> --}}
                            <th>#</th>
                            <th>صورة الزبون</th>
                            <th>اسم الزبون</th>
                            <th>رقم الجوال</th>
                            <th>مجموع النقاط </th>
                            <th>تحويل</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr id="tr_{{ $item->id }}">

                                {{-- <td><input type="checkbox" class="sub_chk" data-id="{{ $item->id }}"></td> --}}

                                <td>{{ $item->id }}</td>
                                {{-- <td> <img src="{{asset('uploads/images/'. $item->customer_image )}} " style="width: 100px;height: 100px;" alt=""></td> --}}
                                <td> <img src="{{ asset('dashboard_files/assets/images/users/1.jpg') }}"
                                        style="width: 75px;height: 75px;" alt=""></td>
                                <td>{{ $item->shop_owner_name }}</td>
                                <td>{{ $item->mobile }}</td>
                                <td>{{ $item->total_point }}</td>


                                <td>

                                    <button onclick="fromId({{ $item->id }})" class="btn btn-success"
                                        data-toggle="modal" id="add-order"data-target="#modals-transfear"><i
                                            class="fas fa-exchange-alt"> تحويل نقاط </i></button>



                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="modal fade" tabindex="-1" id="modals-transfear">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">عملية تحويل نقاط</h5>

                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-dismiss="modal"
                                    aria-label="Close">
                                    <span class="svg-icon svg-icon-2x"></span>
                                </div>
                                <!--end::Close-->
                            </div>


                            <form onsubmit="event.preventDefault()">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group mb-3">
                                        <label for="">رقم جوال الزبون الذي تريد التحويل اليه</label>
                                        <input type="tel" name="to" id="to" class="form-control ">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="">عدد النقاظ التي تريد تحويلها</label>
                                        <input type="number" name="points_number" id="points_number" class="form-control ">
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-light me-3 bg-danger text-light"
                                        data-modal-create-new-action="cancel" data-dismiss="modal" id="close">
                                        {{ __('الغاء') }}</button>
                                    <button type="" class="btn btn-light me-3 bg-success text-light"
                                        onclick="saveTransfer()">
                                        تأكيد عملية التحويل</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{ asset('js/crud2.js') }}"></script>

    <script type="text/javascript">
        var id = null

        function fromId(id) {
            this.id = id;
        }

        function saveTransfer() {

            let data = {
                from: this.id,
                to: document.getElementById('to').value,
                points_number: document.getElementById('points_number').value,
            }
            storeData('/dashboard/points-transfer', data, '/dashboard/points-management');

            // store('/dashboard/points-transfer' , data )
        }

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

            $('#status').on('change', function(e) {
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
                    updateMany(`/dashboard/delivery-update-many/${this.value}`, allVals,
                        '/dashboard/delivery');

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
