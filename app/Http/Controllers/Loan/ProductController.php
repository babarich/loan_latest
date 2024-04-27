<?php

namespace App\Http\Controllers\Loan;

use App\Http\Controllers\Controller;
use App\Models\Loan\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        $products = Product::query()->orderBy('updated_at', 'desc')->get();

        return view('products.index', compact('products'));
    }

    public function create(Request $request)
    {
        return view('products.create');
    }



    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $product = Product::create([
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
            return  redirect()->back()->with('error', 'sorry something went wrong cannot create loan product try again');
        }

        return redirect()->route('product.index')->with('success','You have added successfully a new loan product');
    }


    public function update(Request $request, $id)
    {

        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $product = Product::findOrFail($id);

        try {
            DB::beginTransaction();
            $product->update([
                'name' => $request->filled('name') ? $request->input('name') : null,
                'description' => $request->filled('description') ? $request->input('description') : null,
            ]);

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            Log::info('error_borrow', [$e]);
            return  redirect()->back()->with('error', 'sorry something went wrong cannot create loan product try again');
        }

        return redirect()->route('product.index')->with('success','You have updated successfully your loan product');
    }

    public function show(Request $request, $id)
    {
        $product = Product::with('user')->findOrFail($id);
        return view('products.view',['product' =>$product]);
    }




    public function edit(Request $request, $id)
    {
        $product = Product::with('user')->findOrFail($id);
        return view('products.edit',['product' => $product]);
    }

}
