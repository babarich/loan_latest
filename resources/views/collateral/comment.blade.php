
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
                    <div class="card-title">Comments List</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="file-export" class="table table-bordered text-nowrap w-100 dataTable no-footer">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>Reference</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Commented By</th>
                                <th>Comment </th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$comment->loan->reference ?? ''}}</td>
                                    <td>{{$comment->loan->borrower->first_name . ' ' . $comment->loan->borrower->last_name ?? null}}</td>
                                    <td>{{\Carbon\Carbon::parse($comment->created_at)->format('Y-m-d')}}</td>
                                    <td>{{$comment->user->name ?? null}}</td>.
                                    <td>{{$comment->description}}</td>
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
