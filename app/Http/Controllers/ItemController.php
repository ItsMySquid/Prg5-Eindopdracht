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

        $viewedItems = session()->get('viewed_items', []);

        if (count($viewedItems) < 3) {
            return redirect()->route('items.index')->with('error', 'You must view at least 3 items before creating a new one.');
        }

        return view('item.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0|max:1000000000',
            'category_id' => 'required|exists:categories,id',
        ],[
                'name.required' => 'Please provide a name for the item.',
                'price.required' => 'The item must have a price between 0 and 1.000.000.000.',
                'price.numeric' => 'The price must be a valid number between 0 and 1.000.000.000.',
                'category_id.required' => 'Please select a category.',
                'category_id.exists' => 'The selected category is invalid.',
            ]);

        $item = new Item();
        $item->user_id = auth()->user()->id;
        $item->name = $validatedData['name'];
        $item->price = $validatedData['price'];
        $item->category_id = $validatedData['category_id'];
        $item->status = 1;
        $item->save();

        return redirect()->route('items.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Item::find($id);

        $viewedItems = session()->get('viewed_items', []);

        if (!in_array($id, $viewedItems)) {
            $viewedItems[] = $id;
            session()->put('viewed_items', $viewedItems);
        }

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
            'price' => 'required|numeric|min:0|max:1000000000',
        ],[
            'name.required' => 'Please provide a name for the item.',
            'price.required' => 'The item must have a price between 0 and 1.000.000.000.',
            'price.numeric' => 'The price must be a valid number between 0 and 1.000.000.000.',
        ]);

        $item->name = $validatedData['name'];
        $item->price = $validatedData['price'];
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
