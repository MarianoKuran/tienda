<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Models\Idioma;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role;

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

//LANDING
Route::get('/', function () {
    $isLoginRoute = Route::has('login'); 
    $isRegisterRoute = Route::has('register'); 
    $authUser = Auth::user();
    $idiomaCodigo = Idioma::where('Seleccionado', 1)->first()->Codigo;

    return view('welcome')->with([
        'isLoginRoute'=>$isLoginRoute,
        'isRegisterRoute'=>$isRegisterRoute,
        'authUser'=>$authUser,
        'idiomaCodigo'=>$idiomaCodigo
    ]);
});

//RUTAS PARA SOCIALITE / GOOGLE CLOUD AUTH
Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/google-auth/callback', function () {
    $userGoogle = Socialite::driver('google')->stateless()->user();
    $existeUser = User::where('google_id', $userGoogle->id)->first();

    //usuario que no existe y viene del login o del register
    if ($existeUser == null) {
        if (!Session::has('rolID')) {
            return redirect()->route('register')->with(['error' => true, 'msj'=>'Tu usuario no existe y debes registrarlo. No olvides seleccionar un tipo de cuenta para poder registrarte']);
        }
        
        $user = User::updateOrCreate([
            'google_id'=>$userGoogle->id,
        ],
        [
            'name'=>$userGoogle->name,
            'email'=>$userGoogle->email,
        ]);
        
        $rol = Role::find(Session::get('rolID'));
        if(!$user->getRoleNames()->count()){
            $user->assignRole($rol);
        } else {
            $rolEliminar = Role::find($user->getRoleNames()[0]->id);
            $user->removeRole($rolEliminar);
            $user->removeRole($rol);
        };
        
        Auth::login($user);
        return redirect('/dashboard');
    }
});

//RUTAS DEFAULT DE BREEZE
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
