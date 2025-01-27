@extends('layouts.app')
@section('content')
    <div class="row mb-6 mt-4">
        <div class="col-sm-12 col-md-6 col-lg-6">

        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="d-flex flex-row-reverse gap-3">
                <div class="mr-4">
                    <a class="btn btn-primary" href="{{route('coa.chart')}}"><i class="bx bx-left-arrow-alt"></i>Back</a>
                </div>



            </div>
        </div>
    </div>

    <!-- Start::row-1 -->
    <div class="row mt-4">

        <div class="col-xxl-12 col-xl-12">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-body p-0">
                            <div class="p-3 border-bottom border-block-end-dashed d-flex align-items-center justify-content-between">

                                <ul class="list-group" style="width: 100%">
                                    <li class="list-group-item">
                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                            <div class="me-2 fw-semibold">
                                               Account Name :
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{$chart->name}}</span>
                                        </div>
                                    </li>

                                    <li class="list-group-item">
                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                            <div class="me-2 fw-semibold">
                                               Account Code:
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{$chart->code}}</span>
                                        </div>
                                    </li>

                                    <li class="list-group-item">
                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                            <div class="me-2 fw-semibold">
                                               Account Type :
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{$chart->category->name ?? 'N/A'}}</span>
                                        </div>
                                    </li>

                                    <li class="list-group-item">
                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                            <div class="me-2 fw-semibold">
                                               Account Group:
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{$chart->group->name ?? 'N/A'}}</span>
                                        </div>
                                    </li>

                                    <li class="list-group-item">
                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                            <div class="me-2 fw-semibold">
                                               Open Balance:
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{$chart->open_balance ?? 0 }}</span>
                                        </div>
                                    </li>

                                    <li class="list-group-item">
                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                            <div class="me-2 fw-semibold">
                                               Created By :
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{$chart->user->name ?? 'N/A'}}</span>
                                        </div>
                                    </li>

                                    <li class="list-group-item">
                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                            <div class="me-2 fw-semibold">
                                               Created At:
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{$chart->created_at}}</span>
                                        </div>
                                    </li>

                                    <li class="list-group-item">
                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                            <div class="me-2 fw-semibold">
                                               Notes:
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{$chart->note}}</span>
                                        </div>
                                    </li>

                                </ul>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>







@endsection

@section('scripts')


@endsection
