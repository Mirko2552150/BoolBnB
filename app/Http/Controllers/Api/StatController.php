<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Stat;

class StatController extends Controller
{
    public function getAll()
    {
        $stats = Stat::all();

        return response()->json([
            'result' => 'success',
            'data' => $stats
        ]);
    }
}
