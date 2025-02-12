@extends('layouts.app')
@section('content')
    <div class="row mb-6 mt-4">
        <div class="col-sm-12 col-md-6 col-lg-6">

        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="d-flex flex-row-reverse gap-3">
                <div class="mr-4">
                    <a class="btn btn-primary" href="{{route('expense.index')}}"><i class="bx bx-left-arrow-alt"></i>Back</a>
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
                                               Expense Type :
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{$expense->name}}</span>
                                        </div>
                                    </li>

                                    <li class="list-group-item">
                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                            <div class="me-2 fw-semibold">
                                               Expense Date:
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{$expense->date}}</span>
                                        </div>
                                    </li>

                                    <li class="list-group-item">
                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                            <div class="me-2 fw-semibold">
                                               Account Type :
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{$expense->chart->name ?? 'N/A'}}</span>
                                        </div>
                                    </li>

                                    <li class="list-group-item">
                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                            <div class="me-2 fw-semibold">
                                               Payment Account:
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{$expense->payment->name ?? 'N/A'}}</span>
                                        </div>
                                    </li>

                                      <li class="list-group-item">
                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                            <div class="me-2 fw-semibold">
                                               Amount:
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{number_format($expense->amount) ?? 'N/A'}}</span>
                                        </div>
                                    </li>

                                    <li class="list-group-item">
                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                            <div class="me-2 fw-semibold">
                                               Reference No:
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{$expense->ref_no ?? 'N/A'}}</span>
                                        </div>
                                    </li>

                                    <li class="list-group-item">
                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                            <div class="me-2 fw-semibold">
                                               Created By :
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{$expense->user->name ?? 'N/A'}}</span>
                                        </div>
                                    </li>

                                    <li class="list-group-item">
                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                            <div class="me-2 fw-semibold">
                                               Created At:
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{$expense->created_at}}</span>
                                        </div>
                                    </li>

                                    <li class="list-group-item">
                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                            <div class="me-2 fw-semibold">
                                               Notes:
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{$expense->note}}</span>
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
