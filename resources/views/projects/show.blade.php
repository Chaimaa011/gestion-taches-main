<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails du Projet : ') }} {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Project Details Card -->
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title">{{ $project->name }}</h3>
                            <p class="card-text"><strong>Description:</strong> {{ $project->description }}</p>

                            <p class="card-text">
                                <strong>Statut:</strong>
                                @if($project->status === 'En cours')
                                    <span class="badge bg-warning text-dark">En cours</span>
                                @elseif($project->status === 'Terminé')
                                    <span class="badge bg-success">Terminé</span>
                                @else
                                    <span class="badge bg-secondary">En attente</span>
                                @endif
                            </p>

                            <p class="card-text"><strong>Date de début:</strong> {{ $project->date_debut }}</p>
                            <p class="card-text"><strong>Date de fin:</strong> {{ $project->date_fin }}</p>

                            <!-- Members List -->
                            <h5 class="mt-4">Membres du projet:</h5>
                            @if(count($members) > 0)
                                <ul class="list-group">
                                    @foreach($members as $member)
                                        <li class="list-group-item">
                                            <strong>{{ $member->name }}</strong> - {{ $member->email }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p>Aucun membre ajouté à ce projet.</p>
                            @endif

                            <!-- Back to Projects List Button -->
                            <a href="{{ route('projects.index') }}" class="btn btn-primary mt-3">Retour à la Liste des Projets</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
