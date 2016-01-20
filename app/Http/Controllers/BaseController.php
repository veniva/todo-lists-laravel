<?php

namespace App\Http\Controllers;


use App\Http\Requests;

abstract class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');//authorized access only
    }
}