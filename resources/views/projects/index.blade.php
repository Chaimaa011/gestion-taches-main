<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des Projets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Add Project Button -->
                    <div class="mb-4">
                        <a href="{{ route('projects.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Ajouter un Projet
                        </a>
                    </div>

                    <!-- List of Projects -->
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2 text-left">Nom du Projet</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Statut</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr class="border border-gray-300">
                                    <td class="border border-gray-300 px-4 py-2">{{ $project->name }}</td>
                                    
                                    <!-- Project Status -->
                                    <td class="border border-gray-300 px-4 py-2">
                                        @if($project->status === 'En cours')
                                            <span class="px-2 py-1 text-sm bg-yellow-200 text-yellow-800 rounded">En cours</span>
                                        @elseif($project->status === 'Terminé')
                                            <span class="px-2 py-1 text-sm bg-green-200 text-green-800 rounded">Terminé</span>
                                        @else
                                            <span class="px-2 py-1 text-sm bg-gray-200 text-gray-800 rounded">En attente</span>
                                        @endif
                                    </td>

                                    <td class="border border-gray-300 px-4 py-2 flex gap-2">
                                        <!-- Details Button -->
                                        <a href="{{ route('projects.show', ['project' => $project->id]) }}" 
                                           class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                            Détails
                                        </a>

                                        <!-- Edit Button (Modifier) -->
                                        <a href="{{ route('projects.edit', ['project' => $project->id]) }}" 
                                           class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700">
                                            Modifier
                                        </a>

                                        <!-- Link to Add Members for this project -->
                                        <a href="{{ route('projects.addMembers', ['project' => $project->id]) }}" 
                                           class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                            Ajouter des Membres
                                        </a>

                                        <!-- Delete Button (Supprimer) -->
                                        <form action="{{ route('projects.destroy', ['project' => $project->id]) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
