<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Contracts\Database\Eloquent\Builder;

use function PHPUnit\Framework\isEmpty;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        $query = Restaurant::with(['typologies']);
            //filtro in querystring restaurants?typologies=categoria1,categoria2,categoria3
            //se vuoto ?typologies= restituisce tutti i ristoranti
        if ($request->has('typologies') && $request->input('typologies') != null) {
            $typologies = $request->input('typologies');
            //Crea array dall stringa virgolettata
            $typologiesArray = explode(',', $typologies);

            // Filtra i ristoranti in base all'array fornito e ritorna solo se li ha tutti
            $query->whereHas('typologies', function ($query) use ($typologiesArray) {
                $query->whereIn('name', $typologiesArray);
            }, '=', count($typologiesArray));
        }


        $restaurants = $query->get();
        foreach ($restaurants as $restaurant) {
            $restaurant->makeHidden('user_id', 'piva');
        } //nascondo dati sensibili

        //restituisco dati in formato JSON
        if (count($restaurants) < 1) {
            return response()->json(['message' => 'Ristoranti non trovati'], 200);
        }
        return response()->json($restaurants);
    }

    public function show(string $id)
    {
        if (Restaurant::where('id', $id)->first() == null) {
            return response()->json(['message' => 'Ristorante non trovato'], 404);
        }

        $restaurant = Restaurant::where('id', $id)->with(['typologies', 'dish' => function (Builder $query) {
            $query->where('visible', 1); //solo piatti con visible yes
        }])->first();

        $restaurant->makeHidden('user_id', 'piva'); //nascondo dati sensibili

        return response()->json($restaurant);
    }
}
