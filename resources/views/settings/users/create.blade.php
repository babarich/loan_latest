@extends('layouts.app')
@section('content')

    <!-- Start::row-1 -->
    <div class="row" style="margin-top: 50px">
        <div class="col-xxl-9 col-xl-8">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Create a new user
                    </div>
                </div>
                <form method="POST" action="{{route('user.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row gy-4 mb-4">
                            <div class="col-xl-12">
                                <label for="job-title" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" placeholder="" name="name" autocomplete="off" />
                                @error('name')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-12">
                                <label for="job-title" class="form-label">Email</label>
                                <input type="email" class="form-control" id="name" placeholder="" name="email" autocomplete="off" />
                                @error('email')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-12">
                                <label for="job-title" class="form-label">Default Password</label>
                                <input type="password" class="form-control" id="password" placeholder="password" name="password" autocomplete="off" />
                                @error('password')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-12 mb-3">
                                <label for="create-folder1" class="form-label">Role  Name</label>
                                <select  class="form-control" name="role" id="name" required>
                                    <option value="">Select...</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach

                                </select>
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




