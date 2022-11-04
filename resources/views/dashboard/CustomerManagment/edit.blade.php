@extends('dashboard.layout.parent')
@section('title', 'إدارة الزبائن')
@section('page-title', 'إدارة الزبائن')
@section('main-title', 'إدارة الزبائن')
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
                        <form class="mt-4" id="customer-form">
                            <div class="form-group row">
                                <label class="col-3 col-form-label">الصورة :<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <label for="title">Choose Image Cover</label>
                                    <input type="file" id="customer_image" name="customer_image" accept="image/*"
                                        onchange="previewImage(this);" /><br />
                                    </p>
                                    {{--<img id="previewImg" src="{{ url(Storage::url($customerManagment->customer_image)) }}" width="100px" height="100px" alt="Not Found">--}}
                                    <img id="previewImg" src="{{ asset('storage/app/public/' . $customerManagment->customer_image) }}" width="100px" height="100px" alt="Not Found">
                                    <p>
                                </div>
                            </div>

                            <div class="form-group row mt-4">
                                <label class="col-3 col-form-label">اسم مالك المتجر :<span
                                        class="text-danger">*</span></label>
                                <div class="col-6">
                                    <input name="shop_owner_name" id="shop_owner_name" type="text" class="form-control"
                                        value={{ $customerManagment->shop_owner_name }}>
                                </div>
                            </div>

                            <div class="form-group row mt-4">
                                <label class="col-3 col-form-label">اسم المتجر :<span class="text-danger">*</span></label>
                                <div class="col-6">
                                    <input name="supermarket_name" id="supermarket_name" type="text" class="form-control"
                                        value={{ $customerManagment->supermarket_name }}>
                                </div>
                            </div>

                            <div class="form-group row mt-4">
                                <label class="col-3 col-form-label">العنوان :<span class="text-danger">*</span></label>
                                <div class="col-6">
                                    <input name="address" id="address" type="text" class="form-control"
                                        value={{ $customerManagment->address }}>
                                </div>
                            </div>

                            <div class="form-group row mt-4">
                                <label class="col-3 col-form-label">رقم الهاتف :<span class="text-danger">*</span></label>
                                <div class="col-6">
                                    <input name="mobile" type="number" class="form-control" id="mobile"
                                        value={{ $customerManagment->mobile }}>
                                </div>
                            </div>

                            <div class="form-group row mt-4">
                                <label class="col-3 col-form-label">البريد الالكتروني :<span
                                        class="text-danger">*</span></label>
                                <div class="col-6">
                                    <input name="email" type="email" class="form-control" id="email"
                                        value={{ $customerManagment->email }}>
                                </div>
                            </div>

                            <div class="form-group row mt-4">
                                <label class="col-3 col-form-label">مجموع النقاط :<span class="text-danger">*</span></label>
                                <div class="col-6">
                                    <input name="total_point" type="number" class="form-control" id="total_point"
                                        value={{ $customerManagment->total_point }} />
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <br>
                            <div class="col-9">
                        <button type="button" onclick="customerUpdate('{{$customerManagment->id}}')" class="btn btn-primary">تعديل</button>

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

    //Update Function
    function customerUpdate(id) {
        let formData = new FormData($('#customer-form')[0]);
        formData.append('_method','PUT');
        axios.post('/dashboard/customer/'+id, formData).then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            window.location.href = '/dashboard/customer/';
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

    //Preview Image

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
