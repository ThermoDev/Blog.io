@extends('layouts.app')

@section('content')
    <div class="flex justify-center mb-6">
        <div class="w-3/4 lg:w-5/12 bg-white p-6 rounded-lg">
            <div class="bg-white p-6 rounded-lg">
                <x-alerts />
                @auth
                    <div class="flex justify-between mb-6">
                        <div></div>
                        <div>
                            <a type="button" href="{{ route('createBlog') }}"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Create Blog
                            </a>
                        </div>
                    </div>
                @endauth
                <h1 class="text-3xl font-medium mb-6 text-center">All blogs!</h1>

                @foreach ($blogs as $blog)
                    <div class="mb-4">
                        <p><a href="{{ route('profile', $blog->user->id) }}"
                                class="font-bold text-gray-600 hover:text-gray-900">{{ $blog->user->name }}</span></a>
                            <span class="text-gray-600 text-sm">{{ $blog->created_at->diffForHumans() }}</span>
                        </p>
                        <a class="mb-2 inline-block align-baseline font-bold text-xl text-blue-500 hover:text-blue-800"
                            href="{{ route('blog', $blog->id) }} ">
                            {{ $blog->title }}</a>
                            <hr>
                    </div>
                @endforeach

                {{-- Pagination --}}
                {{ $blogs->links() }}
            </div>
        </div>
    </div>
@endsection
