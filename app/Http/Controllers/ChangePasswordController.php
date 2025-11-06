<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ChangePasswordController extends Controller
{
    public function changePassword(Request $request)
    {
        if (! Gate::allows('change_password_access')) {
            abort(403);
        }

        $request->validate([
            'new_password' => 'required|min:8',
        ]);
        $userId = Auth::id();

        User::where('id', $userId)->update([
            'password' => Hash::make($request->new_password),
        ]);

        return response()->json(['message' => 'Password updated successfully.']);
    }
}
