@extends('layouts.app')

<style>
  .padded {
    padding: 0px;
  }

  h2, p {
    display:inline;
  }

  .title {
    margin: 10px 0 10px 0;
  }

  .task {
    max-width: 100%;
    overflow-x: scroll;
    padding: 10px;
    background-color: white;
    border: 1px solid lightgrey;
  }

  td {
    width: 33%;
  }

</style>

@section('content')
<div class="container">
  <a href="/">Back to Lists</a>
  @if (Auth::check())
    <div class="title">
      <h2>{{$tlist->title}}</h2>
      <p>Created {{$newDate}}</p>
    </div class="p">
    <form method="POST" action="/tlists/{{$tlist->id}}">
      <a href="/tlists/{{$tlist->id}}/task" class="btn btn-primary">Add new Task</a>
      <button type="submit" name="delete" formmethod="POST" class="btn btn-danger">Delete List</button>
      {{ csrf_field() }}
    </form>

  <div class="container">
    <Table class="Table">
      <tbody>
        @foreach($tlist->task as $task)
          <tr class="p-1">
            <td>
              <div class="task">
              {{$task->description}}
              </div>
            </td>
            <td>
              Created {{ $task->created_at->diffForHumans() }}
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
  </div>
  @else
    <h3>You need to log in. <a href="/login">Click here to log in</a></h3>
  @endif
</div>

@endsection
