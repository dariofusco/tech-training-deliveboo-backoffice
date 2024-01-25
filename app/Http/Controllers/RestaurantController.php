<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRestaurantRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use App\Models\Typology;
use App\Models\User;



class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //id utente loggato
        $user_id = Auth::user()->id;
        $userRestaurant = User::find($user_id)->restaurant()->first();
        return view("restaurant.index", compact("userRestaurant"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_id = Auth::user()->id;
        $userRestaurant = User::find($user_id)->restaurant()->first();
        $typologies = Typology::all();
        return view("restaurant.create", compact("userRestaurant", "typologies"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantRequest $request)
    {
        //runnare php artisan storage:link
        //id utente loggato
        $user_id = Auth::user()->id;
        //upload e creazione url del file
        $photoPath = asset('storage') . '/' . Storage::disk('public')->put('uploads', $request->validated('photo'));
        //creazione ristorante
        $newRestaurant = new Restaurant();
        $newRestaurant->user_id = $user_id;
        $newRestaurant->name = $request->validated('name');
        $newRestaurant->address = $request->validated('address');
        $newRestaurant->piva = $request->validated('piva');
        $newRestaurant->photo = $photoPath;
        $newRestaurant->save();
        $newRestaurant->typologies()->attach($request->validated('typologies'));

        return redirect('/admin/restaurant');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    public function edit()
    {
        $user_id = Auth::user()->id;
        $userRestaurant = User::find($user_id)->restaurant()->first();
        $typologies = Typology::all();

        return view("restaurant.edit", compact("userRestaurant", "typologies"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRestaurantRequest $request, string $id)
    {
        $restaurant = Restaurant::find($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'piva' => 'required|string|max:255|unique:restaurants,piva,' . $id, // Escludi il ristorante corrente dall'univocità
            'typologies' => 'required|array',
            'typologies.*' => 'exists:typologies,id',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $restaurant->name = $request->input('name');
        $restaurant->address = $request->input('address');
        $restaurant->piva = $request->input('piva');


        if ($request->has('typologies')) {
            $restaurant->typologies()->sync($request->input('typologies'));
        }
        if ($request->hasFile('photo')) {

            Storage::disk('public')->delete($restaurant->photo);
            $photoPath = asset('storage') . '/' . Storage::disk('public')->put('uploads', $request->file('photo'));
            $restaurant->photo = $photoPath;
        }

        $restaurant->save();

        return redirect('/admin/restaurant');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
