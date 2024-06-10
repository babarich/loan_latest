@extends('layouts.app')
@section('content')

    <!-- Start::row-1 -->
    <div class="row" style="margin-top: 50px">
        <div class="col-xxl-9 col-xl-8">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                 Create a payment
                    </div>
                </div>
                <form method="POST" action="{{route('payment.store')}}" enctype="multipart/form-data">
                    @csrf
                <div class="card-body">
                        <div class="row gy-4 mb-4">
                            <div class="col-xl-12">
                                <label for="job-title" class="form-label">Customer Name</label>
                                <select type="text" class="form-control" id="customerId" placeholder="" name="customer_id">
                                    <option value="">Select..</option>
                                    @foreach($borrowers as $borrow)
                                      <option value="{{$borrow->id}}">{{$borrow->first_name}}{{$borrow->last_name ?? ''}}</option>
                                    @endforeach
                                </select>
                                @error('name')
                                <span class="text-danger"><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                           
                                                    <div class="col-xl-12 mb-3">
                                                        <label for="create-folder1" class="form-label"> Enter Amount</label>
                                                        <input  class="form-control  number-format" type="number" name="amount" id="amount" required
                                                        step=".01">
                                                    </div>
                                                    <div class="col-xl-12 mb-3">
                                                        <label for="create-folder1" class="form-label"> Payment Date</label>
                                                        <input  class="form-control" type="date" name="payment_date" required>
                                                    </div>
                                                    <div class="col-xl-12 mb-3">
                                                        <label for="create-folder1" class="form-label"> Payment Method</label>
                                                        <select class="form-control" name="type" id="paymentMethod" required>
                                                            <option value="">select..</option>
                                                            <option value="Cash">Cash</option>
                                                            <option value="Bank">Bank</option>
                                                            <option value="Cheque">Cheque</option>
                                                            <option value="Mobile Transfer">mobile Transfer</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-xl-12 mb-3" id="bankDiv" style="display: none">
                                                        <label for="create-folder1" class="form-label">Bank Name</label>
                                                        <input class="form-control" name="bank" type="text" />

                                                    </div>
                                                    <div class="col-xl-12 mb-3" id="mobileMoney"  style="display: none">
                                                        <label for="create-folder1" class="form-label">Mobile Money</label>
                                                        <select class="form-control" name="mobile">
                                                            <option value="">select..</option>
                                                            <option value="M-pesa">M-pesa</option>
                                                            <option value="Tigo Pesa">Tigo Pesa</option>
                                                            <option value="Airtel">Airtel Money</option>
                                                            <option value="Halopesa">Halopesa</option>
                                                            <option value="T-Pesa">T-Pesa</option>
                                                            <option value="Azam Pay">Azam Pay</option>
                                                        </select>

                                                    </div>
                                                    <div class="col-xl-12 mb-3" id="referenceDiv" style="display: none">
                                                        <label for="create-folder1" class="form-label">Reference</label>
                                                        <input class="form-control" name="reference" type="text" />

                                                    </div>
                                                    <div class="col-xl-12 mb-3">
                                                        <label for="create-folder1" class="form-label"> Comments</label>
                                                        <textarea  class="form-control" rows="3" name="description"></textarea>
                                                    </div>
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

@section('scripts')
<script>
    $(document).ready(function (){
        $('#paymentMethod').on('change', function (){
            var stat = $(this).val()
            if(stat === 'Bank'){
                $("#bankDiv").show()
                $("#referenceDiv").show()
                $("#mobileMoney").hide()
            }else if(stat === 'Mobile Transfer'){
                $("#bankDiv").hide()
                $("#referenceDiv").show()
                $("#mobileMoney").show()
            }else{
                $("#bankDiv").hide()
                $("#referenceDiv").hide()
                $("#mobileMoney").hide()
            }
        })
$('#customerId').select2({
    class:'form-control',
    placeholder:"Select Customer"
})

    });

</script>


@endsection