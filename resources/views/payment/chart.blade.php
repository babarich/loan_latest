@extends('layouts.app')
@section('content')
    <div class="row mb-6 mt-4">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <h2 class="title">Payments Charts</h2>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="d-flex flex-row-reverse">

            </div>
        </div>
    </div>


    <div class="row mt-4">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xxl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-top justify-content-between">
                                        <div>
                                                        <span class="avatar avatar-md avatar-rounded bg-primary">
                                                            <i class="ti ti-calendar fs-16"></i>
                                                        </span>
                                        </div>
                                        <div class="flex-fill ms-3">
                                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                                <div>
                                                    <p class="text-muted mb-0">Today's Collection</p>
                                                    <h4 class="fw-semibold mt-1">{{number_format($today)}}</h4>
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
                                                            <i class="ti ti-clock fs-16"></i>
                                                        </span>
                                        </div>
                                        <div class="flex-fill ms-3">
                                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                                <div>
                                                    <p class="text-muted mb-0">Last 7 days </p>
                                                    <h4 class="fw-semibold mt-1">{{number_format($week)}}</h4>
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
                                                    <p class="text-muted mb-0">Last 30 days </p>
                                                    <h4 class="fw-semibold mt-1">{{number_format($month)}}</h4>
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
                                                    <p class="text-muted mb-0">All Time  Collection</p>
                                                    <h4 class="fw-semibold mt-1">{{number_format($total)}}</h4>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xxl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-top justify-content-between">
                                        <div>
                                                        <span class="avatar avatar-md avatar-rounded bg-primary">
                                                            <i class="ti ti-calendar fs-16"></i>
                                                        </span>
                                        </div>
                                        <div class="flex-fill ms-3">
                                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                                <div>
                                                    <p class="text-muted mb-0">Total Interest</p>
                                                    <h4 class="fw-semibold mt-1">{{number_format($interest)}}</h4>
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
                                                    <p class="text-muted mb-0">Total Principle </p>
                                                    <h4 class="fw-semibold mt-1">{{number_format($principle)}}</h4>
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
                                                    <p class="text-muted mb-0">Total Penalty </p>
                                                    <h4 class="fw-semibold mt-1">0</h4>
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
                                                    <p class="text-muted mb-0">Total Loans</p>
                                                    <h4 class="fw-semibold mt-1">{{$loan}}</h4>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="row">
                    <div class="col-xl-6">
                        <div class="card custom-card">
                            <div class="card-header justify-content-between">
                                <div class="card-title">
                                    Total Monthly  Collection
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="content-wrapper">
                                    <div id="crm-revenue-analytics">
                                        {!! $chartData->container() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card custom-card">
                            <div class="card-header justify-content-between">
                                <div class="card-title">
                                    Total Monthly  Projection
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="content-wrapper">
                                    <div id="crm-revenue-analytics">
                                        {!! $projectedMonth->container() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card custom-card">
                            <div class="card-header justify-content-between">
                                <div class="card-title">
                                    Total Principle Paid
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="content-wrapper">
                                    <div id="crm-revenue-analytics">
                                        {!! $principlePaid->container() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card custom-card">
                            <div class="card-header justify-content-between">
                                <div class="card-title">
                                    Total Principle Projected
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="content-wrapper">
                                    <div id="crm-revenue-analytics">
                                        {!! $principleProjected->container() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card custom-card">
                            <div class="card-header justify-content-between">
                                <div class="card-title">
                                    Total Interest Paid
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="content-wrapper">
                                    <div id="crm-revenue-analytics">
                                        {!! $interestPaid->container() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card custom-card">
                            <div class="card-header justify-content-between">
                                <div class="card-title">
                                    Total Interest Projected
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="content-wrapper">
                                    <div id="crm-revenue-analytics">
                                        {!! $interestProjected->container() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
        </div>




@endsection

@section('scripts')
            <script src="{{ $chartData->cdn() }}"></script>
            <script src="{{ $projectedMonth->cdn() }}"></script>
            <script src="{{ $interestPaid->cdn() }}"></script>
            <script src="{{ $interestProjected->cdn() }}"></script>
            <script src="{{ $principlePaid->cdn() }}"></script>
            <script src="{{ $principleProjected->cdn() }}"></script>


            {{ $chartData->script() }}
            {{ $projectedMonth->script() }}
            {{ $interestPaid->script() }}
            {{ $interestProjected->script() }}
            {{ $principlePaid->script() }}
            {{ $principleProjected->script() }}


@endsection
