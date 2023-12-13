<x-guest-layout>
    <x-slot name="scripts">
        <script src="{{asset('/js/jquery.js')}}"></script>
        <script src="{{asset('/js/login/selectRolUsuario.js')}}"></script>
        <script src="{{asset('/js/traductor.js')}}"></script>
    </x-slot>
    @if (session('error'))
        <div class="flex items-center justify-center">
            <small class="tag-traducible w-100 text-center text-red-600">
                {{session('msj')}}
            </small>
        </div>
    @endif
    <div class="mt-2 mb-2" style="display: flex; flex-direction:column; align-items:center;">
        <div class="tag-traducible" style="width:100%; text-align:center;">Seleccione un tipo de cuenta segun quiera VENDER o COMPRAR en Tienda</div>
        <input id="idiomaCodigo" type="text" value="{{$idiomaCodigo}}" hidden>
        <div> 
            <div class="flex flex-col md:flex-row align-center justify-center">
                @foreach ($roles as $r)
                    <button id="{{$r->id}}" type="button" class="tag-traducible btn-login-select-rol glass-box py-2 px-10 mx-2 my-4 md:my-6 font-bold">{{$r->name}}</button>
                @endforeach
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mt-2 mb-2" style="display: flex; flex-direction:column; align-items:center;">
            <div class="tag-traducible" style="width:100%; text-align:center;">Crear Cuenta con</div>
            <hr style="width: 70%; margin: 5px;">
            @if ($isLoginRoute)
                <x-auth-buttons authText="Ingresar" noAuthTextG="fa fa-google" noAuthText="Iniciar Sesion" noAuthUrlG="/google-auth/redirect" noAuthUrl="login" authUrl="/dashboard" :isRegisterRoute="false" registerRoute="" :withWelcomeMessage="true" :isLoginPage="true"/>
            @endif
            <hr style="width: 100%;">
            <small style="width:100%; text-align:center;" class="tag-traducible mt-4"> o con una nueva cuenta de Tienda</small>
        </div>
        <div>
            <x-input-label class="tag-traducible" for="name" :value="__('Nombre')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label class="tag-traducible" for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label class="tag-traducible" for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label class="tag-traducible" for="password_confirmation" :value="__('Confirmar Contraseña')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="tag-traducible underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('¿Ya te has registrado antes?') }}
            </a>

            <x-primary-button id="button-submit-disabled" class="tag-traducible ml-4" data-disabled="true">
                {{ __('Registrarme') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
