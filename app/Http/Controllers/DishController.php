<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDishRequest;
use Illuminate\Http\Request;
use App\Models\Dish;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class DishController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $userRestaurant = User::find($user_id)->restaurant()->first();
        $restaurant_id = $userRestaurant->id;
        $restaurantDishes = Dish::where('restaurant_id', $restaurant_id)->get();

        return view('dish.index', compact('restaurantDishes'));
    }

    public function create()
    {
        return view('dish.create');
    }

    public function store(StoreDishRequest $request)
    {
        $user_id = Auth::user()->id;
        $userRestaurant = User::find($user_id)->restaurant()->first();
        $restaurant_id = $userRestaurant->id;
        $photoPath = asset('storage') . '/' . Storage::disk('public')->put('uploads', $request->validated('photo'));
        
        $newDish = new Dish();
        $newDish->restaurant_id = $restaurant_id;
        $newDish->name = $request->validated('name');
        $newDish->description = $request->validated('description');
        $newDish->ingredients = $request->validated('ingredients');
        $newDish->visible = $request->validated('visible');
        $newDish->price = $request->validated('price');
        $newDish->photo = $photoPath;
        $newDish->save();

        return redirect('/admin/restaurant/dish');
    }
}
