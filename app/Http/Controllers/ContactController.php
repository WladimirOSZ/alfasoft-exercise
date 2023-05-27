<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\StoreContactRequest;
use App\Http\Services\ContactService;


class ContactController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth')->except('index');
    // }


    public function index(){
        $contacts = Contact::all();
        return view('dashboard', compact('contacts'));
    }

    public function show(Contact $contact){
        return view('contacts.show', compact('contact'));
    }

    public function create(){
        return view('contacts.create');
    }

    public function store(StoreContactRequest $request){
        ContactService::store($request);
        return redirect()->route('contacts.index');
    }

    public function edit(Contact $contact){
        return view('contacts.edit', compact('contact'));
    }

    public function update(Contact $contact, StoreContactRequest $request){
        ContactService::update($contact, $request);
        return redirect()->route('contacts.index');
    }

    public function destroy(Contact $contact){
        ContactService::destroy($contact);
        return redirect()->route('contacts.index');
    }



}
