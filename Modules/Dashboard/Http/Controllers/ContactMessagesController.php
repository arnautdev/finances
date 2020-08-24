<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Common\Entities\Contact;

class ContactMessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['messages'] = (new Contact())->rows();
        return view('dashboard::contact-messages.index', compact('data'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show(Contact $contact_message)
    {
        // update read at
        if (is_null($contact_message->read_at)) {
            $contact_message->update(['read_at' => date('Y-m-d H:i:s')]);
        }
        $data['message'] = $contact_message;
        return view('dashboard::show', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, Contact $contact_message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Contact $contact_message)
    {
        if ($contact_message->exists() && $contact_message->delete()) {
            return back()->with('success', __('success-delete-message'));
        }
        return back()->with('error', __('error-delete-message'));
    }
}
