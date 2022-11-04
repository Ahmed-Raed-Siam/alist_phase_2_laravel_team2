@extends('dashboard.layout.parent')
@section('title', 'إدارة الزبائن')
@section('page-title', 'إدارة الزبائن')
@section('main-title', 'إدارة الزبائن')
@section('sub-main-title', 'عرض')
@section('content')

    <div class="container-fluid">

        <!-- basic table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> </h4>
                        <h6 class="card-subtitle"></h6>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="min-width: 0px">#</th>
                                        <th>صورة الزبون</th>
                                        <th>مالك المتجر</th>
                                        <th>اسم المتجر</th>
                                        <th>العنوان</th>
                                        <th>رقم الهاتف</th>
                                        <th>البريد الالكتروني</th>
                                        <th>مجموع النقاط </th>
                                        <th>الإعدادات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @forelse ($customerManagment as  $customerManagment)
                                        <tr>
                                            <?php $i++; ?>
                                            <td>{{ $i }}</td>
                                            <td>
                                                {{--<img class="img-circle img-bordered-sm" width="65" height="65" src="{{ url(Storage::url($customerManagment->customer_image)) }}" alt="User Image">--}}
                                                <img class="img-circle img-bordered-sm" width="65" height="65" src="{{ asset('storage/app/public/' . $customerManagment->customer_image) }}" alt="User Image">
                                            </td>
                                            <td>{{ $customerManagment->shop_owner_name }}</td>
                                            <td>{{ $customerManagment->supermarket_name }}</td>
                                            <td>{{ $customerManagment->address }}</td>
                                            <td>{{ $customerManagment->mobile }}</td>
                                            <td>{{ $customerManagment->email }}</td>
                                            <td>{{ $customerManagment->total_point }}</td>
                                            <td>
                                            <a href="{{ route('customer.edit',$customerManagment->id) }}" class="btn btn-info btn-circle"><i class="fas fa-edit"></i></a>
                                            <a href="#" onclick="performDestroy('{{$customerManagment->id}}',this)"  class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></a>
                                            </td>

                                        </tr>
                                    @empty
                                        <h4>لا يوجد بيانات لعرضها</h4>
                                    @endforelse
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('script')
    <script>
        function performDestroy(id, reference) {
            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "لن تتمكن من التراجع عن هذا!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'تأكيد الحذف',
                cancelButtonText: 'الغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    destroy(id, reference);
                }
            });
        }

        function destroy(id, reference) {
            //JS - Axios
            axios.delete('/dashboard/customer/' + id)
                .then(function(response) {
                    // handle success
                    console.log(response);
                    reference.closest('tr').remove();
                    showMessage(response.data);
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                    showMessage(error.response.data);
                })

        }

        function showMessage(data) {
            Swal.fire({
                icon: data.icon,
                title: data.title,
                showConfirmButton: false,
                timer: 1500
            });
        }
    </script>
@endpush
