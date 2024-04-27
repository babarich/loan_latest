@extends('layouts.app')
@section('content')

    <!-- Start::row-1 -->
    <div class="row" style="margin-top: 50px">
        <div class="col-xxl-9 col-xl-8">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Update  guarantor
                    </div>
                </div>
                <form method="POST" action="{{route('guarantor.update', $guarantor->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row gy-4 mb-4">
                            <div class="col-xl-6">
                                <label for="job-title" class="form-label">Guarantor FirstName</label>
                                <input type="text" class="form-control" id="first_name" placeholder="" name="first_name" value="{{old('first_name', $guarantor->first_name)}}">
                                @error('first_name')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label for="job-title" class="form-label">Guarantor LastName</label>
                                <input type="text" class="form-control" id="last_name" placeholder="" name="last_name" value="{{old('last_name', $guarantor->last_name)}}">
                                @error('last_name')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Gender</label>
                                <select class="form-control"  name="gender" required>
                                    <option value="">Select...</option>
                                    <option value="male" {{old('gender', $guarantor->gender === 'male' ? 'selected' : '')}}>Male</option>
                                    <option value="female" {{old('gender', $guarantor->gender === 'female' ? 'selected' : '')}}>Female</option>
                                </select>
                                @error('gender')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Title</label>
                                <select class="form-control"  name="title" required>
                                    <option value=" ">Select..</option>
                                    <option value="mr" {{old('title', $guarantor->gender === 'mr' ? 'selected' : '')}}>Mr</option>
                                    <option value="mrs" {{old('title', $guarantor->gender === 'mrs' ? 'selected' : '')}}>Mrs.</option>
                                    <option value="miss" {{old('title', $guarantor->gender === 'miss' ? 'selected' : '')}}>Miss.</option>
                                    <option value="ms" {{old('title', $guarantor->gender === 'ms' ? 'selected' : '')}}>Ms.</option>
                                    <option value="doc" {{old('title', $guarantor->gender === 'doc' ? 'selected' : '')}}>Doc.</option>
                                    <option value="rev" {{old('title', $guarantor->gender === 'rev' ? 'selected' : '')}}>Rev.</option>
                                    <option value="prof" {{old('title', $guarantor->gender === 'prof' ? 'selected' : '')}}>Prof.</option>
                                </select>
                                @error('title')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Mobile Number</label>
                                <input type="number" class="form-control" id="mobile" placeholder="" name="mobile" required value="{{old('mobile', $guarantor->mobile)}}">
                                @error('mobile')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="" name="email" value="{{old('email', $guarantor->email)}}">
                                @error('email')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="birth" placeholder="" name="birth" value="{{old('birth', date('Y-m-d', strtotime($guarantor->date_birth)))}}">
                                @error('birth')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="" name="address" value="{{old('address',$guarantor->address)}}">
                                @error('address')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label for="skills" class="form-label">Working Status</label>
                                <select class="form-control" name="working" id="working">
                                    <option value="" selected="">Select..</option>
                                    <option value="Employee" {{old('working', $guarantor->working_status === 'Employee' ? 'selected' : '')}}>Employee</option>
                                    <option value="Government Employee" {{old('working', $guarantor->working_status === 'Government Employee' ? 'selected' : '')}}>Government Employee</option>
                                    <option value="Private Sector Employee" {{old('working', $guarantor->working_status === 'Private Sector Employee' ? 'selected' : '')}}>Private Sector Employee</option>
                                    <option value="Owner" {{old('working', $guarantor->working_status === 'Owner' ? 'selected' : '')}}>Owner</option>
                                    <option value="Student" {{old('working', $guarantor->working_status === 'Student' ? 'selected' : '')}}>Student</option>
                                    <option value="Business" {{old('working', $guarantor->working_status === 'Business' ? 'selected' : '')}}>Business</option>
                                    <option value="Pensioner" {{old('working', $guarantor->working_status === 'Pensioner' ? 'selected' : '')}}>Pensioner</option>
                                    <option value="Unemployed" {{old('working', $guarantor->working_status === 'Unemployed' ? 'selected' : '')}}>Unemployed</option>
                                </select>
                                @error('working')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label for="job-deadline" class="form-label">Business Name/Company</label>
                                <input type="text" class="form-control" id="business" placeholder="" name="business" value="{{old('business', $guarantor->business_name)}}">
                                @error('business')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>

                            <div class="col-xl-6">
                                <label for="language" class="form-label">Guarantor Photo:</label>
                                <input type="file" class="form-control" id="input_file" placeholder="" name="photo">
                                @error('photo')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Upload Guarantor Files</label>
                                <input type="file" class="form-control multiple-filepond" name="customer_files"
                                       multiple data-allow-reorder="true" data-max-file-size="3MB" data-max-files="6">
                                @error('customer_files')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label for="job-description" class="form-label">Description :</label>
                                <textarea class="form-control" id="job-description" name="comments" rows="3">{{old('comments', $guarantor->description)}}</textarea>
                                @error('comment')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
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
