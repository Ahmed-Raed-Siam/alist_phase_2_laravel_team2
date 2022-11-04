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
                        <h4 class="card-title">اضافة</h4>
                        <h6 class="card-subtitle"> </h6>
                        <form class="mt-4" id="transport-form">
                            <div class="form-group row">
                                <label class="col-3 col-form-label">الصورة :<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <label for="title">Choose Image Cover</label>
                                    <input type="file" id="driver_image" name="driver_image" accept="image/*"
                                        onchange="previewImage(this);" /><br />
                                    </p>
                                    <img id="previewImg" src={{ asset('dashboard_files/assets/images/blank.png') }}
                                        width="100px" height="100px" alt="Placeholder">
                                    <p>
                                </div>
                            </div>

                            <div class="form-group row mt-4">
                                <label class="col-3 col-form-label">اسم السائق :<span class="text-danger">*</span></label>
                                <div class="col-6">
                                    <input name="driver_name" type="text" class="form-control" id="driver_name" />
                                    <span class="form-text text-muted">الرجاء ادخال السائق</span>
                                </div>

                                <div class="col-6">
                                    <input name="type" type="hidden" class="form-control" id="type" value="create"
                                        placeholder="Please enter your name" />


                                </div>

                            </div>

                            <div class="form-group row mt-4">
                                <label class="col-3 col-form-label">نوع المركبة :<span class="text-danger">*</span></label>
                                <div class="col-6">
                                    <input name="vehicle_type" type="text" class="form-control" id="vehicle_type" />

                                    <span class="form-text text-muted">الرجاء ادخال نوع المركبة</span>
                                </div>

                                <div class="col-6">
                                    <input name="type" type="hidden" class="form-control" id="type" value="create"
                                        placeholder="Please enter your name" />


                                </div>

                            </div>

                            <div class="form-group row mt-4">
                                <label class="col-3 col-form-label">رقم لوحة السيارة :<span
                                        class="text-danger">*</span></label>
                                <div class="col-6">
                                    <input name="plate_number" type="number" class="form-control" id="plate_number" />

                                    <span class="form-text text-muted">الرجاء ادخال رقم لوحة السيارة</span>
                                </div>

                                <div class="col-6">
                                    <input name="type" type="hidden" class="form-control" id="type" value="create"
                                        placeholder="Please enter your name" />


                                </div>

                            </div>



                            <br>
                            <br>
                            <br>
                            <br>
                            <div class="col-9">
                                <button type="button" onclick="store()" class="btn btn-success">

                                    <i class="fa fa-check"></i>
                                    حفظ</button>

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
        {{-- Start_store --}}

        function store() {
            let formData = new FormData($('#transport-form')[0]);
            axios.post('/dashboard/transport', formData, {}).then(function(response) {
                console.log(response);
                toastr.success(response.data.message);
                window.location.href = '/dashboard/transport/';
            }).catch(function(error) {

                let messages = '';
                if (typeof error.response.data.message == 'string') {
                    toastr.error(error.response.data.message);
                } else {
                    for (const [key, value] of Object.entries(error.response.data.message)) {
                        messages += '-' + value + '</br>';
                    }
                    toastr.error(messages);
                }

            });

        }
        {{-- End_store --}}

        {{-- Start_previewImage --}}

        function previewImage(input) {
            var file = $("input[type=file]").get(0).files[0];

            if (file) {
                var reader = new FileReader();
                reader.onload = function() {
                    $("#previewImg").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        }
        {{-- End_previewImage --}}
    </script>
@endpush
