@extends('layouts.app')

@section('content')
<div class="container">
  @if (Auth::check())
    <h2>{{$tlist->title}}</h2>
    <a href="/">Back</a>
    <form method="POST" action="/tlists/{{$tlist->id}}">
      <a href="/tlists/{{$tlist->id}}/task" class="btn btn-primary">Add new Task</a>
      <button type="submit" name="delete" formmethod="POST" class="btn btn-danger">Delete List</button>
      {{ csrf_field() }}
    </form>

    <Table class="Table">
      <tbody>
        @foreach($tlist->task as $task)
          <tr>
            <td>
              {{$task->description}}
            </td>
            <td>
              <form action="/tlists/{{$tlist->id}}/task/{{$task->id}}">
                <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                <button type="submit" name="delete" formmethod="POST" class="btn btn-danger">Delete</button>
                {{ csrf_field() }}
              </form>
            </td>
          </tr>

        @endforeach
      </tbody>
    </table>
  @else
    <h3>You need to log in. <a href="/login">Click here to log in</a></h3>
  @endif
</div>

@endsection
