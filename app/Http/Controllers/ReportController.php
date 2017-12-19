<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function create(Request $request, $id)
    {
    	DB::table('reports')->insert([
    		'post_id' => $id,
    		'reason'  => $request->reason
    	]);

    	return response()->json('radi');
    }
}
