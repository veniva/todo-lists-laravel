@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Edit a list</div>

        <div class="panel-body">
            <form action="{{url('/lists/edit/')}}/{{ $list->id }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <input name="title" class="form-control" value="{{ old('title', $list->title) }}" />
                </div>
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit List
                </button>
            </form>
        </div>
    </div>
@endsection