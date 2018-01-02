@extends('layouts.app')

@section('content')
<div class="container">
  @if (Auth::check())
    <h2>Lists</h2>

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
              <a href="/tlists/{{$tlist->id}}">{{$tlist->title}}</a>
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
