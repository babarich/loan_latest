@extends('layouts.app')
@section('content')
    <div class="row mb-6 mt-4">
        <div class="col-sm-12 col-md-6 col-lg-6">

        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="d-flex flex-row-reverse">
                  <a class="btn btn-primary" href="{{route('loan.create')}}"><i class="bx bx-plus"></i> Add Loan</a>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">Loan List</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                            <table id="file-export" class="table table-bordered text-nowrap w-100 dataTable no-footer">
                               <thead>
                               <tr>
                                    <th>SN</th>
                                    <th>Reference</th>
                                    <th>Full Name</th>
                                    <th>Principle</th>
                                    <th>Total Interest</th>
                                    <th>Interest</th>
                                    <th>Due Amount</th>
                                    <th>Total Paid</th>
                                     <th>Status</th>
                                     <th>Stage</th>
                                     <th>Action</th>
                               </tr>
                               </thead>
                                <tbody>
                                @foreach($loans as $loan)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$loan->reference}}</td>
                                        <td>{{$loan->borrower->first_name ?? ''}} {{$loan->borrower->last_name ?? ''}}</td>
                                        <td>{{number_format($loan->principle_amount)}}</td>
                                        <td>{{number_format($loan->total_interest)}}</td>
                                        <td>{{isset($loan->interest_percentage) ? $loan->interest_percentage. ' '. '%' : $loan->interest_amount}}</td>
                                        <td>{{number_format($loan->total_amount_due)}}</td>
                                        <td>{{number_format($loan->loanpayment->paid_amount) ?? 0}}</td>
                                        <td>
                                            @if($loan->release_status === 'pending')
                                                <span class="badge bg-warning">
                                            Pending
                                        </span>
                                            @elseif($loan->release_status === 'rejected')
                                                <span class="badge bg-danger">Rejected</span>
                                            @else
                                                <span class="badge bg-success">
                                               Approved
                                                </span>
                                            @endif

                                        </td>
                                        <td>
                                            @if($loan->stage === 0)
                                            <span class="badge bg-primary">
                                            Pending Submission
                                            </span>
                                            @elseif($loan->stage === 1)
                                                <span class="badge bg-primary">
                                            Pending Approval
                                            </span>
                                            @elseif($loan->stage === 2)
                                                <span class="badge bg-primary">
                                            Pending Disbursement
                                            </span>
                                            @else
                                                <span class="badge bg-success">Disbursed</span>
                                            @endif

                                        </td>

                                        <td>
                                            <a href="{{route('loan.show', $loan->id)}}" class="btn btn-sm btn-success btn-wave waves-effect waves-light">
                                                <i class="ri-eye-line align-middle me-2 d-inline-block"></i>View
                                            </a>

                                            @if($loan->stage < 3)
                                                <a href="{{route('loan.edit', $loan->id)}}" class="btn btn-sm btn-primary btn-wave waves-effect waves-light">
                                                    <i class="ri-pencil-line align-middle me-2 d-inline-block"></i>Edit
                                                </a>

                                                <a class="btn btn-sm btn-danger btn-wave waves-effect waves-light deleteLoan"
                                                data-id="{{$loan->id}}">
                                                <i class="ri-delete-bin-line align-middle me-2 d-inline-block"></i>Delete
                                                </a>
                                            @endif
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
        $('#file-export').on('click', '.deleteLoan', function (){
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
                        url:"{{route('loan.delete')}}",
                        type:'POST',
                        data:{
                            _token:'{{csrf_token()}}',
                            id:id
                        },
                        success:function (response){
                            location.reload()
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Your loan has been deleted.',
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
