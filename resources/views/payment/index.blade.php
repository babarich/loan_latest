@extends('layouts.app')
@section('content')
    <div class="row mb-6 mt-4">
        <div class="col-sm-12 col-md-6 col-lg-6">

        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="d-flex flex-row-reverse">
                <a class="btn btn-primary" href="{{route('borrow.create')}}"><i class="bx bx-plus"></i> Add Payment</a>
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
                                <th>Date</th>
                                <th>Reference</th>
                                <th>Customer</th>
                                <th>Type </th>
                                <th>Amount</th>
                                <th>Collected By</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payments as $payment)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$payment->payment_date}}</td>
                                    <td>{{$payment->loan->reference}}</td>
                                    <td>{{$payment->loan->borrower->first_name . ' ' . $payment->loan->borrower->last_name}}</td>
                                    <td>{{$payment->type}}</td>.
                                    <td>{{number_format($payment->amount)}}</td>
                                    <td>{{$payment->user->name ?? ''}}</td>
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
