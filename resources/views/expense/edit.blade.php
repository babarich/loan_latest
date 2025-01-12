@extends('layouts.app')
@section('content')
    <div class="row mb-6 mt-4">
        <div class="col-sm-12 col-md-6 col-lg-6">

        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="d-flex flex-row-reverse gap-3">
                <div class="mr-4">
                    <a class="btn btn-primary" href="{{route('coa.chart')}}"><i class="bx bx-left-arrow-alt"></i>Back</a>
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
                        Update  Chart Of Account
                    </div>
                </div>
                <form method="POST" action="{{route('coa.updateChartOfAccount', $chart->id)}}" enctype="multipart/form-data">
                    @csrf
                <div class="card-body">
                        <div class="row gy-4 mb-4">
                            <div class="col-xl-12">
                                <label for="job-title" class="form-label">Account Code</label>
                                <input type="text" class="form-control" id="code" placeholder="" name="code"
                                value="{{old('code',$chart->code)}}">
                                @error('code')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>

                            <div class="col-xl-12">
                                <label for="job-title" class="form-label">Account Name</label>
                                <input type="text" class="form-control" id="name" placeholder="" name="name"
                                value="{{old('code',$chart->name)}}">
                                @error('name')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <div class="col-xl-12">
                                <label for="job-title" class="form-label">Account Type</label>
                                <select  class="form-control" id="accountType"  name="financial_category_id">
                                    <option value="">Select..</option>
                                    @foreach($types as $type)
                                     <option value="{{$type->id}}" {{old('financial_category_id', 
                                        $chart->financial_category_id === $type->id ? 'selected' : '')}}>{{$type->name}}</option>
                                    @endforeach
                                    
                                </select>
                                @error('financial_category_id')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                            <span>If you skip to select a group, system will automatically add this chart name into a group</span>
                            <div class="col-xl-12">
                                <label for="job-title" class="form-label">Account Group</label>
                                <select  class="form-control" id="accountGroup"  name="account_group_id">
                                    <option value="">Select..</option>
                                    @foreach($groups as $group)
                                     <option value="{{$group->id}}" {{old('account_group_id', 
                                        $chart->account_group_id === $group->id ? 'selected' : '')}}>{{$group->name}}</option>
                                    @endforeach
                                </select>
                                @error('account_group')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                             <div class="col-xl-12">
                                <label for="job-title" class="form-label">Enter Notes </label>
                                <textarea rows="3" class="form-control" id="notes" placeholder="" name="note">{{old('note', $chart->note)}}</textarea>
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
