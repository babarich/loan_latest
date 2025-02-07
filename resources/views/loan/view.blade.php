@extends('layouts.app')
@section('content')
    <div class="container-fluid mt-8">
        <div class="row mb-6 mt-4">
            <div class="col-sm-12 col-md-6 col-lg-6">

            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="d-flex flex-row-reverse">
                    @if($loan->stage < 1)
                        <a class="btn btn-success ms-3" id="submitLoan" data-id="{{$loan->id}}"><i class="bx bx-check"></i> Submit Loan</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="card custom-card mt-4">
            <div class="card-header">
                <div class="card-title">
                   Loan Details
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xxl-2 col-xl-2 col-md-2 col--sm-12">
                        <ul class="nav nav-tabs flex-column tab-style-7" role="tablist">
                                <li class="nav-item m-1">
                                    <a class="nav-link active" data-bs-toggle="tab" role="tab" aria-current="page"
                                       href="#personal-info" aria-selected="true"><i class="bx bx-user me-2"></i>Loan Information</a>
                                </li>
                                <li class="nav-item m-1">
                                    <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                                       href="#account-settings" aria-selected="true"><i class="bx bx-money-withdraw me-2"></i>Payments</a>
                                </li>
                                <li class="nav-item m-1">
                                    <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                                       href="#email-settings" aria-selected="true"><i class="bx bx-bell me-2"></i>Loan Schedules</a>
                                </li>
                                <li class="nav-item m-1">
                                    <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                                       href="#agreements" aria-selected="true"><i class="bx bxs-file-doc me-2"></i>Agreement</a>
                                </li>
                                <li class="nav-item m-1">
                                    <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                                       href="#labels" aria-selected="true"><i class="bx bx-building-house me-2"></i>Collaterals</a>
                                </li>
                                <li class="nav-item m-1">
                                    <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                                       href="#notification-settings" aria-selected="true"><i class="bx bxs-file-pdf me-2"></i>Loan Files</a>
                                </li>
                                <li class="nav-item m-1">
                                    <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                                       href="#security" aria-selected="true"><i class="bx bx-message-dots  me-2"></i>Loan Comments</a>
                                </li>
                            <li class="nav-item m-1">
                                <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                                   href="#approve" aria-selected="true"><i class="bx bx-user-check me-2"></i>Approver Comments</a>
                            </li>
                            </ul>
                    </div>
                    <div class="col-xxl-10 col-xl-10 col-md-10 col-sm-12">
                        <div class="tab-content">
                            <div class="tab-pane show active" id="personal-info"
                                 role="tabpanel">
                                <div class="row mt-4">
                                    <div class="col-xxl-4 col-xl-12">
                                        <div class="card custom-card overflow-hidden">
                                            <div class="card-body p-0">
                                                <div class="d-sm-flex align-items-top p-4 border-bottom-0 main-profile-cover">
                                                    <div>
                                                    <span class="avatar avatar-xxl avatar-rounded online me-3">
                                                        @if(isset($loan->borrower->attachment))
                                                            <img src="{{asset('storage/attachments/'.$loan->borrower->attachment)}}" alt="">
                                                        @else
                                                            <img src="{{asset('/assets/images/faces/9.jpg')}}" alt="">
                                                        @endif

                                                    </span>
                                                    </div>
                                                    <div class="flex-fill main-profile-info">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="fw-semibold mb-1 text-fixed-white">{{$loan->borrower->first_name}} {{$loan->borrower->last_name}}</h6>

                                                        </div>
                                                        <p class="mb-1 text-muted text-fixed-white op-7">{{$loan->borrower->working_status}} , {{$loan->borrower->business_name}}</p>
                                                        <p class="fs-12 text-fixed-white mb-4 op-5">
                                                            <span class="me-3"><i class="ri-building-line me-1 align-middle"></i>{{$loan->borrower->address}}</span>

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
                                                            {{$loan->borrower->mobile}}
                                                        </p>
                                                        <p class="mb-2">
                                            <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted">
                                                      <i class="ri-mail-line align-middle fs-14"></i>
                                            </span>
                                                            {{$loan->borrower->email}}
                                                        </p>
                                                        <p class="mb-0">
                                            <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted">
                                                <i class="ri-user-line align-middle fs-14"></i>
                                            </span>
                                                            {{ucfirst(strtolower($loan->borrower->gender))}}
                                                        </p>
                                                        <p class="mb-0">
                                            <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted">
                                                <i class="ri-calendar-line align-middle fs-14"></i>
                                            </span>
                                                            {{$loan->borrower->age}} Years
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
                                                        <div class="border-bottom border-block-end-dashed d-flex align-items-center justify-content-between">
                                                            <ul class="list-group" style="width: 100%">
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <div class="me-2 fw-semibold">
                                                                        Reference :
                                                                    </div>
                                                                    <span class="fs-12 text-muted float-end">{{$loan->reference}}</span>

                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">

                                                                    <div class="me-2 fw-semibold">
                                                                        Joined Date :
                                                                    </div>
                                                                    <span class="fs-12 text-muted float-end">{{\Carbon\Carbon::parse($loan->borrower->created_at)->format('Y-m-d')}}</span>

                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">

                                                                    <div class="me-2 fw-semibold">
                                                                        Loan Officer :
                                                                    </div>
                                                                    <span class="fs-12 text-muted float-end">{{$loan->user->name ?? ''}}</span>

                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">

                                                                    <div class="me-2 fw-semibold">
                                                                        Loan Product
                                                                    </div>
                                                                    <span class="fs-12 text-muted float-end">{{$loan->product->name}}</span>

                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <div class="me-2 fw-semibold">
                                                                        Loan Release Date
                                                                    </div>
                                                                    <span class="fs-12 text-muted float-end">{{$loan->loan_release_date}}</span>

                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">

                                                                    <div class="me-2 fw-semibold">
                                                                        Disbursement Method :
                                                                    </div>
                                                                    <span class="fs-12 text-muted float-end">{{ucfirst(strtolower($loan->disbursement))}}</span>

                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">

                                                                    <div class="me-2 fw-semibold">
                                                                        Principle Amount :
                                                                    </div>
                                                                    <span class="fs-12 text-muted float-end">{{number_format($loan->principle_amount)}}</span>

                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">

                                                                    <div class="me-2 fw-semibold">
                                                                        Total Interest :
                                                                    </div>
                                                                    <span class="fs-12 text-muted float-end">{{number_format($loan->total_interest)}}</span>

                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">

                                                                    <div class="me-2 fw-semibold">
                                                                        Interest  :
                                                                    </div>
                                                                    <span class="fs-12 text-muted float-end">{{$loan->interest_percentage ? $loan->interest_percentage . '%' : $loan->interest_amount}} per {{$loan->interest_duration}}</span>

                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">

                                                                    <div class="me-2 fw-semibold">
                                                                        Interest  Type :
                                                                    </div>
                                                                    <span class="fs-12 text-muted float-end">{{$loan->interest_method}}</span>

                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">

                                                                    <div class="me-2 fw-semibold">
                                                                        Loan Duration :
                                                                    </div>
                                                                    <span class="fs-12 text-muted float-end">{{$loan->loan_duration}} {{$loan->duration_type}}</span>

                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">

                                                                    <div class="me-2 fw-semibold">
                                                                        Repayment Cycle :
                                                                    </div>
                                                                    <span class="fs-12 text-muted float-end">{{$loan->payment_number}} {{$loan->payment_cycle}}</span>

                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">

                                                                    <div class="me-2 fw-semibold">
                                                                        Total Due :
                                                                    </div>
                                                                    <span class="fs-12 text-muted float-end">{{number_format($loan->total_amount_due)}}</span>

                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">

                                                                    <div class="me-2 fw-semibold">
                                                                        Total Paid Amount :
                                                                    </div>
                                                                    <span class="fs-12 text-muted float-end">{{ $loan->loanPayment->paid_amount ? number_format($loan->loanPayment->paid_amount) : 0}}</span>

                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">

                                                                    <div class="me-2 fw-semibold">
                                                                        Loan Status :
                                                                    </div>
                                                                    @if($loan->status === 'pending')
                                                                        <span class="badge bg-warning">
                                                                                Pending
                                                                            </span>
                                                                    @else
                                                                        <span class="badge bg-success">
                                                                                Approved
                                                                            </span>
                                                                    @endif

                                                                </li>
                                                            </ul>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="tab-pane" id="account-settings"
                                 role="tabpanel">
                                <div class="d-flex align-items-center justify-content-between w-100 p-3 border-bottom">
                                    <div>
                                        <h6 class="fw-semibold mb-0">Payment List</h6>
                                    </div>
                                    
                                    @if($loan->release_status === 'approved'  && $loan->schedules->sum('amount') > 0)
                                        <button class="btn btn-sm btn-primary d-flex align-items-center justify-content-center btn-wave waves-light"
                                                data-bs-toggle="modal" data-bs-target="#create-folder">
                                            <i class="ri-add-circle-line align-middle me-1"></i>Add  Payment
                                        </button>
                                    @endif

                                </div>
                                <div class="modal fade" id="create-folder" tabindex="-1"
                                     aria-labelledby="create-folder" data-bs-keyboard="false"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-top">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="staticBackdropLabel">Create Payment
                                                </h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <form action="{{route('loan.payment', $loan->id)}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">


                                                    <div class="col-xl-12 mb-3">
                                                        <label for="paymentSchedule" class="form-label">Payment Cycle</label>
                                                        <select class="form-control" name="schedule" id="paymentSchedule" required>
                                                            <option value="">Select...</option>
                                                            @foreach($loan->schedules as $schedule)
                                                                <option value="{{$schedule->id}}" data-amount="{{$schedule->amount}}">
                                                                    {{$schedule->due_date}} - {{number_format($schedule->amount)}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-xl-12 mb-3">
                                                        <label for="amount" class="form-label">Enter Amount</label>
                                                        <input class="form-control" type="number" name="amount" id="amount" required>
                                                    </div>
                                                    <div id="error-message" style="color: red;"></div>

                                                    <div class="col-xl-12 mb-3">
                                                        <label for="create-folder1" class="form-label"> Payment Date</label>
                                                        <input  class="form-control" type="date" name="date" required>
                                                    </div>
                                                    <div class="col-xl-12 mb-3">
                                                        <label for="create-folder1" class="form-label"> Payment Method</label>
                                                        <select class="form-control" name="type" id="paymentMethod" required>
                                                            <option value="">select..</option>
                                                            <option value="Cash">Cash</option>
                                                            <option value="Bank">Bank</option>
                                                            <option value="Cheque">Cheque</option>
                                                            <option value="Mobile Transfer">mobile Transfer</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-xl-12 mb-3" id="bankDiv" style="display: none">
                                                        <label for="create-folder1" class="form-label">Bank Name</label>
                                                        <input class="form-control" name="bank" type="text" />

                                                    </div>
                                                    <div class="col-xl-12 mb-3" id="mobileMoney"  style="display: none">
                                                        <label for="create-folder1" class="form-label">Mobile Money</label>
                                                        <select class="form-control" name="mobile">
                                                            <option value="">select..</option>
                                                            <option value="M-pesa">M-pesa</option>
                                                            <option value="Tigo Pesa">Tigo Pesa</option>
                                                            <option value="Airtel">Airtel Money</option>
                                                            <option value="Halopesa">Halopesa</option>
                                                            <option value="T-Pesa">T-Pesa</option>
                                                            <option value="Azam Pay">Azam Pay</option>
                                                        </select>

                                                    </div>
                                                    <div class="col-xl-12 mb-3" id="referenceDiv" style="display: none">
                                                        <label for="create-folder1" class="form-label">Reference</label>
                                                        <input class="form-control" name="reference" type="text" />

                                                    </div>
                                                    <div class="col-xl-12 mb-3">
                                                        <label for="create-folder1" class="form-label"> Comments</label>
                                                        <textarea  class="form-control" rows="3" name="description"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm  btn-light"
                                                            data-bs-dismiss="modal"><i class="ri-close-fill"></i> Cancel</button>
                                                    <button type="submit" class="btn btn-sm btn-success"><i class="ri-save-fill"></i> Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table text-nowrap">
                                        <thead class="table-primary">
                                        <tr>
                                            <th scope="col">SN</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Collected By</th>
                                            <th scope="col">Method</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Receipt</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($loan->payments as $payment)
                                            <tr>
                                                <td>
                                                    {{$loop->iteration}}
                                                </td>
                                                <td>{{$payment->payment_date}}</td>
                                                <td>{{$payment->user->name ?? ''}}</td>
                                                <td> {{$payment->type}}</td>
                                                <td> {{number_format($payment->amount)}}</td>
                                                <td></td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="tab-pane p-0" id="email-settings"
                                 role="tabpanel">
                                <div class="table-responsive">
                                    <table id="js-Exportable" class="table text-nowrap">
                                        <thead class="table-primary">
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">Start Date</th>
                                            <th scope="col">Due Date</th>
                                            <th scope="col">Principle</th>
                                            <th scope="col">Interest</th>
                                            <th scope="col">Penalty</th>
                                            <th scope="col">Fees</th>
                                            <th scope="col">Interest Paid</th>
                                            <th scope="col">Principle Paid</th>
                                            <th scope="col">Due Amount</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($loan->schedules as $schedule)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td class="editable-date" data-field="start_date">{{isset($schedule->start_date) ? \Carbon\Carbon::parse($schedule->start_date)->format('Y-m-d') : ''}}</td>
                                                <td class="editable-date" data-field="due_date">{{$schedule->due_date}}</td>
                                                <td class="editable" data-field="principle">{{number_format($schedule->principle,2)}}</td>
                                                <td class="editable" data-field="interest">{{number_format($schedule->interest, 2)}}</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{$schedule->interest_paid ? number_format($schedule->interest_paid,2) : 0.00}}</td>
                                                <td>{{$schedule->principal_paid ? number_format($schedule->principal_paid) : 0.00}}</td>
                                                <td>{{number_format($schedule->amount,2)}}</td>
                                                <td>
                                                    @if($schedule->status === 'pending')
                                                        <span class="badge bg-warning">Pending</span>
                                                    @elseif($schedule->status === 'due')
                                                        <span class="badge bg-danger">Due</span>
                                                    @elseif($schedule->status === 'completed')
                                                        <span class="badge bg-success">Completed</span>
                                                    @elseif($schedule->status === 'partial')
                                                        <span class="badge bg-danger">Partial Paid</span>
                                                    @else
                                                        <span class="badge bg-danger">Overdue</span>
                                                    @endif
                                                </td>
                                                <input type="hidden" class="schedule-id" value="{{$schedule->id}}">
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Total</th>
                                            <th></th>
                                            <th></th>
                                            <th id="total-principle">0.00</th>
                                            <th id="total-interest">0.00</th>

                                            <th></th>
                                            <th>
                                                @if($loan->stage === 0)
                                                    <button class="btn btn-secondary btn-sm" id="saveChanges">Save</button>
                                                @endif

                                            </th>
                                        </tr>
                                        </tfoot>
                                    </table>

                                </div>

                            </div>
                            <div class="tab-pane" id="agreements"
                                 role="tabpanel">

                                <div class="d-flex align-items-center justify-content-between w-100 p-3 border-bottom">
                                    <div>
                                        <h6 class="fw-semibold mb-0">Agreement Forms</h6>
                                    </div>
                                    <button class="btn btn-sm btn-primary d-flex align-items-center justify-content-center btn-wave waves-light"
                                            data-bs-toggle="modal" data-bs-target="#agreement">
                                        <i class="ri-add-circle-line align-middle me-1"></i>Add  Agreement Form
                                    </button>
                                </div>
                                <div class="modal fade" id="agreement" tabindex="-1"
                                     aria-labelledby="agreement" data-bs-keyboard="false"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-top">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="staticBackdropLabel">Attach Agreement Form
                                                </h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <form action="{{route('loan.attachment', $loan->id)}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">

                                                    <div class="col-xl-12 mb-3">
                                                        <label class="form-label">File Name</label>
                                                        <input  class="form-control" type="text" name="filename"/>
                                                    </div>
                                                    <div class="col-xl-12 mb-3">
                                                        <label for="create-folder1" class="form-label"> Add Attachment </label>
                                                        <input  class="form-control" type="file" name="file"  required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm  btn-light"
                                                            data-bs-dismiss="modal"><i class="ri-close-fill"></i> Cancel</button>
                                                    <button type="submit" class="btn btn-sm btn-success"><i class="ri-save-fill"></i> Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table text-nowrap">
                                        <thead class="table-primary">
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">File Name</th>
                                            <th scope="col">Attachment Size</th>
                                            <th scope="col">Uploaded By</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($loan->agreements as $attach)
                                            <tr>
                                                <td>
                                                    {{$loop->iteration}}
                                                </td>

                                                <td>
                                                    {{$attach->name}}
                                                </td>
                                                <td>
                                                    {{$attach->attachment_size}}
                                                </td>
                                                <td>
                                                    {{$attach->user ? $attach->user->name : 'N/A'}}
                                                </td>
                                                <td>
                                                    <a href="{{route('loan.download', $attach->id)}}" class="btn btn-primary btn-sm">
                                                        <i class="bx bx-show"></i> View
                                                    </a>
                                                </td>

                                            </tr>

                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="labels"
                                 role="tabpanel">
                                <div class="d-flex align-items-center justify-content-between w-100 p-3 border-bottom">
                                    <div>
                                        <h6 class="fw-semibold mb-0">Loan  Collaterals</h6>
                                    </div>
                                    <button class="btn btn-sm btn-primary d-flex align-items-center justify-content-center btn-wave waves-light"
                                            data-bs-toggle="modal" data-bs-target="#collateral">
                                        <i class="ri-add-circle-line align-middle me-1"></i>Add  Collateral
                                    </button>
                                </div>

                                <div class="modal fade" id="collateral" tabindex="-1"
                                     aria-labelledby="agreement" data-bs-keyboard="false"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-top">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="staticBackdropLabel">Add  Loan Collaterals
                                                </h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <form action="{{route('collateral.store', $loan->id)}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">

                                                    <div class="col-xl-12 mb-3">
                                                        <label class="form-label">Select Collateral Type</label>
                                                        <select  class="form-control"  name="typeId">
                                                            <option value="">Select..</option>
                                                            @foreach($types as $type)
                                                                <option value="{{$type->id}}">{{$type->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-xl-12 mb-3">
                                                        <label for="create-folder1" class="form-label"> Product Name </label>
                                                        <input  class="form-control" type="text" name="product_name"  required>
                                                    </div>
                                                    <div class="col-xl-12 mb-3">
                                                        <label for="create-folder1" class="form-label"> Value </label>
                                                        <input  class="form-control number-format" type="number" name="amount"  required>
                                                    </div>
                                                    <div class="col-xl-12 mb-3">
                                                        <label for="create-folder1" class="form-label"> Registered Date </label>
                                                        <input  class="form-control" type="date" name="date" >
                                                    </div>
                                                    <div class="col-xl-12 mb-3">
                                                        <label for="create-folder1" class="form-label"> Product Condition </label>
                                                        <select class="form-control" name="condition">
                                                            <option value="">select..</option>
                                                            <option value="Excellent">Excellent</option>
                                                            <option value="Good">Good</option>
                                                            <option value="Fair">Fair</option>
                                                            <option value="Bad">Bad</option>
                                                            <option value="Worst">Worst</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-xl-12 mb-3">
                                                        <label for="create-folder1" class="form-label"> Description </label>
                                                        <textarea  class="form-control" rows="3" name="comment"></textarea>
                                                    </div>
                                                    <div class="col-xl-12 mb-3">
                                                        <label for="create-folder1" class="form-label"> Attachment </label>
                                                        <input  class="form-control" type="file" name="file" />
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm  btn-light"
                                                            data-bs-dismiss="modal"><i class="ri-close-fill"></i> Cancel</button>
                                                    <button type="submit" class="btn btn-sm btn-success"><i class="ri-save-fill"></i> Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table text-nowrap">
                                        <thead class="table-primary">
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Registered Date</th>
                                            <th scope="col">Value</th>
                                            <th scope="col">Condition</th>
                                            <th scope="col">Created By</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($loan->collaterals as $col)
                                            <tr>
                                                <td>
                                                    {{$loop->iteration}}
                                                </td>
                                                <td>
                                                    {{$col->product_name}}
                                                </td>
                                                <td>
                                                    {{$col->date}}
                                                </td>
                                                <td>
                                                    {{number_format($col->amount)}}
                                                </td>
                                                <td>
                                                    {{$col->condition}}
                                                </td>
                                                <td>
                                                    {{$col->user ? $col->user->name : 'N/A'}}
                                                </td>
                                                <td>
                                                    <a href="{{route('collateral.download', $col->id)}}" class="btn btn-sm btn-primary">
                                                        <i class="bx bx-show"></i> View
                                                    </a>
                                                </td>

                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>


                            </div>
                            <div class="tab-pane p-0" id="notification-settings"
                                 role="tabpanel">
                                <div class="d-flex align-items-center justify-content-between w-100 p-3 border-bottom">
                                    <div>
                                        <h6 class="fw-semibold mb-0">Loan Forms</h6>
                                    </div>
                                    <button class="btn btn-sm btn-primary d-flex align-items-center justify-content-center btn-wave waves-light"
                                            data-bs-toggle="modal" data-bs-target="#loanForm">
                                        <i class="ri-add-circle-line align-middle me-1"></i>Add  Loan Form
                                    </button>
                                </div>
                                <div class="modal fade" id="loanForm" tabindex="-1"
                                     aria-labelledby="loanForm" data-bs-keyboard="false"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-top">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="staticBackdropLabel">Attach Loan Form
                                                </h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <form action="{{route('collateral.attach', $loan->id)}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">

                                                    <div class="col-xl-12 mb-3">
                                                        <label class="form-label">File Name</label>
                                                        <input  class="form-control" type="text" name="filename"/>
                                                    </div>
                                                    <div class="col-xl-12 mb-3">
                                                        <label for="create-folder1" class="form-label"> Add Attachment </label>
                                                        <input  class="form-control" type="file" name="file"  required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm  btn-light"
                                                            data-bs-dismiss="modal"><i class="ri-close-fill"></i> Cancel</button>
                                                    <button type="submit" class="btn btn-sm btn-success"><i class="ri-save-fill"></i> Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table text-nowrap">
                                        <thead class="table-primary">
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">File Name</th>
                                            <th scope="col">Attachment Size</th>
                                            <th scope="col">Uploaded By</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($loan->files as $file)
                                            <tr>
                                                <td>
                                                    {{$loop->iteration}}
                                                </td>

                                                <td>
                                                    {{$file->name}}
                                                </td>
                                                <td>
                                                    {{$file->attachment_size}}
                                                </td>
                                                <td>
                                                    {{$file->user ? $file->user->name : 'N/A'}}
                                                </td>
                                                <td>
                                                    <a href="{{route('collateral.downloadFile', $file->id)}}" class="btn btn-primary btn-sm">
                                                        <i class="bx bx-show"></i> View
                                                    </a>
                                                </td>

                                            </tr>

                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane p-0" id="security"
                                 role="tabpanel">
                                <div class="d-flex align-items-center justify-content-between w-100 p-3 border-bottom">
                                    <div>
                                        <h6 class="fw-semibold mb-0">Loan Comments</h6>
                                    </div>
                                    <button class="btn btn-sm btn-primary d-flex align-items-center justify-content-center btn-wave waves-light"
                                            data-bs-toggle="modal" data-bs-target="#commentForm">
                                        <i class="ri-add-circle-line align-middle me-1"></i>Add Comment
                                    </button>
                                </div>
                                <div class="modal fade" id="commentForm" tabindex="-1"
                                     aria-labelledby="commentForm" data-bs-keyboard="false"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-top">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="staticBackdropLabel">Add Comments
                                                </h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <form action="{{route('collateral.comment', $loan->id)}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">

                                                    <div class="col-xl-12 mb-3">
                                                        <label class="form-label">Enter Comment</label>
                                                        <textarea  class="form-control"  name="comment" rows="3"></textarea>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm  btn-light"
                                                            data-bs-dismiss="modal"><i class="ri-close-fill"></i> Cancel</button>
                                                    <button type="submit" class="btn btn-sm btn-success"><i class="ri-save-fill"></i> Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled profile-timeline">
                                            @foreach($loan->comments as $comment)
                                                <li>
                                                    <div>
                                            <span class="avatar avatar-sm bg-primary-transparent avatar-rounded profile-timeline-avatar">
                                                {{substr($comment->user->name, 0,2)}}
                                            </span>
                                                        <p class="mb-2">
                                                            <b>{{$comment->user->name ?? ''}}</b> <span class="float-end fs-11 text-muted">{{\Carbon\Carbon::parse($comment->created_at)->format('D, d M Y H:i:s')}}</span>
                                                        <p class="text-muted mb-0">
                                                           {{$comment->description}}
                                                        </p>
                                                    </div>
                                                </li>
                                            @endforeach


                                        </ul>
                                    </div>

                            </div>
                            <div class="tab-pane p-0" id="approve"
                                 role="tabpanel">
                                <div class="d-flex align-items-center justify-content-between w-100 p-3 border-bottom">
                                    <div>
                                        <h6 class="fw-semibold mb-0">Approver Comments</h6>
                                    </div>

                                </div>

                                <div class="card-body">
                                    <ul class="list-unstyled profile-timeline">
                                        @foreach($returns as $return)
                                            <li>
                                                <div>
                                            <span class="avatar avatar-sm bg-primary-transparent avatar-rounded profile-timeline-avatar">
                                                {{isset($return->user) ? substr($return->user->name, 0,2) : ''}}
                                            </span>
                                                    <p class="mb-2">
                                                        <b>{{$return->user->name ?? ''}}</b> <span class="float-end fs-11 text-muted">{{\Carbon\Carbon::parse($return->created_at)->format('D, d M Y H:i:s')}}</span>
                                                    <p class="text-muted mb-0">
                                                        {{$return->description}}
                                                    </p>
                                                </div>
                                            </li>
                                        @endforeach


                                    </ul>
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
<script>
    $(document).ready(function (){
        $('#paymentMethod').on('change', function (){
            var stat = $(this).val()
            if(stat === 'Bank'){
                $("#bankDiv").show()
                $("#referenceDiv").show()
                $("#mobileMoney").hide()
            }else if(stat === 'Mobile Transfer'){
                $("#bankDiv").hide()
                $("#referenceDiv").show()
                $("#mobileMoney").show()
            }else{
                $("#bankDiv").hide()
                $("#referenceDiv").hide()
                $("#mobileMoney").hide()
            }
        })


        $('#submitLoan').on('click', function (){
            console.log('hello')
           var id = $(this).data('id');
            $.ajax({
                url:"{{route('loan.submit')}}" + '/' + id,
                type:"POST",
                data:{
                    _token:'{{csrf_token()}}'
                },
                success:function(response){
                  location.reload()
                }
            })

        });


          var paymentSchedule = document.getElementById('paymentSchedule');
        var amountInput = document.getElementById('amount');
        var errorMessage = document.getElementById('error-message');

        paymentSchedule.addEventListener('change', function() {
            var selectedOption = paymentSchedule.options[paymentSchedule.selectedIndex];
            var maxAmount = selectedOption.getAttribute('data-amount');

            amountInput.setAttribute('max', maxAmount);
            errorMessage.textContent = ''; 
        });

        amountInput.addEventListener('input', function() {
            var selectedOption = paymentSchedule.options[paymentSchedule.selectedIndex];
            var maxAmount = selectedOption ? selectedOption.getAttribute('data-amount') : null;
            
            if (maxAmount && parseFloat(amountInput.value) > parseFloat(maxAmount)) {
                errorMessage.textContent = 'The entered amount cannot be greater than ' + maxAmount;
                amountInput.value = '';
            } else {
                errorMessage.textContent = '';
            }
        });

            calculateTotals();
            $('.editable').on('click', function() {
                var $cell = $(this);
                var currentValue = $cell.text().trim().replace(/,/g, '');

                var $input = $('<input>', {
                    type: 'text',
                    value: currentValue,
                    class: 'edit-input, form-control',
                    blur: function() {
                        var newValue = parseFloat($(this).val()).toFixed(2);
                        if (isNaN(newValue)) {
                            newValue = 0.00;
                        }
                        $cell.text(newValue.toLocaleString());
                        validateAndCalculateTotals($cell);
                    },
                    keyup: function(e) {
                        if (e.which === 13) {
                            $(this).blur();
                        }
                    }
                }).appendTo($cell.empty()).focus().select();
            });



        $('.editable-date').on('click', function() {
            var $cell = $(this);
            var currentValue = $cell.text().trim();

            var $input = $('<input>', {
                type: 'date',
                value: currentValue,
                class: 'edit-input form-control',
                blur: function() {
                    var newValue = $(this).val();
                    $cell.text(newValue);
                },
                keyup: function(e) {
                    if (e.which === 13) {
                        $(this).blur();
                    }
                }
            }).appendTo($cell.empty()).focus().select();
        });



        function validateAndCalculateTotals($cell) {
            var $row = $cell.closest('tr');
            var principle = parseFloat($row.find('[data-field="principle"]').text().trim().replace(/,/g, '')) || 0;
            var interest = parseFloat($row.find('[data-field="interest"]').text().trim().replace(/,/g, '')) || 0;
            var dueAmount = parseFloat($row.find('.due-amount').text().trim().replace(/,/g, '')) || 0;

            if ((principle + interest) !== dueAmount) {
                alert('Sum of Principle and Interest must be equal to Due Amount.');
                return false;
            }

            calculateTotals();
        }


        function calculateTotals() {
            var totalPrinciple = 0;
            var totalInterest = 0;
            var totalDueAmount = 0;

            $('#js-Exportable tbody tr').each(function() {
                totalPrinciple += parseFloat($(this).find('[data-field="principle"]').text().trim().replace(/,/g, '')) || 0;
                totalInterest += parseFloat($(this).find('[data-field="interest"]').text().trim().replace(/,/g, '')) || 0;
                totalDueAmount += parseFloat($(this).find('.due-amount').text().trim().replace(/,/g, '')) || 0;
            });

            $('#total-principle').text(totalPrinciple.toFixed(2).toLocaleString());
            $('#total-interest').text(totalInterest.toFixed(2).toLocaleString());
            $('#total-due-amount').text(totalDueAmount.toFixed(2).toLocaleString());
        }



        $('#saveChanges').on('click', function (){
            var data = [];
            $('#js-Exportable tbody tr').each(function() {
                var row = {
                    id: $(this).find('.schedule-id').val(),
                    start_date: $(this).find('[data-field="start_date"]').text().trim(),
                    due_date: $(this).find('[data-field="due_date"]').text().trim(),
                    principle: parseFloat($(this).find('[data-field="principle"]').text().trim().replace(/,/g, '')) || 0,
                    interest: parseFloat($(this).find('[data-field="interest"]').text().trim().replace(/,/g, '')) || 0,

                };
                data.push(row);
                
            });

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success ms-2',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, update changes!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:'{{route('schedule.update')}}',
                        type:'POST',
                        data:{
                            _token:'{{csrf_token()}}',
                            schedules:data
                        },
                        success:function (response){
                            location.reload()
                            swalWithBootstrapButtons.fire(
                                'Updated!',
                                'Your loan has been updated.',
                                'success'
                            )
                            toastr.success("Updated the schedules successfully", "Success")
                        },
                        error:function (error){
                         toastr.error("Failed to update schedules", "Error")
                        }
                    })

                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'You have cancelled this action :)',
                        'error'
                    )
                }
            })
        });

        var viewTab = localStorage.getItem('viewTab');
        if(viewTab){
            $('.nav-tabs a[href="' + viewTab + '"]').tab('show')

        }else{
            $('.nav-tabs a:first').tab('show');
        }
        $('.nav-tabs a').on('shown.bs.tab', function (e){
            var targetTab = $(e.target).attr('href');
            localStorage.setItem('viewTab', targetTab)
        })


    });

</script>
@endsection
