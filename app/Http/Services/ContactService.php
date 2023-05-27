<?php

namespace App\Http\Services;
use App\Models\Contact;


class ContactService
{
    public static function store($contact)
    {
        Contact::create([
            'name' => $contact->name,
            'contact' => $contact->contact,
            'email' => $contact->email,
        ]);
    }

    public static function update($contact, $updatedContact)
    {
        $contact->update([
            'name' => $updatedContact->name,
            'contact' => $updatedContact->contact,
            'email' => $updatedContact->email,
        ]);
    }

    public static function destroy($contact)
    {
        $contact->delete();
    }

}
