<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of reports.
     */
    public function index()
    {
        // Get summary statistics
        $totalStudents = Student::count();
        $totalTeachers = Teacher::count();
        $totalClasses = Classes::count();
        $totalSubjects = Subject::count();
        
        // Get students by gender
        $maleStudents = Student::where('gender', 'Male')->count();
        $femaleStudents = Student::where('gender', 'Female')->count();
        
        // Get passing/failing statistics
        $passingGrades = Grade::where('average_grade', '>=', 75)->count();
        $failingGrades = Grade::where('average_grade', '<', 75)->count();
        $totalGrades = Grade::count();
        
        // Get recent grades
        $recentGrades = Grade::with(['student', 'class'])
            ->latest()
            ->take(10)
            ->get();
        
        // Get class performance summary
        $classPerformance = Classes::with(['subject'])
            ->withCount('students')
            ->get()
            ->map(function($class) {
                $avgGrade = Grade::where('class_id', $class->id)
                    ->avg('average_grade');
                $class->average_grade = $avgGrade ? round($avgGrade, 2) : 0;
                return $class;
            })
            ->sortByDesc('average_grade')
            ->take(5);
        
        return view('admin.reports.index', compact(
            'totalStudents',
            'totalTeachers',
            'totalClasses',
            'totalSubjects',
            'maleStudents',
            'femaleStudents',
            'passingGrades',
            'failingGrades',
            'totalGrades',
            'recentGrades',
            'classPerformance'
        ));
    }

    /**
     * Generate student performance report.
     */
    public function studentReport(Request $request)
    {
        $query = Student::with(['class', 'grades']);
        
        // Apply filters
        if ($request->has('class_id') && $request->class_id) {
            $query->where('class_id', $request->class_id);
        }
        
        if ($request->has('gender') && $request->gender) {
            $query->where('gender', $request->gender);
        }
        
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('student_id', 'like', "%{$search}%");
            });
        }
        
        $students = $query->get();
        
        // Calculate statistics for each student
        foreach ($students as $student) {
            $grades = $student->grades;
            $student->average_grade = $grades->avg('average_grade') ?: 0;
            $student->total_classes = $grades->count();
            $student->passing_classes = $grades->where('remarks', 'Passed')->count();
        }
        
        $classes = Classes::all();
        
        return view('admin.reports.student', compact('students', 'classes'));
    }

    /**
     * Generate class performance report.
     */
    public function classReport(Request $request)
    {
        $query = Classes::with(['teacher.user', 'subject', 'students']);
        
        if ($request->has('academic_year') && $request->academic_year) {
            $query->where('academic_year', $request->academic_year);
        }
        
        if ($request->has('semester') && $request->semester) {
            $query->where('semester', $request->semester);
        }
        
        $classes = $query->get();
        
        foreach ($classes as $class) {
            $grades = Grade::where('class_id', $class->id)->get();
            $class->average_grade = $grades->avg('average_grade') ?: 0;
            $class->total_students = $class->students->count();
            $class->graded_students = $grades->count();
            $class->passing_students = $grades->where('remarks', 'Passed')->count();
        }
        
        $academicYears = Classes::distinct('academic_year')->pluck('academic_year');
        $semesters = ['1st', '2nd'];
        
        return view('admin.reports.class', compact('classes', 'academicYears', 'semesters'));
    }

    /**
     * Generate teacher performance report.
     */
    public function teacherReport()
    {
        $teachers = Teacher::with(['user', 'classes'])->get();
        
        foreach ($teachers as $teacher) {
            $classIds = $teacher->classes->pluck('id');
            $grades = Grade::whereIn('class_id', $classIds)->get();
            
            $teacher->total_classes = $teacher->classes->count();
            $teacher->total_students = Student::whereIn('class_id', $classIds)->count();
            $teacher->average_grade = $grades->avg('average_grade') ?: 0;
            $teacher->passing_rate = $grades->count() > 0 
                ? round(($grades->where('remarks', 'Passed')->count() / $grades->count()) * 100, 2)
                : 0;
        }
        
        return view('admin.reports.teacher', compact('teachers'));
    }

    /**
     * Export report as PDF (placeholder - requires barryvdh/laravel-dompdf package).
     */
    public function export(Request $request, $type)
    {
        // This is a placeholder for PDF export
        // You'll need to install: composer require barryvdh/laravel-dompdf
        
        return redirect()->route('admin.reports.index')
            ->with('info', 'PDF export feature coming soon!');
    }
}