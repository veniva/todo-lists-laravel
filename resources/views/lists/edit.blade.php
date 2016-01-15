@extends('layouts.app')

@section('content')
    <div class="container">
        @include('common.messages')
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Task</div>

                <div class="panel-body">
                    <form action="{{url('/tasks/edit/')}}/{{ $task->id }}/{{$page}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea name="description" id="task-description" class="form-control">{{ old('description', $task->description) }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit Task
                        </button> or
                        <a href="{{url('/lists/')}}/{{$task->todo_list_id}}?page={{$page}}">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection