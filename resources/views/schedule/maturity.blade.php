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
                                <th>Reference</th>
                                <th>Customer</th>
                                <th>Loan Release Date</th>
                                <th>Maturity Date</th>
                                <th>Principal</th>
                                <th>Total Paid</th>
                                <th>Balance</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($matures as $mature)
                                <tr>

                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$mature->reference}}</td>
                                    <td>{{$mature->borrower->first_name}} {{$mature->borrower->last_name}}</td>
                                    <td>{{$mature->loan_release_date}}</td>
                                    <td>{{$mature->maturity_date}}</td>
                                    <td>{{number_format($mature->principle_amount)}}</td>
                                    <td>{{number_format($mature->schedules()->sum('principal_paid') ?? 0,)}}</td>
                                    <td>{{number_format($mature->schedules()->sum('principle') ?? 0)}}</td>

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
