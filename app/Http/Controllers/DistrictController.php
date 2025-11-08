<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\Country;
use App\Models\District;
use App\Models\State;

class DistrictController extends Controller
{
    public function index(Request $request)
    {
        if (! Gate::allows('district_access')) {
            abort(403);
        }
        $countries = Country::all();
        return view('districts.index',compact('countries'));
    }

    public function getDistrict()
    {
        if (! Gate::allows('district_access')) {
            abort(403);
        }

        $districts = District::with('country','state')->orderBy('id', 'DESC')->get();
        $data = $districts->map(function ($district) {
            return [
                'id'     => $district->id,
                'name'   => $district->district,
                'country'     => $district->country->country ?? 'N/A',
                'state'     => $district->state->state ?? 'N/A',
                'created_by' => $district->created_by,
                'action' => view('components.action-buttons', [
                    'id'          => $district->id,
                    'viewRoute'   => 'district_view',
                    'editRoute'   => 'district_edit',
                    'deleteRoute' => 'district_delete',
                ])->render()
            ];
        });

        return response()->json(['data' => $data]);
    }

    public function getStatesByCountry(Request $request)
    {
        if (! Gate::allows('district_access')) {
            abort(403);
        }
        $states = State::where('country_id', $request->country_id)
            ->select('id', 'state')
            ->orderBy('state', 'asc')
            ->get();

        return response()->json(['data' => $states]);
    }

    public function createDistrict(Request $request)
    {
        if (! Gate::allows('district_create')) {
            abort(403);
        }

        $request->validate([
            'district_name' => 'required|string|max:255',
            'country_id' => 'required',
        ]);

        if ($request->id) {

            $district = District::findOrFail($request->id);
            $district->update([
                'district'        => $request->district_name,
                'created_by'  => Auth::user()->name,
                'country_id' => $request->country_id,
                'state_id' => $request->state_id,
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'District updated successfully.'
            ]);
        } else {

            District::create([
                'district'        => $request->district_name,
                'created_by'  => Auth::user()->name,
                'country_id' => $request->country_id,
                'state_id' => $request->state_id,
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'District created successfully.'
            ]);
        }
    }

    public function editDistrict(Request $request)
    {

        if (! Gate::allows('district_edit')) {
            abort(403);
        }

        $id = $request->id;

        $editdistrict = District::where('id', $id)->first();

        if ($editdistrict) {
            return response()->json([
                'status' => true,
                'data' => $editdistrict
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'district not found'
            ], 400);
        }
    }

    public function viewDistrict(Request $request)
    {
        if (! Gate::allows('district_view')) {
            abort(403);
        }

        $district = District::find($request->id);

        if (!$district) {
            return response()->json([
                'message' => 'district not found'
            ], 404);
        }

        return response()->json([
            'data' => [
                'id'   => $district->id,
                'name' => $district->district,
                'country_id' => $district->country_id,
                'state_id' => $district->state_id,
            ]
        ]);
    }

    public function deleteDistrict(Request $request)
    {
        if (! Gate::allows('district_delete')) {
            abort(403);
        }
        try {
            $district = District::find($request->id);

            if (!$district) {
                return response()->json([
                    'success' => false,
                    'message' => "district not found!"
                ], 404);
            }

            $district->delete();
            return response()->json([
                'success' => true,
                'message' => "district permanently deleted successfully"
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
