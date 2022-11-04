@extends('dashboard.layout.parent')
@section('title', 'الإعدادات')
@section('page-title', 'الإعدادات')
@section('main-title', 'الإعدادات')
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
                                    <th>الاسم</th>
                                    <th>القيمة</th>
                                    <th>انشئ بتاريخ</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                                @forelse ($settings as  $setting)
                                    <tr>
                                       <?php $i++; ?>
                                       <td>{{ $i }}</td>
                                       <td>{{ $setting->key }}</td>
                                       <td>{{ $setting->value}}</td>
                                       <td>{{ $setting->created_at->diffForHumans() }}</td>
                                       <td>
                                            <a href="{{ route('settings.edit',$setting->id) }}" class="btn btn-info btn-circle"><i class="fas fa-edit"></i></a>
                                            <a href="#" onclick="confirmDestroy('{{$setting->id}}',this)"  class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></a>
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
        function confirmDestroy(id, reference){
            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "لن تتمكن من التراجع عن هذا!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم،احذفه!',
                cancelButtonText: 'الغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    destroy(id, reference);
                }
            });
        }

        function destroy(id, reference) {
            //JS - Axios
            axios.delete('/dashboard/settings/'+id)
                .then(function (response) {
                    // handle success
                    console.log(response);
                    reference.closest('tr').remove();
                    showMessage(response.data);
                })
                .catch(function (error) {
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
