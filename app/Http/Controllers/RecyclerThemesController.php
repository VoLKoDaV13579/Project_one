<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThemeRequest;
use App\Models\RecyclerThemes;
use Illuminate\Http\Request;

class RecyclerThemesController extends Controller
{
    public function index()
    {
        $listOfThemes = RecyclerThemes::get();
        return response()->json([
            'status' => 200,
            'message' => 'created',
            'listOfThemes' => $listOfThemes, 
        ]);
    }


    public function create(ThemeRequest $request)
    {
        $validated = $request->validated();

        RecyclerThemes::create([
            'title' => $validated['title'],
            'description' => $validated['description'],

        ]);
        $listOfThemes = RecyclerThemes::get();
        return response()->json([
            'status' => 200,
            'message' => 'created',
            'listOfThemes' => $listOfThemes, 
        ]);
    }



    public function update(ThemeRequest $request)
    {
        $validated = $request->validated();

        $theme = RecyclerThemes::find($request['id']);
        $theme->title = $validated['title'];
        $theme->description = $validated['description'];
        $theme->save();

        $listOfThemes = RecyclerThemes::get();
        return response()->json([
            'status' => 200,
            'message' => 'updated',
            'listOfThemes' => $listOfThemes,
        ]);

    }

    public function delete(Request $request)
    {
        
        $theme = RecyclerThemes::find($request['id']);
        $theme->delete();

        $listOfThemes = RecyclerThemes::get();
        return response()->json([
            'status' => 200,
            'message' => 'deleted',
            'listOfThemes' => $listOfThemes,
        ]);

    }
}
