<?php

namespace App\Http\Controllers;

use App\Mail\Contact as MailContact;
use App\Managers\RuleManager;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('admin/contact/list',['contacts' => Contact::all()]);
    }

    public function sendForm()
    {
        return view('contact/form');
    }

    public function send(Request $request, RuleManager $manager)
    {
        $contact = new Contact([
            'name' => $request->name,
            'email' => $request->email,
            'company' => $request->company,
            'message' => $request->message
        ]);
        $contact->save();
        $users = $manager->getUsersAuthorized('contact');
        if(count($users) == 0) {
            $this->errorFlash($request, 'Votre message n\'a pu être envoyé, il n\'existe aucun destinataire');
            return redirect('/');
        }
        Mail::to($users)->send(new MailContact($contact));

        $this->successFlash($request, 'Votre message à été envoyé');
        return redirect('/');
    }
}
