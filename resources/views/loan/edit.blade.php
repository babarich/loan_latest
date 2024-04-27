@extends('layouts.app')
@section('content')
    <div class="row mb-6 mt-4">

        <div class="col-sm-12 col-xxl-9 col-xl-8 col-md-8 col-lg-8">
            <div class="d-flex flex-row-reverse">
                <a class="btn btn-primary" href="{{route('borrow.index')}}"><i class="bx bx-left-arrow-alt"></i> Back</a>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4">

        </div>
    </div>
    <!-- Start::row-1 -->
    <div class="row" style="margin-top: 50px">
        <div class="col-xxl-9 col-xl-8">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Update  customer details
                    </div>
                </div>
                <form method="POST" action="{{route('borrow.update', $borrow->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row gy-4 mb-4">
                            <div class="col-xl-6">
                                <label for="job-title" class="form-label">Customer FirstName</label>
                                <input type="text" class="form-control" id="first_name" placeholder="" name="first_name" value="{{old('first_name', $borrow->first_name)}}">
                                @error('first_name')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label for="job-title" class="form-label">Customer LastName</label>
                                <input type="text" class="form-control" id="last_name" placeholder="" name="last_name" value="{{old('last_name', $borrow->last_name)}}">
                                @error('last_name')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Gender</label>
                                <select class="form-control"  name="gender" required>
                                    <option value="">Select...</option>
                                    <option value="male" {{old('gender', $borrow->gender === 'male' ? 'selected' : '')}}>Male</option>
                                    <option value="female" {{old('gender', $borrow->gender === 'female' ? 'selected' : '')}}>Female</option>
                                </select>
                                @error('gender')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Title</label>
                                <select class="form-control"  name="title" required>
                                    <option value=" ">Select..</option>
                                    <option value="mr" {{old('title', $borrow->title === 'mr' ? 'selected' : '')}}>Mr</option>
                                    <option value="mrs" {{old('title', $borrow->title === 'mrs' ? 'selected' : '')}}>Mrs.</option>
                                    <option value="miss" {{old('title', $borrow->title === 'miss' ? 'selected' : '')}}>Miss.</option>
                                    <option value="ms" {{old('title', $borrow->title === 'ms' ? 'selected' : '')}}>Ms.</option>
                                    <option value="doc" {{old('title', $borrow->title === 'doc' ? 'selected' : '')}}>Doc.</option>
                                    <option value="rev" {{old('title', $borrow->title === 'rev' ? 'selected' : '')}}>Rev.</option>
                                    <option value="prof" {{old('title', $borrow->title === 'prof' ? 'selected' : '')}}>Prof.</option>
                                </select>
                                @error('title')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Mobile Number</label>
                                <input type="number" class="form-control" id="mobile" placeholder="" name="mobile" required value="{{old('mobile', $borrow->mobile)}}">
                                @error('mobile')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="" name="email" value="{{old('email', $borrow->email)}}">
                                @error('email')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="birth" placeholder="" name="birth" value="{{old('birth', date('Y-m-d', strtotime($borrow->date_birth)))}}">
                                @error('birth')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="" name="address" value="{{old('address', $borrow->address)}}">
                                @error('address')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label for="skills" class="form-label">Working Status</label>
                                <select class="form-control" name="working" id="working">
                                    <option value="" selected="">Select..</option>
                                    <option value="Employee" {{old('working', $borrow->working_status === 'Employee' ? 'selected' : '')}}>Employee</option>
                                    <option value="Government Employee" {{old('working', $borrow->working_status === 'Government Employee' ? 'selected' : '')}}>Government Employee</option>
                                    <option value="Private Sector Employee" {{old('working', $borrow->working_status === 'Private Sector Employee' ? 'selected' : '')}}>Private Sector Employee</option>
                                    <option value="Owner" {{old('working', $borrow->working_status === 'Owner' ? 'selected' : '')}}>Owner</option>
                                    <option value="Student" {{old('working', $borrow->working_status === 'Student' ? 'selected' : '')}}>Student</option>
                                    <option value="Business" {{old('working', $borrow->working_status === 'Business' ? 'selected' : '')}}>Business</option>
                                    <option value="Pensioner" {{old('working', $borrow->working_status === 'Pensioner' ? 'selected' : '')}}>Pensioner</option>
                                    <option value="Unemployed" {{old('working', $borrow->working_status === 'Unemployed' ? 'selected' : '')}}>Unemployed</option>
                                </select>
                                @error('working')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label for="job-deadline" class="form-label">Business Name/Company</label>
                                <input type="text" class="form-control" id="business" placeholder="" name="business" value="{{old('business', $borrow->business_name)}}">
                                @error('business')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label">Identity Type</label>
                                <select class="form-control"  name="identity">
                                    <option value="">Select..</option>
                                    <option value="nida" {{old('identity', $borrow->identity === 'nida' ? 'selected' : '')}}>National Identity(NIDA)</option>
                                    <option value="passport" {{old('identity', $borrow->identity === 'passport' ? 'selected' : '')}}>Passport</option>
                                    <option value="license" {{old('identity', $borrow->identity === 'license' ? 'selected' : '')}}>Drivers License</option>
                                    <option value="voter" {{old('identity', $borrow->identity === 'voter' ? 'selected' : '')}}>Voters Card</option>
                                </select>
                                @error('identity')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label for="language" class="form-label">Identity Number:</label>
                                <input type="text" class="form-control" id="id_number" placeholder="" name="id_number" value="{{old('id_number', $borrow->id_number)}}">
                                @error('id_number')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-6">
                                <label for="qualification" class="form-label">Customers Group :</label>
                                <select class="form-control" name="group" id="group">
                                    <option value="" >Select..</option>
                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}" {{old('group', $borrow->groupId === $group->id ? 'selected' : '')}}>{{$group->name}}</option>
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
                                <textarea class="form-control" id="job-description" name="comments" rows="3">{{old('comments',$borrow->description)}}</textarea>
                                @error('comment')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary btn-wave waves-effect waves-light">
                            <i class="bi bi-save mr-2"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!--End::row-1 -->










@endsection
