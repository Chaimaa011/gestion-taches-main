@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Membres du Projet: {{ $project->name }}</h2>
    
    <h4>Ajouter un membre</h4>
    <form action="{{ route('projects.members.store', $project->id) }}" method="POST">
        @csrf
        <select name="user_id" class="form-control mb-2">
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>

    <h4 class="mt-4">Liste des Membres</h4>
    <table class="table">
        <tr><th>Nom</th><th>Email</th><th>Action</th></tr>
        @foreach($members as $member)
        <tr>
            <td>{{ $member->name }}</td>
            <td>{{ $member->email }}</td>
            <td>
                <form action="{{ route('projects.members.destroy', [$project->id, $member->id]) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger">Retirer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    <a href="{{ route('projects.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection
