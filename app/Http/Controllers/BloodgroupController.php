<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\Bloodgroup;

class BloodgroupController extends Controller
{
    public function index(Request $request)
    {

        if (! Gate::allows('bloodgroup_access')) {
            abort(403);
        }
        return view('bloodgroups.index');
    }

    public function getBloodgroup()
    {
        if (! Gate::allows('bloodgroup_access')) {
            abort(403);
        }

        $bloodgroups = Bloodgroup::orderBy('id', 'DESC')->get();
        $data = $bloodgroups->map(function ($bloodgroup) {
            return [
                'id'     => $bloodgroup->id,
                'name'   => $bloodgroup->bloodgroup,
                'created_by' => $bloodgroup->created_by,
                'action' => view('components.action-buttons', [
                    'id'          => $bloodgroup->id,
                    'viewRoute'   => 'bloodgroup_view',
                    'editRoute'   => 'bloodgroup_edit',
                    'deleteRoute' => 'bloodgroup_delete',
                ])->render()
            ];
        });

        return response()->json(['data' => $data]);
    }

    public function createBloodgroup(Request $request)
    {
        if (! Gate::allows('bloodgroup_create')) {
            abort(403);
        }

        $request->validate([
            'bloodgroup_name' => 'required|string|max:255',
        ]);

        if ($request->id) {

            $bloodgroup = Bloodgroup::findOrFail($request->id);
            $bloodgroup->update([
                'bloodgroup'        => $request->bloodgroup_name,
                'created_by'  => Auth::user()->name,
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Bloodgroup updated successfully.'
            ]);
        } else {

            Bloodgroup::create([
                'bloodgroup'        => $request->bloodgroup_name,
                'created_by'  => Auth::user()->name,
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Bloodgroup created successfully.'
            ]);
        }
    }

    public function viewBloodgroup(Request $request)
    {
        if (! Gate::allows('bloodgroup_view')) {
            abort(403);
        }

        $bloodgroup = Bloodgroup::find($request->id);

        if (!$bloodgroup) {
            return response()->json([
                'message' => 'Bloodgroup not found'
            ], 404);
        }

        return response()->json([
            'data' => [
                'id'   => $bloodgroup->id,
                'name' => $bloodgroup->bloodgroup,
            ]
        ]);
    }

    public function editBloodgroup(Request $request)
    {

        if (! Gate::allows('bloodgroup_edit')) {
            abort(403);
        }

        $id = $request->id;

        $editbloodgroup = Bloodgroup::where('id', $id)->first();

        if ($editbloodgroup) {
            return response()->json([
                'status' => true,
                'data' => $editbloodgroup
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Bloodgroup not found'
            ], 400);
        }
    }

    public function deleteBloodgroup(Request $request)
    {
        if (! Gate::allows('bloodgroup_delete')) {
            abort(403);
        }
        try {
            $bloodgroup = Bloodgroup::find($request->id);

            if (!$bloodgroup) {
                return response()->json([
                    'success' => false,
                    'message' => "Bloodgroup not found!"
                ], 404);
            }

            $bloodgroup->delete();
            return response()->json([
                'success' => true,
                'message' => "Bloodgroup permanently deleted successfully"
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => "Something went wrong while deleting permission",
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
