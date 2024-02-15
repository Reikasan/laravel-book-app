<nav>
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
</nav>