@extends('layouts.app')
@section('content')

    <!-- Start::row-1 -->
    <div class="row" style="margin-top: 50px">
        <div class="col-xxl-9 col-xl-8">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                 Create a new customer
                    </div>
                </div>
                <form method="POST" action="{{route('borrow.store')}}" enctype="multipart/form-data">
                    @csrf
                <div class="card-body">
                        <div class="row gy-4 mb-4">
                            <div class="col-xl-6">
                                <label for="job-title" class="form-label">Customer FirstName</label>
                                <input type="text" class="form-control" id="first_name" placeholder="" name="first_name">
                                @error('first_name')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label for="job-title" class="form-label">Customer LastName</label>
                                <input type="text" class="form-control" id="last_name" placeholder="" name="last_name">
                                @error('last_name')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Gender</label>
                                <select class="form-control"  name="gender" required>
                                    <option value="">Select...</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                @error('gender')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Title</label>
                                <select class="form-control"  name="title" required>
                                    <option value=" ">Select..</option>
                                    <option value="mr">Mr</option>
                                    <option value="mrs">Mrs.</option>
                                    <option value="miss">Miss.</option>
                                    <option value="ms">Ms.</option>
                                    <option value="doc">Doc.</option>
                                    <option value="rev">Rev.</option>
                                    <option value="prof">Prof.</option>
                                </select>
                                @error('title')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Mobile Number</label>
                                <input type="number" class="form-control" id="mobile" placeholder="" name="mobile" required>
                                @error('mobile')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="" name="email">
                                @error('email')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="birth" placeholder="" name="birth">
                                @error('birth')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="" name="address">
                                @error('address')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label for="skills" class="form-label">Working Status</label>
                                <select class="form-control" name="working" id="working">
                                    <option value="" selected="">Select..</option>
                                    <option value="Employee">Employee</option>
                                    <option value="Government Employee">Government Employee</option>
                                    <option value="Private Sector Employee">Private Sector Employee</option>
                                    <option value="Owner">Owner</option>
                                    <option value="Student">Student</option>
                                    <option value="Business">Business</option>
                                    <option value="Pensioner">Pensioner</option>
                                    <option value="Unemployed">Unemployed</option>
                                </select>
                                @error('working')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label for="job-deadline" class="form-label">Business Name/Company</label>
                                <input type="text" class="form-control" id="business" placeholder="" name="business">
                                @error('business')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Identity Type</label>
                                <select class="form-control"  name="identity">
                                    <option value="">Select..</option>
                                    <option value="nida">National Identity(NIDA)</option>
                                    <option value="passport">Passport</option>
                                    <option value="license">Drivers License</option>
                                    <option value="voter">Voters Card</option>
                                </select>
                                @error('identity')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label for="language" class="form-label">Identity Number:</label>
                                <input type="text" class="form-control" id="id_number" placeholder="" name="id_number">
                                @error('id_number')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label for="qualification" class="form-label">Customers Group :</label>
                                <select class="form-control" name="groupId" id="group">
                                    <option value="" >Select..</option>
                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                </select>
                                @error('group')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label for="language" class="form-label">Customer Photo:</label>
                                <input type="file" class="form-control" id="input_file" placeholder="" name="photo">
                                @error('photo')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Upload Customer Files</label>
                                <input type="file" class="form-control multiple-filepond" name="customer_files"
                                       multiple data-allow-reorder="true" data-max-file-size="3MB" data-max-files="6">
                                @error('customer_files')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label for="job-description" class="form-label">Description :</label>
                                <textarea class="form-control" id="job-description" name="comments" rows="3"></textarea>
                                @error('comment')
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
