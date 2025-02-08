<!-- resources/views/tasks/show.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails de la Tâche: ') }} {{ $task->name }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="card">
            <div class="card-header">Détails de la Tâche</div>
            <div class="card-body">
                <h5 class="card-title">Nom: {{ $task->name }}</h5>
                <p class="card-text"><strong>Description:</strong> {{ $task->description }}</p>
                <p class="card-text"><strong>Statut:</strong> {{ $task->status }}</p>
                <p class="card-text"><strong>Projet:</strong> {{ $task->project_name }}</p>
                <p class="card-text"><strong>Assigné à:</strong> {{ $task->user_name }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
