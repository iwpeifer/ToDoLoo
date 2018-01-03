@extends('layouts.app')

<style>

  h2, p {
    display:inline;
  }

</style>

@section('content')
<div class="container">
  @if (Auth::check())
    <h2>My Lists</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <form method="POST" action="/">
        <input type="text" name="title" placeholder="New List"></input>
        <button type="submit" class="btn btn-primary">Add</button>
        {{ csrf_field() }}
    </form>

    <Table class="Table">
      <tbody>
        @foreach($user->tlists as $tlist)
          <tr>
            <td>
              <h2><a href="/tlists/{{$tlist->id}}">{{$tlist->title}}</a></h2>
              <?php
              $completed = 0;
              $total = $tlist->task->count();
              foreach ($tlist->task as $task) {
                if ($task->status == 'complete') {
                  $completed++;
                }
              }
              echo "$completed/$total tasks completed";
            ?>
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
