<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

class TaskController extends Controller
{
    public function index() {

        $tasks = Task::all();
        $users = User::all();

        return view('tasks/index')->with(compact(
            'tasks', 'users'
        ));
    }

    public function store(Request $request) {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'user_id' => 'required',
            'due_date' => 'required',
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'due_date' => date('Y-m-d', strtotime($request->due_date)),
        ]);

        event(new Registered($task));

        return redirect('/tasks')->with('success', 'Task Created Successfully');
    }

    public function edit(Task $id) {

        $task = $id;
        $users = User::all();
        
        return view('tasks/edit')->with(compact(
            'task', 'users'
        ));
    }

    public function update(Request $request, $id) {

        Task::find($id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'due_date' => date('Y-m-d', strtotime($request->due_date)),
            'status' => $request->status,
        ]);

        return redirect('/tasks')->with('success', 'Task has been updated!');
    }

    public function destroy(Task $id) {

        $id->delete();

        return redirect('/tasks')->with('success', 'Task has been deleted!');
    }

    public function complete(Task $task) {

        $task->completed = true;
        $task->save();

        session()->flash('message','Task Completed Successfully!');
        return redirect('/completed');
    }
}