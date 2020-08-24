<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Common\Entities\Newsletter;

class NewsletterController extends Controller
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
            'name' => '',
            'email' => 'required|email',
            'agreementWithTerms' => ''
        ]);

        $newsletterUser = Newsletter::create($data);
        if ($newsletterUser->exists()) {
            return back()->with('success', __('success-subscribe-newsletter'));
        }
        return back()->with('error', __('error-subscribe-newsletter'));
    }
}
