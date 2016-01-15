@extends('layouts.app')

@section('content')
    <h1>{{ $list->title }}</h1>
    <div class="panel panel-default">
        <div class="panel-heading">New Task</div>

        <div class="panel-body">
            <!-- Display Validation Errors -->
            @include('common.errors')

            <!-- New Task Form -->
            <form action="{{url('/tasks/add')}}?page={{$page}}" method="POST" class="form-horizontal">
                {{ csrf_field() }}

                <!-- Task Name -->
                <div class="form-group">
                    <label for="task-description" class="col-sm-3 control-label">Task</label>

                    <div class="col-sm-6">
                        <textarea name="description" id="task-description" class="form-control">{{ old('description') }}</textarea>
                    </div>
                </div>

                <!-- Add Task Button -->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <input type="hidden" name="todo_list_id" value="{{$list->id}}" />
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-plus"></i>Add Task
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Current Tasks -->
    @if (count($tasks) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">Current Tasks</div>

            <div class="panel-body">
                <table class="table table-striped task-table">
                    <thead>
                        <th>Task</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td class="table-text"><div>{{ $task->description }}</div></td>
                            <!-- Task Delete Button -->
                            <td>
                                <form action="{{url('/tasks/delete')}}/{{ $task->id }}?page={{$page}}" method="POST">
                                    <a class="btn btn-default" href="{{url('/tasks/edit')}}/{{ $task->id }}/{{$page}}" role="button">Edit</a>
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger delete">
                                        <i class="fa fa-trash"></i>Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $tasks->links() !!}
            </div>
        </div>
    @endif
    <script type="text/javascript">
        $('.delete').click(function(){
            if(confirm('Are you sure that you want to delete this task')){
                $(this).parent().submit();
            }
            return false;
        })
    </script>
@endsection
