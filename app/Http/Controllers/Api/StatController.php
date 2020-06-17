<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Stat;

class StatController extends Controller
{
    public function getAll()
    {
        $stats = Stat::all();

        return response()->json([
            'result' => 'success',
            'data' => $stats,
            'count' => $stats->count()
        ]);
    }
}
