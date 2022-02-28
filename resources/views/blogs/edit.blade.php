@extends('layouts.app')

@section('content')
    <div class="flex justify-center mb-6">
        <div class="w-3/4 lg:w-5/12 bg-white p-6 rounded-lg text-center">
            <form action="{{ route('editBlog', $blog->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label for="name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Title
                    </label>
                    <input type="text" name="title" id="title" placeholder="Blog Title"
                        class="shadow appearance-none border rounded-lg w-full py-4 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror"
                        value="{{ old('title', $blog->title) }}">
                    @error('title')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Content
                    </label>
                    <textarea name="content" id="content" cols="30" rows="4"
                        class="shadow appearance-none border rounded-lg w-full py-4 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('content') border-red-500 @enderror"
                        placeholder="Content">{{ old('content', $blog->content) }}</textarea>

                    @error('content')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                        Update blog!
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
