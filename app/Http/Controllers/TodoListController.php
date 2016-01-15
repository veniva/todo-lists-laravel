<?php

namespace App\Http\Controllers;

use App\TodoList;
use Illuminate\Http\Request;

use App\Http\Requests;

class TodoListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');//authorized access only
    }

    public function index(Request $request, TodoList $list)
    {
        $this->authorize('show', $list);//is the user authorized to view this list

        return view('lists.list', [
            'list' => $list,
            'tasks' => $list->tasks()->paginate(),
            'page' => $request->get('page'),
        ]);
    }
}
