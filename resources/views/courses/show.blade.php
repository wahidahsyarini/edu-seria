@extends('layouts.app')

@section('header_title')
    <h1 class="text-2xl font-bold text-gray-800 mb-6">{{ $course->title }}</h1>
@endsection

@section('content')
    <div class="bg-white rounded-lg shadow p-8">
        <p class="text-sm text-gray-500 mb-2">
            Educator: <span class="font-medium">{{ $course->educator->name }}</span>
        </p>
        <p class="text-gray-700 leading-relaxed mb-6">{{ $course->description }}</p>

        @auth
            @if(auth()->user()->isLearner())
                @if($isEnrolled)
                    <div class="flex items-center gap-4">
                        <span class="bg-green-100 text-green-700 px-4 py-2 rounded font-medium">
                            ✅ Enrolled
                        </span>
                        <form method="POST" action="{{ route('enrollments.destroy', $course) }}">
                            @csrf @method('DELETE')
                            <button class="text-red-500 hover:underline text-sm">Unenroll</button>
                        </form>
                    </div>
                @else
                    <form method="POST" action="{{ route('enrollments.store', $course) }}">
                        @csrf
                        <button class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                            Enroll Now
                        </button>
                    </form>
                @endif
            @endif
            @if(auth()->user()->isEducator() && auth()->id() === $course->educator_id)
                <div class="flex gap-3">
                    <a href="{{ route('courses.edit', $course) }}"
                       class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
                    <form method="POST" action="{{ route('courses.destroy', $course) }}">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Delete this course?')"
                                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Delete</button>
                    </form>
                </div>
            @endif
        @else
            <a href="{{ route('login') }}"
               class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Login to Enroll</a>
        @endauth
    </div>
@endsection