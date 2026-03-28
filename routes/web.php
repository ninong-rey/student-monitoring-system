<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ReportController;

Route::get('/test', function () {
    return '✅ App is working! PHP version: ' . PHP_VERSION;
});

// Public routes
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware(['auth'])->group(function () {
    
    // Admin routes
    Route::middleware(['can:admin'])->prefix('admin')->name('admin.')->group(function () {

    // ========== DROP STUDENT ROUTES ==========
        // Dropped students list
        Route::get('/students/dropped', [StudentController::class, 'droppedStudents'])->name('students.dropped');
        
        // Drop student form and action
        Route::get('/students/{student}/drop', [StudentController::class, 'showDropForm'])->name('students.drop-form');
        Route::delete('/students/{student}/drop', [StudentController::class, 'dropStudent'])->name('students.drop');
        
        // Restore student
        Route::patch('/students/{student}/restore', [StudentController::class, 'restoreStudent'])->name('students.restore');
        
        // Drop history
        Route::get('/students/history/drop', [StudentController::class, 'dropHistory'])->name('students.drop-history');
    
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
        Route::resource('teachers', TeacherController::class);
        Route::resource('students', StudentController::class);
        Route::resource('subjects', SubjectController::class);
        Route::resource('classes', ClassController::class);
        Route::get('/classes/{class}/assign-students', [ClassController::class, 'showAssignForm'])->name('classes.assign-form');
        Route::post('/classes/{class}/assign-students', [ClassController::class, 'assignStudents'])->name('classes.assign-students');
        
        // Report routes
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/student', [ReportController::class, 'studentReport'])->name('reports.student');
        Route::get('/reports/class', [ReportController::class, 'classReport'])->name('reports.class');
        Route::get('/reports/teacher', [ReportController::class, 'teacherReport'])->name('reports.teacher');
        Route::get('/reports/export/{type}', [ReportController::class, 'export'])->name('reports.export');
        
        });
    
    // Teacher routes
    Route::middleware(['can:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'teacherDashboard'])->name('dashboard');
        Route::get('/classes', [ClassController::class, 'teacherClasses'])->name('classes.index');
        Route::get('/classes/{class}', [ClassController::class, 'teacherShow'])->name('classes.show');
        Route::get('/students', [StudentController::class, 'teacherStudents'])->name('students.index');
        Route::get('/students/{student}', [StudentController::class, 'teacherShow'])->name('students.show');
        Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');
        Route::get('/grades/class/{class}', [GradeController::class, 'classGrades'])->name('grades.class');
        Route::post('/grades/calculate/{class}', [GradeController::class, 'calculate'])->name('grades.calculate');
        Route::post('/scores/store', [GradeController::class, 'storeScore'])->name('scores.store');
        Route::get('/grades/export/{class}', [GradeController::class, 'export'])->name('grades.export');
        
        // ========== TEACHER DROP STUDENT ROUTES ==========
        // Drop student form and action for teachers
        Route::get('/students/{student}/drop', [StudentController::class, 'teacherDropForm'])->name('students.drop-form');
        Route::delete('/students/{student}/drop', [StudentController::class, 'teacherDropStudent'])->name('students.drop');
    });
});