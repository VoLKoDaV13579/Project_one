<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecyclerRequest;
use App\Http\Requests\RecyclerUpdateRequest;
use App\Models\RecyclerList;
use Illuminate\Http\Request;

class RecyclerListController extends Controller
{
    public function index()
    {
        $listOfRecycler = RecyclerList::get();
        return response()->json($listOfRecycler);
    }
    public function create (RecyclerRequest $request) 
    {
        $validated = $request->validated(); 

        RecyclerList::create([
            'status' => $validated['status'],
            'system_id' => $validated['system_id'],
            'address'=> $validated['address'],
            'serial_number'=>$validated['serial_number']
        ]);
        $listOfRecycler = RecyclerList::get();
        return response()->json([
            'status' => 200,
            'message' => 'created',
            'listOfRecycler' => $listOfRecycler 
        ]);
    }

    public function update(RecyclerUpdateRequest $request)
    {
        $validated = $request->validated(); 

        $recycler = RecyclerList::find($request['id']);
        $recycler->status = $validated ['status'];
        $recycler->address = $validated ['address'];
        $recycler->save();

        $listOfRecycler = RecyclerList::get();
        return response()->json([
            'status' => 200,
            'message' => 'updated',
            'listOfRecycler' => $listOfRecycler 
        ]);
        
    }
    public function delete(Request $request)
    {
        $recycler = RecyclerList::find($request['id']);
        $recycler->delete();
        
        $listOfRecycler = RecyclerList::get();
        return response()->json([
            'status' => 200,
            'message' =>'deleted',
            'listOfRecycler' => $listOfRecycler
        ]);
    }
}
