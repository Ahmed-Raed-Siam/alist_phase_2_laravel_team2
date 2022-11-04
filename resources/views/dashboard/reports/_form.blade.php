@extends('dashboard.layout.parent')
@section('title', 'reports')
@section('page-title', 'reports')
@section('main-title', 'users')
@section('sub-main-title', 'index')
@section('content')


@if($errors->any())
<div class="alert alert-danger">
    Errror!
    <ul>
        @foreach($errors->all() as $message)
        <li>{{ $message }}</li>
        @endforeach
    </ul>
</div>

@endif

<form action="{{route('reports.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row justify-content-center">

    <div class="container">

        

            <div class="form-group mb-3">
                <label for="">اسم المنتج:</label>
                <select name="product_id" class="form-control @error('product_id') is-invlaid @enderror">
                    <option value="">اختار اسم المنتج</option>
                    @foreach ($product as $products)
                    <option value="{{ $products->id }}" @if($products->id==old('product_id',$products->product_id)) selected @endif>{{ $products->product_name }}</option>
                    @endforeach
                </select>
                @error('product_id')
                <p class="invalid-feedback d-block">{{ $message }}</p>
                @enderror
            </div>

            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            

        </div>

    </div>


</form>

            <div class="form-group">
            <button class="btn btn-primary" style="margin: 70px;">
            <a href="{{  route('reports.index')  }}">Cancel</a></button>
            </div>

@endsection