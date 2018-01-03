@extends('layouts.app')

@section('content')
<div class="container">
  <h2>Add New Task</h2>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="/tlists/{{$tlist->id}}/task">
    <div class="form-group">
      <textarea name="description" class="form-control"></textarea>
      <label class="checkbox-inline"><input type="checkbox" name="priority" value="high">Urgent</label>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary">Add Task</button>
    </div>
    {{ csrf_field() }}
  </form>

</div>

@endsection
