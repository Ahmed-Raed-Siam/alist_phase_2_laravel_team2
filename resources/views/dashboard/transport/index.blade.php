@extends('dashboard.layout.parent')
@section('title', 'إدارة سيارات النقل')
@section('page-title', 'إدارة سيارات النقل')
@section('main-title', 'إدارة سيارات النقل')
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
                                    <th>صورة السائق</th>
                                    <th>اسم السائق</th>
                                    <th>نوع السيارة </th>
                                    <th>رقم اللوحة</th>
                                    <th>تاريخ الانشاء</th>
                                    <th>الإعدادات</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                                @forelse ($transport as  $transport)
                                    <tr>
                                       <?php $i++; ?>
                                       <td>{{ $i }}</td>
                                          <td>
                                            {{--<img class="img-circle img-bordered-sm" width="65" height="65" src="{{url(Storage::url($transport->driver_image))}}" alt="User Image">--}}
                                            <img class="img-circle img-bordered-sm" width="65" height="65" src="{{ asset('storage/app/public/' . $transport->driver_image) }}" alt="User Image">
                                          </td>
                                       <td>{{$transport->driver_name}}</td>
                                       <td>{{$transport->vehicle_type}}</td>
                                       <td>{{$transport->plate_number}}</td>
                                       <td>{{ $transport->created_at }}</td>
                                       <td>
                                            <a href="{{ route('transport.edit',$transport->id) }}" class="btn btn-info btn-circle"><i class="fas fa-edit"></i></a>
                                            <a href="#" onclick="performDestroy('{{$transport->id}}',this)"  class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></a>
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
        function performDestroy(id, reference){
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
            axios.delete('/dashboard/transport/'+id)
                .then(function (response) {
                    console.log(response);
                    reference.closest('tr').remove();
                    showMessage(response.data);
                })
                .catch(function (error) {
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
