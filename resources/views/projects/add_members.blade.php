<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter des Membres au Projet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="mb-4">Projet : {{ $project->name }}</h3>

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="text-red-600">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Add Members Form -->
                    <form method="POST" action="{{ route('projects.addMembers.store', ['project' => $project->id]) }}">

                        @csrf

                        <label for="user_id" class="block text-sm font-medium text-gray-700">Sélectionner un membre</label>
                        <select id="user_id" name="user_id" class="mt-1 block w-full">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>

                        <div class="mt-4">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Ajouter au Projet
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
