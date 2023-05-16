<?php

namespace App\Http\Controllers;

use App\Models\RecyclerList;
use Illuminate\Http\Request;

class RecyclerListController extends Controller
{
    public function index()
    {
        $listOfRecycler = RecyclerList::get();
        return response()->json($listOfRecycler);
    }
    public function create (Request $request) 
    {
        RecyclerList::create([
            'status' => $request['status'],
            'system_id' => $request['system_id'],
            'address'=> $request['address'],
            'serial_number'=>$request['serial_number']
        ]);
        $listOfRecycler = RecyclerList::get();
        return response()->json([
            'status' => 200,
            'message' => 'created',
            'listOfRecycler' => $listOfRecycler 
        ]);
    }

    public function update(Request $request)
    {
        $recycler = RecyclerList::find($request['id']);
        $recycler->status = $request['status'];
        $recycler->system_id = $request['system_id'];
        $recycler->address = $request['address'];
        $recycler->serial_number = $request['serial_number'];
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
