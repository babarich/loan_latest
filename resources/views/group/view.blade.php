@extends('layouts.app')
@section('content')
    <div class="row mb-6 mt-4">
        <div class="col-sm-12 col-md-6 col-lg-6">

        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="d-flex flex-row-reverse gap-3">
                <div class="mr-4">
                    <a class="btn btn-primary" href="{{route('group.index')}}"><i class="bx bx-left-arrow-alt"></i>Back</a>
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

                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                            <div class="me-2 fw-semibold">
                                                Name :
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{$group->name}}</span>
                                        </div>
                                    </li>

                                    <li class="list-group-item">
                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                            <div class="me-2 fw-semibold">
                                                Description:
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{$group->description}}</span>
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



    <!--End::row-1 -->
    <div class="col-xl-12 col-lg-12 col-sm-12">
        <div class="card custom-card overflow-hidden">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Group Members
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="file-export" class="table text-nowrap table-bordered dataTable border-primary">
                        <thead>
                        <tr>
                            <th scope="col">S/N</th>
                            <th scope="col">Reference</th>
                            <th scope="col">Name</th>
                            <th scope="col">Business</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Balance</th>
                            <th scope="col">Total Paid</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($group->borrowers as $borrow)
                            <tr>
                               <td>{{$loop->iteration}}</td>
                                <td>{{$borrow->reference}} </td>
                                <td>{{$borrow->first_name}} {{$borrow->last_name}}</td>
                                <td>{{$borrow->business_name}}</td>
                                <td>{{ucfirst(strtolower($borrow->gender))}}</td>
                                <td>{{$borrow->mobile}}</td>
                                <td>{{$borrow->schedules ? $borrow->schedules->sum('principle') +  $borrow->schedules->sum('interest') : 0}}</td>
                                <td>{{$borrow->schedules ? $borrow->schedules->sum('principal_paid') +  $borrow->schedules->sum('interest_paid') : 0}}</td>
                                <td>
                                    <a href="{{route('borrow.show', $borrow->id)}}" class="btn btn-success"><i class="bx bx-eye"></i> View</a>
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
