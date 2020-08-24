<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Common\Entities\Newsletter;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['newsletter'] = (new Newsletter())->rows();
        return view('dashboard::newsletter.index', compact('data'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show(Newsletter $d_newsletter)
    {
        $data['newssleter'] = $d_newsletter;
        return view('dashboard::newsletter.show', compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Newsletter $d_newsletter)
    {
        if ($d_newsletter->exists() && $d_newsletter->delete()) {
            return back()->with('success', __('success-delete-subscriber'));
        }
    }
}
