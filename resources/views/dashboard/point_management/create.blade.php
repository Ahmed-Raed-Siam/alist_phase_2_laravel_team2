@extends('dashboard.layout.parent')
@section('title', 'Delivery - Create')
@section('page-title', 'انشاء طلب توصيل جديد')
@section('main-title', 'Delivery Management')
@section('sub-main-title', 'Create')

@push('styles')
    <style>

    </style>
@endpush

@section('content')


    <form onsubmit="event.preventDefault()">
        @csrf
        <div class="row justify-content-center">

            <div class="container">


                <div class="form-group mb-3">
                    <label for="">الطلب</label>
                    <select name="order_id" id="order_id" class="form-control">>
                        @foreach ($orders as $order)
                            <option value="{{ $order->id }}">{{ $order->order_number }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="">السائق</label>
                    <select name="driver_id" id="driver_id" class="form-control">>
                        @foreach ($drivers as $driver)
                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                        @endforeach
                    </select>
                </div>



                <div class="form-group mb-3">
                    <label for="">رقم الجوال</label>
                    <input type="tel" name="mobile" id="mobile" class="form-control ">
                </div>

                <div class="form-group mb-3">
                    <label for=""> العنوان</label>
                    <input type="text" name="address" id="address" class="form-control ">

                </div>

                <div class="form-group mb-3">
                    <label for="">المبلغ </label>
                    <input type="number" name="total_amount" id="total_amount" class="form-control ">
                </div>

                <div class="form-group mb-3">
                    <label for="">الحالة</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1">جاري معالحة الطلب</option>
                        <option value="2">تم اضافة الطلب</option>
                        <option value="3">قيد التوصيل</option>
                        <option value="4">تم التوصيل</option>
                    </select>
                </div>


                <div class="form-group mb-3">
                    <label for="">التقييم</label>
                    <input type="number" name="evaluation" id="evaluation" class="form-control ">
                </div>



                <div class="form-group">
                    <button type="submit" class="btn btn-primary" onclick="storeData()">حفظ</button>
                </div>

            </div>

        </div>


    </form>

    <div class="form-group">
        <button class="btn btn-primary" style="margin: 70px;">
            <a href="{{ route('delivery.index') }}">Cancel</a></button>
    </div>


    @push('script')
    <script src="{{ asset('js/crud2.js') }}"></script>
        <script>
            function storeData(){
                console.log('test');

                let data = {
                order_id : document.getElementById('order_id').value,
                driver_id : document.getElementById('driver_id').value,
                mobile : document.getElementById('mobile').value,
                address : document.getElementById('address').value,
                total_amount : document.getElementById('total_amount').value,
                status : document.getElementById('status').value,
                evaluation : document.getElementById('evaluation').value,

            }
                store('/dashboard/delivery', data , '/dashboard/delivery');

            }

        </script>
    @endpush
@endsection






