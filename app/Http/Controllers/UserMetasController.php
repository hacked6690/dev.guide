<?php

namespace App\Http\Controllers;

use Auth;
use Session;

use App\UserMetas;
use Illuminate\Http\Request;

class UserMetasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

}
