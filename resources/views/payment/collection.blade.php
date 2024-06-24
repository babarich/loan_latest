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

    <div class="col-xxl-6 col-xl-6">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                 Filter Loan
                </div>
            </div>
            <div class="card-body">
    <form method="GET" action="{{ route('payment.collection') }}">
        <div class="form-group">
            <label class="col-form-label" for="start_date">Start Date:</label>
            <input type="date" class="form-control" name="start_date" id="start_date" value="{{ request('start_date') }}">
        </div>
        <div class="form-group">
            <label class="col-form-label" for="due_date">Due Date:</label>
            <input type="date" class="form-control" name="due_date" id="due_date" value="{{ request('due_date') }}">

        </div>
        <div class="form-group">

            <label for="user_id" class="col-form-label">User:</label>
            <select name="user_id" id="user_id" class="form-control">
                <option value="">Select User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>


        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary btn-wave waves-effect waves-light">
                <i class="bi bi-funnel"></i> Filter
            </button>
        </div>
    </form>
            </div>
</div>
    </div>

    <div class="row mt-4">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">Payment List</div>
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
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($schedules as $schedule)
                                <tr>

                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$schedule->due_date}}</td>
                                    <td>{{$schedule->borrower->first_name}} {{$schedule->borrower->last_name}}</td>
                                    <td>{{isset($schedule->loan->product) ? $schedule->loan->product->name : null}}</td>
                                    <td>{{number_format($schedule->principle,2)}}</td>
                                    <td>{{number_format($schedule->interest,2)}}</td>
                                    <td>{{number_format($schedule->amount,2)}}</td>
                                    <td>{{number_format($schedule->interest_paid + $schedule->principle_paid,2)}}</td>

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
