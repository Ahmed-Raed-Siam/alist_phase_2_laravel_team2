@extends('dashboard.layout.parent')
@section('title', 'انشاء منتج')
@section('page-title', 'انشاء منتج')
@section('main-title', 'الرئيسية')
@section('sub-main-title', 'انشاء منتج')

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div><br />
@endif

<form class="form-horizontal" method="post" action="{{route('products.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <h4 class="card-title">متطلبات</h4>
        <div class="form-group row">
            <label for="com1" class="col-sm-3 text-right control-label col-form-label">الاسم</label>
            <div class="col-sm-9">
                <input type="text" name="product_name" class="form-control" id="com1" placeholder="اسم المنتج" required>
            </div>
        </div>
         <div class="form-group row">
            <label for="com1" class="col-sm-3 text-right control-label col-form-label">الاسم</label>
            <div class="col-sm-9">
                <input type="text" name="product_name_en" class="form-control" id="com1" placeholder="اسم المنتج" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="com1" class="col-sm-3 text-right control-label col-form-label">التصنيف</label>
            <div class="col-sm-9">
                <select name="category_id" class="custom-select col-12" id="example-month-input2">
                    <option selected="">اختار...</option>
                    @foreach($category as $categories)
                    <option value="{{$categories->id}}">{{$categories->ar_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="com1" class="col-sm-3 text-right control-label col-form-label">سعر المنتج</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="number" name="product_price" class="form-control" placeholder="السعر" aria-label="Amount (to the nearest dollar)">
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="date" class="col-sm-3 text-right control-label col-form-label">التاريخ</label>
            <div class="col-sm-9">
                <input type="date" name="product_date" class="form-control" id="date" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="com1" class="col-sm-3 text-right control-label col-form-label">باركود المنتج</label>
            <div class="col-sm-9">
                <input type="number" name="product_barcode" class="form-control" id="com1" placeholder="باركود المنتج" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="com1" class="col-sm-3 text-right control-label col-form-label">الوحدة</label>
            <div class="col-sm-9">
                <input type="text" name="produect_unit" class="form-control" id="com1" placeholder="الوحدة" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 text-right control-label col-form-label">صورة المنتج</label>
            <div class="col-sm-9">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">ارفاق</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" name="product_picture" class="custom-file-input">
                        <label class="custom-file-label" for="inputGroupFile01">اختيار الصورة</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="abpro" class="col-sm-3 text-right control-label col-form-label">تفاصيل المنتج</label>
            <div class="col-sm-9">
                <input type="text" name="product_details" class="form-control" id="abpro" placeholder="تفاصيل المنتج" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 text-right control-label col-form-label">الحالة</label>
            <div class="col-sm-9">
                <div class="custom-control custom-radio">
                    <input type="radio" name="status" value="Available" class="custom-control-input" id="customControlValidation2" required>
                    <label class="custom-control-label" style="padding-right:20px ;" for="customControlValidation2">متوفر</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" name="status" value="Unavailable" class="custom-control-input" id="customControlValidation3" required>
                    <label class="custom-control-label" style="padding-right:20px ;" for="customControlValidation3">غير متوفر </label>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="card-body">
        <div class="form-group m-b-0 text-right">
            <button type="submit" class="btn btn-info waves-effect waves-light">حفظ</button>
            <a href="{{route('products.index')}}" class="btn btn-dark waves-effect waves-light">إلغاء</a>
        </div>
    </div>
</form>



@endsection
