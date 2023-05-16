<?php

namespace App\Http\Controllers;

use App\Models\RecyclerThemes;
use Illuminate\Http\Request;

class RecyclerThemesController extends Controller
{
    public function index()
    {
        $themeList = RecyclerThemes::get();
        return response()->json($themeList);
    }


    public function createTheme(Request $request)
    {
        RecyclerThemes::get([
            'title' => $request['title'],
            'description' => $request['description'],

        ]);
        $listOfThemes = RecyclerThemes::get();
        return response()->json([
            'status' => 200,
            'message' => 'created',
            'themeList' => $listOfThemes, 
        ]);
    }



    public function updateTheme(Request $request)
    {
        $theme = RecyclerThemes::find($request['id']);
        $theme->title = $request['title'];
        $theme->description = $request['description'];

        $listOfThemes = RecyclerThemes::get();
        return response()->json([
            'status' => 200,
            'message' => 'updated',
            '$listOfThemes' => $listOfThemes,
        ]);

    }

    public function deleteTheme(Request $request)
    {
        $theme = RecyclerThemes::find($request['id']);
        $theme->delete();

        $listOfThemes = RecyclerThemes::get();
        return response()->json([
            'status' => 200,
            'message' => 'deleted',
            '$listOfThemes' => $listOfThemes,
        ]);

    }
}
