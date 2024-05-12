<?php

namespace App\Http\Controllers\Loan;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoanRequest;
use App\Models\Borrow\Borrower;
use App\Models\Borrow\Guarantor;
use App\Models\Collateral\CollateralType;
use App\Models\Loan\Loan;
use App\Models\Loan\LoanAttachment;
use App\Models\Loan\LoanPayment;
use App\Models\Loan\LoanSchedule;
use App\Models\Loan\PaymentLoan;
use App\Models\Loan\Product;
use App\Services\PayOffService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Str;
use Inertia\Inertia;

class LoanController extends Controller
{




    public function index(Request $request){


        $loans = Loan::query()->where('status', '!=', 'complete')->get();

        return view('loan.index', compact('loans'));
    }



    public function create(Request $request){

             $guarantors = Guarantor::query()
            ->orderBy('updated_at', 'desc')
            ->get();

            $borrowers = Borrower::query()
            ->orderBy('updated_at', 'desc')
            ->get();

            $products = Product::query()
            ->orderBy('updated_at', 'desc')
            ->get();


        return view('loan.create', compact('guarantors','borrowers', 'products'));
   }


   public function checkLoan(Request $request, $id)
   {


       $pendingLoans = LoanSchedule::where('borrower_id', $id)
           ->where('paid', false)
           ->get();
       $found = false;
       if ($pendingLoans->isNotEmpty()){
           $found = true;
        }
       $status = [
          'status' => 'pending',
          'amount' => $pendingLoans->sum('amount'),
          'found' => $found
       ];


       return response()->json(['status' => $status],200);

   }

   public function store(LoanRequest $request){




        $validatedData = $request->validated();

       try {

           $pendingAmount = $request->input('payoff') === 'yes' ? $request->input('pending') : 0 ;
           $principle = $validatedData['principle'] - $pendingAmount;
           $interest = $validatedData['interest'];
           $interest_type = $validatedData['interest_type'];
           $percent = $request->input('percent');
           $amount = $request->input('interest_amount');
           $duration = $request->input('loan_duration');
           $type = $request->input('duration_type');
           $method = $request->input('interest_method');


               DB::beginTransaction();
               $totalInterest = $this->calculateLoan($principle,$interest,$percent,$duration,$type, $method);
               $loan = Loan::create([
                   'reference' => 'LRN'.''.rand(1000,9999),
                   'loan_product' => $validatedData['product'],
                   'borrower_id' => $validatedData['borrower'],
                   'principle_amount' => $principle,
                   'interest_method' => $validatedData['interest'],
                   'interest_type' => $validatedData['interest_type'],
                   'disbursement' => $request->filled('payment') ?  $request->input('payment') : null,
                   'interest_percentage' => $request->filled('percent') ? $request->input('percent') : null,
                   'interest_duration' => $request->filled('interest_method') ? $request->input('interest_method') : null,
                   'loan_duration' => $validatedData['loan_duration'],
                   'duration_type' => $request->filled('duration_type') ? $request->input('duration_type') : null,
                   'payment_cycle' => $request->filled('payment_cycle') ? $request->input('payment_cycle') : null,
                   'payment_number' => $request->filled('number_payments') ? $request->input('number_payments') : null,
                   'loan_release_date' => $request->filled('release_date') ? $request->input('release_date') : null,
                   'interest_amount' => $request->filled('interest_amount') ? $request->input('interest_amount') : null,
                   'guarantor_id' => $validatedData['guarantor'],
                   'user_id' => Auth::id(),
                   'com_id' => Auth::user()->com_id,
                   'status' => 'pending',
                   'stage' => 0,
                   'release_status' => 'pending',
                   'description' => $request->filled('description') ?  $request->input('description') : null,
                   'total_interest' => $totalInterest
               ]);


                   if ($request->input('payoff') === 'yes'){
                       $payment = new PayOffService();
                       $amount = $request->input('pending');
                       $borrowerId = $request->input('borrower_id');
                       $debt = $payment->makePayment($amount, $borrowerId);
                   }

               LoanPayment::create([
                   'loan_id' => $loan->id,
                   'due_amount' => $totalInterest + $principle,
                   'total' => $totalInterest + $principle,
                   'status' => 'pending',
                   'com_id' => Auth::user()->com_id,
               ]);

               $loanDate = $request->input('release_date');
               $paymentCycle = $request->input('payment_cycle');
               $cycle = $request->input('number_payments');
               $singleInterest = $this->singleInterest($principle,$interest_type,$percent,$amount);
               $schedules = $this->calculateRepaymentSchedule($principle,$totalInterest,$duration,$paymentCycle,$cycle,$loanDate, $interest);

               foreach ($schedules as $schedule){
                   LoanSchedule::create([
                       'loan_id' => $loan->id,
                       'borrower_id' => $validatedData['borrower'],
                       'start_date' => $schedule['start_date'],
                       'due_date' => $schedule['due_date'],
                       'principle' => $schedule['repayment_amount'] - $singleInterest,
                       'interest' => $singleInterest,
                       'amount' => $schedule['repayment_amount'],
                       'status' => 'pending',
                       'user_id' => Auth::id(),
                       'paid' => $schedule['paid'],
                       'com_id' => Auth::user()->com_id,
                   ]);
               }


               DB::commit();


       }catch (\Exception $e){
           DB::rollBack();
           Log::info('error', [$e]);
           return  Redirect::back()->with('error', 'sorry something went wrong cannot create loan try again');
       }
       return Redirect::route('loan.index')->with('success','You have added successfully a new loan');
   }


   private function calculateLoan($principle ,$interest, $percent, $duration, $type, $method){


        $totalInterest = 0;
        if($interest === 'flat'){
            $term = $this->convertTerm($duration, $type,$method);
            $totalInterest =  $principle * ($percent/100) * $term;

        }elseif ($interest === 'reducing'){
            $monthlyInterestRate = $percent/100;
            $term = $this->convertTerm($duration, $type,$method);
            $numberOfPayments = 1;
            $totalInterest = $principle * ($monthlyInterestRate / $numberOfPayments) /
                (1 - pow(1 + ($monthlyInterestRate / $numberOfPayments), (-$numberOfPayments * $term)));

        }elseif ($interest === 'interest'){
            $term = $this->convertTerm($duration, $type,$method);
            $totalInterest =  $principle * ($percent/100);
        }else{

                $term = $this->convertTerm($duration, $type,$method);
                $frequency = $this->compoundFrequency($type);
                $ratePerPeriod = ($percent/100) / $frequency;
                $numberOfPeriods = $frequency * $term;
                $totalInterest = $principle * (1 + $ratePerPeriod) ** $numberOfPeriods;

        }

        return $totalInterest;
   }


   private function singleInterest($principle, $interest_type, $percent, $amount){
        $interest = 0;
        if ($interest_type === 'amount'){
           $interest =  $amount;
        }else{
            $interest = $principle * $percent / 100;
        }

        return $interest;
   }

   private function compoundFrequency($type){
        $frequency = 1;
           switch ($type) {
           case 'day':
            return $frequency = 365;
           case 'week':
             return $frequency = 56;
           case 'month':
              return $frequency = 12;
           case 'year':
              return $frequency = 1;
           default:
               return $frequency;
       }

   }

   private function convertTerm($duration, $type, $method)
   {

       switch ($type) {
           case 'day':
               if ($method === 'day'){
                   return $duration;
               }elseif ($method === 'week'){
                   return $duration/7;
               }else{
                   return $duration/30;
               }
           case 'week':
               if ($method === 'day'){
                   return $duration * 7;
               }elseif ($method === 'week'){
                   return $duration;
               }else{
                   return $duration /4;
               }
           case 'month':
               if ($method === 'day'){
                   return $duration * 30;
               }elseif ($method === 'week'){
                   return $duration * 4;
               }else{
                   return $duration;
               }
           case 'year':
               if ($method === 'day'){
                   return $duration * 360;
               }elseif ($method === 'week'){
                   return $duration * 52;
               }else{
                   return $duration * 12;
               }
           default:
               return $duration;
       }
   }
    public function calculateRepaymentSchedule($principle, $interest, $term, $repaymentCycle, $cycleCount, $loanDate, $int)
    {

        $principleAmount = $principle;
        $date = Carbon::parse($loanDate);
        $repaymentSchedule = [];
        $repaymentFrequency = $cycleCount;
        $repaymentAmount = $this->calculateRepaymentAmount($principleAmount, $interest, $term, $int);


        // Generate repayment schedule
        for ($i = 0; $i < $repaymentFrequency; $i++) {
            if ($repaymentCycle === 'week'){
                $dueDate = $date->addDays(7)->format('Y-m-d');
                $startDate = Carbon::parse($dueDate)->subDays(7)->format('Y-m-d');
            }elseif ($repaymentCycle === 'day'){
                $dueDate = $date->addDays(1)->format('Y-m-d');
                $startDate = Carbon::parse($dueDate)->subDays(1)->format('Y-m-d');
            }else{
                $dueDate = $date->addDays(30)->format('Y-m-d');
                $startDate = Carbon::parse($dueDate)->subDays(30)->format('Y-m-d');
            }

            $repaymentSchedule[] = [
                'principle' => $principle,
                'due_date' => $dueDate,
                'start_date' => $startDate,
                'repayment_amount' => $repaymentAmount,
                'paid' => false,
            ];
        }

        return $repaymentSchedule;
    }

    private function calculateRepaymentAmount($principleAmount, $interest, $term, $int)
    {
        $repaymentAmount = 0;

        if($int === 'reducing'){
            $value1 = $interest * pow((1 + $interest), $term);
            $value2 = pow((1 + $interest), $term) - 1;
            $repaymentAmount    = $principleAmount * ($value1 / $value2);
        }else{
            $totalRepayment = $principleAmount + $interest;
            $repaymentAmount = $totalRepayment / $term;
        }


        return $repaymentAmount;
    }



    public function show(Request $request, $id){
        $types = CollateralType::query()->get();
        $loan = Loan::with(['schedules','user', 'borrower','guarantor','product', 'loanpayment','agreements',
            'collaterals', 'files','comments','cycles', 'payments'])->findOrFail($id);
        return view('loan.view',['loan' =>$loan, 'types' => $types]);
    }


    public function showSettlement(Request $request, $id){
        $types = CollateralType::query()->get();
        $totalInterest = LoanSchedule::query()->where('loan_id', $id)->whereDate('due_date', '<', Carbon::now())
            ->sum('interest');

        $totalPrinciple = LoanSchedule::query()->where('loan_id', $id)
            ->sum('principle');

        $loan = Loan::with(['schedules','user', 'borrower','guarantor','product', 'loanpayment','agreements',
            'collaterals', 'files','comments','cycles', 'payments'])->findOrFail($id);
        return view('loan.view_settlement',['loan' =>$loan, 'types' => $types,
            'totalInterest' => $totalInterest, 'totalPrinciple' => $totalPrinciple]);
    }


    public function showRollover(Request $request, $id){
        $types = CollateralType::query()->get();

        $schedule = LoanSchedule::query()->where('loan_id', $id)
            ->where('interest_paid', '<=', 0)
            ->orderBy('due_date', 'asc')
            ->first();

        $loan = Loan::with(['schedules','user', 'borrower','guarantor','product', 'loanpayment','agreements',
            'collaterals', 'files','comments','cycles', 'payments'])->findOrFail($id);
        return view('loan.view_rollover',['loan' =>$loan, 'types' => $types, 'schedule' => $schedule]);
    }


    public function attachment(Request $request, $loanId)
    {

     $validatedData= $request->validate([
            'filename' => 'required',
            'file' => 'required'
        ]);

        try {
           DB::beginTransaction();
            $attach = $request->file('file');
            $filename = $attach->getClientOriginalName();
            $filesize = $attach->getSize();
            $path = $attach->store('file');
           LoanAttachment::create([
               'loan_id' => $loanId,
               'name' => $validatedData['filename'],
               'filename' => $request->input('filename'),
               'file' => $filename,
               'attachment' => $path,
               'attachment_size' => $filesize,
               'uploaded_by' => Auth::id(),
               'com_id' => Auth::user()->com_id,
               'type' => 'agreement'
           ]);

           DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error', [$e]);
            return  Redirect::back()->with('error', 'sorry something went wrong cannot create loan try again');
        }
        return Redirect::back()->with('success','You have added successfully a new agreement file');
    }


    private function saveImage($image)
    {
        // Check if image is valid base64 string
        if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
            // Take out the base64 encoded text without mime type
            $image = substr($image, strpos($image, ',') + 1);
            // Get file extension
            $type = strtolower($type[1]); // jpg, png, gif

            // Check if file is an image
            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                throw new \Exception('invalid image type');
            }
            $image = str_replace(' ', '+', $image);
            $image = base64_decode($image);

            if ($image === false) {
                throw new \Exception('base64_decode failed');
            }
        } else {
            throw new \Exception('did not match data URI with image data');
        }

        $dir = 'images/';
        $file = Str::random() . '.' . $type;
        $absolutePath = public_path($dir);
        $relativePath = $dir . $file;
        if (!File::exists($absolutePath)) {
            File::makeDirectory($absolutePath, 0755, true);
        }
        file_put_contents($relativePath, $image);

        return $relativePath;
    }


    public function edit(Request $request, $id)
    {


        $loan = Loan::findOrFail($id);

        return view('loan.edit',[
            'guarantors' => Guarantor::query()
                ->orderBy('updated_at', 'desc')
                ->get(),
            'borrowers' => Borrower::query()
                ->orderBy('updated_at', 'desc')
                ->get(),

            'products' => Product::query()
                ->orderBy('updated_at', 'desc')
                ->get(),
            'loan' => $loan
        ]);
    }

    public function distributeLoanPayment(Request $request, $loanId) {
         $validatedData =  $request->validate([
             'amount' => 'required',
             'type' => 'required',
             'date' => 'required',
             'schedule' => 'required'
         ]);


        $loanSchedules = LoanSchedule::findOrFail($validatedData['schedule']);
        try {
            DB::beginTransaction();
            if ($loanSchedules){
                $paymentAmount = $validatedData['amount'];
                $due = 0;

                $payment = LoanPayment::query()->where('loan_id', $loanId)->first();

                $remainingAmountDue = $loanSchedules->interest + $loanSchedules->principle;

                if ($paymentAmount >= $remainingAmountDue && $remainingAmountDue > 0) {
                    $loanSchedules->paid = true;
                    $loanSchedules->status = 'completed';
                    $paidInterest = min($paymentAmount, $loanSchedules->interest);
                    $loanSchedules->interest_paid = $paidInterest;
                    $loanSchedules->interest -= $paidInterest;
                    $paymentAmount -= $paidInterest;
                    $paidPrincipal = min($paymentAmount, $loanSchedules->principle);
                    $loanSchedules->principal_paid = $paidPrincipal;
                    $loanSchedules->principle -= $paidPrincipal;
                    $paymentAmount -= $paidPrincipal;
                    $loanSchedules->amount -= $paidPrincipal + $paidInterest;
                    $loanSchedules->save();
                    $total = $payment->paid_amount + $validatedData['amount'];
                    if ($payment->due_Amount > 0 && $payment->due_amount > $validatedData['amount']){
                        $due = $payment->due_amount - $validatedData['amount'];
                    }else{
                        $due = 0;
                    }
                    $payment->update(['paid_amount' => $total, 'due_amount' => $due]);
                } else if ($paymentAmount < $remainingAmountDue && $remainingAmountDue > 0) {
                    $paidInterest = min($paymentAmount, $loanSchedules->interest);
                    $loanSchedules->interest_paid = $paidInterest;
                    $loanSchedules->interest -= $paidInterest;
                    $paymentAmount -= $paidInterest;
                    // Paying principal
                    $principalToPay = min($paymentAmount, $loanSchedules->principle);
                    $loanSchedules->principal_paid = $principalToPay;
                    $paymentAmount -= $principalToPay;
                    $loanSchedules->principle -= $principalToPay;

                    // Update schedule properties
                    $loanSchedules->paid = false;
                    $loanSchedules->status = 'partial';
                    $loanSchedules->amount -= ($loanSchedules->interest_paid + $loanSchedules->principal_paid);
                    $loanSchedules->save();

                    // Update payment properties
                    $totalPaid = $payment->paid_amount + $validatedData['amount'];
                    $dueAmount = max(0, $payment->due_amount - $validatedData['amount']);
                    $payment->update(['paid_amount' => $totalPaid, 'due_amount' => $dueAmount]);
                }





                PaymentLoan::create([
                    'loan_id' => $loanId,
                    'borrower_id' => $loanSchedules->borrower_id,
                    'description' => $request->filled('description') ? $request->input('description') : null,
                    'payment_date' => $validatedData['date'],
                    'amount' => $validatedData['amount'],
                    'type' => $validatedData['type'],
                    'bank' => $request->filled('bank') ? $request->input('bank') : null,
                    'mobile' => $request->filled('mobile') ? $request->input('mobile') : null,
                    'reference' => $request->filled('reference') ? $request->input('reference') : null,
                    'user_id' => Auth::id(),
                    'com_id' => Auth::user()->com_id,
                ]);
            }


            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error_payment', [$e]);
            return  Redirect::back()->with('error', 'sorry something went wrong cannot create loan try again');
        }

        return Redirect::route('loan.show', $loanId)->with('success','You have added successfully a payment');
    }


    public function report(Request $request)
    {
        try {
            DB::beginTransaction();
            $loans = Loan::all();
            $pdf =  Pdf::loadView('loan_report', compact('loans'));
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error_report', [$e]);
        }
        return $pdf->stream('Loan.pdf',[
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="loan_report.pdf"'
        ]);
    }



    public function exportExcel(Request $request)
    {

    }

    public function submitLoan(Request $request, $id)
    {

        $loan = Loan::findOrFail($id);
        try {
            $loan->update(['stage' => 1]);
        }catch (\Exception $e){
            Log::info('error_loan', [$e]);
            return  redirect()->back()->with('error', 'sorry something went wrong cannot create loan try again');
        }

        return redirect()->route('loan.index')->with('success','You have submitted  successfully a loan');
    }


    public function settlement(Request $request){


        $loans = Loan::query()->where('status', '!=', 'complete')
            ->where('release_status', 'approved')
            ->get();

        return view('loan.settlement', compact('loans'));
    }


    public function rollover(Request $request){


        $loans = Loan::query()->where('status', '!=', 'complete')
            ->where('release_status', 'approved')
            ->get();

        return view('loan.rollover', compact('loans'));
    }


    public function closed(Request $request){


        $loans = Loan::query()->where('status', '=', 'complete')
            ->where('release_status', 'approved')
            ->get();

        return view('loan.closed', compact('loans'));
    }


    public function settlePayment(Request $request, $loanId) {
        $validatedData =  $request->validate([
            'amount' => 'required',
            'type' => 'required',
            'date' => 'required',

        ]);
        $schedules = LoanSchedule::query()->where('loan_id', '=', $loanId)->get();
        try {
            DB::beginTransaction();
            if ($schedules){
                $paymentAmount = $validatedData['amount'];
                $due = 0;
                $payment = LoanPayment::query()->where('loan_id', $loanId)->first();
                foreach ($schedules as $schedule){
                    $remainingAmountDue = $schedule->interest + $schedule->principle;
                        $schedule->paid = true;
                        $schedule->status = 'completed';
                        $paidInterest = $schedule->interest;
                        $schedule->interest_paid = $paidInterest;
                        $schedule->interest -= $paidInterest;
                        $paymentAmount -= $paidInterest;
                        $paidPrincipal = $schedule->principle;
                         $schedule->principal_paid = $paidPrincipal;
                          $schedule->principle -= $paidPrincipal;
                         $paymentAmount -= $paidPrincipal;
                         $schedule->amount -= $paidPrincipal + $paidInterest;
                         $schedule->save();
                        $total = $payment->paid_amount + $validatedData['amount'];
                        if ($payment->due_Amount > 0 && $payment->due_amount > $validatedData['amount']){
                            $due = $payment->due_amount - $validatedData['amount'];
                        }else{
                            $due = 0;
                        }
                        $payment->update(['paid_amount' => $total, 'due_amount' => $due]);


                }

                $loan = Loan::query()->find($loanId);
                PaymentLoan::create([
                    'loan_id' => $loanId,
                    'borrower_id' => $loan->borrower_id,
                    'description' => $request->filled('description') ? $request->input('description') : null,
                    'payment_date' => $validatedData['date'],
                    'amount' => $validatedData['amount'],
                    'type' => $validatedData['type'],
                    'bank' => $request->filled('bank') ? $request->input('bank') : null,
                    'mobile' => $request->filled('mobile') ? $request->input('mobile') : null,
                    'reference' => $request->filled('reference') ? $request->input('reference') : null,
                    'user_id' => Auth::id(),
                    'com_id' => Auth::user()->com_id,
                ]);



                $loan->update(['status' => 'completed']);

            }

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error_payment', [$e]);
            return  Redirect::back()->with('error', 'sorry something went wrong cannot create loan try again');
        }

        return Redirect::route('loan.settlement')->with('success','You have added successfully a payment');
    }


    public  function rolloverPayment(Request $request, $loanId)
    {
        $validatedData =  $request->validate([
            'amount' => 'required',
            'type' => 'required',
            'date' => 'required',

        ]);
        $schedules = LoanSchedule::query()->where('loan_id', '=', $loanId)->get();
        try {
            DB::beginTransaction();
            if ($schedules){
                $paymentAmount = $validatedData['amount'];
                $due = 0;
                $payment = LoanPayment::query()->where('loan_id', $loanId)->first();
                foreach ($schedules as $schedule){
                    $remainingAmountDue = $schedule->interest + $schedule->principle;
                    $schedule->paid = true;
                    $schedule->status = 'completed';
                    $paidInterest = $schedule->interest;
                    $schedule->interest_paid = $paidInterest;
                    $schedule->interest -= $paidInterest;
                    $paymentAmount -= $paidInterest;
                    $paidPrincipal = $schedule->principle;
                    $schedule->principal_paid = $paidPrincipal;
                    $schedule->principle -= $paidPrincipal;
                    $paymentAmount -= $paidPrincipal;
                    $schedule->amount -= $paidPrincipal + $paidInterest;
                    $schedule->save();
                    $total = $payment->paid_amount + $validatedData['amount'];
                    if ($payment->due_Amount > 0 && $payment->due_amount > $validatedData['amount']){
                        $due = $payment->due_amount - $validatedData['amount'];
                    }else{
                        $due = 0;
                    }
                    $payment->update(['paid_amount' => $total, 'due_amount' => $due]);


                }

                $loan = Loan::query()->find($loanId);
                PaymentLoan::create([
                    'loan_id' => $loanId,
                    'borrower_id' => $loan->borrower_id,
                    'description' => $request->filled('description') ? $request->input('description') : null,
                    'payment_date' => $validatedData['date'],
                    'amount' => $validatedData['amount'],
                    'type' => $validatedData['type'],
                    'bank' => $request->filled('bank') ? $request->input('bank') : null,
                    'mobile' => $request->filled('mobile') ? $request->input('mobile') : null,
                    'reference' => $request->filled('reference') ? $request->input('reference') : null,
                    'user_id' => Auth::id(),
                    'com_id' => Auth::user()->com_id,
                ]);



                $loan->update(['status' => 'completed']);

            }

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error_payment', [$e]);
            return  Redirect::back()->with('error', 'sorry something went wrong cannot create loan try again');
        }

        return Redirect::route('loan.settlement')->with('success','You have added successfully a payment');
    }

}
