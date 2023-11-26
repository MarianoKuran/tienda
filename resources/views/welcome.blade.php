<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tienda</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('/styles/normalize.css')}}">
        <link rel="stylesheet" href="{{asset('/styles/index.css')}}">
        <link rel="stylesheet" href="{{asset('/styles/welcome/welcome.css')}}">
        <link rel="stylesheet" href="{{asset('/styles/traductor/dropdown.css')}}">
        @livewireStyles
    </head>
    <body class="gradient-bg">
        @if ($isLoginRoute)
            <header class="grandient-bg">
                <nav class="centrado-flex">
                    <span class="logo">Tienda</span>
                    <div class="centrado-flex auth-buttons-lg" style="margin:0px 40px;">
                        <x-auth-buttons authText="Ingresar" noAuthTextG="Google" noAuthText="Iniciar Sesion" noAuthUrlG="/google-auth/redirect" noAuthUrl="login" authUrl="/dashboard" :isRegisterRoute="false" registerRoute="" :withWelcomeMessage="true" :isLoginPage="false"/>
                        @livewire('idioma.select-idioma')
                        <input id="idiomaCodigo" type="text" value="{{$idiomaCodigo}}" hidden>
                    </div>
                </nav>
            </header>
            <main class="hero">
                <section class="section-card glass-box">
                    @if ($authUser != null)
                        <h1 class="title-lg tag-traducible">¡Hola de nuevo, {{$authUser->name}}!</h1> 
                    @else
                        <div style="display: flex; justify-content:star;">
                            <strong class="title-lg tag-traducible" style="width:fit-content;">Bienvenido a </strong><strong class="title-lg" style="width:fit-content; margin-left:18px;"> Tienda</strong> 
                        </div>
                    @endif
                    <p class="tag-traducible">Descubre un nuevo mundo de oportunidades para tu emprendimiento. Nosotros, conectamos visionarios y creadores como tú con una audiencia ávida de descubrir productos y servicios únicos porque creemos en el poder de los sueños y la innovación. Únete a nosotros y sé parte de una comunidad que celebra el espíritu emprendedor. ¡Regístrate hoy y comienza a hacer crecer tu negocio!</p>
                    <x-auth-buttons authText="Ingresar" noAuthTextG="Google" noAuthText="Iniciar Sesion" noAuthUrlG="/google-auth/redirect" noAuthUrl="login" authUrl="/dashboard" :isRegisterRoute="$isRegisterRoute" registerRoute="register" registerText="Registrarse" :withWelcomeMessage="false" :isLoginPage="false"/>
                </section>
                <section class="section-secondary-title"> 
                    <h2 class="title-lg tag-traducible">¿Por qué unirte a nosotros?</h2>

                    <div class="glass-box glass-box-sm card centrado-flex">
                        <h3 class="title-md tag-traducible">Exposición Sin Límites</h3>
                        <p class="p-card tag-traducible">Alcanza a clientes de todo el mundo y muestra tu talento a una audiencia diversa.</p>
                        <x-auth-buttons authText="Ingresar" noAuthTextG="Google" noAuthText="Iniciar Sesion" noAuthUrlG="/google-auth/redirect" noAuthUrl="login" authUrl="/dashboard" :isRegisterRoute="$isRegisterRoute" registerRoute="register" registerText="Comenzar" :withWelcomeMessage="false" :isLoginPage="false"/>
                    </div>
                    <div class="glass-box glass-box-sm card centrado-flex">
                        <h3 class="title-md tag-traducible">Crecimiento Acelerado</h3>
                        <p class="p-card tag-traducible">Impulsa tu emprendimiento al siguiente nivel con nuestro sólido apoyo y recursos.</p>
                        <x-auth-buttons authText="Ingresar" noAuthTextG="Google" noAuthText="Iniciar Sesion" noAuthUrlG="/google-auth/redirect" noAuthUrl="login" authUrl="/dashboard" :isRegisterRoute="$isRegisterRoute" registerRoute="register" registerText="Comenzar" :withWelcomeMessage="false" :isLoginPage="false"/>
                    </div>
                    <div class="glass-box glass-box-sm card centrado-flex">
                        <h3 class="title-md tag-traducible">Conexiones Estratégicas</h3>
                        <p class="p-card tag-traducible">Colabora con otros emprendedores y crea alianzas que impulsen tu negocio.</p>
                        <x-auth-buttons authText="Ingresar" noAuthTextG="Google" noAuthText="Iniciar Sesion" noAuthUrlG="/google-auth/redirect" noAuthUrl="login" authUrl="/dashboard" :isRegisterRoute="$isRegisterRoute" registerRoute="register" registerText="Comenzar" :withWelcomeMessage="false" :isLoginPage="false"/>
                    </div>
                </section>
            </main>
        @endif


        <script src="{{asset('/js/jquery.js')}}"></script>
        <script src="{{asset('/js/traductor.js')}}"></script>
        @livewireScripts
    </body>
</html>
