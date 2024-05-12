@extends('layouts.app')
@section('content')
    <div class="row mb-6 mt-4">
        <div class="col-sm-12 col-md-6 col-lg-6">

        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="d-flex flex-row-reverse gap-3">
                <div class="mr-4">
                    <a class="btn btn-primary" href="{{route('borrow.index')}}"><i class="bx bx-left-arrow-alt"></i>Back</a>
                </div>
                <div class="vr"></div>
                <div>
                    <a  href="{{route('borrow.assign', $borrow->id)}}" class="btn btn-danger mr-4">
                        <i class="bx bx-user w-4 h-4 mr-2"></i>  Assign as Guarantor
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
                            @if(isset($borrow->attachment))
                                <img src="{{'storage/attachments/'.$borrow->attachment}}" alt="">
                            @else
                                <img src="{{asset('/assets/images/faces/9.jpg')}}" alt="">
                            @endif

                        </span>
                        </div>
                        <div class="flex-fill main-profile-info">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="fw-semibold mb-1 text-fixed-white">{{$borrow->first_name}} {{$borrow->last_name}}</h6>

                            </div>
                            <p class="mb-1 text-muted text-fixed-white op-7">{{$borrow->working_status}} , {{$borrow->business_name}}</p>
                            <p class="fs-12 text-fixed-white mb-4 op-5">
                                <span class="me-3"><i class="ri-building-line me-1 align-middle"></i>{{$borrow->address}}</span>

                            </p>

                        </div>
                    </div>

                    <div class="p-4 border-bottom border-block-end-dashed">
                        <p class="fs-15 mb-2 me-4 fw-semibold">Customer Information :</p>
                        <div class="text-muted">
                            <p class="mb-2">
                                            <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted">
                                                          <i class="ri-phone-line align-middle fs-14"></i>
                                            </span>
                              {{$borrow->mobile}}
                            </p>
                            <p class="mb-2">
                                            <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted">
                                                      <i class="ri-mail-line align-middle fs-14"></i>
                                            </span>
                             {{$borrow->email}}
                            </p>
                            <p class="mb-0">
                                            <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted">
                                                <i class="ri-user-line align-middle fs-14"></i>
                                            </span>
                               {{ucfirst(strtolower($borrow->gender))}}
                            </p>
                            <p class="mb-0">
                                            <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted">
                                                <i class="ri-calendar-line align-middle fs-14"></i>
                                            </span>
                                {{$borrow->age}} Years
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
                                            <span class="fs-12 text-muted float-end">{{$borrow->reference}}</span>

                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">

                                            <div class="me-2 fw-semibold">
                                                Onboarded Date :
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{$borrow->created_at}}</span>

                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">

                                            <div class="me-2 fw-semibold">
                                                Loan Officer :
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{$borrow->user->name ?? ''}}</span>

                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">

                                            <div class="me-2 fw-semibold">
                                                Identity
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{$borrow->identity}}</span>

                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">

                                            <div class="me-2 fw-semibold">
                                                Identification Number
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{$borrow->id_number}}</span>

                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">

                                            <div class="me-2 fw-semibold">
                                                Customers Group :
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{$borrow->group ? $borrow->group->name : ''}}</span>

                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">

                                            <div class="me-2 fw-semibold">
                                                Description :
                                            </div>
                                            <span class="fs-12 text-muted float-end">{{$borrow->description}}</span>

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
                    Customer Files
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
                        @foreach($borrow->attachments as $attachment)
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
    <!--End::row-1 -->
    <div class="col-xl-12 col-lg-12 col-sm-12">
        <div class="card custom-card overflow-hidden">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Loan History
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-nowrap table-bordered border-primary">
                        <thead>
                        <tr>
                            <th scope="col">S/N</th>
                            <th scope="col">Reference</th>
                            <th scope="col">Principle</th>
                            <th scope="col">Total Interest</th>
                            <th scope="col">Interest</th>
                            <th scope="col">Interest Type</th>
                            <th scope="col">Due Amount</th>
                            <th scope="col">Total Paid</th>
                            <th scope="col">Last Payment</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($borrow->loans as $loan)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$loan->reference}}</td>
                                <td>{{$loan->principle_amount}}</td>
                                <td>{{$loan->total_interest}}</td>
                                <td>{{$loan->interest_percentage ? $loan->interest_percentage . ' ' . '%' : $loan->interest_amount}}</td>
                                <td>{{'per'.' ' . $loan->interest_duration}}</td>
                                <td>{{$loan->loanpayment->due_amount}}</td>
                                <td>{{$loan->loanpayment->paid_amount}}</td>
                                <td>{{$loan->loanpayment->latest_payment}}</td>
                                <td>
                                    @if($loan->status === 'pending')
                                        <span class="badge bg-warning">
                                        Pending
                                    </span>
                                    @else
                                        <span class="badge bg-success" >
                                        Approved
                                    </span>
                                    @endif


                                </td>
                                <td>
                                    <a href="{{route('loan.show', $loan->id)}}" class="btn btn-success">
                                        <i class="bx bx-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--End::row-1 -->

    <div class="col-xl-12 col-lg-12 col-sm-12">
        <div class="card custom-card overflow-hidden">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Payment History
                </div>

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-nowrap table-bordered border-primary">
                        <thead>
                        <tr>
                            <th scope="col">S/N</th>
                            <th scope="col">Collection Date</th>
                            <th scope="col">Loan Reference</th>
                            <th scope="col">Amount Paid</th>
                            <th scope="col">Payment Type</th>
                            <th scope="col">Collected By</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($borrow->payments as $payment)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$payment->payment_date}}</td>
                                <td>{{$payment->loan->reference}}</td>
                                <td>{{number_format($payment->amount)}}</td>
                                <td>{{$payment->type}}</td>
                                <td>{{$payment->user->name ?? null}}</td>

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
