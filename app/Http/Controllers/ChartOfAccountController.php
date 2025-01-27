<?php

namespace App\Http\Controllers;

use App\Helpers\FunctionHelper;
use App\Models\Account\AccountGroup;
use App\Models\Account\ChartOfAccount;
use App\Models\Account\Expense;
use App\Models\Account\FinancialCategory;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ChartOfAccountController extends Controller
{
    public function index(){
        $category = FinancialCategory::get();
        $groups = AccountGroup::where('com_id', Auth::user()->com_id)->get();
        $charts=ChartOfAccount::where('com_id', Auth::user()->com_id)->orderBy('id','DESC')->get();
    
         return view('chart.index', compact('category', 'groups', 'charts'));
    }

    public function addChartOfAccount(Request $request){
        $chart_no = \collect(DB::select('select max(chart_no) as chart_no from chart_of_accounts where
        (financial_category_id='. request('financial_category_id') .' and com_id='. Auth::user()->com_id .')'))->first();

        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/(^([a-zA-Z0-9,. ]+)(\d+)?$)/u',
            'financial_category_id' => 'required',

        ], [
            'name.required' => 'Name Required',
            'financial_category_id.required' => 'Account Type Required',

        ]);

   
        
        $obj = [
            'name' => request('name'),
            "financial_category_id" => request('financial_category_id'),
            "com_id"=>Auth::user()->com_id
        ];

        if ((int) request("account_group_id") > 0) {
            $account_group_id = request("account_group_id");

        } else {
            $check = DB::table('account_groups')->where($obj)->first();
            $account_group_id = !empty($check) ? $check->id : DB::table('account_groups')->insertGetId($obj);
        }

        $array = array(
            "name" => trim(request("name")),
            "financial_category_id" => request('financial_category_id'),
            "note" => request("note"),
            "account_group_id" => $account_group_id,
            'code' => request('code') == '' ? FunctionHelper::createCode() : request('code'),
            'open_balance' => (float) request('open_balance') > 0 ? (float) request('open_balance') : 0,
            "status" => "1",
            "com_id"=>Auth::user()->com_id,
            "user_id" => Auth::id(),
            "chart_no" => $chart_no->chart_no + 1
        );

        ChartOfAccount::create($array);
        $msg="Chart of Account successfully added!";
        return redirect()->route('coa.chart')->with('success', $msg);
    }

    public function updateChartOfAccount(Request $request, $id)
    {
        $chartofaccount = ChartOfAccount::find($id);

        $category = FinancialCategory::get();
        $groups = AccountGroup::where('com_id', Auth::user()->com_id)->get();
        if (!empty($chartofaccount)) {

                if ($chartofaccount->chart_no > 0) {
                  $chart_no = \collect(DB::select(
                    'select chart_no from chart_of_accounts WHERE id = ? and com_id = ?',
                    [$id, Auth::user()->com_id]
                     ))->first();

                    $chart_number = $chart_no->chart_no;
                } else {
                    $chart_no = \collect(DB::select('select max(chart_no) as chart_no from chart_of_accounts where
              (financial_category_id=' . request('financial_category_id') . ' and com_id=' . Auth::user()->com_id . ')'))->first();

                    $chart_number = $chart_no->chart_no + 1;
                }
                $array = array();
                if ($chartofaccount->predefined > 0) {
                    $array = array(
                        "note" => request("note"),
                        'code' => request('code') == '' ? FunctionHelper::createCode() : request('code'),
                        'open_balance' => (float)request('open_balance') > 0 ? (float)request('open_balance') : 0,
                    );
                } else {

                    $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'account_group_id' => 'required',

                    ], [
                        'name.required' => 'Name Required',
                        'account_group_id.required' => 'Account Group Required',

                    ]);

                    
                    $obj = [
                        'name' => request('name'),
                        "financial_category_id" => request('financial_category_id'),
                    ];
                    $account_group_id = (int)trim(request("account_group_id")) > 0 ? (int)trim(request("account_group_id")) : DB::table('account_groups')->insertGetId($obj);

                    $array = array(
                        "name" => trim(request("name")),
                        "account_group_id" => $account_group_id,
                        "financial_category_id" => request('financial_category_id'),
                        "note" => request("note"),
                        "chart_no" => $chart_number,
                        'open_balance' => (float)request('open_balance') > 0 ? (float)request('open_balance') : 0,
                        'code' => request('code') == '' ? FunctionHelper::createCode() : request('code')
                    );
                }

                $affected_number = $chartofaccount->update($array);
                if ($affected_number > 0) {
                    $msg = "Chart of account updated successfully";
                    return redirect()->route('coa.chart')->with('success',$msg);
                } else {
                    $msg = "Update failed , please try again";
                    return redirect()->back()->with('error', $msg);
                }



        }
    }


    public function create(Request $request){
        $types = FinancialCategory::get();
        $groups = AccountGroup::where('com_id', Auth::user()->com_id)->get();

        return view('chart.create', compact('types', 'groups'));
    }
   

    public function edit(Request $request, $chartId){
        $types = FinancialCategory::get();
        $groups = AccountGroup::where('com_id', Auth::user()->com_id)->get();

        $chart = ChartOfAccount::findOrFail($chartId);

        return view('chart.edit', compact('types', 'groups', 'chart'));
    }

    public function show(Request $request, $chartId){
   
        $chart = ChartOfAccount::findOrFail($chartId);
        
        return view('chart.view', compact('chart'));
    }

    public function deleteChartOfAccount(Request $request){
        $id = $request->input('id');
        $check_expense = Expense::where('chart_id', $id)->first();
        $check_chart = ChartOfAccount::where('id', $id)->first();
        if($check_expense){
            $msg = "Error cannot delete this chart of account";
            return redirect()->back()->with('error',$msg);
        }
        if (empty($check_expense)) {
            ChartOfAccount::where('id', $id)->delete();
            $msg = "Chart of account deleted successfully";
            return redirect()->back()->with('success', $msg);
        } else {
            
        }
    }
}
