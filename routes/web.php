<?php

use App\Http\Controllers\ProfileController;
use App\Models\Idioma;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
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
    $isLoginRoute = Route::has('login'); 
    $isRegisterRoute = Route::has('register'); 
    $authUser = Auth::user();
    $idiomaSeleccionado = Idioma::where('Seleccionado', true)->first();

    return view('welcome')->with([
        'isLoginRoute'=>$isLoginRoute,
        'isRegisterRoute'=>$isRegisterRoute,
        'authUser'=>$authUser,
        'idiomaSeleccionado'=>$idiomaSeleccionado,
    ]);
});

//RUTAS PARA SOCIALITE / GOOGLE CLOUD AUTH
Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});
 
Route::get('/google-auth/callback', function () {
    $userGoogle = Socialite::driver('google')->stateless()->user();
    $user = User::updateOrCreate([
        'google_id'=>$userGoogle->id,
    ],
    [
        'name'=>$userGoogle->name,
        'email'=>$userGoogle->email,
    ]);
    Auth::login($user);
    return redirect('/dashboard');
});


//rutas default de BREEZE
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';