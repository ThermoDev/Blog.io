@extends('layouts.app')

@section('content')
    <div class="flex justify-center mb-6">
        <div class="w-3/4 lg:w-5/12 bg-white p-6 rounded-lg">
            @if (session('msg'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                    {{ session('msg') }}
                </div>
            @endif
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6"
                    role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <h1 class="text-2xl font-medium mb-2 text-center">Update Basic Info</h1>
            <form action="{{ route('updateBio') }}" method="post" class="mb-4">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Name
                    </label>
                    <input type="text" name="name" id="name" placeholder="{{ $name }}"
                        class="shadow appearance-none border rounded-lg w-full py-4 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror"
                        value="{{ old('name') }}">
                    @error('name')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Bio
                    </label>
                    <textarea name="bio" id="bio" cols="30" rows="4"
                    class="shadow appearance-none border rounded-lg w-full py-4 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('bio') border-red-500 @enderror"
                    placeholder="{{ $bio }}" value="{{ old('bio') }}"></textarea>

                    @error('bio')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">
                        Update Bio!
                    </button>
                </div>
            </form>

            <br>
            <hr>
            <br>
            <h1 class="text-2xl font-medium mb-2 text-center">Update Password</h1>
            <form action="{{ route('updatePassword') }}" method="post">
                @csrf
                <div class="mb-4">
                    <label for="old_password" class="sr-only">Current password</label>
                    <input type="password" name="old_password" id="old_password" placeholder="Current password"
                        class="shadow appearance-none border rounded-lg w-full py-4 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror">
                    @error('old_password')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="new_password" class="sr-only">New password</label>
                    <input type="password" name="new_password" id="new_password" placeholder="New Password"
                        class="shadow appearance-none border rounded-lg w-full py-4 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror">
                    @error('new_password')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="new_password_confirmation" class="sr-only">New password confirmation</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                        placeholder="Confirm the new password"
                        class="shadow appearance-none border rounded-lg w-full py-4 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror">
                    @error('new_password_confirmation')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">
                        Change Password
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
