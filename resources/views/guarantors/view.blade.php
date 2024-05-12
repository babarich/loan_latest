@extends('layouts.app')
@section('content')
    <div class="row mb-6 mt-4">
        <div class="col-sm-12 col-md-6 col-lg-6">

        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="d-flex flex-row-reverse gap-3">
                <div class="mr-4">
                    <a class="btn btn-primary" href="{{route('guarantor.index')}}"><i class="bx bx-left-arrow-alt"></i>Back</a>
                </div>
                <div class="vr"></div>
                <div>
                    <a  href="{{route('guarantor.assign', $guarantor->id)}}" class="btn btn-primary mr-4">
                        <i class="bx bx-user w-4 h-4 mr-2"></i>  Assign as Customer
                    </a>
                </div>





            </div>
        </div>
    </div>

    <!-- Start::row-1 -->
    <div class="row mt-4">
        <div class="col-xxl-4 col-xl-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-body p-0">
                    <div class="d-sm-flex align-items-top p-4 border-bottom-0 main-profile-cover">
                        <div>
                        <span class="avatar avatar-xxl avatar-rounded online me-3">
                            @if(isset($guarantor->attachment))
                                <img src="{{'storage/attachments/'.$guarantor->attachment}}" alt="">
                            @else
                                <img src="{{asset('/assets/images/faces/9.jpg')}}" alt="">
                            @endif

                        </span>
                        </div>
                        <div class="flex-fill main-profile-info">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="fw-semibold mb-1 text-fixed-white">{{$guarantor->first_name}} {{$guarantor->last_name}}</h6>

                            </div>
                            <p class="mb-1 text-muted text-fixed-white op-7">{{$guarantor->working_status}} , {{$guarantor->business_name}}</p>
                            <p class="fs-12 text-fixed-white mb-4 op-5">
                                <span class="me-3"><i class="ri-building-line me-1 align-middle"></i>{{$guarantor->address}}</span>

                            </p>

                        </div>
                    </div>

                    <div class="p-4 border-bottom border-block-end-dashed">
                        <p class="fs-15 mb-2 me-4 fw-semibold">Guarantor Information :</p>
                        <div class="text-muted">
                            <p class="mb-2">
                                            <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted">
                                                          <i class="ri-phone-line align-middle fs-14"></i>
                                            </span>
                              {{$guarantor->mobile}}
                            </p>
                            <p class="mb-2">
                                            <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted">
                                                      <i class="ri-mail-line align-middle fs-14"></i>
                                            </span>
                             {{$guarantor->email}}
                            </p>
                            <p class="mb-0">
                                            <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted">
                                                <i class="ri-user-line align-middle fs-14"></i>
                                            </span>
                               {{ucfirst(strtolower($guarantor->gender))}}
                            </p>
                            <p class="mb-0">
                                            <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted">
                                                <i class="ri-calendar-line align-middle fs-14"></i>
                                            </span>
                                {{$guarantor->age}} Years
                            </p>
                        </div>
                    </div>



                </div>
            </div>
        </div>
        <div class="col-xxl-8 col-xl-12">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-body p-0">
                            <div class="p-3 border-bottom border-block-end-dashed d-flex align-items-center justify-content-between">

                                <ul class="list-group" style="width: 100%">
                                    <li class="list-group-item d-flex justify-content-between">

                                            <div class="me-2 fw-semibold">
                                                Reference :
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{$guarantor->reference}}</span>

                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">

                                            <div class="me-2 fw-semibold">
                                                Onboarded Date :
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{$guarantor->created_at}}</span>

                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">

                                            <div class="me-2 fw-semibold">
                                                Loan Officer :
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{$guarantor->user->name ?? ''}}</span>

                                    </li>

                                    <li class="list-group-item d-flex justify-content-between">

                                            <div class="me-2 fw-semibold">
                                                Description :
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{$guarantor->description}}</span>

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
                    Guarantor Files
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-nowrap table-bordered border-primary">
                        <thead>
                        <tr>
                            <th scope="col">S/N</th>
                            <th scope="col">File Name</th>
                            <th scope="col">Attachment Size</th>
                            <th scope="col">Uploaded By</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($guarantor->attachments as $attachment)
                            <tr>
                               <td>{{$loop->iteration}}</td>
                                <td>{{$attachment->filename}}</td>
                                <td>{{$attachment->attachment_size}}</td>
                                <td>{{$attachment->user->name ?? ''}}</td>
                                <td>
                                    <a href="{{route('borrow.download', $attachment->id)}}" class="btn btn-success"><i class="bx bx-download"></i> Download</a>
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
