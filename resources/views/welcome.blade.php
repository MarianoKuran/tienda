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
    </head>
    <body class="gradient-bg">
        @if ($isLoginRoute)
            <header class="grandient-bg">
                <nav class="centrado-flex">
                    <span class="logo">Tienda</span>
                    <div class="centrado-flex auth-buttons-lg">
                        <x-auth-buttons authText="Ingresar" noAuthTextG="Google" noAuthText="Iniciar Sesion" noAuthUrlG="/google-auth/redirect" noAuthUrl="login" authUrl="/dashboard" :isRegisterRoute="false" registerRoute="" :withWelcomeMessage="true" :isLoginPage="false"/>
                    </div>
                </nav>
            </header>
            <main class="hero">
                <section class="section-card glass-box">
                    @if ($authUser != null)
                        <h1 class="title-lg tag-traducible">¡Hola de nuevo, {{$authUser->name}}!</h1> 
                    @else
                        <h1 class="title-lg tag-traducible">Bienvenido a Tienda</h1> 
                    @endif
                    <p>Descubre un nuevo mundo de oportunidades para tu emprendimiento. En <strong>Tienda</strong>, conectamos visionarios y creadores como tú con una audiencia ávida de descubrir productos y servicios únicos porque creemos en el poder de los sueños y la innovación. Únete a nosotros y sé parte de una comunidad que celebra el espíritu emprendedor. ¡Regístrate hoy y comienza a hacer crecer tu negocio!</p>
                    <x-auth-buttons authText="Ingresar" noAuthTextG="Google" noAuthText="Iniciar Sesion" noAuthUrlG="/google-auth/redirect" noAuthUrl="login" authUrl="/dashboard" :isRegisterRoute="$isRegisterRoute" registerRoute="register" registerText="Registrarse" :withWelcomeMessage="false" :isLoginPage="false"/>
                    @livewire('idioma.select-idioma', ['idiomaSeleccionado' => $idiomaSeleccionado])
                </section>
                <section class="section-secondary-title"> 
                    <h2 class="title-lg">¿Por qué unirte a Tienda?</h2>

                    <div class="glass-box glass-box-sm card centrado-flex">
                        <h3 class="title-md">Exposición Sin Límites</h3>
                        <p class="p-card">Alcanza a clientes de todo el mundo y muestra tu talento a una audiencia diversa.</p>
                        <x-auth-buttons authText="Ingresar" noAuthTextG="Google" noAuthText="Iniciar Sesion" noAuthUrlG="/google-auth/redirect" noAuthUrl="login" authUrl="/dashboard" :isRegisterRoute="$isRegisterRoute" registerRoute="register" registerText="Comenzar" :withWelcomeMessage="false" :isLoginPage="false"/>
                    </div>
                    <div class="glass-box glass-box-sm card centrado-flex">
                        <h3 class="title-md">Crecimiento Acelerado</h3>
                        <p class="p-card">Impulsa tu emprendimiento al siguiente nivel con nuestro sólido apoyo y recursos.</p>
                        <x-auth-buttons authText="Ingresar" noAuthTextG="Google" noAuthText="Iniciar Sesion" noAuthUrlG="/google-auth/redirect" noAuthUrl="login" authUrl="/dashboard" :isRegisterRoute="$isRegisterRoute" registerRoute="register" registerText="Comenzar" :withWelcomeMessage="false" :isLoginPage="false"/>
                    </div>
                    <div class="glass-box glass-box-sm card centrado-flex">
                        <h3 class="title-md">Conexiones Estratégicas</h3>
                        <p class="p-card">Colabora con otros emprendedores y crea alianzas que impulsen tu negocio.</p>
                        <x-auth-buttons authText="Ingresar" noAuthTextG="Google" noAuthText="Iniciar Sesion" noAuthUrlG="/google-auth/redirect" noAuthUrl="login" authUrl="/dashboard" :isRegisterRoute="$isRegisterRoute" registerRoute="register" registerText="Comenzar" :withWelcomeMessage="false" :isLoginPage="false"/>
                    </div>
                </section>
            </main>
        @endif
        <script src="{{asset('/js/jquery.js')}}"></script>
        <script src="{{asset('/js/traductor.js')}}"></script>
    </body>
</html>
