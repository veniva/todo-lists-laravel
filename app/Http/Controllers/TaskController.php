<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

use App\Http\Requests;

class TaskController extends BaseController
{
    public function add(Requests\StoreTaskRequest $request)
    {
        $request->user()->tasks()->create([
            'todo_list_id' => $request->todo_list_id,
            'description' => $request->description
        ]);
        return redirect('/lists/'.$request->todo_list_id.'?page='.$request->get('page'))->with('success', 'The task has been added successfully');
    }

    public function delete(Request $request, Task $task)
    {
        $this->authorize('store', $task);

        $listID = $task->todo_list_id;
        $task->delete();

        $lastPage = \App\TodoList::find($listID)->tasks()->paginate(config('pagination.per_page'))->lastPage();//last possible page
        $page = $request->get('page');//current page
        $page = $page <= $lastPage ? $page : $lastPage;//calculate the possible page

        return redirect('/lists/'.$listID.'?page='.$page)->with('info', 'The task has been deleted successfully');
    }

    public function editGet(Task $task, $page)
    {
        $this->authorize('store', $task);

        return view('tasks.edit', [
            'task' => $task,
            'page' => $page,
        ]);
    }

    public function editPost(Requests\StoreTaskRequest $request, Task $task, $page)
    {
        $this->authorize('store', $task);

        $task->description = trim($request->description);
        $task->save();

        return redirect('/lists/'.$task->todo_list_id.'?page='.$page)->with('success', 'The task has been edited successfully');
    }
}
