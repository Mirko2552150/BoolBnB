<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\Home;
use App\User;
use App\Message;
use App\Service;
use App\InfoUser;
use App\Stat;

class StatController extends Controller
{
    // public function create()
    // {
    //     return view('guest.messages.create');
    // }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request, $home_id)
    {
        $data = $request->all();
        $home = Home::findOrFail($home_id);
        $data['home_id'] = $home_id;
        // dd($data);
        $stat = new Stat;
        $stat->fill($data);
        $stat->save();

        return redirect()->route('guest.homes.show', compact('home'));
    }

}
