<?php

namespace App\Http\Controllers\Collateral;

use App\Http\Controllers\Controller;
use App\Models\Collateral\CollateralType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Inertia\Inertia;

class CollateralTypeController extends Controller
{


    public function index(Request $request)
    {

        $types = CollateralType::query()->get();
        return view('collateralType.index', compact('types'));
    }

    public function create(Request $request)
    {
        return view('collateralType.create');
    }



    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $type = CollateralType::create([
                'name' => $request->filled('name') ? $request->input('name') : null,
                'description' => $request->filled('description') ? $request->input('description') : null,
                'user_id' => Auth::id(),
                'com_id' => Auth::user()->com_id,
                'status' => 'pending',
            ]);

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error_borrow', [$e]);
            return  redirect()->back()->with('error', 'sorry something went wrong cannot create borrower try again');
        }

        return redirect()->route('collateraltype.index')->with('success','You have added successfully a new type');
    }


    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $type = CollateralType::findOrFail($id);
        try {
            DB::beginTransaction();
            $type->update([
                'name' => $request->filled('name') ? $request->input('name') : null,
                'description' => $request->filled('description') ? $request->input('description') : null,
            ]);
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error_borrow', [$e]);
            return  redirect()->back()->with('error', 'sorry something went wrong cannot create borrower try again');
        }

        return redirect()->route('collateraltype.index')->with('success','You have updated successfully your collateral type');
    }

    public function show(Request $request, $id)
    {
        $type = CollateralType::with('user')->findOrFail($id);

        return view('collateralType.view',['type' =>$type]);
    }





    public function edit(Request $request, $id)
    {
         $type = CollateralType::with('user')->findOrFail($id);
        return view('collateralType.edit',['type' => $type]);
    }

}
