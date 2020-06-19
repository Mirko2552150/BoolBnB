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

    public function search(Request $request) // qui prendiamo i dati del form algolia (lat-long)
    {
        // dd($request->all());
        $homes = Home::all();
        $data = $request->all();
        $dataLat = $data['lat'];
        $dataLon = $data['long'];

         // funzione che calcola raggio di inclusione case tramite long e lat
        function distanza($latApp, $lonApp, $latForm, $lonForm, $unit)
        {
            $theta = $lonApp - $lonForm;
            $dist = rad2deg(acos(sin(deg2rad($latApp)) * sin(deg2rad($latForm)) + cos(deg2rad($latApp)) * cos(deg2rad($latForm)) * cos(deg2rad($theta))));
            // $dist = acos($dist);
            // $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);
            if ($unit == "K") {
                return ($miles * 1.609344);
            // } else if ($unit == "N") {
            //     return ($miles * 0.8684);
            // } else {
            //     return $miles;
            }
        };
        foreach ($homes as $key => $home) {
            $homeLat = $home->lat;
            $homeLon = $home->long;
            $distanzaHome = distanza($homeLat, $homeLon, $dataLat, $dataLon, 'K');
            dd($distanzaHome);
        }
        // Filtriamo tutte le case con i parametri necessari di lat e long
        return view('.homes.search', compact('homesFiltrate'));
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
