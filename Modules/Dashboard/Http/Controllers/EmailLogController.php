<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class EmailLogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['emails'] = DB::table('email_log')->orderBy('id','DESC')->get();
        return view('dashboard::email-log.index', compact('data'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $data['email'] = DB::table('email_log')->where('id', '=', $id)->first();
        return view('dashboard::email-log.show', compact('data'));
    }
}
