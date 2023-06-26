<?php

namespace App\Http\Controllers;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function  contact ()
    {
        return view ('contact-us');
    }

    public function sendEmail(Request $request): \Illuminate\Http\RedirectResponse
    {
        $detail =[
            'name' => $request-> name,
            'email'=> $request-> email,
            'phone'=> $request->phone ,
            'msg'=> $request-> msg


        ];
        Mail:: to('assembleianacional@parlamento.ao')-> send(new ContactMail($detail));
        return back ()->with('Mensagem Enviada', 'A Sua Mensagem Foi Enviada Com Sucesso');


    }


}
