<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\Country;

class CountryController extends Controller
{
    public function index(Request $request)
    {

        if (! Gate::allows('country_access')) {
            abort(403);
        }
        return view('countries.index');
    }

    public function getCountry()
    {
        if (! Gate::allows('country_access')) {
            abort(403);
        }

        $countrys = Country::orderBy('id', 'DESC')->get();
        $data = $countrys->map(function ($country) {
            return [
                'id'     => $country->id,
                'name'   => $country->country,
                'created_by' => $country->created_by,
                'action' => view('components.action-buttons', [
                    'id'          => $country->id,
                    'viewRoute'   => 'country_view',
                    'editRoute'   => 'country_edit',
                    'deleteRoute' => 'country_delete',
                ])->render()
            ];
        });

        return response()->json(['data' => $data]);
    }

    public function createCountry(Request $request)
    {
        if (! Gate::allows('country_create')) {
            abort(403);
        }

        $request->validate([
            'country_name' => 'required|string|max:255',
        ]);

        if ($request->id) {

            $country = Country::findOrFail($request->id);
            $country->update([
                'country'        => $request->country_name,
                'created_by'  => Auth::user()->name,
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Country updated successfully.'
            ]);
        } else {

            Country::create([
                'country'        => $request->country_name,
                'created_by'  => Auth::user()->name,
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Country created successfully.'
            ]);
        }
    }

    public function viewCountry(Request $request)
    {
        if (! Gate::allows('country_view')) {
            abort(403);
        }

        $country = Country::find($request->id);

        if (!$country) {
            return response()->json([
                'message' => 'Country not found'
            ], 404);
        }

        return response()->json([
            'data' => [
                'id'   => $country->id,
                'name' => $country->country,
            ]
        ]);
    }

    public function editCountry(Request $request)
    {

        if (! Gate::allows('country_edit')) {
            abort(403);
        }

        $id = $request->id;

        $editcountry = Country::where('id', $id)->first();

        if ($editcountry) {
            return response()->json([
                'status' => true,
                'data' => $editcountry
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Country not found'
            ], 400);
        }
    }

    public function deleteCountry(Request $request)
    {
        if (! Gate::allows('country_delete')) {
            abort(403);
        }
        try {
            $country = Country::find($request->id);

            if (!$country) {
                return response()->json([
                    'success' => false,
                    'message' => "Country not found!"
                ], 404);
            }

            $country->delete();
            return response()->json([
                'success' => true,
                'message' => "Country permanently deleted successfully"
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
