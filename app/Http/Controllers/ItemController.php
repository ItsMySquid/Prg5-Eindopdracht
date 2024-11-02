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

        $items = Item::query()
            ->where('status', 1) // Alleen items met 'status' 1
            ->with('category'); // Eager load de 'category' relatie

        if ($filter->filled('search')) {
            $items->where('name', 'like', '%' . $filter->input('search') . '%'); // Gebruik LIKE voor gedeeltelijke zoekopdrachten
        }

        if ($filter->filled('category_id')) {
            $items->where('category_id', $filter->input('category_id'));
        }

        $items = $items->get();

        return view('item.index', compact('items', 'category'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('item.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0|max:10000000',
            'category_id' => 'required|exists:categories,id',
        ]);

        $item = new Item();
        $item->user_id = auth()->user()->id;
        $item->name = $validatedData['name'];
        $item->price = $validatedData['price'];
        $item->category_id = $validatedData['category_id'];
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0|max:10000000',
            'category_id' => 'required|exists:categories,id',
        ]);

        $item = new Item();
        $item->user_id = auth()->user()->id;
        $item->name = $validatedData['name'];
        $item->price = $validatedData['price'];
        $item->category_id = $validatedData['category_id'];
        $item->save();

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

    public function toggleStatus($id)
    {
        $item = Item::findOrFail($id);

        $item->status = !$item->status;
        $item->save();

        return redirect()->route('dashboard');
    }

}
