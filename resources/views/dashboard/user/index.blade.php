@extends('dashboard.layout.parent')
@section('title', 'users')
@section('page-title', 'المستخدمين')
@section('main-title', 'users')
@section('sub-main-title', 'index')
@section('content')

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- basic table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"> </h4>
                    <h6 class="card-subtitle"></a></h6>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>

                                    <th>الرقم المتسلسل</th>

                                    <th>الاسم</th>
                                    <th>البريد الكتروني</th>
                                    <th>انشئ بتاريخ</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as  $user)
                                        <tr>

                                            <td> {{ $loop->iteration }}</td>

                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at }}</td>

                                            <td>
                                                <a href="{{ route('users.edit',$user->id) }}" class="btn btn-info waves-effect waves-light"><i class="fas fa-edit"></i></a>
                                                <a href="#" onclick="performDestroy('{{$user->id}}', this)"    class="btn btn-danger waves-effect waves-light"><i class="fas fa-trash"></i></a>
                                            </td>



                                        </tr>

                                    @empty
                                        <h4> no data found</h4>
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
@push('style')

@endpush
@push('script')
<script>
    function performDestroy(id,reference) {
        confirmDestroy('/dashboard/users', id, reference);
    }
</script>
@endpush
