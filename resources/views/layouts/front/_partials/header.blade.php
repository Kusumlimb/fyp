<header>
    <div class="logo">
        <a href="{{route('front.home')}}">
            <img src="{{\Illuminate\Support\Facades\Vite::asset('resources/images/logo.png')}}" alt="logo" style="height: 50px;">
        </a>
    </div>
    <nav>
        <ul>
            <li><a href="{{route('front.home')}}">Home</a></li>
            <li><a href="{{route('front.courses')}}">Languages</a></li>
            <li><a href="/about/blog">Blog</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>
    <div>
        @guest
            <a href="{{route('register')}}" style="margin-right: 15px; color: white;">Register</a>
            <a href="{{route('login')}}" style="color: white;">Log In</a>
        @endguest
        @auth
            <form method="POST" action="{{route('logout')}}">
                @csrf
                <a onclick="event.preventDefault(); this.closest('form').submit()" href="#" style="color: white;">Log Out</a>
            </form>
        @endauth
    </div>
</header>