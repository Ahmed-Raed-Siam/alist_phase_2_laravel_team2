@extends('dashboard.layout.parent')
@section('title', 'items')
@section('page-title', 'المستخدمين')
@section('main-title', 'items')
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
                                    <th>#</th>
                                    <th>رقم الطلب</th>
                                    <th>اسم السائق</th>
                                    <th>رقم الجوال</th>
                                    <th>اجمالي المبلغ </th>
                                    <th>الحالة  </th>
                                    <th>التقييم  </th>
                                    <th>العنوان </th>
                                    <th>اجرائات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as  $item)
                                        <tr>


                                            <td width="50px"><input type="checkbox" id="master"></td>
                                            <td>{{ $item->order->order_number }}</td>
                                            <td>{{ $item->driver->name  }}</td>
                                            <td>{{ $item->mobile }}</td>
                                            <td>{{ $item->total_amount }}</td>
                                            <td>{{ $item->status_name }}</td>
                                            <td>{{ $item->evaluation }}</td>
                                            <td>{{ $item->address }}</td>

                                            <td>
                                                <a href="{{ route('delivery.edit',$item->id) }}" class="btn btn-info waves-effect waves-light"><i class="fas fa-edit"></i></a>
                                                <a href="#" onclick="performDestroy('{{$item->id}}', this)"    class="btn btn-danger waves-effect waves-light"><i class="fas fa-trash"></i></a>
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
        confirmDestroy('/dashboard/items', id, reference);
    }
</script>
@endpush
