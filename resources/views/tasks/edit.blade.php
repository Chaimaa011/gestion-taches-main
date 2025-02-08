<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier la tâche: ' . $task->name) }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="card">
                <div class="card-header">Détails de la Tâche</div>
                <div class="card-body">
                    <!-- Nom de la tâche -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom de la tâche</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $task->name }}" required>
                    </div>

                    <!-- Description de la tâche -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description">{{ $task->description }}</textarea>
                    </div>

                    <!-- Statut de la tâche -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Statut</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>En attente</option>
                            <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>En cours</option>
                            <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Terminé</option>
                        </select>
                    </div>

                    <!-- Sélectionner un projet -->
                    <div class="mb-3">
                        <label for="project_id" class="form-label">Projet</label>
                        <select class="form-select" id="project_id" name="project_id" required>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ $task->project_id == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Assigné à un utilisateur -->
                    <div class="mb-3">
                        <label for="assigned_to" class="form-label">Assigné à</label>
                        <select class="form-select" id="assigned_to" name="assigned_to">
                            <option value="">Non assigné</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $task->assigned_to == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Mettre à jour la tâche</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
