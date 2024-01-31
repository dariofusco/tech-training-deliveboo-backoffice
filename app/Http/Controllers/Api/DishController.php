<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use Illuminate\Http\Request;

class DishController extends Controller
{
    public function index() {
        //recupero dati dal DB
        $dishes = Dish::with(['restaurant'])->get();
        //restituisco dati in formato JSON
        return response()->json($dishes);
    }
}
