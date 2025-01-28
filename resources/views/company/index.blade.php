@extends('layouts.app')
@section('content')
    <div class="row mb-6 mt-4">
        <div class="col-sm-12 col-md-6 col-lg-6">

        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="d-flex flex-row-reverse">
                 
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">Company Details List</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                            <table id="file-export" class="table table-bordered text-nowrap w-100 dataTable no-footer">
                               <thead>
                               <tr>
                                   <th>SN</th>
                                   <th>Name</th>
                                   <th>Address</th>
                                   <th>Email</th>
                                   <th>Mobile</th>
                                   <th>Photo</th>
                                   <th>Website</th>
                                   <th>Action </th>

                               </tr>
                               </thead>
                                <tbody>
                              
                                    <tr>
                                        <td>1</td>
                                        <td>{{$company->name}}</td>
                                        <td>{{$company->address}}</td>
                                        <td>{{$company->email}} </td>
                                        <td>{{$company->phone_number ?? 0 }}</td>
                                        <td>
                                            @if($company->photo)
                                                <img src="{{ Storage::url($company->photo) }}" alt="Company Photo" width="100">
                                            @else
                                                <p>No photo available.</p>
                                            @endif
                                        </td>
                                        <td>{{$company->website}}</td>
                                       <td>
                                            <a href="{{route('company.editCompany', $company->id)}}" class="btn btn-sm btn-primary btn-wave waves-effect waves-light">
                                                <i class="ri-pencil-line align-middle me-2 d-inline-block"></i>Edit
                                            </a>
                                            
                                        </td>
                                    </tr>
                              
                               </tbody>
                            </table>
                </div>
            </div>
        </div>
    </div>




@endsection

@section('scripts')
<script>
   $(document).ready( function (){
       $('#file-export').on('click', '.deleteTrans', function (){
           var id = $(this).data('id');
           const swalWithBootstrapButtons = Swal.mixin({
               customClass: {
                   confirmButton: 'btn btn-success ms-2',
                   cancelButton: 'btn btn-danger'
               },
               buttonsStyling: false
           })
           swalWithBootstrapButtons.fire({
               title: 'Are you sure?',
               text: "You won't be able to revert this!",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonText: 'Yes, delete it!',
               cancelButtonText: 'No, cancel!',
               reverseButtons: true
           }).then((result) => {
               if (result.isConfirmed) {
                   $.ajax({
                       url:'{{route('company.delete')}}',
                       type:'POST',
                       data:{
                           _token:'{{csrf_token()}}',
                           id:id
                       },
                       success:function (response){
                           location.reload()
                           swalWithBootstrapButtons.fire(
                               'Deleted!',
                               'Your loan has been deleted.',
                               'success'
                           )
                       },
                       error:function (error){

                       }
                   })

               } else if (
                   result.dismiss === Swal.DismissReason.cancel
               ) {
                   swalWithBootstrapButtons.fire(
                       'Cancelled',
                       'You have cancelled this action :)',
                       'error'
                   )
               }
           })
       });
   });

</script>

@endsection
