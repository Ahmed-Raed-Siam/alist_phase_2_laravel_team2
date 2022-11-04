@extends('dashboard.layout.parent')
@section('title', 'إدارة سيارات النقل')
@section('page-title', 'إدارة سيارات النقل')
@section('main-title', 'إدارة سيارات النقل')
@section('sub-main-title', 'إنشاء')
@section('content')

    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush

    <div class="container-fluid">

        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">تعديل</h4>
                        <h6 class="card-subtitle"> </h6>
                        <form class="mt-4" id="transport-form">
                            <div class="form-group row">
                                <label class="col-3 col-form-label">الصورة :<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <label for="title">Choose Image Cover</label>
                                    <input type="file" id="driver_image" name="driver_image" accept="image/*"
                                        onchange="previewImage(this);" /><br />
                                    </p>
                                    {{-- <img id="previewImg" src="{{ url(Storage::url($transport->driver_image)) }}" width="100px" height="100px" alt="Not Found"> --}}
                                    <img id="previewImg" src="{{ asset('storage/app/public/' . $transport->driver_image) }}" width="100px" height="100px" alt="Not Found">
                                    <p>
                                </div>
                            </div>


                            <div class="form-group row mt-4">
                                <label class="col-3 col-form-label">اسم السائق :<span class="text-danger">*</span></label>
                                <div class="col-6">
                                    <input name="driver_name" type="text" class="form-control" id="driver_name"
                                        value={{ $transport->driver_name }} />
                                </div>

                            </div>

                            <div class="form-group row mt-4">
                                <label class="col-3 col-form-label">نوع المركبة :<span class="text-danger">*</span></label>
                                <div class="col-6">
                                    <input name="vehicle_type" type="text" class="form-control" id="vehicle_type"
                                        value={{ $transport->vehicle_type }} />
                                </div>
                            </div>

                            <div class="form-group row mt-4">
                                <label class="col-3 col-form-label">رقم لوحة السيارة :<span
                                        class="text-danger">*</span></label>
                                <div class="col-6">
                                    <input name="plate_number" type="number" class="form-control" id="plate_number"
                                        value={{ $transport->plate_number }} />
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <br>
                            <div class="col-9">

                                <button type="button" onclick="updateTransport('{{ $transport->id }}')"
                                    class="btn btn-primary">تعديل</button>


                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@push('script')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>

    //Update Transport Function
    function updateTransport(id) {
        let formData = new FormData($('#transport-form')[0]);
        formData.append('_method','PUT');
        axios.post('/dashboard/transport/'+id, formData).then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            window.location.href = '/dashboard/transport/';
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

    //Image Preview

    function previewImage(input){
        var file = $("input[type=file]").get(0).files[0];
        if(file){
        var reader = new FileReader();
        reader.onload = function(){
        $("#previewImg").attr("src", reader.result);
    }
        reader.readAsDataURL(file);
    }
    }

</script>

@endpush
