<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function showAddMembersPage($projectId)
    {
        // Using DB facade, but could be done with Eloquent as well
        $project = DB::select("SELECT * FROM projects WHERE id = ?", [$projectId])[0];
        $users = DB::select("SELECT * FROM users");
        
        // Return view with the project and users data
        return view('projects.add_members', compact('project', 'users'));
    }
    
    // Add members to a project
    public function addMembers(Request $request, $projectId)
    {
        // Insert the new project-user relation into the pivot table
        $userId = $request->user_id;
        DB::insert("INSERT INTO project_user (project_id, user_id) VALUES (?, ?)", [
            $projectId,
            $userId
        ]);
        
        // Redirect back to the project list page
        return redirect()->route('projects.index');
    }

    // Display the list of projects
    public function index()
    {
        // Retrieve all projects
        $projects = DB::select("SELECT * FROM projects");
        
        // Pass the projects data to the view
        return view('projects.index', compact('projects'));
    }

    // Show the page to create a new project
    public function create()
    {
        return view('projects.create');
    }

    // Store the newly created project
    public function store(Request $request)
    {
        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        // Insert project data into the projects table
        DB::insert("INSERT INTO projects (name, description, date_debut, date_fin, created_at, updated_at) 
                    VALUES (?, ?, ?, ?, NOW(), NOW())", [
            $request->name,
            $request->description,
            $request->date_debut,
            $request->date_fin,
        ]);

        // Redirect to the project list page
        return redirect()->route('projects.index');
    }

    // Show the details of a specific project
    public function show($projectId)
    {
        // Fetch the project details
        $project = DB::table('projects')->where('id', $projectId)->first();
        
        // Abort if project not found
        if (!$project) {
            abort(404, "Projet non trouvé.");
        }

        // Fetch the members of the project
        $members = DB::table('users')
                     ->join('project_user', 'users.id', '=', 'project_user.user_id')
                     ->where('project_user.project_id', $projectId)
                     ->select('users.name', 'users.email')
                     ->get();

        // Return the project details view
        return view('projects.show', compact('project', 'members'));
    }

    // Delete a specific project
    public function destroy($id)
    {
        // Delete the project
        DB::delete("DELETE FROM projects WHERE id = ?", [$id]);
        
        // Redirect to the project list page
        return redirect()->route('projects.index');
    }

    // Show the edit page for a project
    public function edit($id)
    {
        // Retrieve the project to be edited
        $project = DB::table('projects')->where('id', $id)->first();
        
        // Return edit view with the project data
        return view('projects.edit', compact('project'));
    }

    // Update an existing project
    public function update(Request $request, $id)
    {
        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        // Update the project data
        DB::update("UPDATE projects 
                    SET name = ?, description = ?, date_debut = ?, date_fin = ?, updated_at = NOW() 
                    WHERE id = ?", [
            $request->name,
            $request->description,
            $request->date_debut,
            $request->date_fin,
            $id
        ]);

        // Redirect to the project list page
        return redirect()->route('projects.index');
    }
}
