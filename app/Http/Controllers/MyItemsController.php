<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyItemsController extends Controller
{
    // In je ItemsController
    public function showItems() {
        $user_id = auth()->user()->id;

        if (!$user_id) {
            return redirect()->route('login')->with('error', 'You need to be logged in to view your items.');
        }

        // Haal alle items op die toebehoren aan de ingelogde gebruiker
        $items = Item::where('user_id', $user_id)->get();

        // Geef de items door aan de view
        return view('my-items', compact('items'));
    }

}
