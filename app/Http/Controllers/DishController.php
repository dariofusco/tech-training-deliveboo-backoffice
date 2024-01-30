<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDishRequest;
use App\Http\Requests\UpdateDishRequest;
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

    public function edit(string $id)
    {
        $dish = Dish::find($id);

        return view("dish.edit", compact("dish"));
    }

    public function update(UpdateDishRequest $request, string $id)
    {
        $dish = Dish::find($id);
        $dish->name = $request->validated('name');
        $dish->description = $request->validated('description');
        $dish->ingredients = $request->validated('ingredients');
        $dish->visible = $request->validated('visible');
        $dish->price = $request->validated('price');
        if ($request->hasFile('photo')) {
            Storage::disk('public')->delete($dish->photo);
            $photoPath = asset('storage') . '/' . Storage::disk('public')->put('uploads', $request->file('photo'));
            $dish->photo = $photoPath;
        }
        $dish->save();

        return redirect('/admin/restaurant/dish')->with('updated', 'Il piatto ' . $dish->name . ' è stato aggiornato');
    }

    public function destroy(string $id)
    {
        $dish = Dish::find($id);
        $dishName = $dish->name;
        $dish->delete();

        return redirect('/admin/restaurant/dish')->with('deleted', 'Il piatto ' . $dishName . ' è stato eliminato');
    }
}
