<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecyclerSolutionsRequest;
use App\Models\RecyclerSolutions;
use Illuminate\Http\Request;

class RecyclerSolutionsController extends Controller
{

    public function index()
    {
        $listOfSolution = RecyclerSolutions::get();
        return response()->json([
            'status' => 200,
            'message' => 'get',
            'listOfSolution' => $listOfSolution  
        ]);
    }
    public function create(Request $request)
    {
        
        RecyclerSolutions::create([
            'theme' => $request['theme'],
            'title' => $request['title'],
        ]);

        $listOfSolution = RecyclerSolutions::get();
        return response()->json([
            'status' => 200,
            'message' =>'created',
            'listOfSolution' => $listOfSolution 
        ]);
    }
    public function update(Request $request)
    {

        $solution = RecyclerSolutions::find($request['id']);
        $solution->theme = $request['theme'];
        $solution->title = $request['title'];
        $solution->save();

        $listOfSolution = RecyclerSolutions::get();
        return response()->json([
            'status' => 200,
            'message' => 'updated',
            'listOfSolution' => $listOfSolution 
        ]);

    }

    public function delete(Request $request)
    {
        
        $solution = RecyclerSolutions::find($request['id']);
        $solution->delete();

        $listOfSolution = RecyclerSolutions::get();
        return response()->json([
            'status' => 200,
            'message' => 'deleted',
            'listOfSolution' => $listOfSolution 
        ]);

    }


}
