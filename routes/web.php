<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('courses', CourseController::class);

Route::get('/courses/{course}/availability', function (Course $course) {
    return response()->json([
        'course' => $course->name,
        'remaining' => $course->quota,
    ]);
})->name('courses.availability');

Route::get('/pendaftaran', function () {
    $courses = Course::where('status', 'open')->orderBy('name')->get();

    return view('enrollments.create', compact('courses'));
})->name('enrollments.create');

Route::post('/pendaftaran/preview', function (Request $request) {
    $data = $request->validate([
        'name' => ['required', 'string', 'min:3', 'max:100'],
        'email' => ['required', 'email'],
        'course_id' => ['required', 'integer', 'exists:courses,id'],
    ]);

    return back()
        ->with('success', 'Form lolos validasi. Pendaftaran akan disimpan pada pertemuan berikutnya.')
        ->withInput();
})->name('enrollments.preview');