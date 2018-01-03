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
    border-radius: 4px;
    max-width: 100%;
    overflow-x: scroll;
    padding: 10px;
    background-color: white;
    border: 1px solid lightgrey;
    position: relative;
  }

  .complete {
    color: rgb(51,176,124);
  }

  .task.complete {
    background-color: #f1f8e9;
    border-color: rgb(51,176,124);
  }

  /*.high {
    background-color: lightpink;
    color: white;
  }*/

  .tag {
    width: 20px;
    height: 20px;
    position: absolute;
    right: 0;
    top: 2;
    border-radius: 50%;
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

  <div>
    <Table class="Table">
      <tbody>
        @foreach($tlist->task as $task)
          <tr class="p-1">
            <td>
              <div class="task {{ $task->status }}">
              {{ $task->description }}
              @if ($task->priority == "high")
                <div class="tag">❗</div>
              @endif
              </div>
            </td>
            <td>
              @if ($task->status == 'complete')
                <p class="complete">Completed {{ $task->updated_at->diffForHumans() }}</p>
              @else
                Created {{ $task->created_at->diffForHumans() }}
              @endif
            </td>
            <td>
              <form action="/tlists/{{$tlist->id}}/task/{{$task->id}}">
                @if ($task->status == 'incomplete')
                  <button type="submit" name="complete" formmethod="POST" class="btn btn-default">✔️</button>
                @else
                  <button type="submit" name="complete" formmethod="POST" class="btn btn-success">✔️</button>
                @endif
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
