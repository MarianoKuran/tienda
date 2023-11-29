<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Idioma;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $isLoginRoute = Route::has('login'); 
        $isRegisterRoute = Route::has('register');
        $roles = Role::whereIn('name', ['Cliente', 'Empresa'])->get();
        $idiomaCodigo = Idioma::where('Seleccionado', 1)->first()->Codigo;
        return view('auth.register')->with([
            'isLoginRoute'=>$isLoginRoute,
            'isRegisterRoute'=>$isRegisterRoute,
            'roles'=>$roles,
            'idiomaCodigo'=>$idiomaCodigo,
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        if (!Session::has('rolID')) {
            return redirect()->route('register')->with(['error' => true, 'msj'=>'No olvides seleccionar un tipo de cuenta para poder registrarte']);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $rol = Role::find(Session::get('rolID'));
        if(!$user->getRoleNames()->count()){
            $user->assignRole($rol);
        } else {
            $rolEliminar = Role::find($user->getRoleNames()[0]->id);
            $user->removeRole($rolEliminar);
            $user->removeRole($rol);
        };

        Session::forget('rolID');

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function setearRolSession($rolID)
    {
        if ($rolID != null) {
            Session::put('rolID', $rolID);
        }
    }
}
