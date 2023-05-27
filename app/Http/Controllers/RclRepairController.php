<?php

namespace App\Http\Controllers;

use App\Models\RclRepair;
use Illuminate\Http\Request;

class RclRepairController extends Controller
{
    public function index()
    {

        $repairList = RclRepair::get();
        return response()->json([
            'status' => 200,
            'message' => 'get',
            'repairList' => $repairList,
        ]);

    }
    public function create(Request $request) {

        RclRepair::create([
            'recycler_id'=> $request['recycler_id'],
            'theme_id'=> $request['theme_id'],
            'solution_id'=> $request['solution_id'],
        ]);

        $repairList = RclRepair::get();
        return response()->json([
            'status' => 200,
            'message' => 'get',
            'repairList' => $repairList,
        ]);
    }
}
