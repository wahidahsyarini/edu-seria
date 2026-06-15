<?php
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController; // ← this line is missing
use Illuminate\Support\Facades\Route;


// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');
Route::get('/', fn() => redirect()->route('courses.index'));

// Public
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return auth()->user()->isEducator()
            ? redirect()->route('courses.manage')
            : redirect()->route('enrollments.my-learning');
    })->name('dashboard');

    // Educator routes
    Route::get('/my-courses', [CourseController::class, 'manage'])->name('courses.manage');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');  // ← before {course}
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
    Route::resource('users', UserController::class)->except(['create','store','show']);

    // Learner routes
    Route::post('/enroll/{course}', [EnrollmentController::class, 'store'])->name('enrollments.store');
    Route::delete('/unenroll/{course}', [EnrollmentController::class, 'destroy'])->name('enrollments.destroy');
    Route::get('/my-learning', [EnrollmentController::class, 'myLearning'])->name('enrollments.my-learning');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
});

Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');