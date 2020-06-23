<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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
        // $homes = Home::all()
        // ->sortBy('created_at', 'asc')
        // ->get();
        $homes = Home::whereDate('created_at', '<', Carbon::now()) // prendiamo tutte le case
        ->orderBy('created_at', 'desc') // ordiniamo rispetto alla data di creazione
        ->get();
        // dd($homes);
        return view('guest.homes.index', compact('homes'));
    }

    public function search(Request $request) // qui prendiamo i dati del form algolia (lat-long)
    {
        // dd($request->all());
        $homes = Home::all();
        $services = Service::all();
        $data = $request->all();
        $inputRange = $data['range']; // prendiamo l'input del raggio inserito dall'utente
        $dataLat = $data['lat'];
        $dataLon = $data['long'];

         // funzione che calcola raggio di inclusione case tramite long e lat
        function distanza($latApp, $lonApp, $latForm, $lonForm, $unit)
        {
            $theta = $lonApp - $lonForm;
            $dist = rad2deg(acos(sin(deg2rad($latApp)) * sin(deg2rad($latForm)) + cos(deg2rad($latApp)) * cos(deg2rad($latForm)) * cos(deg2rad($theta))));
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

        // $inputRange = 20000; // esempio input selezionato da UTENTE GUEST: da inserire barra per utente
        $homesFiltrate = [];
        foreach ($homes as $key => $home) {
            $homeLat = $home->lat;
            $homeLon = $home->long;
            $distanzaHome = distanza($homeLat, $homeLon, $dataLat, $dataLon, 'K');
            $home['distanza'] = $distanzaHome;
            if ($home['distanza'] <= $inputRange) {
                $homesFiltrate[] = $home;
            }
        }

        // funzione per ordinare l'array $homesFiltrate per distanza
        function array_sort_by_column(&$array, $column, $direction = SORT_ASC) {
            $reference_array = array();
            foreach($array as $key => $row) {
                $reference_array[$key] = $row[$column];
            }
            array_multisort($reference_array, $direction, $array);
        }
        array_sort_by_column($homesFiltrate, 'distanza');


        // dd($homesFiltrate);


        return view('guest.homes.search', compact('homesFiltrate', 'services'))->with('dataLat', $dataLat)->with('dataLon', $dataLon);
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
