@extends('dashboard.layout.parent')
@section('title', 'الاعلانات')
@section('page-title', 'الاعلانات')
@section('main-title', 'الاعلانات')
@section('sub-main-title', 'تعديل')
@section('content')

@push('styles')

@endpush

<div class="container-fluid">

    <!-- row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">تعديل</h4>
                    <h6 class="card-subtitle">   </h6>
                    <form  class="mt-4" id="create-form" >
                        <div class="form-group row">
                            <label class="col-3 col-form-label">الصورة :<span class="text-danger">*</span></label>
                            <div class="form-group">
                                <label for="title">Choose Image Cover</label>
                                <input type="file" id="image" name="image" accept="image/*" onchange="previewFile(this);" /><br/>
                                </p>
                                <img id="previewImg"  src="{{url(Storage::url($ad->image))}}" width="100px" height="100px" alt="Placeholder">
                                <p>
                            </div>
                        </div>


                        <div class="form-group row mt-4">
                            <label class="col-3 col-form-label">العنوان :<span class="text-danger">*</span></label>
                            <div class="col-6">
                                <input name="title" type="text" class="form-control" id="title"  value="{{$ad->title}}" />

                            </div>

                        </div>
                        <div class="form-group row mt-4">
                            <label class="col-3 col-form-label">الوصف :<span class="text-danger">*</span></label>
                            <div class="col-6">
                                <input name="description" type="text" class="form-control" id="description"  value="{{$ad->description}}" />


                            </div>

                        </div>

                        <div class="form-group row mt-4">
                            <label class="col-3 col-form-label">الرابط :<span class="text-danger">*</span></label>
                            <div class="col-6">
                                <input name="link" type="text" class="form-control" id="link"  value="{{$ad->link}}" />


                            </div>
                        </div>

                         <br>
                        <div class="col-9">
                        <button type="button" onclick="update('{{$ad->id}}')" class="btn btn-primary">تحديث</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop


@push('script')

<script>
    {{--Start_store--}}

    function update(id) {
        let formData = new FormData($('#create-form')[0]);
        formData.append('_method','PUT');
        axios.post('/dashboard/ads/'+id, formData).then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            window.location.href = '/dashboard/ads/';
        }).catch(function (error) {

            let messages = '';
            if(typeof  error.response.data.message == 'string'){
                toastr.error(error.response.data.message);
            }else{
                for (const [key, value] of Object.entries(error.response.data.message)) {
                    messages+='-'+value+'</br>';
                }
                toastr.error(messages);
            }

        });

    }
    {{--End_store--}}

    {{--Start_previewImage--}}

    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];

        if(file){
        var reader = new FileReader();
        reader.onload = function(){
        $("#previewImg").attr("src", reader.result);
    }
        reader.readAsDataURL(file);
    }
    }
{{--End_previewImage--}}

</script>


@endpush
