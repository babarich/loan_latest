@extends('layouts.app')
@section('content')


    <!-- Start::row-1 -->
    <div class="row mt-4">
        <div class="col-xxl-12 col-xl-12">
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xxl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-top justify-content-between">
                                        <div>
                                                        <span class="avatar avatar-md avatar-rounded bg-primary">
                                                            <i class="ti ti-users fs-16"></i>
                                                        </span>
                                        </div>
                                        <div class="flex-fill ms-3">
                                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                                <div>
                                                    <p class="text-muted mb-0">Total Customers</p>
                                                    <h4 class="fw-semibold mt-1">{{$borrowers}}</h4>
                                                </div>

                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-1">
                                                <div>
                                                    <a class="text-primary" href="{{route('borrow.index')}}">View All<i class="ti ti-arrow-narrow-right ms-2 fw-semibold d-inline-block"></i></a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-top justify-content-between">
                                        <div>
                                                        <span class="avatar avatar-md avatar-rounded bg-secondary">
                                                            <i class="ti ti-wallet fs-16"></i>
                                                        </span>
                                        </div>
                                        <div class="flex-fill ms-3">
                                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                                <div>
                                                    <p class="text-muted mb-0">Amount Due</p>
                                                    <h4 class="fw-semibold mt-1">{{number_format($totalOutstanding)}}</h4>
                                                </div>

                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-1">
                                                <div>
                                                    <a class="text-secondary" href="javascript:void(0);">View All<i class="ti ti-arrow-narrow-right ms-2 fw-semibold d-inline-block"></i></a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-top justify-content-between">
                                        <div>
                                                        <span class="avatar avatar-md avatar-rounded bg-success">
                                                            <i class="ti ti-wave-square fs-16"></i>
                                                        </span>
                                        </div>
                                        <div class="flex-fill ms-3">
                                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                                <div>
                                                    <p class="text-muted mb-0">Principle Outstanding</p>
                                                    <h4 class="fw-semibold mt-1">{{number_format($principleOutstanding)}}</h4>
                                                </div>

                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-1">
                                                <div>
                                                    <a class="text-success" href="javascript:void(0);">View All<i class="ti ti-arrow-narrow-right ms-2 fw-semibold d-inline-block"></i></a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-top justify-content-between">
                                        <div>
                                                        <span class="avatar avatar-md avatar-rounded bg-warning">
                                                            <i class="ti ti-briefcase fs-16"></i>
                                                        </span>
                                        </div>
                                        <div class="flex-fill ms-3">
                                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                                <div>
                                                    <p class="text-muted mb-0">Pending Loans</p>
                                                    <h4 class="fw-semibold mt-1">{{$open}}</h4>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-1">
                                                <div>
                                                    <a class="text-warning" href="{{route('loan.index')}}">View All<i class="ti ti-arrow-narrow-right ms-2 fw-semibold d-inline-block"></i></a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Due Loan  Analytics
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="content-wrapper">
                                <div id="crm-revenue-analytics">

                                        <div class="table-responsive">
                                            <table  class="table table-bordered text-nowrap w-100 dataTable no-footer">
                                                <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Month</th>
                                                    <th>Amount</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($dueChart as $due)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                         <td>{{$due}}</td>
                                                        <td></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>

    </div>
    <!-- End::row-1 -->

@endsection

@section('scripts')

@endsection
