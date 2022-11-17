@extends('dashboard.layout.parent')
@section('title', 'Orders Points')
@section('page-title', 'Orders Points')
@section('main-title', 'Orders  ')
@section('sub-main-title', 'Points')


@section('content')
    <div class="row justify-content-center" style="margin-right: -8px;">

        <div class="container">

            <div class="row">



                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>رقم الطلب</th>
                            <th>اسم الزبون </th>
                            <th>عدد النقاط</th>
                            <th> وقت الاضافة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr id="tr_{{ $item->id }}">


                                <td>{{ $item->id }}</td>

                                <td>{{ $item->order->order_number}}</td>
                                <td>{{ $item->customer->shop_owner_name}}</td>
                                <td>{{ $item->points_number}}</td>
                                <td>{{ $item->created_at}}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{ asset('js/crud2.js') }}"></script>

    <script type="text/javascript">

    </script>

    <script>
        function performDestroy(id, reference) {
            confirmDestroy('/dashboard/points-transfer', id, reference);
        }
    </script>
@endsection
