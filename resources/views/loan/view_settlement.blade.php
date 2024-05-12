@extends('layouts.app')
@section('content')
    <div class="container-fluid mt-8">
        <div class="row mb-6 mt-4">
            <div class="col-sm-12 col-md-6 col-lg-6">

            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="d-flex flex-row-reverse">
                    @if($loan->release_status = 'approved')
                        <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#settlement"><i class="bx bx-check"></i> Cash Settlement </a>
                    @endif

                </div>
            </div>
        </div>
        <div class="modal fade" id="settlement" tabindex="-1"
             aria-labelledby="settlement" data-bs-keyboard="false"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-top">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="staticBackdropLabel">Make Cash Settlement
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <form action="{{route('loan.settlePayment', $loan->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">


                            <div class="col-xl-12 mb-3">
                                <label for="create-folder1" class="form-label">Total Interest </label>
                                <input  class="form-control" name="interest" id="paymentSchedule" value="{{$totalInterest}}" readonly>

                            </div>
                            <div class="col-xl-12 mb-3">
                                <label for="create-folder1" class="form-label">Total Principle </label>
                                <input  class="form-control" name="principle" id="paymentSchedule" value="{{$totalPrinciple}}" readonly>

                            </div>
                            <div class="col-xl-12 mb-3">
                                <label for="create-folder1" class="form-label"> Enter Settlement Amount</label>
                                <input  class="form-control  number-format" type="number" name="amount" id="amount" required>
                            </div>
                            <div class="col-xl-12 mb-3">
                                <label for="create-folder1" class="form-label"> Settlement Date</label>
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
                                                                    <span class="fs-12 text-muted float-end">{{number_format($loan->loanPayment->due_amount)}}</span>

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
                                                        <label for="create-folder1" class="form-label">Payment  Cycle</label>
                                                        <select  class="form-control" name="schedule" id="paymentSchedule" required>
                                                            <option value="">Select...</option>
                                                            @foreach($loan->schedules as $schedule)
                                                                <option value="{{$schedule->id}}">{{$schedule->due_date}} - {{number_format($schedule->amount)}}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    <div class="col-xl-12 mb-3">
                                                        <label for="create-folder1" class="form-label"> Enter Amount</label>
                                                        <input  class="form-control  number-format" type="number" name="amount" id="amount" required>
                                                    </div>
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
                                    <table class="table text-nowrap">
                                        <thead class="table-primary">
                                        <tr>
                                            <th scope="col">S/N</th>
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
                                                <td>
                                                    {{$loop->iteration}}
                                                </td>

                                                <td>
                                                    {{$schedule->due_date}}
                                                </td>
                                                <td>
                                                    {{number_format($schedule->principle)}}
                                                </td>
                                                <td>
                                                    {{number_format($schedule->interest)}}
                                                </td>

                                                <td>

                                                </td>

                                                <td>

                                                </td>

                                                <td>
                                                    {{$schedule->interest_paid ? number_format($schedule->interest_paid) : 0.00}}
                                                </td>

                                                <td>
                                                    {{$schedule->principal_paid ? number_format($schedule->principal_paid) : 0.00}}
                                                </td>
                                                <td>
                                                    {{number_format($schedule->amount)}}
                                                </td>
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
                                                        <span  class="badge bg-danger">Overdue</span>
                                                    @endif
                                                </td>
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

            // Swal.fire({
            //     title:"Are you sure?",
            //     text:"You want to submit this Loan",
            //     type:"warning",
            //     showCancelButton:true,
            //     confirmButtonClass:"btn-danger",
            //     confirmButtonText:"Yes,Accept",
            //     cancelButtonText:"No,Cancel",
            //     closeOnConfirm:false,
            //     closeOnCancel:false
            // },
            // function (isConfirm){
            //     if(isConfirm){
            //
            //     }else{
            //         Swal.fire("Cancelled", "You have cancelled submitting the loan :)", "error")
            //     }
            // }
            // )
        })
    </script>
@endsection
