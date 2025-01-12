@extends('layouts.app')
@section('content')
    <div class="row mb-6 mt-4">
        <div class="col-sm-12 col-md-6 col-lg-6">

        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="d-flex flex-row-reverse">
                  <a class="btn btn-primary" href="{{route('expense.create')}}"><i class="bx bx-plus"></i> Add new Expense</a>
            </div>
        </div>
    </div>

        

    <div class="row mt-4">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">Expenses List</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                            <table id="file-export" class="table table-bordered text-nowrap w-100 dataTable no-footer">
                               <thead>
                               <tr>
                                   <th>SN</th>
                                   <th>Date</th>
                                   <th>Expense Type</th>
                                   <th>Account Type</th>
                                   <th>Payment</th>
                                   <th>Amount</th>
                                   <th>Created By</th>
                                   <th>Created At</th>
                                   <th>Action </th>

                               </tr>
                               </thead>
                                <tbody>
                                @foreach($expenses as $expense)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$expense->date}}</td>
                                        <td>{{$expense->name}}</td>
                                        <td>{{$expense->chart->name ?? 'N/A'}}</td>
                                        <td>{{$expense->payment->name ?? 'N/A'}} </td>
                                        <td>{{number_format($expense->amount)}}</td>
                                        <td>{{$expense->user->name ?? ''}}</td>
                                        <td>{{$expense->created_at}}</td>
                                       <td>
                                           
                                            <a href="{{route('expense.show', $expense->id)}}" class="btn btn-sm btn-success btn-wave waves-effect waves-light">
                                                <i class="ri-eye-line align-middle me-2 d-inline-block"></i>View
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                               </tbody>
                            </table>
                </div>
            </div>
        </div>
    </div>




@endsection

@section('scripts')
<script>
   $(document).ready( function (){
       $('#file-export').on('click', '.deleteTrans', function (){
           var id = $(this).data('id');
           const swalWithBootstrapButtons = Swal.mixin({
               customClass: {
                   confirmButton: 'btn btn-success ms-2',
                   cancelButton: 'btn btn-danger'
               },
               buttonsStyling: false
           })
           swalWithBootstrapButtons.fire({
               title: 'Are you sure?',
               text: "You won't be able to revert this!",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonText: 'Yes, delete it!',
               cancelButtonText: 'No, cancel!',
               reverseButtons: true
           }).then((result) => {
               if (result.isConfirmed) {
                   $.ajax({
                       url:'{{route('coa.deleteChart')}}',
                       type:'POST',
                       data:{
                           _token:'{{csrf_token()}}',
                           id:id
                       },
                       success:function (response){
                           location.reload()
                           swalWithBootstrapButtons.fire(
                               'Deleted!',
                               'Your account group has been deleted.',
                               'success'
                           )
                       },
                       error:function (error){

                       }
                   })

               } else if (
                   result.dismiss === Swal.DismissReason.cancel
               ) {
                   swalWithBootstrapButtons.fire(
                       'Cancelled',
                       'You have cancelled this action :)',
                       'error'
                   )
               }
           })
       });
   });

</script>

@endsection
