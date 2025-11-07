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
        $states = State::where('country_id', $request->country_id)
            ->select('id', 'state')
            ->orderBy('state', 'asc')
            ->get();

        return response()->json(['data' => $states]);
    }



}
