<?php

namespace App\Http\Controllers\Upr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


use App\Message;
use App\Home;
use App\User;
use App\Service;
use App\InfoUser;


class MessageController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $userId = Auth::id();
        $messageFindorFail = Message::findOrFail($id);
        // dd($message);
        $messages = DB::table('homes')
            ->rightJoin('messages', 'homes.id', '=', 'messages.home_id')
            ->where('user_id', $userId)
            ->get();
        $message = $messages->where('id',$id)->first();
        // dd($message->user_id);
        // dd($messageFindorFail);

        if ($userId != $message->user_id) {
            return redirect()->route('upr.homes.index')
            ->with('failure', 'Non sei autorizzato ad eliminare questo messaggio');
        }


        $deleted = $messageFindorFail->delete();

        if (!$deleted) {
            return redirect()->route('upr.homes.index')
            ->with('failure', 'Cancellazione messaggio non avvenuta');
        }

        return redirect()->route('upr.homes.index')
        ->with('success', 'Cancellazione del messaggio di ' . $messageFindorFail->mail . ' riuscita');
    }
}
