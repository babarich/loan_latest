@extends('layouts.app')
@section('content')
    <div class="row mb-6 mt-4">
        <div class="col-sm-12 col-md-6 col-lg-6">

        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="d-flex flex-row-reverse">
                <a class="btn btn-primary" href="{{route('user.create')}}"><i class="bx bx-plus"></i> Add New User</a>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">Users List</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="file-export" class="table table-bordered text-nowrap w-100 dataTable no-footer">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Last Login</th>
                                <th>Action </th>

                            </tr>
                            </thead>

                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email ?? ''}}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            <span class="badge bg-primary">{{$role->name}}</span>
                                        @endforeach
                                    </td>
                                    <td>{{$user->last_login}}</td>.
                                    <td>
                                        <a  class="btn btn-sm btn-success btn-wave waves-effect waves-light"
                                            data-bs-toggle="modal" data-bs-target="#editModal{{$user->id}}">
                                            <i class="ri-check-line align-middle me-2 d-inline-block"></i>assign role
                                        </a>
                                        <a  class="btn btn-sm btn-danger btn-wave waves-effect waves-light"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal{{$user->id}}">
                                            <i class="ri-stop-line align-middle me-2 d-inline-block"></i>unassign role
                                        </a>

                                    </td>
                                </tr>
                                <div class="modal fade" id="editModal{{$user->id}}" tabindex="-1"
                                     aria-labelledby="editModal" data-bs-keyboard="false"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-top">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="staticBackdropLabel">Assign User Role
                                                </h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <form action="{{route('user.assign', $user->id)}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">

                                                    <div class="col-xl-12 mb-3">
                                                        <label for="create-folder1" class="form-label">Role  Name</label>
                                                        <select  class="form-control" name="name" id="name" required>
                                                            <option value="">Select...</option>
                                                            @foreach($roles as $role)
                                                                <option value="{{$role->name}}">{{$role->name}}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm  btn-light"
                                                            data-bs-dismiss="modal"><i class="ri-close-fill"></i> Cancel</button>
                                                    <button type="submit" class="btn btn-sm btn-success"><i class="ri-save-fill"></i> Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="deleteModal{{$user->id}}" tabindex="-1"
                                     aria-labelledby="editModal" data-bs-keyboard="false"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-top">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="staticBackdropLabel">Remove User Role
                                                </h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>

                                                <div class="modal-body">

                                                    <div class="col-xl-12 mb-3">
                                                        <label for="create-folder1" class="form-label">Role  Name</label>
                                                        @foreach($user->roles as $role)
                                                        <div class="form-check">
                                                            <input class="form-check-input deleteRole" type="checkbox" value="{{$role->id}}" id="flexCheckChecked"
                                                                   data-id="{{$user->id}}" data-role="{{$role->name}}" checked>
                                                            <label class="form-check-label" for="flexCheckChecked">
                                                                {{$role->name}}
                                                            </label>
                                                        </div>
                                                        @endforeach


                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm  btn-light"
                                                            data-bs-dismiss="modal"><i class="ri-close-fill"></i> Cancel</button>
                                                    <button type="submit" class="btn btn-sm btn-success"><i class="ri-save-fill"></i> Submit</button>
                                                </div>

                                        </div>
                                    </div>
                                </div>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>




@endsection

@section('scripts')
<script>
 $(document).ready(function (){
     $('.deleteRole').on('click', function (){
         var id = $(this).data('id');
         var role = $(this).data('role');
         $.ajax({
             url:'{{route('user.unassign')}}' + '/' + id,
             type:'POST',
             data:{
                 _token:'{{csrf_token()}}',
                 name:role
             },
             success:function (response){
                 location.reload()
             },
             error:function (error){

             }
         })
     })
 })

</script>

@endsection
