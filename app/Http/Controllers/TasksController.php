<?php

namespace App\Http\Controllers;

use App\Task;

class TasksController extends Controller
{
    public function index() {
        $name = 'Laravel project 1';
        $tasks = Task::all();
        return view('welcome', compact('name', 'tasks'));
    }
    public function show($id) {
        $name = 'Task search';
        $task = Task::find($id);
        return view('tasks.show', compact('name', 'task'));
    }
}
