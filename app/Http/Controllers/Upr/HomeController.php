<?php

namespace App\Http\Controllers\Upr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\Home;
use App\User;
use App\Service;
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
        $services = Service::all();

        return view('upr.homes.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();

        $path = Storage::disk('public')->put('images', $data['path']);
        // dd($path);
        $data['path'] = $path;
        $data['long'] = '1234';
        $data['lat'] = '1234';
        $data['address'] = 'via roma';
        // dd($data->['path']);
        $validator = Validator::make($data, [
            'name' => 'required|string|max:50',
            'n_rooms' => 'required|integer|min:1|max:20',
            'n_beds' => 'required|integer|min:1|max:40',
            'n_bath' => 'required|integer|min:1|max:20',
            'mq' => 'required|integer|min:20|max:10000',
            // 'address' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $home = new Home;
        $home->fill($data);
        $saved = $home->save();

        if (!$saved) {
            return redirect()->back()
            ->with('failure', 'Salvataggio della casa ' . $home->id . ' fallito');
        }

        return redirect()->route('upr.homes.show', $home->id)
        ->with('success', 'Salvataggio della casa ' . $home->id . ' riuscito');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userId = Auth::id();
        $home = Home::findOrFail($id);

        if ($userId!=$id) {
            return redirect()->route('upr.homes.index')
            ->with('failure', 'Non sei autorizzato a vedere questa sezione');
        }

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
        $userId = Auth::id();
        $home = Home::findOrFail($id);

        if ($userId!=$id) {
            return redirect()->route('upr.homes.index')
            ->with('failure', 'Non sei autorizzato ad eliminare questa casa');
        }

        $home->services()->detach();
        Storage::disk('public')->delete($home['path']);
        $deleted = $home->delete();

        if (!$deleted) {
            return redirect()->route('upr.homes.index')
            ->with('failure', 'Cancellazione non avvenuta');
        }

        return redirect()->route('upr.homes.index')
        ->with('success', 'Cancellazione della casa ' . $home->id . ' riuscita');



    }
}
