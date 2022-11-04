@extends('dashboard.layout.parent')
@section('title', 'reports')
@section('page-title', 'reports')
@section('main-title', 'users')
@section('sub-main-title', 'index')
@section('content')


    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif

    @if (session()->has('succes'))
    <div class="alert alert-success">
        {{ session()->get('succes') }}
    </div>
    @endif

    <div class="row justify-content-center" style="margin-right: -8px;">

        <div class="container">

        <form action="{{ route('reports.index') }}" method="get" class="d-flex mb-4">
                    <input type="text" name="ar_name" class="form-control me-2" placeholder="Search by name">
                    <button type="submit" class="btn btn-secondary">Filter</button>
                </form>

            <div class="row">

                
                
                <div class="table-toolbar mb-3">
                    <a href="{{  route('reports.create')  }}" class="btn btn-info">إنشاء</a>
                </div>

                <div class="table-toolbar mb-3">
                <button style="margin-bottom: 10px" class="btn btn-primary delete_all" data-url="">Delete All Selected</button>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th width="50px"><input type="checkbox" id="master"></th>
                            <th>ID</th>
                            <th>اسم المنتج</th>
                            <th>عدد الطلبات</th>
                            <th>اجمالية الكمية الخارجة</th>
                            <th>عدد المنتج</th>
                            <th>اجمالي السعر</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                        <tr id="tr_{{$report->id}}">
                            
                            <td><input type="checkbox" class="sub_chk" data-id="{{$report->id}}"></td>
                            <td>{{ $report->id }}</td>
                            <td>{{ $report->product->product_name }}</td>
                            <td>{{ $report->number_of_orders }}</td>
                            <td>{{ $report->total_outgoing_quantity }}</td>
                            <td>{{ $report->number_of_products }}</td>
                            <td>{{ $report->total_price }}</td>
                            <td>
                                <a href="{{  route('reports.edit',[$report->id])  }}">تعديل</a>
                            </td>
                                <td>
                                <form method="POST" action="{{  route('reports.destroy',[$report->id])  }}">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
                                </form>
                                </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
               

            </div>
        </div>
    </div> 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
   
<script type="text/javascript">
 
     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete it?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
  
   $(document).ready(function () {


        $('#master').on('click', function(e) {
         if($(this).is(':checked',true))  
         {
            $(".sub_chk").prop('checked', true);  
         } else {  
            $(".sub_chk").prop('checked',false);  
         }  
        });


        $('.delete_all').on('click', function(e) {


            var allVals = [];  
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  


            if(allVals.length <=0)  
            {  
                alert("Please select row.");  
            }  else {  


                var check = confirm("Are you sure you want to delete this row?");  
                if(check == true){  


                    var join_selected_values = allVals.join(","); 


                    $.ajax({
                        url:  "reports-delete-all",
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });


                  $.each(allVals, function( index, value ) {
                      $('table tr').filter("[data-row-id='" + value + "']").remove();
                  });
                }  
            }  
        });

    });
</script>

@endsection

