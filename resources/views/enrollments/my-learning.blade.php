@extends('layouts.app')

@section('header_title')
    <h1 class="text-2xl font-bold text-gray-800 mb-6">My Learning</h1>
@endsection

@section('content')
    @forelse($enrollments as $enrollment)
        <div class="bg-white rounded-lg shadow p-5 mb-3 flex justify-between items-center">
            <div>
                <h3 class="font-bold text-gray-800">{{ $enrollment->course->title }}</h3>
                <p class="text-sm text-gray-500 mt-1">By {{ $enrollment->course->educator->name }}</p>
                <p class="text-xs text-gray-400 mt-1">Enrolled {{ $enrollment->created_at->diffForHumans() }}</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('courses.show', $enrollment->course) }}"
                   class="text-sm bg-blue-100 text-blue-700 px-3 py-1.5 rounded hover:bg-blue-200">Go to Course</a>
                <form method="POST" action="{{ route('enrollments.destroy', $enrollment->course) }}">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Unenroll?')"
                            class="text-sm bg-red-100 text-red-700 px-3 py-1.5 rounded hover:bg-red-200">Unenroll</button>
                </form>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-lg shadow p-12 text-center text-gray-400">
            You haven't enrolled in any courses yet.
            <a href="{{ route('courses.index') }}" class="block mt-4 text-blue-600 hover:underline">Browse courses</a>
        </div>
    @endforelse
@endsection