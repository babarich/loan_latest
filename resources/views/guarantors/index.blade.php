@extends('layouts.app')
@section('content')
    <div class="row mb-6 mt-4">
        <div class="col-sm-12 col-md-6 col-lg-6">

        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="d-flex flex-row-reverse">
                  <a class="btn btn-primary" href="{{route('guarantor.create')}}"><i class="bx bx-plus"></i> Add Guarantor</a>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">Guarantors List</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                            <table id="file-export" class="table table-bordered text-nowrap w-100 dataTable no-footer">
                               <thead>
                               <tr>
                                   <th>SN</th>
                                   <th>Full Name</th>
                                   <th>Reference</th>
                                   <th>Email</th>
                                   <th>Mobile</th>
                                   <th>Business </th>
                                   <th>Address</th>
                                   <th>Gender</th>
                                   <th>Action</th>
                               </tr>
                               </thead>
                                <tbody>
                                @foreach($guarantors as $guarantor)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$guarantor->first_name}} {{$guarantor->last_name}}</td>
                                        <td>{{$guarantor->reference}}</td>
                                        <td>{{$guarantor->email}}</td>
                                        <td>{{$guarantor->mobile}}</td>.
                                        <td>{{$guarantor->business_name}}</td>
                                        <td>{{$guarantor->address}}</td>
                                        <td>{{$guarantor->gender}}</td>
                                        <td>
                                            <a href="{{route('guarantor.edit', $guarantor->id)}}" class="btn btn-sm btn-primary btn-wave waves-effect waves-light">
                                                <i class="ri-pencil-line align-middle me-2 d-inline-block"></i>Edit
                                            </a>
                                            <a href="{{route('guarantor.show', $guarantor->id)}}" class="btn btn-sm btn-success btn-wave waves-effect waves-light">
                                                <i class="ri-eye-line align-middle me-2 d-inline-block"></i>View
                                            </a>

                                            <button class="btn btn-sm btn-danger btn-wave waves-effect waves-light">
                                                <i class="ri-delete-bin-line align-middle me-2 d-inline-block"></i>Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                               </tbody>
                            </table>
                </div>
            </div>
        </div>
    </div>




@endsection

@section('scripts')


@endsection
