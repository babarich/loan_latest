@extends('layouts.app')
@section('content')

    <!-- Start::row-1 -->
    <div class="row" style="margin-top: 50px">
        <div class="col-xxl-9 col-xl-8">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                 Create a new loan
                    </div>
                </div>
                <form method="POST" action="{{route('loan.store')}}" enctype="multipart/form-data">
                    @csrf
                <div class="card-body">
                        <div class="row gy-4 mb-4">
                            <div class="col-xl-6">
                                <label for="job-title" class="form-label">Product Name</label>
                                <select class="form-control"  name="product" required>
                                    <option value="">Select...</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                                @error('product')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label for="job-title" class="form-label">Customer Name</label>
                                <select class="form-control"  name="borrower"  id="customerId" required>
                                    <option value="">Select...</option>
                                    @foreach($borrowers as $borrower)
                                        <option value="{{$borrower->id}}">{{$borrower->first_name}} {{$borrower->last_name}}</option>
                                    @endforeach
                                </select>
                                @error('borrower')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Disbursement Method</label>
                                <select class="form-control"  name="payment" required id="paymentMethod">
                                    <option value="">Select...</option>
                                    <option value="cash">Cash</option>
                                    <option value="cheque">Cheque</option>
                                    <option value="bank">Bank Transfer</option>
                                    <option value="mobile">Mobile Money</option>
                                </select>
                                @error('payment')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6" id="bankDiv" style="display: none">
                                <label class="form-label">Select Banks</label>
                                <select class="form-control"  name="bank_name">
                                    <option value="">Select...</option>
                                    <option value="NMB">NMB</option>
                                    <option value="CRDB">CRDB</option>
                                    <option value="NBC">NBC</option>
                                    <option value="Exim">Exim</option>
                                </select>
                                @error('bank_name')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>


                            <div class="col-xl-6" id="mobileMoney" style="display: none">
                                <label class="form-label">Select Mobile Money</label>
                                <select class="form-control"  name="mobile_money">
                                    <option value="">Select...</option>
                                    <option value="M-pesa">Mpesa</option>
                                    <option value="Tigo Pesa">Tigo Pesa</option>
                                    <option value="Airtel Money">Airtel money</option>
                                    <option value="T-Pesa">T-pesa</option>
                                </select>
                                @error('payment')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Loan Principle Amount</label>
                                <input type="number" class="form-control number_format" id="principle" placeholder=""
                                       name="principle" required>
                                @error('principle')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6" style="display: none" id="pendingDiv">
                                <label class="form-label">Previous Pending Loan</label>
                                <input type="number" class="form-control" id="pending" placeholder=""
                                       name="pending">
                                @error('pending')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6" style="display: none" id="payDiv">
                                <label class="form-label">Do you want to pay off previous loan</label>
                                <select class="form-control" name="payoff">
                                    <option value="">select..</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                @error('payoff')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Loan Release Date</label>
                                <input type="date" class="form-control" id="release_date" placeholder="" name="release_date">
                                @error('release_date')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Interest Method</label>
                                <select class="form-control" name="interest" required>
                                    <option value="">select..</option>
                                    <option value="flat">Flat Rate</option>
                                    <option value="reducing">Reducing Balance</option>
                                    <option value="compound">Compound Interest</option>
                                </select>
                                @error('interest')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label for="percentage" class="form-label">Loan Interest Percentage</label>
                                <input type="number" name="percent" class="form-control" required>
                                @error('percent')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label for="interest_method" class="form-label">Interest Period</label>
                                <select class="form-control" name="interest_method">
                                    <option value="">select..</option>
                                    <option value="day">Per Day</option>
                                    <option value="week">Per Week</option>
                                    <option value="month">Per Month</option>
                                    <option value="year">Per Year</option>
                                </select>
                                @error('interest_method')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Loan Duration</label>
                                <input class="form-control"  name="loan_duration"  type="number"/>
                                @error('loan_duration')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label for="language" class="form-label">Duration Type:</label>
                                <select class="form-control" name="duration_type">
                                    <option value="">select..</option>
                                    <option value="day">Days</option>
                                    <option value="week">Weeks</option>
                                    <option value="month">Months</option>
                                    <option value="year">Years</option>
                                </select>
                                @error('duration_type')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Repayment Cycle</label>
                                <select class="form-control" name="payment_cycle">
                                    <option value="">select..</option>
                                    <option value="day">daily</option>
                                    <option value="week">weekly</option>
                                    <option value="month">monthly</option>
                                </select>
                                @error('payment_cycle')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Number of payments</label>
                                <input  class="form-control" name="number_payments" type="number"/>
                                @error('number_payments')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div>
                                <input type="hidden" name="interest_type" value="percent">
                            </div>
                            <div class="col-xl-6">
                                <label for="qualification" class="form-label">Guarantor:</label>
                                <select class="form-control" name="guarantor" id="guarantorId">
                                    <option value="" >Select..</option>
                                    @foreach($guarantors as $guarantor)
                                        <option value="{{$guarantor->id}}">{{$guarantor->first_name}}</option>
                                    @endforeach
                                </select>
                                @error('guarantor')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label for="job-description" class="form-label">Description :</label>
                                <textarea class="form-control" id="job-description" name="description" rows="3"></textarea>
                                @error('description')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                        </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary btn-wave waves-effect waves-light">
                        <i class="bi bi-save"></i> Submit
                    </button>
                </div>
                </form>
            </div>
        </div>

    </div>
    <!--End::row-1 -->



@endsection


@section('scripts')
   <script>
       $(document).ready(function (){

           $('#paymentMethod').on('change', function (){
               var stat = $(this).val()
               if(stat === 'bank'){
                   $("#bankDiv").show()
                   $("#mobileMoney").hide()
               }else if(stat === 'mobile'){
                   $("#bankDiv").hide()
                   $("#mobileMoney").show()
               }else{
                   $("#bankDiv").hide()
                   $("#mobileMoney").hide()
               }
           })

           $('#customerId').select2({
               class:'form-control',
               placeholder:"Select Customer"
           })


           $('#guarantorId').select2({
               class:'form-control',
               placeholder:"Select Customer"
           })

           $('#customerId').on('change', function (){
               var id = $(this).val()
               $.ajax({
                   url: "{{route('loan.check', ['id' => ''])}}" + '/' + id,
                   dataType:'json',
                   type:'POST',
                   data:{_token:"{{csrf_token()}}"},
                   delay:250,
                   success:function (response){
                       let item = response.status

                       if (item.found === true){
                           $('#pending').val(item.amount)
                           $('#pendingDiv').show()
                           $('#payDiv').show()
                       }else{
                           $('#pendingDiv').hide()
                           $('#payDiv').hide()
                       }

                   },
                   error:function (error){
                     toastr.error("sorry it seems something went wrong")
                       $('#pendingDiv').hide()
                       $('#payDiv').hide()
                   }
               })
           })
       })
   </script>


@endsection
