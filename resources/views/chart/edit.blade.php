@extends('layouts.app')
@section('content')
    <div class="row mb-6 mt-4">
        <div class="col-sm-12 col-md-6 col-lg-6">

        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="d-flex flex-row-reverse gap-3">
                <div class="mr-4">
                    <a class="btn btn-primary" href="{{route('company.index')}}"><i class="bx bx-left-arrow-alt"></i>Back</a>
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
                        Update  Company Payment Method
                    </div>
                </div>
                <form method="POST" action="{{route('company.update', $transaction->id)}}" enctype="multipart/form-data">
                    @csrf
                <div class="card-body">
                        <div class="row gy-4 mb-4">
                            <div class="col-xl-12">
                                <label for="job-title" class="form-label">Account Name</label>
                                <input type="text" class="form-control" id="name" placeholder="" name="name"
                                value="{{old('name', $transaction->name)}}">
                                @error('name')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-12">
                                <label for="job-title" class="form-label">Payment Method</label>
                                <select  class="form-control" id="percent"  name="payment_type">
                                    <option value="">Select..</option>
                                    <option value="Mobile Money" {{old('payment_type', $transaction->payment_type === 'Mobile Money' ? 'selected' : '')}}>Mobile Money</option>
                                    <option value="Bank Account" {{old('payment_type', $transaction->payment_type === 'Bank Account' ? 'selected' : '')}}>Bank Account</option>
                                </select>
                                @error('payment_type')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-12">
                                <label for="job-title" class="form-label">Account / Mobile</label>
                                <input type="text" class="form-control" id="account" placeholder="" name="account"
                                value="{{old('account', $transaction->account)}}">
                                @error('account')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                             <div class="col-xl-12">
                                <label for="job-title" class="form-label">Open Balance </label>
                                <input type="text" class="form-control" id="balance" placeholder="" name="balance"
                                value="{{old('balance', $transaction->open_balance)}}">
                                @error('balance')
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
