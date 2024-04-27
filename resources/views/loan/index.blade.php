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
                                   <th>Interest Type </th>
                                   <th>Due Amount</th>
                                   <th>Total Paid</th>
                                   <th>Last Payment</th>
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
                                        <td>{{$loan->first_name}} {{$loan->last_name}}</td>
                                        <td>{{number_format($loan->principle_amount)}}</td>
                                        <td>{{number_format($loan->total_interest)}}</td>.
                                        <td>{{isset($loan->interest_percentage) ? $loan->interest_percentage. ' '. '%' : $loan->interest_amount}}</td>
                                        <td>{{'per'.' '.$loan->interest_duration}}</td>
                                        <td>{{$loan->loanpayment->due_amount}}</td>
                                        <td>{{$loan->loanpayment->paid_amount ?? 0}}</td>
                                        <td>{{$loan->loanpayment->latest_payment ?? 0}}</td>
                                        <td>
                                            @if($loan->release_status === 'pending')
                                                <span class="badge badge-warning">
                                            Pending
                                        </span>
                                            @else
                                                <span class="badge badge-success">
                                            Approved
                                        </span>
                                            @endif

                                        </td>
                                        <td>
                                            @if($loan->stage === 0)
                                            <span class="badge badge-primary">
                                            Pending Submission
                                            </span>
                                            @elseif($loan->stage === 1)
                                                <span class="badge badge-primary">
                                            Pending Approval
                                            </span>
                                            @elseif($loan->stage === 2)
                                                <span class="badge badge-primary">
                                            Pending Disbursement
                                            </span>
                                            @else
                                                <span class="badge badge-success">Disbursed</span>
                                            @endif

                                        </td>
                                        <td></td>
                                        <td>
                                            <a href="{{route('loan.edit', $loan->id)}}" class="btn btn-sm btn-primary btn-wave waves-effect waves-light">
                                                <i class="ri-pencil-line align-middle me-2 d-inline-block"></i>Edit
                                            </a>
                                            <a href="{{route('loan.show', $loan->id)}}" class="btn btn-sm btn-success btn-wave waves-effect waves-light">
                                                <i class="ri-eye-line align-middle me-2 d-inline-block"></i>View
                                            </a>

                                            <button class="btn btn-sm btn-danger btn-wave waves-effect waves-light">
                                                <i class="ri-delete-bin-line align-middle me-2 d-inline-block"></i>Delete
                                            </button>
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
