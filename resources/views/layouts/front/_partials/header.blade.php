<header>
    <div class="logo">
        <a href="{{route('front.home')}}">
            <img src="{{\Illuminate\Support\Facades\Vite::asset('resources/images/logo.png')}}" alt="logo" class="object-cover max-w-full h-[75px]">
        </a>
    </div>
    <nav>
        <ul>
            <li><a href="{{route('front.home')}}">Home</a></li>
            <li><a href="{{route('front.courses')}}">Languages</a></li>
            <li><a href="{{route('front.blogs')}}">Blog</a></li>
            <li><a href="{{route('front.contact')}}">Contact</a></li>
        </ul>
    </nav>
    <div class="flex justify-center items-center gap-x-2">
        @guest
            <a href="{{route('register')}}" style="margin-right: 15px; color: white;">Register</a>
            <a href="{{route('login')}}" style="color: white;">Log In</a>
        @endguest
        @auth
            <form method="POST" action="{{route('logout')}}">
                @csrf
                <a class="text-xs bg-red-500 rounded px-2 py-1" onclick="event.preventDefault(); this.closest('form').submit()" href="#" style="color: white;">Log Out</a>
            </form>
            @if(!auth()->user()->isStudent())
            <a href="{{route('dashboard.index')}}" class="text-xs bg-[#f39c12] rounded px-2 py-1">Dashboard</a>
            @endif
        @endauth
    </div>
</header>