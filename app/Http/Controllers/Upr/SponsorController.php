<?php

namespace App\Http\Controllers\Upr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\Home;
use App\User;
use App\Message;
use App\Service;
use App\InfoUser;
use App\Stat;
use App\Sponsor;
use App\SponsorType;
use Braintree\Gateway;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $token = $gateway->ClientToken()->generate();
        $sponsorsType = SponsorType::all();

        return view('upr.homes.sponsor', [
            'token' => $token,
            'home_id' => $id,
            'sponsors_type' => $sponsorsType
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $data = $request->all();
        $userId = Auth::id();
        $now = Carbon::now();

        $data['home_id'] = $id;
        if ($data['amount'] == "2.99") {
            $data['sponsor_type_id'] = 1;
            $now->addHours(24);
            $data['expired'] = $now;
        } elseif ($data['amount'] == "5.99") {
            $data['sponsor_type_id'] = 2;
            $now->addHours(72);
            $data['expired'] = $now;
        } elseif ($data['amount'] == "9.99") {
            $data['sponsor_type_id'] = 3;
            $now->addHours(144);
            $data['expired'] = $now;
        } else {
            return redirect()->back()
            ->with('failure', 'Pagamento fallito amount');
        }


        $home = Home::findOrFail($id);

        if ($userId!=$home->user_id) {
            return redirect()->route('upr.homes.index')
            ->with('failure', 'Non sei autorizzato a vedere questa sezione');
        }

        $sponsor = new Sponsor;
        $sponsor->fill($data);
        $saved = $sponsor->save();

        if (!$saved) {
            return redirect()->back()
            ->with('failure', 'Pagamento fallito');
        }

        return redirect()->route('upr.homes.index')
        ->with('success', 'Pagamento riuscito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
