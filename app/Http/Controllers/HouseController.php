<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;

/**
 * Class HouseController
 * @package App\Http\Controllers
 */
class HouseController extends Controller
{
    /**
     * Search.
     *
     * @return array
     */
    public function search(Request $request): array
    {
        // checking for the presence of a filter or sorting type in the request and if available, using a filter or sorting 
        $houses = House::when($request->name, function ($query, $name) {
            return $query->where('name', 'like', "%{$name}%");
        })->when($request->minPrice, function ($query, $minPrice) {
            return $query->where('price', ">=", $minPrice);
        })->when($request->maxPrice, function ($query, $maxPrice) {
            return $query->where('price', "<=", $maxPrice);
        // Sorting
        })->when($request->sortByPrice && in_array($request->sortByPrice, ['m', 'l']), function ($query) use ($request) {
            return $query->orderBy('price', $request->sortByPrice == 'l' ? 'asc' : 'desc');
        }, function ($query) {
            return $query->orderByDesc('id');
        })->paginate(15);

        // Return the search view with the results compacted
        return compact('houses');
    }
}
