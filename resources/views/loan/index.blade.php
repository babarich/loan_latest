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
                                        <td>{{$loan->borrower->first_name}} {{$loan->borrower->last_name}}</td>
                                        <td>{{number_format($loan->principle_amount)}}</td>
                                        <td>{{number_format($loan->total_interest)}}</td>.
                                        <td>{{isset($loan->interest_percentage) ? $loan->interest_percentage. ' '. '%' : $loan->interest_amount}}</td>
                                        <td>{{number_format($loan->loanpayment->due_amount)}}</td>
                                        <td>{{number_format($loan->loanpayment->paid_amount) ?? 0}}</td>
                                        <td>
                                            @if($loan->release_status === 'pending')
                                                <span class="badge bg-warning">
                                            Pending
                                        </span>
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

                                            @if($loan->stage === 0)

                                                <a href="{{route('loan.edit', $loan->id)}}" class="btn btn-sm btn-primary btn-wave waves-effect waves-light">
                                                    <i class="ri-pencil-line align-middle me-2 d-inline-block"></i>Edit
                                                </a>

                                                <button class="btn btn-sm btn-danger btn-wave waves-effect waves-light">
                                                <i class="ri-delete-bin-line align-middle me-2 d-inline-block"></i>Delete
                                            </button>
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


@endsection
