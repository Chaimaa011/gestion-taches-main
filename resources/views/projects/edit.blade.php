<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier le Projet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('projects.update', $project->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom du Projet</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $project->name) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="description" name="description" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $project->description) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="date_debut" class="block text-sm font-medium text-gray-700">Date de Début</label>
                            <input type="date" id="date_debut" name="date_debut" value="{{ old('date_debut', $project->date_debut) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                        </div>

                        <div class="mb-4">
                            <label for="date_fin" class="block text-sm font-medium text-gray-700">Date de Fin</label>
                            <input type="date" id="date_fin" name="date_fin" value="{{ old('date_fin', $project->date_fin) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                        </div>

                        <div class="mb-4 flex gap-4">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Enregistrer les Modifications
                            </button>
                            <a href="{{ route('projects.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
