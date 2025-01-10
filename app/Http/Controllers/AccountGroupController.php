<?php

namespace App\Http\Controllers;

use App\Models\Account\AccountGroup;
use App\Models\Account\FinancialCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AccountGroupController extends Controller
{
    public function index(){

    $groups = AccountGroup::where('com_id', Auth::user()->com_id)->orderBy('id','DESC')->get();
   
    return view('accountGroup.index', compact('groups'));
    }


public function create(Request $request)
    {

        $types = FinancialCategory::query()
        ->orderBy('updated_at', 'desc')->get();

        return view('accountGroup.create', compact('types'));
    }



public function store(Request $request){
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'financial_category_id' => 'required',

    ], [
        'name.required' => 'Group Name Required',
        'financial_category_id.required' => 'Account Type Required',

    ]);


   $check = AccountGroup::query()
    ->whereRaw('lower(name) = ?', [strtolower(request('name'))])
    ->where('com_id', Auth::user()->com_id)
    ->get();

    if (count($check) > 0) {
        $msg= 'Group name already exists. Please use a different name';
        return redirect()->back()->with('error', $msg);
    }
    $accountgroup = new AccountGroup;
    $accountgroup->name= $request->name;
    $accountgroup->financial_category_id= $request->financial_category_id;
    $accountgroup->note= $request->note;
    $accountgroup->com_id=Auth::user()->com_id;
    $accountgroup->save();

    return redirect()->route('coa.index')->with('success', 'You have added a group successfully');


}


public function update(Request $request, $id){
        $accountGroup = AccountGroup::findOrFail($id);
 
        $data= array();
        $data['name']= $request->name;
        $data['financial_category_id']= $request->financial_category_id;
        $data['note']= $request->note;
        $accountGroup->update($data);

       return redirect()->route('coa.index')->with('success', 'You have updated a group successfully');
    
}


 public function show(Request $request, $id)
    {
        $group = AccountGroup::findOrFail($id);

        return view('accountGroup.view',['group' => $group]);
    }





    public function edit(Request $request, $id)
    {
        $group = AccountGroup::findOrFail($id);
        return view('accountGroup.edit',['group' => $group]);
    }

public function delete(Request  $request, $id){
    $group = AccountGroup::findOrFail($id);
    // $check_group_id = \App\Models\COA::where('account_group_id', $id)->count();
    // if ($check_group_id > 0) {
    //     $msg = "Error Cannot delete this group, please delete associated transactions first";
    //     return response()->json(['code' => 422, 'message' => $msg], 422);

    // } else {
    //     \App\Models\COA::where('account_group_id', $id)->delete();
    //     \App\Models\AccountGroup::where('id', $id)->delete();
    //     $msg = 'Account Group Deleted Successfully!';
    //     return response()->json(['code' => 200, 'message' => $msg], 200);
    // }
}

}
