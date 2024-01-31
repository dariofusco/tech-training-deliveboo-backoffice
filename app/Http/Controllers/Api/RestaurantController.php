<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Contracts\Database\Eloquent\Builder;
class RestaurantController extends Controller
{
    public function index()
    {
        //recupero dati dal DB
        $restaurants = Restaurant::with(['typologies'])->get(); //tolto dish, non ci serve nella index
        foreach ($restaurants as $restaurant) {
            $restaurant->makeHidden('user_id', 'piva');
        } //nascondo dati sensibili

        //restituisco dati in formato JSON
        return response()->json($restaurants);
    }

    public function show(string $id)
    {
        if (Restaurant::find($id) == null) {
            return response()->json(['message' => 'Ristorante non trovato'], 404);
        }

        $restaurant = Restaurant::find($id)->with(['typologies', 'dish' => function (Builder $query) {
            $query->where('visible', 1); //solo piatti con visible yes
        }])->first();

        $restaurant->makeHidden('user_id', 'piva'); //nascondo dati sensibili

        return response()->json($restaurant);
    }
}
