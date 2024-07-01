<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $details = [
            'title' => 'Mensaje de Contacto',
            'email' => $request->email,
            'message' => $request->message
        ];

        Mail::to('lablancastore.aqp@gmail.com')->send(new ContactMail($details));

        return back()->with('success', 'Tu mensaje ha sido enviado con éxito.');
    }
}
