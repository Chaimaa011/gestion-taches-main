<!-- resources/views/projects/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer un Nouveau Projet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('projects.store') }}">
                        @csrf
                        <div class="space-y-4">
                            <!-- Nom du projet -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nom du projet</label>
                                <input type="text" id="name" name="name" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea id="description" name="description" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" rows="4"></textarea>
                            </div>

                            <!-- Date de début -->
                            <div>
                                <label for="date_debut" class="block text-sm font-medium text-gray-700">Date de début</label>
                                <input type="date" id="date_debut" name="date_debut" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>

                            <!-- Date de fin -->
                            <div>
                                <label for="date_fin" class="block text-sm font-medium text-gray-700">Date de fin</label>
                                <input type="date" id="date_fin" name="date_fin" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>

                            <!-- Statut du projet -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                                <select id="status" name="status" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="En attente">En attente</option>
                                    <option value="En cours">En cours</option>
                                    <option value="Terminé">Terminé</option>
                                </select>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                    Créer le projet
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
