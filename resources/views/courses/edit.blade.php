@extends('layouts.app')

@section('header_title')
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Course</h1>
@endsection

@section('content')
    <div class="bg-white rounded-lg shadow p-8 max-w-2xl">
        <form method="POST" action="{{ route('courses.update', $course) }}">
            @csrf @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Course Title</label>
                <input type="text" name="title" value="{{ old('title', $course->title) }}"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="4"
                          class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $course->description) }}</textarea>
            </div>
            <div class="mb-6 flex items-center gap-2">
                <input type="checkbox" name="is_published" id="is_published" value="1"
                       {{ $course->is_published ? 'checked' : '' }}>
                <label for="is_published" class="text-sm text-gray-700">Published</label>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600">
                    Update Course
                </button>
                <a href="{{ route('courses.manage') }}"
                   class="bg-gray-200 text-gray-700 px-6 py-2 rounded hover:bg-gray-300">Cancel</a>
            </div>
        </form>
    </div>
@endsection