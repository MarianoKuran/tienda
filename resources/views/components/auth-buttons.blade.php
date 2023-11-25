@auth
    @if ($withWelcomeMessage)
        <span class="welcome-user">¡Hola de nuevo {{Auth::user()->name}}!</span>
    @endif
        <a href="{{ url($authUrl) }}" class="centrado-flex">{{$authText}}</a>
@else
    @if ($isRegisterRoute)
        <a href="{{ route($registerRoute) }}" class="centrado-flex btn-primary">{{$registerText}}</a>
    @else
        @if (!$isLoginPage)
            <a href="{{ route($noAuthUrl) }}" class="centrado-flex">{{$noAuthText}}</a>
            <a href="{{$noAuthUrlG}}" class="centrado-flex">{{$noAuthTextG}}</a>
        @else
            <a href="{{$noAuthUrlG}}" class="{{$noAuthTextG}}" style="font-size: 2em;"></a>
        @endif
    @endif
@endauth