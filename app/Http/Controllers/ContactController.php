<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
public function showContact(?string $id = null) {
    $company = 'Skymarkt';
    return view('contact', ['company' => $company, 'id' => $id]);
}
}
