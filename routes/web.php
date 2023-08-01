<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\DashboardComponent;
use App\Http\Livewire\User\UserComponent;

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Article\ArticlesComponent;
use App\Http\Livewire\Typearticle\TypeArticlesComponent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user', UserComponent::class)->name('user.index');
Route::get('/type', TypeArticlesComponent::class)->name('type.index');
Route::get('/article', ArticlesComponent::class)->name('article.index');

Route::get('/dashboard', DashboardComponent::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
