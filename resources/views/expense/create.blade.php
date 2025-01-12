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
    <div class="row" style="margin-top: 50px">
        <div class="col-xxl-9 col-xl-8">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                 Create a new expense
                    </div>
                </div>
                <form method="POST" action="{{route('expense.store')}}" enctype="multipart/form-data">
                    @csrf
                <div class="card-body">
                        <div class="row gy-4 mb-4">
                            <div class="col-xl-12">
                                <label for="job-title" class="form-label">Expense Type</label>
                                <input type="text" class="form-control" id="name" placeholder="" name="name">
                                @error('name')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>

                            <div class="col-xl-12">
                                <label for="job-title" class="form-label">Date</label>
                                <input type="date" class="form-control" id="date" placeholder="" name="date">
                                @error('date')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>

                            <div class="col-xl-12">
                                <label for="job-title" class="form-label">Amount</label>
                                <input type="text" class="form-control" id="amount" placeholder="" name="amount">
                                @error('amount')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>

                            <div class="col-xl-12">
                                <label for="job-title" class="form-label">Account Type</label>
                                <select  class="form-control" id="accountType"  name="chart_id">
                                    <option value="">Select..</option>
                                    @foreach($charts as $chart)
                                     <option value="{{$chart->id}}">{{$chart->name}}</option>
                                    @endforeach
                                    
                                </select>
                                @error('chart_id')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                  
                            <div class="col-xl-12">
                                <label for="job-title" class="form-label">Payment Account</label>
                                <select  class="form-control" id="paymentAccount"  name="payment_id">
                                    <option value="">Select..</option>
                                    @foreach($payments as $payment)
                                     <option value="{{$payment->id}}">{{$payment->name}}</option>
                                    @endforeach
                                    
                                </select>
                                @error('payment_id')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-12">
                                <label for="job-title" class="form-label">Reference No</label>
                                <input type="text" class="form-control" id="ref" placeholder="" name="ref_no">
                                @error('ref_no')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>

                             <div class="col-xl-12">
                                <label for="job-title" class="form-label">Enter Notes </label>
                                <textarea rows="3" class="form-control" id="notes" placeholder="" name="note"></textarea>
                                @error('note')
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
