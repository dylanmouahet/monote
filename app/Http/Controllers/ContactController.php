<?php

namespace App\Http\Controllers;

use App\models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function send(Request $request)
    {
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) 
        {
            msg_flash("L'adresse email est invalide", "danger");
            return back();
        }

        if (strlen($request->subject) < 3 || $request->subject == '')
        {   
            msg_flash("Le champ sujet est requis et dois contenir au moins 3 caracteres", "danger");
            return back();
        }

        if (strlen($request->message) < 10 || $request->message == '') 
        {
            msg_flash("Le champ message est requis et dois contenir au moins 10 caracteres", "danger");
            return back();
        }

        Message::create([
                'user_id' => Auth::user()->id,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
        ]);

        msg_flash("Votre message a été envoyé.", "success");
        return back();
         
    }
}
