<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Common\Entities\Contact;

class ContactController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'subject' => '',
            'email' => '',
            'phone' => '',
            'message' => '',
            'agreementWithTerms' => '',
        ]);

        $message = Contact::create($data);
        if ($message->exists()) {
            return back()->with('success', __('success-send-message'));
        }
        return back()->with('error', __('error-send-message'));
    }
}
