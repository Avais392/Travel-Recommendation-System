<?php

namespace App\Http\Controllers;
use App\HotelOrRestaurant;

use Illuminate\Http\Request;

class hotelAPIController extends Controller
{
    //

    public function index()
    {
        return HotelOrRestaurant::all();
    }

    public function show($id)
    {
        return HotelOrRestaurant::find($id);
    }

    public function store(Request $request)
    {
        return HotelOrRestaurant::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $hotel = HotelOrRestaurant::findOrFail($id);
        $hotel->update($request->all());

        return $hotel;
    }

    public function delete(Request $request, $id)
    {
        $hotel = HotelOrRestaurant::findOrFail($id);
        $hotel->delete();

        return 204; //No content
    }

}
