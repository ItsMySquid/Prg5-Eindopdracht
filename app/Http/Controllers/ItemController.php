<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $filter)
    {
        $category = Category::all();

        $items = Item::query();

        if ($filter->filled('category_id')){
            $items->where('category_id', $filter->input('category_id'));
        }

        $items = $items->with('category')->get();

        return view('item.index', compact('items', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('item.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $item = new Item();

//        $request->validate([]); // zelf opzoeken als validatie
        $item->user_id = auth()->user()->id;
        $item->name = $request->input('name');
        $item->price = $request->input('price');
        $item->category_id = 1;
        $item->save();

        return redirect()->route('items.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Item::find($id);
        return view('item.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Item::find($id);
        return view('item.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        // Velden opslaan in de database
        $item->user_id = auth()->user()->id;
        $item->name = $request->input('name');
        $item->price = $request->input('price');
        $item->category_id = 1;
        $item->save();

        // Sla de wijzigingen op
        $item->save();

        // Redirect terug naar de items pagina met een succesmelding
        return redirect()->route('items.show', $item->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::find($id);
        $item->delete();
        return redirect()->route('items.index');
    }
}
