@extends('layouts.app')
@section('content')
    <div class="row mb-6 mt-4">
        <div class="col-sm-12 col-md-6 col-lg-6">

        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="d-flex flex-row-reverse">

            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">Due Loans List</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                            <table id="file-export" class="table table-bordered text-nowrap w-100 dataTable no-footer">
                               <thead>
                               <tr>
                                    <th>SN</th>
                                   <th>Due Date</th>
                                    <th>Full Name</th>
                                    <th>Product</th>
                                    <th>Principle</th>
                                   <th>Interest</th>
                                   <th>Due Amount</th>
                                   <th>Total Paid</th>
                                   <th>Status</th>
                                   <th>Action</th>
                               </tr>
                               </thead>
                                <tbody>
                                @foreach($schedules as $schedule)
                                    <tr>

                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$schedule->due_date}}</td>
                                        <td>{{$schedule->borrower->first_name}} {{$schedule->borrower->last_name}}</td>
                                        <td>{{isset($schedule->loan->product) ? $schedule->loan->product->name : null}}</td>
                                        <td>{{number_format($schedule->principle)}}</td>
                                        <td>{{number_format($schedule->interest)}}</td>
                                        <td>{{number_format($schedule->amount)}}</td>
                                        <td>{{number_format($schedule->interest_paid + $schedule->principle_paid)}}</td>

                                        <td>
                                            @if($schedule->status === 'pending')
                                                <span class="badge bg-warning">
                                            Pending
                                        </span>
                                            @else
                                                <span class="badge bg-success">
                                               Completed
                                                </span>
                                            @endif

                                        </td>

                                        <td>
                                            @if(isset($schedule->loan))
                                                <a href="{{route('loan.show', $schedule->loan->id)}}" class="btn btn-sm btn-success btn-wave waves-effect waves-light">
                                                    <i class="ri-eye-line align-middle me-2 d-inline-block"></i>View
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


@endsection
