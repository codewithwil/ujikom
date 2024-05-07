<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index($id){
        return view('back.profile.index', [
            'users'=> User::find($id)
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
}

