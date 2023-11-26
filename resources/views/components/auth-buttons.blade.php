@auth
    @if ($withWelcomeMessage)
        <span class="welcome-user tag-traducible">¡Hola de nuevo, {{Auth::user()->name}}!</span>
    @endif
        <a href="{{ url($authUrl) }}" class="centrado-flex tag-traducible">{{$authText}}</a>
@else
    @if ($isRegisterRoute)
        <a href="{{ route($registerRoute) }}" class="centrado-flex btn-primary tag-traducible">{{$registerText}}</a>
    @else
        @if (!$isLoginPage)
            <a href="{{ route($noAuthUrl) }}" class="centrado-flex tag-traducible">{{$noAuthText}}</a>
        @else
            <a href="{{$noAuthUrlG}}" style="font-size: 2em;"><i class="{{$noAuthTextG}}"></i></a>
        @endif
    @endif
@endauth