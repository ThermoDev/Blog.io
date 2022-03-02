@extends('layouts.app')

@section('content')
    <div class="flex justify-center mb-6">
        <div class="w-3/4 lg:w-5/12 bg-white p-6 rounded-lg">
            <x-alerts />

            @if ($editable)
                <div class="flex justify-between mb-6">
                    <div></div>
                    <div>
                        <a type="button" href="{{ route('editProfile') }}"
                            class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Edit Profile
                        </a>
                    </div>
                </div>
            @endif

            <h1 class="text-3xl font-medium mb-2 text-center">Profile Page</h1>
            <h1 class="text-2xl font-medium mb-4 text-center">{{ $name }}</h1>

            <div
                class="w-full border-r mb-4 border-b border-l border-gray-400 border-t bg-white rounded p-4 flex flex-col justify-between leading-normal">
                <div class="mb-8">
                    <div class="text-gray-900 font-bold text-xl mb-2">Bio:</div>
                    <p class="text-gray-700 text-base text-left">{{ $bio }}</p>
                </div>
            </div>

            <div class="mt-4">
                <div class="text-gray-900 font-bold text-xl mb-4">Blogs created by {{ $name }}</div>
                @foreach ($blogs as $blog)
                    <div class="mb-4">
                        <a class="mb-2 inline-block align-baseline font-bold text-xl text-blue-500 hover:text-blue-800"
                            href="{{ route('blog', $blog->id) }} ">
                            {{ $blog->title }}</a>
                        <span class="text-gray-600 text-sm">{{ $blog->created_at->diffForHumans() }}</span>
                        <hr>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            {{ $blogs->links() }}

            <div class="mt-6">
                <a type="button" href="{{ url()->previous() }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    < Go back </a>
            </div>
        </div>
    </div>
@endsection
