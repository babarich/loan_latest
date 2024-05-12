<?php

namespace App\Http\Controllers\Borrower;

use App\Http\Controllers\Controller;
use App\Models\Borrow\BorrowerAttachment;
use App\Models\Borrow\RelationOfficer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Inertia\Inertia;

class BorrowerGroup extends Controller
{



    public function index(Request $request)
    {

        $groups = \App\Models\Borrow\BorrowerGroup::query()->orderBy('updated_at', 'desc')->with('borrowers')->get();

        return view('group.index', compact('groups'));
    }

    public function create(Request $request)
    {
        return view('group.create');
    }



    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $borrow = \App\Models\Borrow\BorrowerGroup::create([
                'reference' => 'BRG'.rand(1000,9999),
                'name' => $request->filled('name') ? $request->input('name') : null,
                'description' => $request->filled('description') ? $request->input('description') : null,
                'com_id' => Auth::user()->com_id,
                'user_id' => Auth::id(),
                'status' => 'pending',
            ]);

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error_borrow', [$e]);
            return  redirect()->back()->with('error', 'sorry something went wrong cannot create borrower try again');
        }

        return redirect()->route('group.index')->with('success','You have added successfully a new group');
    }


    public function update(Request $request, $id)
    {

        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $group = \App\Models\Borrow\BorrowerGroup::findOrFail($id);

        try {
            DB::beginTransaction();
            $group->update([
                'name' => $request->filled('name') ? $request->input('name') : null,
                'description' => $request->filled('description') ? $request->input('description') : null,
            ]);

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error_borrow', [$e]);
            return  redirect()->back()->with('error', 'sorry something went wrong cannot create borrower try again');
        }

        return redirect()->route('group.index')->with('success','You have updated successfully your group');
    }

    public function show(Request $request, $id)
    {
        $group = \App\Models\Borrow\BorrowerGroup::with(['borrowers', 'officers'])->findOrFail($id);



        $users = User::query()->get();


        return view('group.view',compact('group', 'users'));
    }





    public function edit(Request $request, $id)
    {
        $group = \App\Models\Borrow\BorrowerGroup::query()->findOrFail($id);
        return view('group.edit', compact('group'));
    }


    public function assignRelation(Request $request, $groupId)
    {



        try {
            DB::beginTransaction();
            RelationOfficer::create([
               'group_id' => $groupId,
               'user_id' => $request->input('user_id'),
               'status' => 'pending',
               'created_by' => Auth::id(),
            ]);
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error_assign_relation', [$e]);
            return  Redirect::back()->with('error', 'sorry something went wrong cannot create borrower try again');
        }

        return Redirect::back()->with('success','You have assigned successfully your relation officer to group');
    }

}
