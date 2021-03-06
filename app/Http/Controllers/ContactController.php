<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\LayoutResolver;

class ContactController extends Controller
{
    use LayoutResolver;

    protected $page  = 'contact';
    protected $title = 'Dados de Contato';

    public function edit()
    {
        $this->viewAttributes['contact'] = Contact::first();
        return view('admin.contact.form', $this->viewAttributes);
    }

    public function save(Request $request)
    {
        $contact = Contact::firstOrNew(['id' => 1]);
        $contact->telephone = $request->input('telephone');
        $contact->email     = $request->input('email');
        $contact->postal_code = $request->input('postal_code');
        $contact->address = $request->input('address');
        $contact->city    = $request->input('city');
        $contact->state   = $request->input('state');

        if ($contact->save()) {
          return redirect()->route('admin::contact:edit')->with('success', ["Dados salvos com sucesso!"]);
        }
    }
}
