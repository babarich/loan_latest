@extends('layouts.app')
@section('content')

    <!-- Start::row-1 -->
    <div class="row" style="margin-top: 50px">
        <div class="col-xxl-9 col-xl-8">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Update  a new loan details
                    </div>
                </div>

                <form method="POST" action="{{route('loan.update', $loan->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row gy-4 mb-4">
                            <div class="col-xl-6">
                                <label for="job-title" class="form-label">Product Name</label>
                                <select class="form-control"  name="product" required>
                                    <option value="">Select...</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}" {{old('product', $loan->loan_product === $product->id ? 'selected' : '')}}>{{$product->name}}</option>
                                    @endforeach
                                </select>
                                @error('product')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label for="job-title" class="form-label">Customer Name</label>
                                <select class="form-control"  name="borrower" id="customerId" required>
                                    <option value="">Select...</option>
                                    @foreach($borrowers as $borrower)
                                        <option value="{{$borrower->id}}" {{old('borrower', $loan->borrower_id === $borrower->id ? 'selected' : '')}}>{{$borrower->first_name}} {{$borrower->last_name}}</option>
                                    @endforeach
                                </select>
                                @error('borrower')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Disbursement Method</label>
                                <select class="form-control"  name="payment" required>
                                    <option value="">Select...</option>
                                    <option value="cash" {{old('payment', $loan->disbursement === 'cash' ? 'selected' : '')}}>Cash</option>
                                    <option value="cheque" {{old('payment', $loan->disbursement === 'cheque' ? 'selected' : '')}}>Cheque</option>
                                    <option value="bank" {{old('payment', $loan->disbursement === 'bank' ? 'selected' : '')}}>Bank Transfer</option>
                                    <option value="mobile" {{old('payment', $loan->disbursement === 'mobile' ? 'selected' : '')}}>Mobile Money</option>
                                </select>
                                @error('payment')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>

                            <div class="col-xl-6">
                                <label class="form-label">Loan Principle Amount</label>
                                <input type="number" class="form-control number_format" id="principle" placeholder=""
                                       name="principle" required value="{{old('principle', $loan->principle_amount)}}">
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
                                <input type="date" class="form-control" id="release_date" placeholder="" name="release_date"
                                value="{{old('release_date', date('Y-m-d', strtotime($loan->loan_release_date)))}}">
                                @error('release_date')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Interest Method</label>
                                <select class="form-control" name="interest">
                                    <option value="">select..</option>
                                    <option value="flat" {{old('interest', $loan->interest_method === 'flat' ? 'selected' : '')}}>Flat Rate</option>
                                    <option value="reducing" {{old('interest', $loan->interest_method === 'reducing' ? 'selected' : '')}}>Reducing Balance</option>
                                    <option value="compound" {{old('interest', $loan->interest_method === 'compound' ? 'selected' : '')}}>Compound Interest</option>
                                </select>
                                @error('interest')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label for="percentage" class="form-label">Loan Interest Percentage</label>
                                <input type="number" name="percent" class="form-control" value="{{old('percent', $loan->interest_percentage)}}">
                                @error('percent')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label for="interest_method" class="form-label">Interest Period</label>
                                <select class="form-control" name="interest_method">
                                    <option value="">select..</option>
                                    <option value="day" {{old('interest_method', $loan->interest_duration === 'day' ? 'selected' : '')}}>Per Day</option>
                                    <option value="week" {{old('interest_method', $loan->interest_duration === 'week' ? 'selected' : '')}}>Per Week</option>
                                    <option value="month" {{old('interest_method', $loan->interest_duration === 'month' ? 'selected' : '')}}>Per Month</option>
                                    <option value="year" {{old('interest_method', $loan->interest_duration === 'year' ? 'selected' : '')}}>Per Year</option>
                                </select>
                                @error('interest_method')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Loan Duration</label>
                                <input class="form-control"  name="loan_duration"  type="number" value="{{old('loan_duration', $loan->loan_duration)}}"/>
                                @error('loan_duration')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label for="language" class="form-label">Duration Type:</label>
                                <select class="form-control" name="duration_type">
                                    <option value="">select..</option>
                                    <option value="day" {{old('duration_type', $loan->duration_type === 'day' ? 'selected' : '')}}>Days</option>
                                    <option value="week" {{old('duration_type', $loan->duration_type === 'week' ? 'selected' : '')}}>Weeks</option>
                                    <option value="month" {{old('duration_type', $loan->duration_type === 'month' ? 'selected' : '')}}>Months</option>
                                    <option value="year" {{old('duration_type', $loan->duration_type === 'year' ? 'selected' : '')}}>Years</option>
                                </select>
                                @error('duration_type')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Repayment Cycle</label>
                                <select class="form-control" name="payment_cycle">
                                    <option value="">select..</option>
                                    <option value="day" {{old('payment_cycle', $loan->payment_cycle === 'day' ? 'selected' : '')}}>daily</option>
                                    <option value="week" {{old('payment_cycle', $loan->payment_cycle === 'week' ? 'selected' : '')}}>weekly</option>
                                    <option value="month" {{old('payment_cycle', $loan->payment_cycle === 'month' ? 'selected' : '')}}>monthly</option>
                                </select>
                                @error('payment_cycle')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Number of payments</label>
                                <input  class="form-control" name="number_payments" type="number" value="{{old('number_payments', $loan->payment_number)}}"/>
                                @error('number_payments')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div>
                                <input type="hidden" name="interest_type" value="percent">
                            </div>
                            <div class="col-xl-6">
                                <label for="qualification" class="form-label">Guarantor:</label>
                                <select class="form-control" name="guarantor" id="group">
                                    <option value="" >Select..</option>
                                    @foreach($guarantors as $guarantor)
                                        <option value="{{$guarantor->id}}" {{old('guarantor', $loan->guarantor_id === $guarantor->id ? 'selected' : '')}}>{{$guarantor->first_name}}</option>
                                    @endforeach
                                </select>
                                @error('guarantor')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label for="job-description" class="form-label">Description :</label>
                                <textarea class="form-control" id="job-description" name="description" rows="3">{{old('description', $loan->description)}}</textarea>
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

            $('#customerId').on('change', function (){
                var id = $(this).val()
                $.ajax({
                    url: '{{route('loan.check', ['id' => ''])}}' + '/' + id,
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
