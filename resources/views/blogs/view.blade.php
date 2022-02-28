@extends('layouts.app')

@section('content')
    <div class="flex justify-center mb-6">
        <div class="w-3/4 lg:w-5/12 bg-white p-6 rounded-lg text-center">
            <div class="max-w-sm w-full max-w-full">
                @if ($editable)
                    <div class="flex justify-between mb-6">
                        <div>
                            <form action="{{ route('destroyBlog', $blog->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Delete Blog
                                </button>
                            </form>
                        </div>
                        <div>
                            <a type="button" href="{{ route('editBlog', $blog->id) }}"
                                class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Edit Blog
                            </a>
                        </div>
                    </div>
                @endif
                <div
                    class="w-full border-r border-b border-l border-gray-400 border-t bg-white rounded p-4 flex flex-col justify-between leading-normal">
                    <div class="mb-8">
                        <div class="text-gray-900 font-bold text-xl mb-2">{{ $blog->title }}</div>
                        <p class="text-gray-700 text-base text-left">{{ $blog->content }}</p>
                    </div>
                    <div class="flex items-center justify-center">
                        <div class="text-sm">
                            <p class="text-gray-900 leading-none">{{ $blog->user->name }}</p>
                            <p class="text-gray-600">{{ $blog->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <a type="button" href="{{ route('blogs') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                    Back to all Blogs
                </a>
            </div>
        </div>
    </div>
@endsection
