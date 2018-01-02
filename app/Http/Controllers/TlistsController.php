<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Tlist;

use App;

class TlistsController extends Controller
{
  public function show(Tlist $tlist)
  {
    if (Auth::check() && Auth::user()->id == $tlist->user_id)
    {
      // pre-format date for view
      $originalDate = explode(" ", $tlist->created_at)[0];
      $newDate = date("m-d-Y", strtotime($originalDate));
      return view('tlists/show', compact('tlist'), compact('newDate'));
    }
    else
    {
      return redirect('/');
    }
  }

  public function create(Request $request, Tlist $tlist)
  {
    $validatedData = $request->validate([
      'title' => 'required|max:140'
    ]);
    $tlist = new Tlist();
    $tlist->title = $request->title;
    $tlist->user_id = Auth::id();
    $tlist->save();
    return redirect('/');
  }

  public function update(Request $request, Tlist $tlist)
  {
    if (isset($_POST['delete']))
    {
      if ($tlist->task->count() > 0)
      {
        foreach ($tlist->task as $task)
        {
          $task->delete();
        }
      }
      $tlist->delete();
      return redirect('/');
    }
  }

}
