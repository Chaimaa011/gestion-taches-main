<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectMemberController extends Controller
{
    // Afficher la page pour ajouter un membre à un projet
    public function create($projectId)
    {
        $project = DB::table('projects')->where('id', $projectId)->first();
        if (!$project) {
            abort(404, 'Projet non trouvé.');
        }

        $users = DB::table('users')->get(); // Récupérer tous les utilisateurs

        return view('projects.add_members', compact('project', 'users'));
    }

    // Ajouter un membre à un projet
    public function store(Request $request, $projectId)
    {
        $userId = $request->input('user_id');

        // Vérifier si le projet existe
        $project = DB::table('projects')->where('id', $projectId)->first();
        if (!$project) {
            abort(404, 'Projet introuvable.');
        }

        // Vérifier si l'utilisateur existe
        $user = DB::table('users')->where('id', $userId)->first();
        if (!$user) {
            return back()->withErrors(['user_id' => 'Utilisateur non valide.']);
        }

        // Vérifier si l'utilisateur est déjà dans le projet
        $exists = DB::table('project_user')
            ->where('project_id', $projectId)
            ->where('user_id', $userId)
            ->exists();

        if ($exists) {
            return back()->withErrors(['user_id' => 'Cet utilisateur fait déjà partie du projet.']);
        }

        try {
            // Ajouter l'utilisateur au projet
            DB::table('project_user')->insert([
                'project_id' => $projectId,
                'user_id' => $userId
            ]);

            return redirect()->route('projects.index')->with('success', 'Membre ajouté avec succès.');
        } catch (\Exception $e) {
            Log::error("Erreur lors de l'ajout d'un membre au projet : " . $e->getMessage());
            return back()->withErrors(['error' => 'Une erreur est survenue.']);
        }
    }
}
