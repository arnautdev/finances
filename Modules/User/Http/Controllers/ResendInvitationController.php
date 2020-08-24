<?php

namespace Modules\User\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class ResendInvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(User $user)
    {
        return view('user::index');
    }
}
