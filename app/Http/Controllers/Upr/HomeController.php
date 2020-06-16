<?php

namespace App\Http\Controllers\Upr;

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

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();
        $homes = Home::all()->where('user_id', $userId);
        $messages = DB::table('homes')
            ->rightJoin('messages', 'homes.id', '=', 'messages.home_id')
            ->where('user_id', $userId)
            ->get();
            // dd($messages);
        return view('upr.homes.index', compact('homes', 'messages'));
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
        // dd($data);
        $data['user_id'] = Auth::id();
        if (!isset($data['path'])) {
          return redirect()->back()
          ->with('failure', 'Inserisci una foto');
        }

        $path = Storage::disk('public')->put('images', $data['path']);
        // dd($path);
        $data['path'] = $path;
        // dd($data->['path']);
        $validator = Validator::make($data, [
            'name' => 'required|string|max:50',
            'n_rooms' => 'required|integer|min:1|max:20',
            'n_beds' => 'required|integer|min:1|max:40',
            'path' => 'required|string',
            'n_bath' => 'required|integer|min:1|max:20',
            'mq' => 'required|integer|min:20|max:10000',
            'services' => 'array',
            'services.*'=> 'exists:services,id',
            'address' => 'required|string',
            'long' => 'required|string',
            'lat' => 'required|string',
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
            ->with('failure', 'Salvataggio della casa ' . $home->name . ' fallito');
        }
        if(isset($data['services'])) {//se esiste il data service faccio attach per collegare la tab. ponte
            $home->services()->attach($data['services']);
        }

        return redirect()->route('upr.homes.show', $home->id)
        ->with('success', 'Salvataggio della casa ' . $home->name . ' riuscito');


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

        if ($userId!=$home->user_id) {
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
        $userId = Auth::id();
        $home = Home::findOrFail($id);
        $services = Service::all();

        if ($userId!=$home->user_id) {
            return redirect()->route('upr.homes.index')
            ->with('failure', 'Non sei autorizzato a vedere questa sezione');
        }

        return view('upr.homes.edit', compact('home', 'services'));
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
        $home = Home::findOrfail($id);
        $data = $request->all();
        // dd($data['path']);
        $data['user_id'] = Auth::id();
        if (isset($data['path'])) {
            Storage::disk('public')->delete($home['path']);
            $path = Storage::disk('public')->put('images', $data['path']);
            $data['path'] = $path;
        }
        // $pathOld = $home->path;
        // dd($pathOld);
        $data['long'] = '1234';
        $data['lat'] = '1234';
        $data['address'] = 'via roma';
        // dd($data->['path']);
        $validator = Validator::make($data, [
            'name' => 'required|string|max:50',
            'n_rooms' => 'required|integer|min:1|max:20',
            'n_beds' => 'required|integer|min:1|max:40',
            // 'path' => 'required',
            'n_bath' => 'required|integer|min:1|max:20',
            'mq' => 'required|integer|min:20|max:10000',
            'services' => 'required|array',
            'services.*'=> 'exists:services,id',
            // 'address' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $home->fill($data);
        $updated = $home->update();
        if (!$updated) {
            return redirect()->back()
            ->with('failure', 'La modifica della casa ' . $home->name . ' fallito');
        }
        $home->services()->sync($data['services']);

        return redirect()->route('upr.homes.show', $home->id)
        ->with('success', 'Salvataggio della casa ' . $home->name . ' riuscito');

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

        if ($userId!=$home->user_id) {
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
        ->with('success', 'Cancellazione della casa ' . $home->name . ' riuscita');



    }
}
