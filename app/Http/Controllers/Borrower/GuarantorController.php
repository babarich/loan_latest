<?php

namespace App\Http\Controllers\Borrower;

use App\Http\Controllers\Controller;
use App\Models\Borrow\Borrower;
use App\Models\Borrow\Guarantor;
use App\Models\Borrow\GuarantorAttachment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Str;
use Inertia\Inertia;
use function Pest\Laravel\get;

class GuarantorController extends Controller
{


    public function index(Request $request)
    {
        $guarantors = Guarantor::query()->orderBy('updated_at', 'desc')->get();
        return  view('guarantors.index', compact('guarantors'));
    }

    public function create(Request $request)
    {
        return view('guarantors.create');
    }



    public function store(Request $request)
    {

        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'mobile' => 'required',
        ]);
        $relativePath = '';
        try {
            DB::beginTransaction();

            $guarantor = Guarantor::create([
                'reference' => 'GAN'.rand(1000,9999),
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
                'description' => $request->filled('description') ? $request->input('description') : null,
            ]);

            if($request->hasFile('customer_file')){
                foreach ($request->file('customer_file') as $attach){
                    $filename = $attach->getClientOriginalName();
                    $filesize = $attach->getSize();
                    $path = $attach->store('file');
                    GuarantorAttachment::create([
                        'guarantor_id' => $guarantor->id,
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
            return  redirect()->back()->with('error', 'sorry something went wrong cannot create guarantor try again');
        }

        return redirect()->route('guarantor.index')->with('success','You have added successfully a new guarantor');
    }


    public function update(Request $request, $id)
    {

        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);
        $guarantor = Guarantor::findOrFail($id);

        try {
            DB::beginTransaction();

            $guarantor->update([
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
                'description' => $request->filled('description') ? $request->input('description') : null,
            ]);

            if($request->hasFile('customer_file')){
                foreach ($request->file('customer_file') as $attach){
                    $filename = $attach->getClientOriginalName();
                    $filesize = $attach->getSize();
                    $path = $attach->store('file');
                    GuarantorAttachment::create([
                        'guarantor_id' => $guarantor->id,
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
            return  redirect()->back()->with('error', 'sorry something went wrong cannot create guarantor try again');
        }

        return redirect()->route('guarantor.index')->with('success','You have updated successfully your guarantor');
    }

    public function show(Request $request, $id)
    {
        $guarantor = Guarantor::with(['attachments','user'])->findOrFail($id);
        return view('guarantors.view',compact('guarantor'));
    }





    public function edit(Request $request, $id)
    {
        $guarantor = Guarantor::with(['attachments','user'])->findOrFail($id);
        return view('guarantors.edit', compact('guarantor'));
    }

    public function downloadAttachment(Request $request, $id){

        $file = GuarantorAttachment::findOrFail($id);
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


    public function borrower(Request $request, $id){

        try {
            DB::beginTransaction();
            $borrow = Guarantor::findOrFail($id);
            Borrower::create([
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
                'id_number' => $borrow->id_number ?? null,
                'identity' => $borrow->identity ?? null,
                'com_id' => Auth::user()->com_id,
            ]);



            DB::commit();
        }catch (\Exception $e){
            Log::info('error_borrow', [$e]);
            return  Redirect::back()->with('error', 'sorry something went wrong cannot create guarantor try again');
        }

        return Redirect::route('guarantor.index')->with('success','You have updated successfully reassign borrower');
    }

}
