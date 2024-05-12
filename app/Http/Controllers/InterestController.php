<?php

namespace App\Http\Controllers;

use App\Models\Setting\InterestPercent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InterestController extends Controller
{
    public function index(Request $request)
    {

        $interests = InterestPercent::query()->get();
        return view('settings.interest.index', compact('interests'));
    }

    public function create(Request $request)
    {
        return view('settings.interest.create');
    }



    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'percent' => 'required',

        ]);

        try {
            DB::beginTransaction();

            $type = InterestPercent::create([
                'name' => $request->filled('name') ? $request->input('name') : null,
                'percent' => $request->filled('percent') ? $request->input('percent') : null,
                'user_id' => Auth::id(),
                'com_id' => Auth::user()->com_id,
                'status' => 'pending',
            ]);

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error_interest', [$e]);
            return  redirect()->back()->with('error', 'sorry something went wrong cannot create borrower try again');
        }

        return redirect()->route('interest.index')->with('success','You have added successfully a new interest');
    }


    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'percent' => 'required'
        ]);
        $type = InterestPercent::findOrFail($id);
        try {
            DB::beginTransaction();
            $type->update([
                'name' => $request->filled('name') ? $request->input('name') : null,
                'percent' => $request->filled('percent') ? $request->input('name') : null,

            ]);
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error_borrow', [$e]);
            return  redirect()->back()->with('error', 'sorry something went wrong cannot create borrower try again');
        }

        return redirect()->route('interest.index')->with('success','You have updated successfully your collateral type');
    }

    public function show(Request $request, $id)
    {
        $interest = InterestPercent::with('user')->findOrFail($id);

        return view('settings.interest.view',['interest' =>$interest]);
    }





    public function edit(Request $request, $id)
    {
        $interest = InterestPercent::with('user')->findOrFail($id);
        return view('settings.interest.edit',['interest' => $interest]);
    }
}
