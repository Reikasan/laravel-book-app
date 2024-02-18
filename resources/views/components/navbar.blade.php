<nav class="nav"> 
    <div class="nav--left">
        <a 
        @auth
            href="{{ route('home') }}"
        @else
            href="{{ route('welcome') }}"
        @endauth 
        >
            <div class="logo">
                <img src="{{ asset('images/yomulog1-logos_transparent.png') }}" alt="Logo" />
            </div>
        </a>
    </div>
    @auth    
    <div class="nav--right">
        <form action={{ route('logout') }} method="POST">
            @csrf
            <button type="submit" class="nav__btn--sq">Log<span>out</span></button>
        </form>
    </div>
    @endauth
</nav>