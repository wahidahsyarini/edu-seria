<?php
namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller {

    // LIST all published courses (Learner view)
    public function index() {
        $courses = Course::where('is_published', true)->with('educator')->latest()->get();
        return view('courses.index', compact('courses'));
    }

    // Educator: manage own courses
    public function manage() {
        $this->authorize('create', Course::class);
        $courses = Course::where('educator_id', Auth::id())->latest()->get();
        return view('courses.manage', compact('courses'));
    }

    public function create() {
        $this->authorize('create', Course::class);
        return view('courses.create');
    }

    public function store(Request $request) {
        $this->authorize('create', Course::class);
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_published'=> 'nullable|boolean',
        ]);
        $data['educator_id'] = Auth::id();
        $data['is_published'] = $request->has('is_published');
        Course::create($data);
        return redirect()->route('courses.manage')->with('success', 'Course created!');
    }

    public function show(Course $course) {
        $isEnrolled = Auth::check()
            ? $course->enrollments()->where('user_id', Auth::id())->exists()
            : false;
        return view('courses.show', compact('course', 'isEnrolled'));
    }

    public function edit(Course $course) {
        $this->authorize('update', $course);
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course) {
        $this->authorize('update', $course);
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $data['is_published'] = $request->has('is_published');
        $course->update($data);
        return redirect()->route('courses.manage')->with('success', 'Course updated!');
    }

    public function destroy(Course $course) {
        $this->authorize('delete', $course);
        $course->delete();
        return redirect()->route('courses.manage')->with('success', 'Course deleted!');
    }
}