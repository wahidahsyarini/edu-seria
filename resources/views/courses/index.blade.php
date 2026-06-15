@extends('layouts.app')

@section('header_title')
    <h1 class="text-2xl font-bold text-gray-800 mb-6">All Courses</h1>
@endsection

@section('content')
    @forelse($courses as $course)
        <div class="bg-white rounded-lg shadow p-6 mb-4 flex justify-between items-start">
            <div>
                <h2 class="text-lg font-bold text-gray-800">{{ $course->title }}</h2>
                <p class="text-sm text-gray-500 mt-1">By {{ $course->educator->name }}</p>
                <p class="text-gray-600 mt-2">{{ Str::limit($course->description, 120) }}</p>
            </div>
            <a href="{{ route('courses.show', $course) }}"
               class="ml-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm whitespace-nowrap">
                View Course
            </a>
        </div>
    @empty
        <div class="bg-white rounded-lg shadow p-12 text-center text-gray-400">
            No courses available yet.
            @auth
                @if(auth()->user()->isEducator())
                    <a href="{{ route('courses.create') }}" class="block mt-4 text-blue-600 hover:underline">
                        Create the first course
                    </a>
                @endif
            @endauth
        </div>
    @endforelse
@endsection