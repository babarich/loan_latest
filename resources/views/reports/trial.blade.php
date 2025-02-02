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
             <form action="{{ route('coa.trial') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <label for="from_date">From Date</label>
                <input type="date" name="from_date" id="from_date" class="form-control" value="{{ $fromDate }}">
            </div>
            <div class="col-md-3">
                <label for="to_date">To Date</label>
                <input type="date" name="to_date" id="to_date" class="form-control" value="{{ $toDate }}">
            </div>
            <div class="col-md-3 align-self-end">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>
            <div class="card custom-card">
    <div class="card-header d-md-flex d-block">
        <div class="h5 mb-0 d-sm-flex d-block align-items-center">
            <div class="ms-sm-2 ms-0 mt-sm-0 mt-2">
                <div class="h6 fw-semibold mb-0">
                    Trial Balance As of <span class="text-primary">{{ \Carbon\Carbon::now()->format('Y-m-d') }}</span>
                </div>
            </div>
        </div>
        <div class="ms-auto mt-md-0 mt-2">
           <button class="btn btn-sm btn-secondary me-1" id="printButton">Print <i class="ri-printer-line ms-1 align-middle d-inline-block"></i></button>
            <button class="btn btn-sm btn-primary" id="saveAsPdf">Save As PDF <i class="ri-file-pdf-line ms-1 align-middle d-inline-block"></i></button>
        </div>
    </div>
    <div class="card-body" id="printableArea">
        <div class="row gy-3">
            <div class="col-xl-12">
                <h3 class="text-center">{{ $company->name }}</h3>
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6">
                        <p class="text-muted mb-2">Company Details:</p>
                        <p class="mb-1 text-muted">Address: {{ $company->address }}</p>
                        <p class="mb-1 text-muted">Email: {{ $company->email }}</p>
                        <p class="mb-1 text-muted">Phone: {{ $company->phone_number }}</p>
                        <p class="mb-1 text-muted">Website: {{ $company->website }}</p>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 ms-auto mt-sm-0 mt-3">
                        <div class="text-end">
                            @if($company->photo)
                                <img src="{{ Storage::url($company->photo) }}" alt="Company Photo" class="img-fluid rounded" width="100">
                            @else
                                <p>No photo available.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <hr style="border: 4px solid #50C878;">

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script>
    $(document).ready(function () {
        // Save as PDF
        document.getElementById('saveAsPdf').addEventListener('click', function () {
            // Initialize jsPDF correctly for the UMD version
            const { jsPDF } = window.jspdf || {}; 
            const doc = new jsPDF('p', 'mm', 'a4'); // Portrait mode, A4 size

            // Capture the content
            const content = document.querySelector('.card-body');

            html2canvas(content).then((canvas) => {
                const imgData = canvas.toDataURL('image/png');
                const imgWidth = 210; // A4 width in mm
                const imgHeight = (canvas.height * imgWidth) / canvas.width;

                // Add image to PDF
                doc.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
                doc.save('TrialBalance.pdf');
            });
        });
    

        // Print functionality
        function printDiv(divID) {
            // Get the HTML of the div
            var divElements = document.getElementById(divID).innerHTML;
            // Get the HTML of the whole page
            var oldPage = document.body.innerHTML;

            // Reset the page's HTML with the div's HTML only
            document.body.innerHTML =
                '<html><head><title></title></head><body>' +
                divElements + '</body>';

            // Print the page
            window.print();

            // Restore the original HTML
            document.body.innerHTML = oldPage;
        }

        // Attach the print function to a button (if needed)
        document.getElementById('printButton').addEventListener('click', function () {
            printDiv('printableArea'); // Replace 'printableArea' with the ID of the div you want to print
        });
    });
</script>

@endsection
