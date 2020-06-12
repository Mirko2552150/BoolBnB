<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $homes = Home::all();
        return view('guest.index', compact('homes'));
    }

    public function show($id)
    {
        $home = Home::findOrFail($id);

        return view('guest.show', compact('home'));
    }
}
