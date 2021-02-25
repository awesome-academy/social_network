<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset(config('img.img_logo')) }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ trans('log_res.title') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <!-- Styles -->
    {{ Html::script('messages.js') }}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/time_line.css') }}">
    <script src="{{ asset('bower_components/jquery/dist/jquery.slim.min.js') }}"></script>
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <link href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/font-awesome/css/all.min.css') }}" rel="stylesheet"
        crossorigin="anonymous">
    <script src="{{ asset('js/search.js') }}"></script>
    <script src="{{ asset('js/follow.js') }}"></script>
    <script src="{{ asset('js/like_post.js') }}"></script>
    <script src="{{ asset('js/profile.js') }}"></script>
    <script src="{{ asset('js/show_post.js') }}"></script>
    <script src="{{ asset('js/paginate.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/font-awesome/js/fontawesome.min.js') }}"></script>
    <script src="{{ asset('bower_components/font-awesome/js/all.js') }}"></script>
    <script src="{{ asset('js/comment.js') }}"></script>
    <script src="{{ asset('bower_components/pusher-js/dist/web/pusher.min.js') }}"></script>
    @yield('css')
    @toastr_css
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
            <div class="container" id="menu-top">
                <a class="navbar-brand" 
                    @if (Auth::check()) {
                        href="{{ route('home') }}"
                    }
                    @endif>
                    <img src="{{ asset(config('img.img_logo_navbar')) }}" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" 
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                    aria-expanded="false" aria-label="{{ trans('log_res.toggle') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home.lang', ['vi']) }}">Tiếng Việt</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home.lang', ['en']) }}">English</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ trans('log_res.login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ trans('log_res.register') }}</a>
                                </li>
                            @endif
                        @else 
                           <div class="menu_app">
                                <li class="list-inline" id="btn-search">
                                    <div>
                                        <input class="form-control mr-sm-4 search-input" id="search"  type="text" placeholder="{{ @trans('timeline.search') }}" aria-label="Search">
                                        <div class="card search-result" id="result"> 
                                        </div>
                                    </div>
                                </li>
                                <div class="li_navbar_icon">
                                    <li class="list-inline-item icon-navbar">
                                        <a href="{{ route('home') }}" class="link-menu">
                                            <svg viewBox="0 0 16 16" class="bi bi-house-door-fill icon">
                                                <path
                                                    d="M6.5 10.995V14.5a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5h-4a.5.5 0 0 1-.5-.5V11c0-.25-.25-.5-.5-.5H7c-.25 0-.5.25-.5.495z" />
                                                <path fill-rule="evenodd"
                                                    d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li class="list-inline-item ml-2 icon-navbar">
                                        <a type="button" href="{{ route('activity.history') }}" class="link-menu" type="button" data-toggle="modal" data-target="#listhistory">
                                            <svg viewBox="0 0 16 16" class="bi bi-compass icon">
                                                <path fill-rule="evenodd"
                                                    d="M8 15.016a6.5 6.5 0 1 0 0-13 6.5 6.5 0 0 0 0 13zm0 1a7.5 7.5 0 1 0 0-15 7.5 7.5 0 0 0 0 15z" />
                                                <path
                                                    d="M6 1a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2H7a1 1 0 0 1-1-1zm.94 6.44l4.95-2.83-2.83 4.95-4.95 2.83 2.83-4.95z" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li class="list-inline-item ml-2 icon-navbar notication-span">
                                        <a class="link-menu">
                                            <svg viewBox="0 0 16 16" class="bi bi-heart icon">
                                                <path fill-rule="evenodd"
                                                    d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                            </svg>
                                        </a>
                                        @if (count(Auth::user()->unreadNotifications) > config('check_var_on_view.count_notification'))
                                            <span id="count-noti" class="badge badge-danger span-count-noti" data-count="{{ count(Auth::user()->unreadNotifications) }}">{{ count(Auth::user()->unreadNotifications) }}</span>
                                        @endif
                                        <div class="dropdown-content">
                                            @foreach (Auth::user()->notifications->slice(config('check_var_on_view.start_record_notification'), config('check_var_on_view.end_record_notification')) as $notification)
                                                <input id="csrf" type="hidden" name="" value="{{ csrf_token() }}">   
                                                <input id="id_user" type="hidden" name="" value="{{ Auth::user()->id }}">
                                                <div class="notification-list{{ $loop->index }}">                         
                                                    @if ($notification->read_at == null)
                                                        <a class="read-noti" href="{{ route('read.noti', $notification->id) }}">
                                                            <div class="notification-unread">
                                                                <span>{{ $notification->data['user_name'] }}</span>
                                                                <span>{{ trans($notification->data['action']) }}</span>
                                                                <span>{{ trans($notification->data['for_you']) }}</span>
                                                            </div>
                                                        </a>
                                                    @else
                                                        <div class="notification-read">
                                                            <span>{{ $notification->data['user_name'] }}</span>
                                                            <span>{{ trans($notification->data['action']) }}</span>
                                                            <span>{{ trans($notification->data['for_you']) }}</span>
                                                        </div>
                                                    @endif
                                                    <hr>
                                                </div>
                                            @endforeach
                                        </div>
                                    </li>
                                    <li class="list-inline-item ml-2 align-middle">
                                        <a href="{{ route('profile.index') }}" class="link-menu">
                                            <div
                                                class="rounded-circle overflow-hidden d-flex justify-content-center align-items-center border topbar-profile-photo">
                                                <img class="img-profile" src="{{ asset('avatar/' . Auth::user()->avatar) }}" alt="...">
                                            </div>
                                        </a>
                                    </li>
                                </div>
                           </div>
                            </div>
                            &nbsp;
                            &nbsp;
                            <li class="nav-item dropdown">
                                &nbsp;
                                &nbsp;
                                <div class="dropdown" id="navbarDropdown">
                                    <span dusk="change-language">{{ Auth::user()->username }}</span>
                                </div>
                                <div class="dropdown-content" id="option-user">
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <li class="nav-item">
                                            <a class="nav-link" dusk="vi" href="{{ route('home.lang', ['vi']) }}">Tiếng Việt</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" dusk="en" href="{{ route('home.lang', ['en']) }}">English</a>
                                        </li>
                                        <button class="btn btn-link" type="submit">{{ trans('log_res.logout') }}</button>
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
            @yield('profile')
        </main>
    </div>
    @include('layouts.accesspusher')
</body>
    @jquery
    @toastr_js
    @toastr_render
</html>
