@extends('layouts.app')

@section('header_title')
    <h1 class="text-2xl font-bold text-gray-800 mb-6">My Courses</h1>
@endsection

@section('content')
    <div class="mb-4">
        <a href="{{ route('courses.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ New Course</a>
    </div>

    @forelse($courses as $course)
        <div class="bg-white rounded-lg shadow p-5 mb-3 flex justify-between items-center">
            <div>
                <h3 class="font-bold text-gray-800">{{ $course->title }}</h3>
                <div class="flex items-center gap-3 mt-1">
                    <span class="text-xs px-2 py-0.5 rounded
                        {{ $course->is_published ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                        {{ $course->is_published ? 'Published' : 'Draft' }}
                    </span>
                    <span class="text-xs text-gray-400">{{ $course->enrollments->count() }} students</span>
                </div>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('courses.show', $course) }}"
                   class="text-sm bg-gray-100 text-gray-700 px-3 py-1.5 rounded hover:bg-gray-200">View</a>
                <a href="{{ route('courses.edit', $course) }}"
                   class="text-sm bg-yellow-100 text-yellow-700 px-3 py-1.5 rounded hover:bg-yellow-200">Edit</a>
                <form method="POST" action="{{ route('courses.destroy', $course) }}">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Delete this course?')"
                            class="text-sm bg-red-100 text-red-700 px-3 py-1.5 rounded hover:bg-red-200">Delete</button>
                </form>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-lg shadow p-12 text-center text-gray-400">
            You haven't created any courses yet.
        </div>
    @endforelse
@endsection