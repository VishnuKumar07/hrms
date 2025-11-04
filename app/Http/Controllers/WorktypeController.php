<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Worktype;

class WorktypeController extends Controller
{
    public function index(Request $request)
    {
        return view('worktypes.index');
    }

    public function getWorktype()
    {
        if (! Gate::allows('worktype_access')) {
            abort(403);
        }

        $worktypes = Worktype::orderBy('id', 'DESC')->get();
        $data = $worktypes->map(function ($worktype) {
            return [
                'id'     => $worktype->id,
                'name'   => $worktype->worktype,
                'created_by' => $worktype->created_by,
                'action' => view('components.action-buttons', [
                    'id'          => $worktype->id,
                    'viewRoute'   => 'worktype_view',
                    'editRoute'   => 'worktype_edit',
                    'deleteRoute' => 'worktype_delete',
                ])->render()
            ];
        });

        return response()->json(['data' => $data]);
    }

    public function createWorktype(Request $request)
    {
        if (! Gate::allows('worktype_create')) {
            abort(403);
        }

        $request->validate([
            'worktype_name' => 'required|string|max:255',
        ]);

        if ($request->id) {

            $worktype = Worktype::findOrFail($request->id);
            $worktype->update([
                'worktype'  => $request->worktype_name,
                'created_by'  => Auth::user()->name,
            ]);
            return response()->json([
                'status'  => true,
                'message' => 'Worktype updated successfully.'
            ]);
        } else {
            Worktype::create([
                'worktype' => $request->worktype_name,
                'created_by'  => Auth::user()->name,
            ]);
            return response()->json([
                'status'  => true,
                'message' => 'Worktype created successfully.'
            ]);
        }
    }

    public function viewWorktype(Request $request)
    {
        if (! Gate::allows('worktype_view')) {
            abort(403);
        }

        $worktype = Worktype::find($request->id);

        if (!$worktype) {
            return response()->json([
                'message' => 'Worktype not found'
            ], 404);
        }

        return response()->json([
            'data' => [
                'id'   => $worktype->id,
                'name' => $worktype->worktype,
            ]
        ]);
    }

    public function editWorktype(Request $request)
    {

        if (! Gate::allows('worktype_edit')) {
            abort(403);
        }

        $id = $request->id;

        $editworktype = Worktype::where('id', $id)->first();

        if ($editworktype) {
            return response()->json([
                'status' => true,
                'data' => $editworktype
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'worktype not found'
            ], 400);
        }
    }

    public function deleteWorktype(Request $request)
    {
        if (! Gate::allows('worktype_delete')) {
            abort(403);
        }
        try {
            $worktype = Worktype::find($request->id);

            if (!$worktype) {
                return response()->json([
                    'success' => false,
                    'message' => "Worktype not found!"
                ], 404);
            }

            $worktype->delete();
            return response()->json([
                'success' => true,
                'message' => "Worktype permanently deleted successfully"
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
