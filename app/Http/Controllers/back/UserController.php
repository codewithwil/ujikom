<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(){
        $users = User::get();
        return view('back.user.index', [
            'users' => $users
        ]);
    }
    public function create(){
        $role = Role::get();
        return view('back.user.create', [
            'roles' => $role
        ]);
    }

    public function store(CreateUserRequest $request) {
        $data = $request->validated();
     
        DB::beginTransaction();
        try {
            if ($request->hasFile('foto_profile')) {
                $checkingFile = $request->file('foto_profile');
                $this->managementFile($checkingFile);
            }
    
            $data['password'] = bcrypt($data['password']);
            $user             = User::create($data);
            $role = Role::where('name', $request->input('role'))->first();
            if ($role) {
                $user->assignRole($role);
            }
            
            DB::commit();

            return redirect(route('users.index'))->with('success', ' User has been created');
        } catch (Exception $e) {
            info($e->getMessage());
            DB::rollBack();

            return response()->json([
                "code"    => 412,
                "status"  => "Error",
                "message" =>  $e->getLine() . ' ' . $e->getMessage()
            ]);
            
        }
    }

    public function edit($id){
        $role = Role::get();
        return view('back.user.update', [
            'users'    => User::find($id),
            'roles'    => $role
        ]);
    }

    public function update(UpdateUserRequest $request, $id){
        $data = $request->validated();
     
        DB::beginTransaction();
        try {
            if ($request->hasFile('foto_profile')) {
                $checkingFile = $request->file('foto_profile');
                $this->managementFile($checkingFile);
            }
    
        if($request->filled('password')) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
            unset($data['password_confirmation']);
        }
            $user = User::find($id);
            $user->update($data);

            $role = Role::where('name', $request->input('role'))->first();
            if ($role) {
                $user->syncRoles([$role->id]);
            }
            DB::commit();

            return redirect(route('users.index'))->with('success', ' User has been update');
        } catch (Exception $e) {
            info($e->getMessage());
            DB::rollBack();

            return response()->json([
                "code"    => 412,
                "status"  => "Error",
                "message" =>  $e->getLine() . ' ' . $e->getMessage()
            ]);
            
        }
    }

    public function profile($id){
        $user = User::find($id);
    
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
        $roles = Role::all();
        
        return view('back.profile.index', [
            'users' => $user,
            'roles' => $roles
        ]);
    }

    public function updateProfile(UpdateUserRequest $request, $id){
            $data = $request->validated();
         
            DB::beginTransaction();
            try {
                if ($request->hasFile('foto_profile')) {
                    $checkingFile = $request->file('foto_profile');
                    $filename = $checkingFile->getClientOriginalName();
                    $path = $checkingFile->storeAs('public/back/foto-profile',$filename);
                    $data['foto_profile'] = $filename;
            
                    $user = User::find($id);
                    if ($user->foto_profile) {
                        Storage::delete('public/back/foto-profile/' . $user->foto_profile);
                    }
                }
            if($request->filled('password')) {
                $data['password'] = bcrypt($data['password']);
            } else {
                unset($data['password']);
                unset($data['password_confirmation']);
            }
                $user = User::find($id);
                $user->update($data);
                DB::commit();
    
                return redirect()->route('users.profile', ['id' => $user->id])->with('success', 'User has been updated');
            } catch (Exception $e) {
                info($e->getMessage());
                DB::rollBack();
    
                return response()->json([
                    "code"    => 412,
                    "status"  => "Error",
                    "message" =>  $e->getLine() . ' ' . $e->getMessage()
                ]);  
            }
        }
}

