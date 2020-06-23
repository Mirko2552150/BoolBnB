<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Home;

class SearchController extends Controller
{
    public function getFilter(Request $request)
    {
        $homes = Home::all();
        $data = $request->all();
        $inputRange = $data['range']; // prendiamo l'input del raggio inserito dall'utente
        $dataLat = $data['lat'];
        $dataLon = $data['long'];
        dd($data);

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
        return response()->json([
            'result' => 'success',
            'data' => $homesFiltrate
        ]);
    }

}
