<!-- resources/views/tasks/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer une Nouvelle Tâche') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf
            <div class="card">
                <div class="card-header">Détails de la Tâche</div>
                <div class="card-body">
                    <!-- Nom de la tâche -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom de la Tâche</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <!-- Description de la tâche -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" class="form-control" rows="4"></textarea>
                    </div>

                    <!-- Statut de la tâche -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Statut</label>
                        <select id="status" name="status" class="form-select" required>
                            <option value="Pending">En Attente</option>
                            <option value="In Progress">En Cours</option>
                            <option value="Completed">Terminé</option>
                        </select>
                    </div>

                    <!-- Sélectionner un projet -->
                    <div class="mb-3">
                        <label for="project_id" class="form-label">Sélectionner un Projet</label>
                        <select id="project_id" name="project_id" class="form-select" required>
                            <option value="">Sélectionner un projet</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Attribuer à un utilisateur -->
                    <div class="mb-3">
                        <label for="assigned_to" class="form-label">Attribuer à un Utilisateur</label>
                        <select id="assigned_to" name="assigned_to" class="form-select">
                            <option value="">Sélectionner un utilisateur</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Créer la Tâche</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
