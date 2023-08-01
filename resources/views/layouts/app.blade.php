<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite('resources/css/app.css')
{{--    @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <div class="row" id="app">
        <div class="col-md-2 sidebar">
            <nav class="navbar navbar-inverse" id="sidebar-wrapper" role="navigation">
                <ul class="nav sidebar-nav">
                    <div class="sidebar-header">
                        <div class="sidebar-brand">
                            <ul>
{{--                                @if(auth()->user()->hasRole('business analyst')&& status_id == 1 )--}}
                                @if(auth()->user()->hasRole('Admin'))
                                    @if(request()->routeIs('admin*'))
                                        <li class="active"><a href="{{ route('admin.dashboard') }}"><img src="/images/users_green.png" alt="users">Users</a></li>
                                    @else
                                        <li><a href="{{ route('admin.dashboard') }}"><img src="/images/users_white.png" alt="users">Users</a></li>
                                    @endif
                                    @if(request()->routeIs('systems*'))
                                        <li class="active"><a href="{{ route('systems') }}"><img src="/images/system_green.png" alt="system">Systems</a></li>
                                    @else
                                        <li><a href="{{ route('systems') }}"><img src="/images/system_white.png" alt="system">Systems</a></li>
                                    @endif
                                    @if(request()->routeIs('roles*'))
                                        <li class="active"><a href="{{ route('roles') }}"><img src="/images/role_green.png" alt="role">Roles</a></li>
                                    @else
                                        <li><a href="{{ route('roles') }}"><img src="/images/role_white.png" alt="role">Roles</a></li>
                                    @endif
                                @endif
{{--                                                                @endrole--}}
{{--                                                                @role('User')--}}
{{--                                @if(request()->routeIs('change_requests*'))--}}
{{--                                    <li class="active"><a href="{{ route('change_requests.create') }}"><font-awesome-icon icon="fa-solid fa-plus" style="color: #026b5b;"/>Create</a></li>--}}
{{--                                @else--}}
{{--                                    <li><a href="{{ route('change_requests.create') }}"><span><font-awesome-icon icon="fa-solid fa-plus" style="color: #ffffff;"/></span>--}}
{{--                                            <span class="create-text"> Create </span></a></li>--}}
{{--                                @endif--}}
                                    @if(request()->routeIs('change_requests*'))
                                        <li class="active"><a href="{{ route('change_requests') }}"><img src="/images/request_green.png" alt="request">Requests</a></li>
                                    @else
                                        <li><a href="{{ route('change_requests') }}"><img src="/images/request_white.png" alt="request">Requests</a></li>
                                    @endif
{{--                                                                @endrole--}}
                            </ul>
                        </div>
                    </div>

                </ul>
            </nav>
        </div>


        <!-- Page Content -->
        <main class="col-md-10">
            @include('flash-message')
            {{ $slot }}
        </main>
    </div>
</div>
@vite('resources/js/app.js')
</body>
</html>
