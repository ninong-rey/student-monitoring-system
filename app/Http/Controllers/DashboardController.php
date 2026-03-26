<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $totalStudents = Student::count();
        $totalTeachers = Teacher::count();
        $totalClasses = Classes::count();
        $totalSubjects = Subject::count();
        
        $recentStudents = Student::with('class')
            ->latest()
            ->take(5)
            ->get();
            
        $recentTeachers = Teacher::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalStudents', 'totalTeachers', 'totalClasses', 
            'totalSubjects', 'recentStudents', 'recentTeachers'
        ));
    }

    public function teacherDashboard()
    {
        $teacher = Auth::user()->teacher;
        
        $myClasses = Classes::where('teacher_id', $teacher->id)
            ->with('subject')
            ->count();
            
        $myStudents = Student::whereIn('class_id', 
            Classes::where('teacher_id', $teacher->id)->pluck('id')
        )->count();
        
        $recentClasses = Classes::where('teacher_id', $teacher->id)
            ->with('subject')
            ->latest()
            ->take(5)
            ->get();

        return view('teacher.dashboard', compact(
            'myClasses', 'myStudents', 'recentClasses'
        ));
    }
}