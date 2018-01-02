@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Edit the Task</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <form method="POST" action="/tlists/{{ $tlist->id }}/task/{{ $task->id }}">

      <div class="form-group">
        <textarea name="description" class="form-control">{{ $task->description}}</textarea>
      </div>

      <div class="form-group">
        <button type="submit" name="update" class="btn btn-primary">Update Task</button>
      </div>

      {{ csrf_field() }}
    </form>

  </div>

@stop
