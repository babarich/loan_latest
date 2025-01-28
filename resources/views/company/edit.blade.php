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
                <form action="{{ route('company.updateCompany', $company->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    
<div class="card-body">
                        <div class="row gy-4 mb-4">
                        <div>
                            <label class="form-label" for="name">Company Name</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ $company->name }}">
                             @error('name')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                        </div>

                        <div>
                            <label class="form-label" for="address">Address</label>
                            <input class="form-control" type="text" name="address" id="address" value="{{ $company->address }}">
                             @error('address')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                        </div>

                        <div>
                            <label class="form-label" for="mobile">Mobile</label>
                            <input class="form-control" type="text" name="mobile" id="mobile" value="{{ $company->phone_number }}">
                             @error('mobile')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                        </div>

                        <div>
                            <label class="form-label" for="website">Website</label>
                            <input class="form-control" type="url" name="website" id="website" value="{{ $company->website }}">
                             @error('website')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                        </div>

                        <div>
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ $company->email }}">
                             @error('email')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                        </div>

                        <div>
                            <label class="form-label" for="photo">Photo</label>
                            <input class="form-control"  type="file" name="photo" id="photo">
                        </div>

                        </div>
</div>
                        <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary btn-wave waves-effect waves-light">
                        <i class="bi bi-save"></i> Update
                    </button>
                </div>
                    </form>
              
            </div>
        </div>

    </div>
    <!--End::row-1 -->










@endsection
