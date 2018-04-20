<?php

namespace App\Http\Controllers;

use App\ContentRelationships;
use Illuminate\Http\Request;

class ContentRelationshipsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
