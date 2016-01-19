<?php

namespace App\Http\Controllers;

use App\TodoList;
use Illuminate\Http\Request;

use App\Http\Requests;

class TodoListController extends BaseController
{
    public function index(Request $request, TodoList $list)
    {
        $this->authorize('store', $list);//check if the user owns this list

        $page = $request->get('page');

        return view('lists.list', [
            'list' => $list,
            'tasks' => $list->tasks()->paginate(config('pagination.per_page')),
            'page' => $page ? $page : 1,
            'title' => $list->title,
            'lists' => $this->lists,
        ]);
    }

    public function add(Requests\StoreTodoListRequest $request)
    {

        $list = $request->user()->todoLists()->create([
            'title' => $request->title
        ]);

        return redirect('/lists/'.$list->id)->with('success', 'The todo list has been created successfully');
    }

    public function editGet(TodoList $list)
    {
        $this->authorize('store', $list);//check if the user owns this list

        return view('lists.edit', [
            'list' => $list,
            'lists' => $this->lists,
        ]);
    }

    public function editPost(Requests\StoreTodoListRequest $request, TodoList $list)
    {
        $this->authorize('store', $list);//check if the user owns this list

        $list->title = $request->title;
        $list->save();

        return redirect('/')->with('success', 'The list name has been edited successfully');
    }

    public function delete(TodoList $list)
    {
        $this->authorize('store', $list);//check if the user owns this list

        $list->delete();

        return redirect('/')->with('info', 'The list has been deleted successfully');
    }
}
