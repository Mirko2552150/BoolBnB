<?php

namespace App\Http\Controllers\Upr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Home;
use App\User;
use App\InfoUser;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $userId = Auth::id(); // metto in variabile utente registrato
      // $infoUsers = InfoUser::all(); // find or fail cerca primary key
      // $infoUser = $infoUsers->where('user_id', $userId);
      // // dd($user);
      // if ($userId = $infoUser->user_id) { // se utente LOG e diverso dal creatore della HOME, restuisce errore
      //   abort('404');
      // }

      // $homes = Home::findOrFail($userId);
      $homes = Home::all()->where('user_id', $userId);;
      // $infoUser = $infoUsers->where('user_id', $userId);
      // if ($userId != $homes->user_id) {
      //   abort('Utente non riconosciuto');
      // }

      return view('upr.homes.index', compact('homes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

      return view('upr.homes.show', compact('home'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
