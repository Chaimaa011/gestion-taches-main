<!-- resources/views/tasks/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste de Toutes les Tâches') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <!-- Button pour ajouter une nouvelle tâche -->
        <div class="mb-4">
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">Ajouter une Nouvelle Tâche</a>
        </div>

        <!-- Table des tâches -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom de la Tâche</th>
                    <th>Projet</th>
                    <th>Statut</th>
                    <th>Attribué à</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->project_name }}</td> <!-- Afficher le nom du projet -->
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->user_name ?? 'Non attribué' }}</td>
                        <td>
                            <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info">Voir</a>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
