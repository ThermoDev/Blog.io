<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog.io</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="bg-gray-200">
    <nav class="flex items-center justify-between flex-wrap bg-blue-500 p-6 mb-6">
        <div class="flex items-center flex-shrink-0 text-white mr-6">
            <svg class="fill-current h-8 w-8 mr-2" width="54" height="54" viewBox="0 -10 54 54"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="m34.098 24.095l-0.016 6.905-5.635-6.376h-11.928c-3.548 0-6.425-2.877-6.425-6.426v-7.476c0-3.548 2.876-6.425 6.425-6.425h15.035c3.548 0 6.425 2.877 6.425 6.425v7.476c0 2.645-1.6 4.911-3.881 5.897zm-26.075-13.392v5.354l-4.794 5.357-0.009-5.805c-1.893-0.825-3.22-2.709-3.22-4.906v-5.349c0-2.958 2.396-5.354 5.355-5.354h12.719c1.743 0 3.277 0.846 4.254 2.135h-5.738c-4.732 0-8.567 3.835-8.567 8.568z">
                </path>
                <span class="font-semibold text-xl tracking-tight">Blog.io</span>
        </div>

        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
            <div class="text-sm lg:flex-grow">
                <a href="{{ route('home') }}"
                    class="block mt-4 lg:inline-block lg:mt-0 text-blue-200 hover:text-white mr-4">
                    Home
                </a>
                <a href="{{ route('blogs') }}"
                    class="block mt-4 lg:inline-block lg:mt-0 text-blue-200 hover:text-white mr-4">
                    Blogs
                </a>
                @if (auth()->user() && auth()->user()->admin)
                    <a href="{{ route('activities') }}"
                        class="block mt-4 lg:inline-block lg:mt-0 text-blue-200 hover:text-white">
                        Activity Logs
                    </a>
                @endif
            </div>

            <div>
                @auth
                    <a href="{{ route('profile', auth()->user()->id) }}"
                        class="inline-block text-sm px-4 py-2 leading-none border rounded text-white
                            border-white hover:border-transparent hover:text-blue-500 hover:bg-white mt-4 mr-3 lg:mt-0">
                        Profile
                    </a>
                    <form action="{{ route('logout') }}" method="post" class="inline">
                        @csrf
                        <button type="submit"
                            class="inline-block text-sm px-4 py-2 leading-none border rounded text-white
                        border-white hover:border-transparent hover:text-blue-500 hover:bg-white mt-4 lg:mt-0">Logout</button>
                    </form>
                @endauth
                @guest
                    <a href="{{ route('register') }}"
                        class="inline-block text-sm px-4 py-2 leading-none border rounded text-white
                            border-white hover:border-transparent hover:text-blue-500 hover:bg-white mt-4 mr-3 lg:mt-0">
                        Register
                    </a>
                    <a href="{{ route('login') }}"
                        class="inline-block text-sm px-4 py-2 leading-none border rounded text-white
                            border-white hover:border-transparent hover:text-blue-500 hover:bg-white mt-4 lg:mt-0">
                        Login
                    </a>
                @endguest
            </div>
        </div>
    </nav>
    @yield('content')
</body>

</html>
