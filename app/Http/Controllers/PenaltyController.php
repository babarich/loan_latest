<?php

namespace App\Http\Controllers;

use App\Models\Setting\Penalty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PenaltyController extends Controller
{


    public function index(Request $request)
    {

        $penaltys = Penalty::query()->get();
        return view('settings.penalty.index', compact('penaltys'));
    }

    public function create(Request $request)
    {
        return view('settings.penalty.create');
    }



    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'percent' => 'required',
            'period' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $penalty = Penalty::create([
                'name' => $request->filled('name') ? $request->input('name') : null,
                'percent' => $request->filled('percent') ? $request->input('percent') : null,
                'period' => $request->filled('period') ? $request->input('period') : null,
                'user' => Auth::id(),
                'com_id' => Auth::user()->com_id,
            ]);

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error_interest', [$e]);
            return  redirect()->back()->with('error', 'sorry something went wrong cannot create borrower try again');
        }

        return redirect()->route('penalty.index')->with('success','You have added successfully a new penalty');
    }


    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'period' => 'required',
            'percent' => 'required'
        ]);
        $penalty = Penalty::findOrFail($id);
        try {
            DB::beginTransaction();
            $penalty->update([
                'name' => $request->filled('name') ? $request->input('name') : null,
                'percent' => $request->filled('percent') ? $request->input('name') : null,
                'period' => $request->filled('period') ? $request->input('period') : null,
            ]);
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error_borrow', [$e]);
            return  redirect()->back()->with('error', 'sorry something went wrong cannot create borrower try again');
        }

        return redirect()->route('penalty.index')->with('success','You have updated successfully your collateral type');
    }

    public function show(Request $request, $id)
    {
        $penalty = Penalty::with('user')->findOrFail($id);

        return view('settings.penalty.view',['penalty' =>$penalty]);
    }





    public function edit(Request $request, $id)
    {
        $penalty = Penalty::with('user')->findOrFail($id);
        return view('settings.penalty.edit',['penalty' => $penalty]);
    }


}
