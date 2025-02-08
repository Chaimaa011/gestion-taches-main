<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Display all tasks
    public function index()
    {
        $tasks = DB::table('tasks')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->leftJoin('users', 'tasks.assigned_to', '=', 'users.id')
            ->select('tasks.*', 'projects.name as project_name', 'users.name as user_name')
            ->get();

        return view('tasks.index', compact('tasks'));
    }

    // Show the form to create a new task
    public function create()
    {
        $projects = DB::table('projects')->get();
        $users = DB::table('users')->get();

        return view('tasks.create', compact('projects', 'users'));
    }

    // Store a new task
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,In Progress,Completed',
            'project_id' => 'required|exists:projects,id',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        DB::table('tasks')->insert([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'project_id' => $request->input('project_id'),
            'assigned_to' => $request->input('assigned_to'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tâche créée avec succès!');
    }

    // Show the details of a task
    public function show($id)
    {
        $task = DB::table('tasks')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->leftJoin('users', 'tasks.assigned_to', '=', 'users.id')
            ->select('tasks.*', 'projects.name as project_name', 'users.name as user_name')
            ->where('tasks.id', $id)
            ->first();

        if (!$task) {
            return redirect()->route('tasks.index')->with('error', 'Tâche non trouvée.');
        }

        return view('tasks.show', compact('task'));
    }

    // Show the form to edit an existing task
    public function edit($id)
    {
        $task = DB::table('tasks')->where('id', $id)->first();
        $projects = DB::table('projects')->get();
        $users = DB::table('users')->get();

        if (!$task) {
            return redirect()->route('tasks.index')->with('error', 'Tâche non trouvée.');
        }

        return view('tasks.edit', compact('task', 'projects', 'users'));
    }

    // Update an existing task
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,In Progress,Completed',
            'project_id' => 'required|exists:projects,id',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        DB::table('tasks')
            ->where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'status' => $request->input('status'),
                'project_id' => $request->input('project_id'),
                'assigned_to' => $request->input('assigned_to'),
                'updated_at' => now(),
            ]);

        return redirect()->route('tasks.index')->with('success', 'Tâche mise à jour avec succès!');
    }

    // Delete a task
    public function destroy($id)
    {
        DB::table('tasks')->where('id', $id)->delete();

        return redirect()->route('tasks.index')->with('success', 'Tâche supprimée avec succès!');
    }
}
