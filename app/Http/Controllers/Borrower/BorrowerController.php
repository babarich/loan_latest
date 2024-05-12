<?php

namespace App\Http\Controllers\Borrower;

use App\Http\Controllers\Controller;
use App\Models\Borrow\Borrower;
use App\Models\Borrow\BorrowerAttachment;
use App\Models\Borrow\Guarantor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;

class BorrowerController extends Controller
{



   public function index(Request $request)
   {


       $customers =  Borrower::query()->orderBy('updated_at', 'desc')->get();

       return view('customers.index', compact('customers'));
   }

    public function create(Request $request)
    {


        $groups = \App\Models\Borrow\BorrowerGroup::query()->select('id', 'name')->get();
       return view('customers.create', compact('groups'));
    }



    public function store(Request $request)
    {



        $data = $request->validate([
            'mobile' =>'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'id_number'=>'required',
        ]);

        try {
            DB::beginTransaction();

            $borrow = Borrower::create([
                'reference' => 'BRW'.rand(1000,9999),
                'first_name' => $request->filled('first_name') ? $request->input('first_name') : null,
                'last_name' => $request->filled('last_name') ? $request->input('last_name') : null,
                'gender' => $request->filled('gender') ? $request->input('gender') : null,
                'title' => $request->filled('title') ? $request->input('title') : null,
                'mobile' => $request->filled('mobile') ? $request->input('mobile') : null,
                'email' => $request->filled('email') ? $request->input('email') : null,
                'date_birth' => $request->filled('birth') ? $request->input('birth') : null,
                'address' => $request->filled('address') ? $request->input('address') : null,
                'city' => $request->filled('city') ? $request->input('city') : null,
                'working_status' => $request->filled('working') ? $request->input('working') : null,
                'business_name' => $request->filled('business') ? $request->input('business') : null,
                'filename' =>  $request->hasFile('photo') ? $request->file('photo')->getClientOriginalName(): null,
                'group_id' =>$request->filled('groupId') ? $request->input('groupId') : null,
                'attachment_size' => $request->hasFile('photo') ? $request->file('photo')->getSize() : null,
                'attachment' => $request->hasFile('photo') ? $request->file('photo')->store('attachments') : null,
                'uploaded_by' => Auth::id(),
                'status' => 'pending',
                'com_id' => Auth::user()->com_id,
                'description' => $request->filled('comments') ? $request->input('comments') : null,
                'id_number' => $request->filled('id_number') ? $request->input('id_number') : null,
                'identity' => $request->filled('identity') ? $request->input('identity') : null,
            ]);

            if($request->hasFile('customer_files')){
                foreach ($request->file('customer_files') as $attach){
                    $filename = $attach->getClientOriginalName();
                    $filesize = $attach->getSize();
                    $path = $attach->store('customer_files');
                    BorrowerAttachment::create([
                        'borrower_id' => $borrow->id,
                        'filename' => $filename,
                        'attachment_size' => $filesize,
                        'attachment' => $path,
                        'uploaded_by' => Auth::id()
                    ]);
                }

            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error_borrow', [$e]);
            return  redirect()->back()->with('error', 'sorry something went wrong cannot create borrower try again');
        }

        return redirect()->route('borrow.index')->with('success','You have added successfully a new borrower');
    }


    public function update(Request $request, $id)
    {

        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required',
        ]);
        $borrow = Borrower::findOrFail($id);

        try {
            DB::beginTransaction();

            $borrow->update([
                'first_name' => $request->filled('first_name') ? $request->input('first_name') : null,
                'last_name' => $request->filled('last_name') ? $request->input('last_name') : null,
                'gender' => $request->filled('gender') ? $request->input('gender') : null,
                'title' => $request->filled('title') ? $request->input('title') : null,
                'mobile' => $request->filled('mobile') ? $request->input('mobile') : null,
                'email' => $request->filled('email') ? $request->input('email') : null,
                'date_birth' => $request->filled('birth') ? Carbon::parse($request->input('birth'))->format('Y-m-d')  : null,
                'address' => $request->filled('address') ? $request->input('address') : null,
                'city' => $request->filled('city') ? $request->input('city') : null,
                'working_status' => $request->filled('working') ? $request->input('working') : null,
                'business_name' => $request->filled('business') ? $request->input('business') : null,
                'filename' =>  $request->hasFile('photo') ? $request->file('photo')->getClientOriginalName(): null,
                'group_id' =>$request->filled('groupId') ? $request->input('groupId') : null,
                'attachment_size' => $request->hasFile('photo') ? $request->file('photo')->getSize() : null,
                'attachment' => $request->hasFile('photo') ? $request->file('photo')->store('attachments') : null,
                'description' => $request->filled('comments') ? $request->input('comments') : null,
                'id_number' => $request->filled('id_number') ? $request->input('id_number') : null,
                'identity' => $request->filled('identity') ? $request->input('identity') : null,


            ]);

            if($request->hasFile('customer_files')){
                foreach ($request->file('customer_files') as $attach){
                    $filename = $attach->getClientOriginalName();
                    $filesize = $attach->getSize();
                    $path = $attach->store('file');
                    BorrowerAttachment::create([
                        'borrower_id' => $borrow->id,
                        'filename' => $filename,
                        'attachment_size' => $filesize,
                        'attachment' => $path,
                        'uploaded_by' => Auth::id()
                    ]);
                }

            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error_borrow', [$e]);
            return  Redirect::back()->with('error', 'sorry something went wrong cannot create borrower try again');
        }

        return Redirect::route('borrow.index')->with('success','You have updated successfully your borrower');
    }

    public function show(Request $request, $id)
    {
        $borrow = Borrower::with(['attachments','payments', 'loans'])->findOrFail($id);

        return view('customers.view', compact('borrow'));
    }





    public function edit(Request $request, $id)
    {
        $borrow = Borrower::with(['attachments','user'])->findOrFail($id);

        $groups = \App\Models\Borrow\BorrowerGroup::query()->select('id', 'name')->get();
        return view('customers.edit', compact('borrow', 'groups'));
    }

    public function downloadAttachment(Request $request, $id){

       $file = BorrowerAttachment::findOrFail($id);
       $filePath = storage_path('app/'. $file->attachment);

       return response()->download($filePath, $file->filename);
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


    public function reassign(Request $request, $id)
    {
        $validatedData = $request->validate([
            'groupId' => 'required',
        ]);
        $borrow = Borrower::findOrFail($id);
        try {
            $borrow->update(['group_id' => $request->input('groupId')]);
        }catch (\Exception $e){
            Log::info('error_borrow', [$e]);
            return  Redirect::back()->with('error', 'sorry something went wrong cannot create borrower try again');
        }

        return Redirect::route('borrow.show', $id)->with('success','You have updated successfully reassign group to your borrower');
    }

    public function guarantor(Request $request, $id){

        try {
            DB::beginTransaction();
            $borrow = Borrower::findOrFail($id);

            Guarantor::create([
                'reference' => 'GAN'.rand(1000,9999),
                'first_name' => $borrow->first_name ?? null,
                'last_name' => $borrow->last_name ?? null,
                'gender' => $borrow->gender ?? null,
                'title' => $borrow->title ?? null,
                'mobile' => $borrow->mobile ?? null,
                'email' => $borrow->email ?? null,
                'date_birth' => $borrow->birth ?? null,
                'address' => $borrow->address ?? null,
                'city' => $borrow->city ?? null,
                'working_status' => $borrow->working_status ?? null,
                'business_name' => $borrow->business_name ?? null,
                'filename' =>  $borrow->filename ?? null,
                'attachment_size' => null,
                'attachment' => $borrow->attachment ?? null,
                'uploaded_by' => Auth::id(),
                'status' => 'pending',
                'description' => $borrow->description ?? null,
            ]);



            DB::commit();
        }catch (\Exception $e){
            Log::info('error_borrow', [$e]);
            return  Redirect::back()->with('error', 'sorry something went wrong cannot create guarantor try again');
        }

        return Redirect::route('guarantor.index')->with('success','You have updated successfully reassign borrower');
    }
}
