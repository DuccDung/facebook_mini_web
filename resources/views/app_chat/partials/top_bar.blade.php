<div class="topbar">
    <!-- Left: Logo + Search -->
    <div class="top-left">
        <a class="brand" href="{{ route('home') }}"><img src="{{ Vite::asset('resources/assets/app_chat/icons/facebook.svg') }}"
                alt=""></a>
        <div class="searchbar-top">
            <img src="{{ Vite::asset('resources/assets/app_chat/icons/search.svg') }}" alt="">
            <input type="text" placeholder="Tìm kiếm trên Facebook">
        </div>
    </div>

    <!-- Center: Main nav -->
    <div class="top-center">
        {{-- <button class="icon-btn"><img src="{{ Vite::asset('resources/assets/app_chat/icons/house-door.svg') }}"
                alt=""></button>
        <button class="icon-btn"><img src="{{ Vite::asset('resources/assets/app_chat/icons/people-fill.svg') }}"
                alt=""></button>
        <button class="icon-btn"><img src="{{ Vite::asset('resources/assets/app_chat/icons/play-btn.svg') }}"
                alt=""></button>
        <button class="icon-btn"><img src="{{ Vite::asset('resources/assets/app_chat/icons/shop copy.svg') }}"
                alt=""></button>
        <button class="icon-btn"><img src="{{ Vite::asset('resources/assets/app_chat/icons/controller.svg') }}"
                alt=""></button> --}}
    </div>

    <!-- Right: Options -->
    <div class="top-right">
        <a href="{{ route('chat') }}" class="icon-btn"><img src="{{ Vite::asset('resources/assets/app_chat/icons/messenger2.png') }}"
                alt=""></a>
        <button class="icon-btn"><img src="{{ Vite::asset('resources/assets/app_chat/icons/bell.svg') }}"
                alt=""></button>
        {{-- <button class="avatar"><img id="avatar__img-main" src="{{ Vite::asset('resources/assets/app_chat/images/user-default.png') }}" alt=""></button> --}}
        <a href="{{ route('personal') }}" class="avatar">
        <button class="avatar">
            <img id="avatar__img-main" src="{{ Vite::asset('resources/assets/app_chat/images/user-default.png') }}"
                data-default-src="{{ Vite::asset('resources/assets/app_chat/images/user-default.png') }}"
                alt="">
        </button>
        </a>
    </div>
</div>
