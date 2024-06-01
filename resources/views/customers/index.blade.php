@extends('layouts.app')
@section('content')
    <div class="row mb-6 mt-4">
        <div class="col-sm-12 col-md-6 col-lg-6">

        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="d-flex flex-row-reverse">
                  <a class="btn btn-primary" href="{{route('borrow.create')}}"><i class="bx bx-plus"></i> Add Customer</a>
            </div>
        </div>
    </div>





    <div class="modal fade" id="commentForm" tabindex="-1"
         aria-labelledby="commentForm" data-bs-keyboard="false"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-top">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="staticBackdropLabel">Upload Files
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <form action="{{route('borrow.upload')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="col-xl-12 mb-3">
                            <label class="form-label">Enter File</label>
                            <input type="file"  class="form-control"  name="customer_report"  />
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm  btn-light"
                                data-bs-dismiss="modal"><i class="ri-close-fill"></i> Cancel</button>
                        <button type="submit" class="btn btn-sm btn-success"><i class="ri-save-fill"></i> Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">Customers List</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                            <table id="file-export" class="table table-bordered text-nowrap w-100 dataTable no-footer">
                               <thead>
                               <tr>
                                   <th>SN</th>
                                   <th>Full Name</th>
                                   <th>Reference</th>
                                   <th>Email</th>
                                   <th>Mobile</th>
                                   <th>Business </th>
                                   <th>Open Loan Balance</th>
                                   <th>Total Paid</th>
                                   <th>Action</th>
                               </tr>
                               </thead>
                                <tbody>
                                @foreach($customers as $customer)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$customer->first_name}} {{$customer->last_name}}</td>
                                        <td>{{$customer->reference}}</td>
                                        <td>{{$customer->email}}</td>
                                        <td>{{$customer->mobile}}</td>
                                        <td>{{$customer->business_name}}</td>
                                        <td>{{$customer->schedules ? number_format($customer->schedules->sum('principle') +  $customer->schedules->sum('interest')): 0}}</td>
                                        <td>{{$customer->schedules ? number_format($customer->schedules->sum('principal_paid') +  $customer->schedules->sum('interest_paid')) : 0}}</td>
                                        <td>
                                            <a href="{{route('borrow.edit', $customer->id)}}" class="btn btn-sm btn-primary btn-wave waves-effect waves-light">
                                                <i class="ri-pencil-line align-middle me-2 d-inline-block"></i>Edit
                                            </a>
                                            <a href="{{route('borrow.show', $customer->id)}}" class="btn btn-sm btn-success btn-wave waves-effect waves-light">
                                                <i class="ri-eye-line align-middle me-2 d-inline-block"></i>View
                                            </a>

                                            <a class="btn btn-sm btn-danger btn-wave waves-effect waves-light deleteCustomer"
                                                data-id="{{$customer->id}}">
                                                <i class="ri-delete-bin-line align-middle me-2 d-inline-block"></i>Delete
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
        $(document).ready(function (){
         $('#file-export').on('click', '.deleteCustomer', function (){
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
                         url:'{{route('borrow.delete')}}',
                         type:'POST',
                         data:{
                             _token:'{{csrf_token()}}',
                             id:id
                         },
                         success:function (response){
                             location.reload()
                             swalWithBootstrapButtons.fire(
                                 'Deleted!',
                                 'Your file has been deleted.',
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
