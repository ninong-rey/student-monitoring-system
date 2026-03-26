<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    /**
     * Display a listing of all classes (for admin).
     */
    public function index()
    {
        $classes = Classes::with(['teacher.user', 'subject'])->get();
        return view('admin.classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new class.
     */
    public function create()
    {
        $teachers = Teacher::with('user')->get();
        $subjects = Subject::all();
        return view('admin.classes.create', compact('teachers', 'subjects'));
    }

    /**
     * Store a newly created class in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_name' => 'required|string',
            'section' => 'required|string',
            'academic_year' => 'required|string',
            'semester' => 'required|string',
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        Classes::create($request->all());

        return redirect()->route('admin.classes.index')
            ->with('success', 'Class created successfully.');
    }

    /**
     * Display the specified class.
     */
    public function show(Classes $class)
    {
        $class->load(['teacher.user', 'subject', 'students']);
        return view('admin.classes.show', compact('class'));
    }

    /**
     * Show the form for editing the specified class.
     */
    public function edit(Classes $class)
    {
        $teachers = Teacher::with('user')->get();
        $subjects = Subject::all();
        return view('admin.classes.edit', compact('class', 'teachers', 'subjects'));
    }

    /**
     * Update the specified class in storage.
     */
    public function update(Request $request, Classes $class)
    {
        $request->validate([
            'class_name' => 'required|string',
            'section' => 'required|string',
            'academic_year' => 'required|string',
            'semester' => 'required|string',
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $class->update($request->all());

        return redirect()->route('admin.classes.index')
            ->with('success', 'Class updated successfully.');
    }

    /**
     * Remove the specified class from storage.
     */
    public function destroy(Classes $class)
    {
        // Check if class has students
        if ($class->students()->count() > 0) {
            return redirect()->route('admin.classes.index')
                ->with('error', 'Cannot delete class because it has enrolled students.');
        }

        $class->delete();

        return redirect()->route('admin.classes.index')
            ->with('success', 'Class deleted successfully.');
    }

    /**
     * Display classes for the logged-in teacher.
     */
    public function teacherClasses()
    {
        $teacher = Auth::user()->teacher;
        
        $classes = Classes::where('teacher_id', $teacher->id)
            ->with(['subject', 'students'])
            ->get();

        return view('teacher.classes.index', compact('classes'));
    }

    /**
     * Display a specific class for teacher view.
     */
    public function teacherShow(Classes $class)
    {
        $teacher = Auth::user()->teacher;
        
        if ($class->teacher_id !== $teacher->id) {
            abort(403, 'Unauthorized access to this class.');
        }

        $class->load(['subject', 'students']);
        
        return view('teacher.classes.show', compact('class'));
    }
    /**
 * Show form to assign students to class.
 */
public function showAssignForm(Classes $class)
{
    $students = Student::all();
    $totalStudents = Student::count();
    $assignedCount = Student::where('class_id', $class->id)->count();
    
    return view('admin.classes.assign-students', compact('class', 'students', 'totalStudents', 'assignedCount'));
}

/**
 * Assign students to class.
 */
public function assignStudents(Request $request, Classes $class)
{
    $request->validate([
        'student_ids' => 'array',
        'student_ids.*' => 'exists:students,id'
    ]);

    // Remove all students from this class first (optional - depends on your needs)
    // Student::where('class_id', $class->id)->update(['class_id' => null]);
    
    // Assign selected students to this class
    if ($request->has('student_ids')) {
        Student::whereIn('id', $request->student_ids)->update(['class_id' => $class->id]);
        
        // Optional: Remove students not in the list from this class
        Student::whereNotIn('id', $request->student_ids)
            ->where('class_id', $class->id)
            ->update(['class_id' => null]);
    } else {
        // If no students selected, remove all from this class
        Student::where('class_id', $class->id)->update(['class_id' => null]);
    }

    return redirect()->route('admin.classes.show', $class)
        ->with('success', 'Students assigned successfully!');
}
}