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
        $userRestaurantTypologies = $userRestaurant->typologies;
        return view("restaurant.index", compact("userRestaurant", "userRestaurantTypologies"));
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

        //todo: vanno aggiunte le categorie sia qui che nella create per selezionarle

        return redirect('/admin/restaurant');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
