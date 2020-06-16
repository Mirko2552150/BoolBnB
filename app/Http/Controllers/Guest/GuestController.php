<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\Home;
use App\User;
use App\Service;
use App\InfoUser;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $homes = Home::all();
        return view('guest.homes.index', compact('homes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $home = Home::findOrFail($id);

        if (Auth::check()) {
          $userId = Auth::id();
          $user = User::findOrFail($userId);
          return view('guest.homes.show', compact('home', 'user'));
        }


        return view('guest.homes.show', compact('home'));
    }
}
