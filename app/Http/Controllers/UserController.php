<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{




    public function index(Request $request){

        $users = User::with('roles:name')->orderBy('id', 'DESC')->get(['id', 'name', 'email','last_login']);
        $roles = Role::orderBy('id', 'ASC')->get();
        return Inertia::render('Settings/Users/Index', ['users' => $users, 'roles' => $roles]);
    }

    public function unassignRole(Request $request, $userId){

        $validatedData = $request->validate([
            'name' => 'required'
        ]);
        $user = User::findOrFail($userId);

        try {
            if ($user->hasRole($validatedData['name'])) {
                $user->removeRole($validatedData['name']);
            }

        }catch (\Exception $e){
            Log::info('error', [$e]);
            return  Redirect::back()->with('error', 'sorry something went wrong cannot create loan try again');
        }
        return Redirect::route('user.index')->with('success','You have removed successfully a role');
    }


    public function assignRole(Request $request, $userId){

        $validatedData = $request->validate([
            'name' => 'required'
        ]);
        $user = User::findOrFail($userId);

        try {
            if (!$user->hasRole($validatedData['name'])) {
                $user->assignRole($validatedData['name']);
            }

        }catch (\Exception $e){
            Log::info('error', [$e]);
            return  Redirect::back()->with('error', 'sorry something went wrong cannot assign role try again');
        }
        return Redirect::route('user.index')->with('success','You have assigned successfully a role');
    }


    public function create(Request $request){
        $roles = Role::all();
        return Inertia::render('Settings/Users/Create',['roles' => $roles]);
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'role' => 'required',
            'password' => 'required|min:4',
            'email' => 'required|email|unique:users,email',
        ]);
        try {
            DB::beginTransaction();
             $user = User::create([
                'email' => $validatedData['email'],
                'name' => $validatedData['name'],
                'password' => Hash::make($validatedData['password']),
             ]);
             $role = Role::findOrFail($validatedData['role']);
            $user->assignRole($role->name);
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            return  Redirect::back()->with('error', 'sorry something went wrong cannot create user try again');
        }
        return Redirect::route('user.index')->with('success','You have created a user successfully');
    }
}
