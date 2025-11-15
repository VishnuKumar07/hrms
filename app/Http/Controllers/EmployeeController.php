<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeList;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
Use App\Models\User;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {

        if (! Gate::allows('employee_list_access')) {
            abort(403);
        }
        return view('employees.index');
    }

    public function getEmployee(Request $request)
    {
        if (! Gate::allows('employee_list_access')) {
            abort(403);
        }

        $employees = EmployeeList::with('user','designation','personalDetails')->where('employee_status', 'Active')->get();
        $data = $employees->map(function ($employee) {
            return [
                'id' => encrypt($employee->id),
                'name'   => $employee->user->name,
                'email'   => $employee->user->email,
                'employee_id'   => $employee->employee_id,
                'employee_status'   => $employee->employee_status,
                'designation'   => $employee->designation->designation,
                'mobile_number'    => $employee->personalDetails->mobile_number ?? 'N/A',
                'gender'    => $employee->personalDetails->gender ?? 'N/A',
                'action' => view('components.action-buttons', [
                    'id'          => $employee->id,
                    'viewRoute'   => 'employee_view',
                    'editRoute'   => 'employee_edit',
                    'deleteRoute' => 'employee_deletee',
                ])->render()
            ];
        });
        return response()->json(['data' => $data]);
    }

    public function employeeChangePassword(Request $request)
    {
        if (! Gate::allows('change_employee_password')) {
            abort(403);
        }

        $request->validate([
            'password' => 'required|min:8',
            'id' => 'required|exists:employee_list,id',
        ]);

        $employeeId = $request->id;
        $newPassword = $request->password;

        $user_id = EmployeeList::where('id', $employeeId)->value('user_id');

        if (!$user_id) {
            return response()->json([
                'status' => false,
                'message' => 'User not found for this employee.',
            ], 404);
        }

        User::where('id', $user_id)->update([
            'password' => Hash::make($newPassword),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Password updated successfully.',
        ]);
    }

    public function view($encryptedId)
    {
        if (! Gate::allows('employee_list_view')) {
            abort(403);
        }
        try {
            $id = decrypt($encryptedId);
        } catch (\Exception $e) {
            abort(404, 'Invalid ID');
        }

        $employee = EmployeeList::with(['user', 'designation', 'personalDetails'])
                        ->findOrFail($id);
        return view('employees.view', compact('employee'));
    }

}
