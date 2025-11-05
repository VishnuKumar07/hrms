<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\State;
use App\Models\Country;

class StateController extends Controller
{
    public function index(Request $request)
    {
        if (! Gate::allows('state_access')) {
            abort(403);
        }
        $countries = Country::all();
       return view('states.index', compact('countries'));
    }

    public function getState()
    {
        if (! Gate::allows('state_access')) {
            abort(403);
        }

        $states = State::with('country')->orderBy('id', 'DESC')->get();
        $data = $states->map(function ($state) {
            return [
                'id'     => $state->id,
                'name'   => $state->state,
                'country'     => $state->country->country ?? 'N/A',
                'created_by' => $state->created_by,
                'action' => view('components.action-buttons', [
                    'id'          => $state->id,
                    'viewRoute'   => 'state_view',
                    'editRoute'   => 'state_edit',
                    'deleteRoute' => 'state_delete',
                ])->render()
            ];
        });

        return response()->json(['data' => $data]);
    }

    public function createState(Request $request)
    {
        if (! Gate::allows('state_create')) {
            abort(403);
        }

        $request->validate([
            'state_name' => 'required|string|max:255',
            'country_id' => 'required',
        ]);

        if ($request->id) {

            $state = State::findOrFail($request->id);
            $state->update([
                'state'        => $request->state_name,
                'created_by'  => Auth::user()->name,
                'country_id' => $request->country_id,
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'State updated successfully.'
            ]);
        } else {

            State::create([
                'state'        => $request->state_name,
                'created_by'  => Auth::user()->name,
                'country_id' => $request->country_id,
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'State created successfully.'
            ]);
        }
    }

    public function viewState(Request $request)
    {
        if (! Gate::allows('state_view')) {
            abort(403);
        }

        $state = State::find($request->id);

        if (!$state) {
            return response()->json([
                'message' => 'State not found'
            ], 404);
        }

        return response()->json([
            'data' => [
                'id'   => $state->id,
                'name' => $state->state,
                'country_id' => $state->country_id,
            ]
        ]);
    }

    public function editState(Request $request)
    {

        if (! Gate::allows('state_edit')) {
            abort(403);
        }

        $id = $request->id;

        $editstate = State::where('id', $id)->first();

        if ($editstate) {
            return response()->json([
                'status' => true,
                'data' => $editstate
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'State not found'
            ], 400);
        }
    }

    public function deleteState(Request $request)
    {
        if (! Gate::allows('state_delete')) {
            abort(403);
        }
        try {
            $state = State::find($request->id);

            if (!$state) {
                return response()->json([
                    'success' => false,
                    'message' => "State not found!"
                ], 404);
            }

            $state->delete();
            return response()->json([
                'success' => true,
                'message' => "State permanently deleted successfully"
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
