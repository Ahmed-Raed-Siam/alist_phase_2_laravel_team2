@extends('dashboard.layout.parent')
@section('title', 'الصفحة الرئيسية')
@section('page-title', ' نظرة عامة على الفواتير')
@section('main-title', 'title')
@section('sub-main-title', 'sub-title')
@push('styles')
    <style>

    </style>
@endpush




@section('content')

    <div class="container-fluid">
        <h6 class="pr-6"> {{ date('h:i:s') }} || {{ date('d-m-y') }} </h6>
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-group">
                            <!-- Card -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">

                                        <div>
                                            <a href="{{ route('cart') }} " class="btn btn-success"> <i class="fa fa-plus"></i> طلب جديد
                                            </a>
                                        </div>
                                        <div class="ml-auto">
                                            <h2 class="m-b-0 font-light"> إجمالي المبيعات {{ $total_items }} $  </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">

                                        <div>

                                        </div>
                                        <div class="ml-auto">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">

                                        <div>
                                            <a href=" {{route('customer.create')}} " class="btn btn-success"> <i class="fa fa-plus"></i> متجر جديد
                                            </a>
                                        </div>
                                        <div class="ml-auto">
                                            <h3 class="m-b-0 font-light"> إجمالي المتاجر  {{ $customaer }} </h3>

                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Column -->
            <div class="col-12  ">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <div class="col-sm-12  ">
                                    <div class="form-group row">
                                        <h4>المبيعات</h4>

                                    </div>
                                </div>

                            </div>
                            <div class="ml-auto">
                                <ul class="list-inline font-12 dl m-r-10">
                                    <li class="list-inline-item">
                                        <div class="col-12">

                                            <select  class="form-control" id="year">
                                                @for($i=6 ; $i >= 0 ; $i--)
                                                    <option
                                                        value="{{now()->subYears($i)->year}}" {{now()->subYears($i)->year  ==  now()->year  ? 'selected' : ''}}>
                                                        {{now()->subYears($i)->year}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <canvas id="myChart" width="200" height="50"></canvas>

                    </div>
                </div>

            </div>
            <!-- Column -->



        </div>

        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <!-- basic table -->
            <div class="row mt-6">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">اخر المبيعات </h4>
                            <h6 class="card-subtitle"></a></h6>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>

                                            <th>الرقم المتسلسل</th>
                                            <th>رقم الطلب</th>
                                            <th>التاريخ</th>
                                            <th>الوقت</th>
                                            <th>   اسم السوبر ماركت</th>
                                            <th>    اسم المنتج </th>
                                            <th>    الكمية </th>
                                            <th>    السعر </th>
                                            <th>    اجمالي الفاتورة </th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($orders as $item)
                                            <tr>

                                                <td> {{ $loop->iteration }}</td>
                                                <td>{{@ $item->order_number }}</td>
                                                <td> {{@ $item->created_at->format('d/m/Y')  }} </td>
                                                <td> {{@ $item->created_at->format('h:i:s') }} </td>
                                                <td>{{@ $item->customers->supermarket_name }}</td>
                                                <td> xx</td>
                                                <td> 344 </td>
                                                <td>23$ </td>
                                                <td>233$ </td>





                                            </tr>
                                        @endforeach



                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        @push('script')
            <script>
                const ctx = document.getElementById('myChart').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'bar',

                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                function displayChart(year = '2022') {


                    fetch("{{ route('dashboard.OrderChart') }}?year=" + year)
                        .then(console.log(year))
                        .then(response => response.json())
                        .then(json => {
                            myChart.data.labels = json.labels;
                            myChart.data.datasets = json.datasets;
                            myChart.update();
                        });

                }
                $(document).on('change', '#year', function(e) {

                    e.preventDefault();

                    var val = $(this).find(':selected').val();

                    displayChart(val);
                });
                displayChart();
            </script>
        @endpush
    @endsection
