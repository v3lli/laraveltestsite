<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    //
    public function index()
    {
        return response()->json(Website::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url',
        ]);

        $website = Website::create($request->only('name', 'url'));
        return response()->json($website, 201);
    }
}
