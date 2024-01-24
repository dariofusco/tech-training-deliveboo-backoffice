<?php

namespace App\Http\Controllers;

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
        $restaurantDishes = Dish::find($restaurant_id)->all();
        return view('dish.index', compact('restaurantDishes'));
    }

    public function create()
    {
        return view('dish.create');
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $userRestaurant = User::find($user_id)->restaurant()->first();
        $restaurant_id = $userRestaurant->id;
        $photoPath = asset('storage') . '/' . Storage::disk('public')->put('uploads', $request->photo);
        $newDish = new Dish();
        $newDish->restaurant_id = $restaurant_id;
        $newDish->name = $request->name;
        $newDish->description = $request->description;
        $newDish->ingredients = $request->ingredients;
        $newDish->visible = $request->visible;
        $newDish->price = $request->price;
        $newDish->photo = $photoPath;
        $newDish->save();
    }
}
