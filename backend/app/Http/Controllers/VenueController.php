<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VenueController extends Controller
{
    public function index(Request $request)
    {
        $venues = json_decode(Storage::disk('local')->get('data.json'), true);

        $name = $request->query('name');
        $discountPercentage = $request->query('discount_percentage');

        if ($name) {
            $venues = array_filter($venues, function ($venue) use ($name) {
                return strpos($venue['name'], $name) !== false;
            });
        }

        if ($discountPercentage) {
            $venues = array_filter($venues, function ($venue) use ($discountPercentage) {
                return $venue['discount_percentage'] >= $discountPercentage;
            });
        }

        return response()->json($venues);
    }
}
