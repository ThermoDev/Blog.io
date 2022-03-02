@extends('layouts.app')

@section('content')
    <div class="flex justify-center mb-6">
        <div class="w-3/4 lg:w-5/12 bg-white p-6 rounded-lg">
            <div class="bg-white p-6 rounded-lg">
                <h1 class="text-2xl font-medium mb-2 text-center">Activity Logs</h1>
                @foreach ($activities as $activity)
                    <div class="mb-4">
                        <p></a> <span class="text-gray-600 text-sm">{{ $activity->created_at }}</span>

                        <p class="mb-2">
                            <a href="{{ route('profile', $activity->causer->id) }}"
                                class="font-bold text-gray-600 hover:text-gray-900">
                                {{ $activity->causer->name }}
                            </a></span>:
                            {{ $activity->description }}</p>
                    </div>
                @endforeach

                {{-- Pagination --}}
                {{ $activities->links() }}
            </div>
        </div>
    </div>
@endsection
