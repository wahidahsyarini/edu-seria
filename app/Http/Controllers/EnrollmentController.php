<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller {

    public function store(Course $course) {
    if (!Auth::user()->isLearner()) {
        return back()->with('error', 'Only learners can enroll.');
    }
    Enrollment::firstOrCreate([
        'user_id'   => Auth::id(),
        'course_id' => $course->id,
    ]);
    return back()->with('success', 'Enrolled successfully!');
}

    public function destroy(Course $course) {
        Enrollment::where('user_id', Auth::id())
                  ->where('course_id', $course->id)
                  ->delete();
        return back()->with('success', 'Unenrolled.');
    }

    public function myLearning() {
        $enrollments = Auth::user()->enrollments()->with('course.educator')->latest()->get();
        return view('enrollments.my-learning', compact('enrollments'));
    }
}