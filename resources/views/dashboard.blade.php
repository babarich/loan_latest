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
                                                    <h4 class="fw-semibold mt-1">{{$principleOutstanding}}</h4>
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
                                                    <h4 class="fw-semibold mt-1">{{$principleOutstanding}}</h4>
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
                                    {!! $dueChart->container() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                             Recent Payments
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                <div>
                                    <input class="form-control form-control-sm" type="text" placeholder="Search Here" aria-label=".form-control-sm example">
                                </div>
                                <div class="dropdown">
                                    <a href="javascript:void(0);" class="btn btn-primary btn-sm btn-wave waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                        Sort By<i class="ri-arrow-down-s-line align-middle ms-1 d-inline-block"></i>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a class="dropdown-item" href="javascript:void(0);">New</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">Popular</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">Relevant</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-nowrap table-hover border table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="row" class="ps-4"><input class="form-check-input" type="checkbox" id="checkboxNoLabel1" value="" aria-label="..."></th>
                                        <th scope="col">Sales Rep</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Mail</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row" class="ps-4"><input class="form-check-input" type="checkbox" id="checkboxNoLabel2" value="" aria-label="..."></th>
                                        <td>
                                            <div class="d-flex align-items-center fw-semibold">
                                                                <span class="avatar avatar-sm me-2 avatar-rounded">
                                                                    <img src="../assets/images/faces/4.jpg" alt="img">
                                                                </span>Mayor Kelly
                                            </div>
                                        </td>
                                        <td>Manufacture</td>
                                        <td>mayorkelly@gmail.com</td>
                                        <td>
                                            <span class="badge bg-info-transparent">Germany</span>
                                        </td>
                                        <td>Sep 15 - Oct 12, 2023</td>
                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-success-light"><i class="ri-download-2-line"></i></a>
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-wave waves-effect waves-light btn-sm btn-primary-light"><i class="ri-edit-line"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="ps-4"><input class="form-check-input" type="checkbox" id="checkboxNoLabel13" value="" aria-label="..." checked></th>
                                        <td>
                                            <div class="d-flex align-items-center fw-semibold">
                                                                <span class="avatar avatar-sm me-2 avatar-rounded">
                                                                    <img src="../assets/images/faces/15.jpg" alt="img">
                                                                </span>Andrew Garfield
                                            </div>
                                        </td>
                                        <td>Development</td>
                                        <td>andrewgarfield@gmail.com</td>
                                        <td>
                                            <span class="badge bg-primary-transparent">Canada</span>
                                        </td>
                                        <td>Apr 10 - Dec 12, 2023</td>
                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon waves-effect waves-light btn-sm btn-success-light"><i class="ri-download-2-line"></i></a>
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon waves-effect waves-light btn-sm btn-primary-light"><i class="ri-edit-line"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="ps-4"><input class="form-check-input" type="checkbox" id="checkboxNoLabel4" value="" aria-label="..."></th>
                                        <td>
                                            <div class="d-flex align-items-center fw-semibold">
                                                                <span class="avatar avatar-sm me-2 avatar-rounded">
                                                                    <img src="../assets/images/faces/11.jpg" alt="img">
                                                                </span>Simon Cowel
                                            </div>
                                        </td>
                                        <td>Service</td>
                                        <td>simoncowel234@gmail.com</td>
                                        <td>
                                            <span class="badge bg-danger-transparent">Europe</span>
                                        </td>
                                        <td>Sep 15 - Oct 12, 2023</td>
                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon waves-effect waves-light btn-sm btn-success-light"><i class="ri-download-2-line"></i></a>
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon waves-effect waves-light btn-sm btn-primary-light"><i class="ri-edit-line"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="ps-4"><input class="form-check-input" type="checkbox" id="checkboxNoLabel5" value="" aria-label="..." checked></th>
                                        <td>
                                            <div class="d-flex align-items-center fw-semibold">
                                                                <span class="avatar avatar-sm me-2 avatar-rounded">
                                                                    <img src="../assets/images/faces/8.jpg" alt="img">
                                                                </span>Mirinda Hers
                                            </div>
                                        </td>
                                        <td>Marketing</td>
                                        <td>mirindahers@gmail.com</td>
                                        <td>
                                            <span class="badge bg-warning-transparent">USA</span>
                                        </td>
                                        <td>Apr 14 - Dec 14, 2023</td>
                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon waves-effect waves-light btn-sm btn-success-light"><i class="ri-download-2-line"></i></a>
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon waves-effect waves-light btn-sm btn-primary-light"><i class="ri-edit-line"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="ps-4"><input class="form-check-input" type="checkbox" id="checkboxNoLabel3" value="" aria-label="..." checked></th>
                                        <td>
                                            <div class="d-flex align-items-center fw-semibold">
                                                                <span class="avatar avatar-sm me-2 avatar-rounded">
                                                                    <img src="../assets/images/faces/9.jpg" alt="img">
                                                                </span>Jacob Smith
                                            </div>
                                        </td>
                                        <td>Social Plataform</td>
                                        <td>jacobsmith@gmail.com</td>
                                        <td>
                                            <span class="badge bg-success-transparent">Singapore</span>
                                        </td>
                                        <td>Feb 25 - Nov 25, 2023</td>
                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon waves-effect waves-light btn-sm btn-success-light"><i class="ri-download-2-line"></i></a>
                                                <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon waves-effect waves-light btn-sm btn-primary-light"><i class="ri-edit-line"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex align-items-center">
                                <div>
                                    Showing 5 Entries <i class="bi bi-arrow-right ms-2 fw-semibold"></i>
                                </div>
                                <div class="ms-auto">
                                    <nav aria-label="Page navigation" class="pagination-style-4">
                                        <ul class="pagination mb-0">
                                            <li class="page-item disabled">
                                                <a class="page-link" href="javascript:void(0);">
                                                    Prev
                                                </a>
                                            </li>
                                            <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                                            <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                            <li class="page-item">
                                                <a class="page-link text-primary" href="javascript:void(0);">
                                                    next
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
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

    <script src="{{ $dueChart->cdn() }}"></script>
    {{ $dueChart->script() }}
@endsection
