<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Designation;


class DesignationController extends Controller
{
    public function index(Request $request)
    {
        if (! Gate::allows('designation_access')) {
            abort(403);
        }
        return view('desingations.index');
    }

    public function getDesignation()
    {
        if (! Gate::allows('designation_access')) {
            abort(403);
        }

        $designations = Designation::orderBy('id', 'DESC')->get();
        $data = $designations->map(function ($designation) {
            return [
                'id'     => $designation->id,
                'name'   => $designation->designation,
                'created_by' => $designation->created_by,
                'action' => view('components.action-buttons', [
                    'id'          => $designation->id,
                    'viewRoute'   => 'designation_view',
                    'editRoute'   => 'designation_edit',
                    'deleteRoute' => 'designation_delete',
                ])->render()
            ];
        });

        return response()->json(['data' => $data]);
    }

    public function createDesignation(Request $request)
    {
        if (! Gate::allows('designation_create')) {
            abort(403);
        }

        $request->validate([
            'designation_name' => 'required|string|max:255',
        ]);

        if ($request->id) {

            $designation = Designation::findOrFail($request->id);
            $designation->update([
                'designation'  => $request->designation_name,
                'created_by'  => Auth::user()->name,
            ]);
            return response()->json([
                'status'  => true,
                'message' => 'Designation updated successfully.'
            ]);
        } else {
            Designation::create([
                'designation' => $request->designation_name,
                'created_by'  => Auth::user()->name,
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Designation created successfully.'
            ]);
        }
    }

    public function viewDesignation(Request $request)
    {
        if (! Gate::allows('designation_view')) {
            abort(403);
        }

        $designation = Designation::find($request->id);

        if (!$designation) {
            return response()->json([
                'message' => 'Designation not found'
            ], 404);
        }

        return response()->json([
            'data' => [
                'id'   => $designation->id,
                'name' => $designation->designation,
            ]
        ]);
    }

    public function editDesignation(Request $request)
    {

        if (! Gate::allows('designation_edit')) {
            abort(403);
        }

        $id = $request->id;

        $editdesignation = Designation::where('id', $id)->first();

        if ($editdesignation) {
            return response()->json([
                'status' => true,
                'data' => $editdesignation
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Designation not found'
            ], 400);
        }
    }

    public function deleteDesignation(Request $request)
    {
        if (! Gate::allows('designation_delete')) {
            abort(403);
        }
        try {

            $designation = Designation::find($request->id);
            if (!$designation) {
                return response()->json([
                    'success' => false,
                    'message' => "Designation not found!"
                ], 404);
            }

            $designation->delete();
            return response()->json([
                'success' => true,
                'message' => "Designation permanently deleted successfully"
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
