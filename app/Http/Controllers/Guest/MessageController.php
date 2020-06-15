<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Message;

class MessageController extends Controller
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
    public function store(Request $request)
    {
        $data = $request->all();
        // dd($id);
        // dd($data);
        $validator = Validator::make($data, [
            'mail' => 'required|string|email',
            'body' => 'required|string',
            'home_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }


        $message = new Message;
        $message->fill($data);
        $saved = $message->save();

        if (!$saved) {
            return redirect()->back()
            ->with('failure', 'Invio del messaggio fallito');
        }

        return redirect()->back()
        ->with('success', 'Invio messaggio riuscito');
    }
}
