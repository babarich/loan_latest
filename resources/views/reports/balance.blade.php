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
                    <div class="card-title">Balance Sheet As of {{ \Carbon\Carbon::now()->format('Y-m-d') }} </div>
                </div>
                <div class="card-body">
               
            
    <!-- Assets -->
    <h5>Assets</h5>
    <table>
        <thead>
            <tr>
                <th>Account</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assets as $asset)
            <tr>
                <td>{{ $asset->name }}</td>
                <td>{{ number_format($asset->balance, 2) }}</td>
            </tr>
            @endforeach
            <tr>
                <th>Total Assets</th>
                <th>{{ number_format($totalAssets, 2) }}</th>
            </tr>
        </tbody>
    </table>

    <!-- Liabilities -->
    <h5>Liabilities</h5>
    <table>
        <thead>
            <tr>
                <th>Account</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($liabilities as $liability)
            <tr>
                <td>{{ $liability->name }}</td>
                <td>{{ number_format($liability->balance, 2) }}</td>
            </tr>
            @endforeach
            <tr>
                <th>Total Liabilities</th>
                <th>{{ number_format($totalLiabilities, 2) }}</th>
            </tr>
        </tbody>
    </table>

    <!-- Equity -->
    <h5>Equity</h5>
    <table>
        <thead>
            <tr>
                <th>Account</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($equity as $eq)
            <tr>
                <td>{{ $eq->name }}</td>
                <td>{{ number_format($eq->balance, 2) }}</td>
            </tr>
            @endforeach
            <tr>
                <th>Total Equity</th>
                <th>{{ number_format($totalEquity, 2) }}</th>
            </tr>
        </tbody>
    </table>

    <!-- Balance Check -->
    <h3>Balance Check</h3>
    <p>
        Total Assets = Total Liabilities + Total Equity<br>
        {{ number_format($totalAssets, 2) }} = {{ number_format($totalLiabilities + $totalEquity, 2) }}
    </p>
                </div>
                            </div>
                        </div>
  




@endsection

@section('scripts')


@endsection
