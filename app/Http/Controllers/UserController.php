<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Designation;
use App\Models\PersonalDetails;
Use App\Models\EmployeeList;
use App\Models\Worktype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        if (! Gate::allows('user_access')) {
            abort(403);
        }

        $users = User::with('roles')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        if (! Gate::allows('user_create')) {
            abort(403);
        }

        $roles = Role::all();
        $designations = Designation::all();
        $worktypes = Worktype::all();
        return view('users.create', compact('roles','designations','worktypes'));
    }

    public function store(Request $request)
    {
        if (! Gate::allows('user_create')) {
            abort(403);
        }

         $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role_id' => 'required',
            'designation_id' => 'required_if:role_id,3',
            'employee_id' => 'required_if:role_id,3',
            'gender' => 'required_if:role_id,3',
            'mobile_number' => 'required_if:role_id,3|digits:10',
            'worktype_id' => 'required_if:role_id,3',
        ]);

        $user = User::create([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->roles()->sync($request->role_id);

        if ($request->role_id == 3) {

            PersonalDetails::create([
                'user_id' => $user->id,
                'role_id' => $request->role_id,
                'designation_id' => $request->designation_id,
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
                'mobile_number' => $request->mobile_number,
            ]);

            EmployeeList::create([
                'user_id' => $user->id,
                'role_id' => $request->role_id,
                'employee_id' => $request->employee_id,
                'designation_id' => $request->designation_id,
                'worktype_id' => $request->worktype_id,
                'employee_status' => 'Active'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'User created successfully',
        ]);
    }

    public function edit(User $user)
    {
        if (! Gate::allows('user_edit')) {
            abort(403);
        }

        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();
        $personalDetails = PersonalDetails::where('user_id', $user->id)->first();
        $employeeDetails = EmployeeList::where('user_id', $user->id)->first();
        $designations = Designation::all();
        $worktypes = Worktype::all();
        return view('users.edit', compact('user', 'roles', 'userRoles','personalDetails','employeeDetails','designations','worktypes'));
    }

    public function update(Request $request, User $user)
    {
        if (! Gate::allows('user_edit')) {
            abort(403);
        }

        $request->validate([
            'name' => 'required',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->password) {
            $user->update([ 'password' => Hash::make($request->password) ]);
        }

        if ($request->role_id == 3) {
            PersonalDetails::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'mobile_number' => $request->mobile_number,
                    'gender' => $request->gender,
                ]
            );
            EmployeeList::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'employee_id' => $request->employee_id,
                    'designation_id' => $request->designation_id,
                    'worktype_id' => $request->worktype_id,
                ]
            );
        }

        $user->roles()->sync($request->role_id);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        if (! Gate::allows('user_delete')) {
            abort(403);
        }

        $roleId = $user->roles()->pluck('roles.id')->first();

        if ($roleId == 3) {
            PersonalDetails::where('user_id', $user->id)->delete();
            EmployeeList::where('user_id', $user->id)->delete();
        }

        $user->roles()->detach();
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

}
