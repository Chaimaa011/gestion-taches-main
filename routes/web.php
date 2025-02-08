<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectMemberController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Ici, vous pouvez enregistrer les routes web de votre application. 
| Ces routes sont chargées par le RouteServiceProvider et seront 
| assignées au middleware "web".
*/

Route::middleware('auth')->group(function () {
    // 📌 Routes pour la gestion des projets
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    // 📌 Routes pour la gestion des membres d'un projet
    Route::get('/projects/{project}/members', [ProjectMemberController::class, 'index'])->name('projects.members.index');
    Route::post('/projects/{project}/members', [ProjectMemberController::class, 'store'])->name('projects.members.store');
    Route::delete('/projects/{project}/members/{member}', [ProjectMemberController::class, 'destroy'])->name('projects.members.destroy');

    // 📌 Routes pour l'ajout de membres via formulaire
    Route::get('/projects/{project}/add-members', [ProjectMemberController::class, 'create'])->name('projects.addMembers');
    Route::post('/projects/{project}/add-members', [ProjectMemberController::class, 'store'])->name('projects.storeMembers');
    Route::resource('tasks', TaskController::class);
    Route::post('/projects/{project}/add-members', [ProjectMemberController::class, 'store'])->name('projects.addMembers.store');
});


// 📌 Page d'accueil
Route::get('/', function () {
    return view('welcome');
});

// 📌 Tableau de bord (dashboard)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 📌 Routes pour la gestion du profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 📌 Inclusion des routes d'authentification
require __DIR__.'/auth.php';
