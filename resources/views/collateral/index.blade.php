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
                    <div class="card-title">Collaterals List</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="file-export" class="table table-bordered text-nowrap w-100 dataTable no-footer">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>Type</th>
                                <th>Collateral Name</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Date </th>
                                <th>Condition</th>
                                <th>Added By</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($collaterals as $collateral)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$collateral->type->name ?? ''}}</td>
                                    <td>{{$collateral->product_name}}</td>
                                    <td>{{$collateral->loan->borrower->first_name}} {{$collateral->loan->borrower->last_name}}</td>
                                    <td>{{number_format($collateral->amount)}}</td>.
                                    <td>{{\Carbon\Carbon::parse($collateral->date)->format('Y-m-d'),}}</td>
                                    <td>{{$collateral->condition}}</td>
                                    <td>{{$collateral->user->name ?? null}}</td>

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
