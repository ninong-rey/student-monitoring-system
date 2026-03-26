<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of all students (for admin).
     */
    public function index()
    {
        $students = Student::with('class')->get();
        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        $classes = Classes::all();
        return view('admin.students.create', compact('classes'));
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|string|unique:students',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'birth_date' => 'required|date',
            'gender' => 'required|string',
            'address' => 'required|string',
            'contact_number' => 'nullable|string',
            'guardian_name' => 'required|string',
            'guardian_contact' => 'required|string',
            'class_id' => 'nullable|exists:classes,id',
        ]);

        Student::create($request->all());

        return redirect()->route('admin.students.index')
            ->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified student.
     */
    public function show(Student $student)
    {
        $student->load('class', 'scores', 'grades');
        return view('admin.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(Student $student)
    {
        $classes = Classes::all();
        return view('admin.students.edit', compact('student', 'classes'));
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'student_id' => 'required|string|unique:students,student_id,' . $student->id,
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'birth_date' => 'required|date',
            'gender' => 'required|string',
            'address' => 'required|string',
            'contact_number' => 'nullable|string',
            'guardian_name' => 'required|string',
            'guardian_contact' => 'required|string',
            'class_id' => 'nullable|exists:classes,id',
        ]);

        $student->update($request->all());

        return redirect()->route('admin.students.index')
            ->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('admin.students.index')
            ->with('success', 'Student deleted successfully.');
    }

    /**
     * Display students for the logged-in teacher.
     */
    public function teacherStudents()
    {
        $teacher = Auth::user()->teacher;
        
        // Get all classes taught by this teacher
        $classIds = Classes::where('teacher_id', $teacher->id)->pluck('id');
        
        // Get all students in those classes
        $students = Student::whereIn('class_id', $classIds)
            ->with('class')
            ->get();

        return view('teacher.students.index', compact('students'));
    }

    /**
     * Display a specific student for teacher view.
     */
    public function teacherShow(Student $student)
    {
        $teacher = Auth::user()->teacher;
        
        // Check if the student belongs to a class taught by this teacher
        $class = Classes::where('id', $student->class_id)
            ->where('teacher_id', $teacher->id)
            ->first();
        
        if (!$class) {
            abort(403, 'Unauthorized access to this student.');
        }

        $student->load('class', 'scores', 'grades');
        
        return view('teacher.students.show', compact('student'));
    }
}