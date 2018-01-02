<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Task;
use App\Tlist;

class TasksController extends Controller
{
    public function index()
    {
      $user= Auth::user();
      return view('welcome', compact('user'));
    }

    public function add(Tlist $tlist)
    {
      return view('tasks/add', compact('tlist'));
    }

    public function create(Request $request, Tlist $tlist)
    {
      $validatedData = $request->validate([
        'description' => 'required|max:140'
      ]);
      $task = new Task();
      $task->description = $request->description;
      $task->tlist_id = $tlist->id;
      $task->save();
      return redirect("tlists/$tlist->id");
    }

    public function edit(Tlist $tlist, Task $task)
    {
      if (Auth::check() && Auth::user()->id == $tlist->user_id)
      {
        return view('tasks/edit', compact('tlist'), compact('task'));
      }
      else
      {
        return redirect('/');
      }
    }

    public function update(Request $request, Tlist $tlist, Task $task)
    {
      if (isset($_POST['delete']))
      {
        $task->delete();
        return redirect("tlists/$tlist->id");
      }
      else
      {
        $validatedData = $request->validate([
          'description' => 'required|max:255'
        ]);
        $task->description = $request->description;
        $task->save();
        return redirect("tlists/$tlist->id");
      }
    }
}
