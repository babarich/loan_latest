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
        <form action="{{route('report.exportGender')}}" method="GET">
        <div class="row">
            <div class="col-md-3">
                <select name="quarter" class="form-select">
                    <option value="1">Q1</option>
                    <option value="2">Q2</option>
                    <option value="3">Q3</option>
                    <option value="4">Q4</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" name="year" class="form-control" value="{{ date('Y') }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Export Excel</button>
            </div>
        </div>
    </form>
            
</div>
            
  




@endsection

