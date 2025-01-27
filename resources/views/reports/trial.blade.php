@extends('layouts.app')
@section('content')
<style>
    
    
    h1, h2 {
      text-align: center;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    table th, table td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    table th {
      background-color: #f4f4f4;
    }
    .totals {
      font-weight: bold;
      text-align: right;
    }
</style>
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
                    <div class="card-title">Trial Balance</div>
                </div>
                <div class="card-body">
                <table>
                        <tr>
                            <th>Account</th>
                            <th>Debit</th>
                            <th>Credit</th>
                        </tr>
                        @foreach ($trialBalance as $row)
                            <tr>
                                <td>{{ $row['account_name'] }}</td>
                                <td>{{ number_format($row['debit'], 2) }}</td>
                                <td>{{ number_format($row['credit'], 2) }}</td>
                            </tr>
                        @endforeach
                       
                           <tr>
                            <td>Total</td>
                            <td>{{ number_format($totals['debit'], 2) }}</td>
                            <td>{{ number_format($totals['credit'], 2) }}</td>
                        </tr>
                    </table>
                    </div>
                    
                                </div>
                            </div>
  




@endsection

@section('scripts')


@endsection
