<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Email Address -->
            <div class="mt-2 mb-2" style="display: flex; flex-direction:column; align-items:center;">
                <div style="width:100%; text-align:center;">Iniciar Sesion con</div>
                <hr style="width: 70%; margin: 5px;">
                @if ($isLoginRoute)
                    <x-auth-buttons authText="Ingresar" noAuthTextG="fa fa-google" noAuthText="Iniciar Sesion" noAuthUrlG="/google-auth/redirect" noAuthUrl="login" authUrl="/dashboard" :isRegisterRoute="false" registerRoute="" :withWelcomeMessage="true" :isLoginPage="true"/>
                @endif
                <hr style="width: 100%;">
                <small style="width:100%; text-align:center;"> o con tus credenciales de Tienda</small>
            </div>
            <div class="mt-4 mb-2">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                
                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    
                    <x-text-input id="password" class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required autocomplete="current-password" />
                    
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    
                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Recuerdame') }}</span>
                        </label>
                    </div>
                    
                    <div class="flex flex-col items-center justify-center mt-4">
                        <div>
                            <x-primary-button style="background-color: rgba(78,79,235,1);">
                                {{ __('Iniciar Sesion') }}
                            </x-primary-button>
                        </div>
                    </div>
                </div>
    
                @if (Route::has('password.request'))
                    <a class="mt-6 underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Olvidaste tu contraseña?') }}
                    </a>
                @endif
            </div>
    </form>
</x-guest-layout>
