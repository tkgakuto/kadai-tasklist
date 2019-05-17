<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $tasks = \App\Task::orderBy('id', 'desc')->paginate(10);
        
        return view ('tasks.index', [
            'tasks' => $tasks,
            ]);
    }
    
    public function show($id)
    {
         $user = \App\User::find($id);
         $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);
         
         $data = [
             'user' => $user,
             'tasks' => $tasks,
             ];
             
         $data += $this->counts($user);
         

         return view('users.show', $data);
    }
}
