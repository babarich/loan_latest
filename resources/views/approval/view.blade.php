@extends('layouts.app')
@section('content')
    <div class="container-fluid mt-8">
        <div class="row mb-6 mt-4">
            <div class="col-sm-12 col-md-6 col-lg-6">

            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="d-flex flex-row-reverse">
                    @if($loan->stage < 2)
                        <a class="btn btn-success" href="{{route('approve.approveFirst', $loan->id)}}"><i class="bx bx-check"></i> Approve Loan</a>

                        <a class="btn btn-danger me-4"  data-bs-toggle="modal" data-bs-target="#rejectForm"><i class="bx bx-stop"></i> Reject Loan</a>

                    @elseif($loan->stage < 3)
                        <a class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#paymentForm"><i class="bx bx-check"></i> Disburse Loan</a>

                        <a class="btn btn-danger me-4"  data-bs-toggle="modal" data-bs-target="#rejectForm"><i class="bx bx-stop"></i> Reject Loan</a>
                    @endif

                </div>
            </div>
        </div>

        <div class="modal fade" id="paymentForm" tabindex="-1"
             aria-labelledby="paymentForm" data-bs-keyboard="false"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-top">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="staticBackdropLabel">Disburse Loan for  Payment
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <form action="{{route('approve.disburse', $loan->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">

                            <div class="col-xl-12 mb-3">
                                <label class="form-label">Payment Method</label>
                                <select  class="form-control" type="text" name="payment_method">
                                    <option value="">Select</option>
                                    @foreach($transactions as $transaction)
                                        <option value="{{$transaction->id}}">{{$transaction->name}} - {{$transaction->account}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-12 mb-3">
                                <label class="form-label">Payment Reference</label>
                                <input  class="form-control" type="text" name="payment_reference" />

                            </div>
                            
                                @php
                                $user = \Illuminate\Support\Facades\Auth::user();
                                $logo = \App\Models\Company::where('id', $user->com_id)->first();
                                
                                @endphp

                             @if(isset($logo) && $logo->id === 2)   
                            <div class="col-xl-12">
                                <label for="job-title" class="form-label">Account Type</label>
                                <select  class="form-control" id="chartId"  name="chart_id">
                                    <option value="">Select..</option>
                                    @foreach($charts as $chart)
                                     <option value="{{$chart->id}}">{{$chart->name}}</option>
                                    @endforeach
                                    
                                </select>
                                @error('chart_id')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            @endif

                            <div class="col-xl-12 mb-3">
                                <label class="form-label">Payment Date</label>
                                <input  class="form-control" type="date" name="payment_date" />

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

    <div class="modal fade" id="rejectForm" tabindex="-1"
         aria-labelledby="rejectForm" data-bs-keyboard="false"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-top">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="staticBackdropLabel">Reason For Rejecting Loan
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <form action="{{route('approve.rejectFirst', $loan->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="col-xl-12 mb-3">
                            <label class="form-label">Reject Reasons</label>
                            <textarea  class="form-control" type="text" name="comment" rows="3"></textarea>
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
                                                                    <span class="fs-12 text-muted float-end">{{number_format($loan->principle_amount + $loan->total_interest)}}</span>

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
                            <div class="tab-pane" id="agreements"
                                 role="tabpanel">

                                <div class="d-flex align-items-center justify-content-between w-100 p-3 border-bottom">
                                    <div>
                                        <h6 class="fw-semibold mb-0">Agreement Forms</h6>
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


        })
    </script>
@endsection
