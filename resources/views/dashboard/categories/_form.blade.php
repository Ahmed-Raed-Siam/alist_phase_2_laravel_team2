@extends('dashboard.layout.parent')
@section('title', 'categories')
@section('page-title', 'categories')
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

<form action="{{route('categories.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row justify-content-center">

    <div class="container">

        

            <div class="form-group mb-3">
                <label for="">الاسم العربي:</label>
                <input type="text" name="ar_name" class="form-control @error('ar_name') is-invlaid @enderror">
                @error('ar_name')
                <p class="invalid-feedback d-block">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="">الاسم انجلش:</label>
                <input type="text" name="en_name" class="form-control @error('en_name') is-invlaid @enderror">
                @error('en_name')
                <p class="invalid-feedback d-block">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group mb-3">
                    <label for="">Main:</label>
                    <select name="main_id" class="form-control @error('main_id') is-invlaid @enderror">
                        <option value="">No Main</option>
                        @foreach ($main as $parent)
                        <option value="{{ $parent->id }}" @if($parent->id==old('main_id',$category->main_id)) selected @endif>{{ $parent->ar_name }}</option>
                        @endforeach
                    </select>
                    @error('main_id')
                    <p class="invalid-feedback d-block">{{ $message }}</p>
                    @enderror
                </div>

            <div class="form-group mb-3">
                    <label for="">الصورة:</label>
                    <input type="file" name="image" class="form-control @error('image') is-invlaid @enderror">
                    @error('image')
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
            <a href="{{  route('categories.index')  }}">Cancel</a></button>
            </div>

@endsection