@extends('layouts.app')

@section('content')
    <div class="flex justify-center mb-6">
        <div class="w-3/4 lg:w-5/12 bg-white p-6 rounded-lg text-center">
            <x-alerts />
            @auth
                <p>Hello <span class="font-bold">{{ auth()->user()->name }}</span>!</p>
            @endauth
            @guest
                <p>Welcome to Blog.io!</p>
                <div class="mt-6">
                    <a href="{{ route('register') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
                        Click here to register!
                    </a>
                </div>
            @endguest
        </div>
    </div>
@endsection
