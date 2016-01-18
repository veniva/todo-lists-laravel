<?php

namespace App\Http\Controllers;

use App\TodoList;

use App\Http\Requests;

abstract class BaseController extends Controller
{
    /**
     * @var \Illuminate\Database\Eloquent\Collection|static[]
     */
    protected $lists;

    public function __construct()
    {
        $this->middleware('auth');//authorized access only

        $this->lists = $lists = TodoList::all();
    }
}