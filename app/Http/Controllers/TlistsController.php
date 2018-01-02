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
      return view('tlists/show', compact('tlist'));
    }
    else
    {
      return redirect('/');
    }
  }

  public function create(Request $request)
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
}
