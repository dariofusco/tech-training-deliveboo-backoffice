<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index() {
        //recupero dati dal DB
        $restaurants = Restaurant::with(['typologies','dish'])->get();
        //restituisco dati in formato JSON
        return response()->json($restaurants);
    }
}
