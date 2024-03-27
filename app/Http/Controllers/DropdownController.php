<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;

class DropdownController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('dropdown', compact('countries'));
    }

    public function getStates($id)
    {
        info($id);
        info("call");
        $states = State::where('country_id', $id)->get();
        info($states);
        return response()->json($states);
    }

    public function getCities($id)
    {
        info($id);
        info("call");
        $cities = City::where('state_id', $id)->get();
        info($cities);
        return response()->json($cities);
    }
}
