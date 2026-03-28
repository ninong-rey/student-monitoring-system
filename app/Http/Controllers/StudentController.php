<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Classes;
use App\Models\DroppedStudent;
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
        
        // Get all students in those classes (including dropped? Usually teachers shouldn't see dropped students)
        $students = Student::whereIn('class_id', $classIds)
            ->where('is_dropped', false) // Only show active students to teachers
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

    // ========== DROP STUDENT METHODS ==========

    /**
     * Show form to drop a student (Admin).
     */
    public function showDropForm(Student $student)
    {
        // Check if student is already dropped
        if ($student->is_dropped) {
            return redirect()->route('admin.students.show', $student)
                ->with('error', 'This student is already dropped.');
        }

        return view('admin.students.drop', compact('student'));
    }

    /**
     * Process dropping a student (Admin).
     */
    public function dropStudent(Request $request, Student $student)
    {
        $request->validate([
            'reason' => 'required|string|max:100',
            'remarks' => 'nullable|string',
        ]);

        // Check if student is already dropped
        if ($student->is_dropped) {
            return redirect()->route('admin.students.index')
                ->with('error', 'This student is already dropped.');
        }

        // Save the class_id before dropping
        $classId = $student->class_id;
        $teacherId = $student->class ? $student->class->teacher_id : null;

        // Drop the student
        $student->is_dropped = true;
        $student->drop_date = now();
        $student->drop_reason = $request->reason;
        $student->drop_remarks = $request->remarks;
        $student->dropped_by = Auth::id();
        $student->save();

        // Save to history table
        DroppedStudent::create([
            'student_id' => $student->id,
            'class_id' => $classId,
            'teacher_id' => $teacherId,
            'drop_date' => now(),
            'reason' => $request->reason,
            'remarks' => $request->remarks,
            'status' => 'dropped',
            'grades_snapshot' => json_encode($student->grades),
            'dropped_by' => Auth::id()
        ]);

        return redirect()->route('admin.students.index')
            ->with('success', 'Student has been dropped successfully.');
    }

    /**
     * Show list of dropped students (Admin).
     */
    public function droppedStudents()
    {
        $droppedStudents = Student::where('is_dropped', true)
            ->with(['class', 'droppedBy'])
            ->orderBy('drop_date', 'desc')
            ->get();

        return view('admin.students.dropped', compact('droppedStudents'));
    }

    /**
     * Restore a dropped student (Admin).
     */
    public function restoreStudent(Student $student)
    {
        if (!$student->is_dropped) {
            return redirect()->route('admin.students.index')
                ->with('error', 'This student is not dropped.');
        }

        $student->is_dropped = false;
        $student->drop_date = null;
        $student->drop_reason = null;
        $student->drop_remarks = null;
        $student->dropped_by = null;
        $student->save();

        return redirect()->route('admin.students.index')
            ->with('success', 'Student has been restored successfully.');
    }

    /**
     * Show drop history (Admin).
     */
    public function dropHistory()
    {
        $history = DroppedStudent::with(['student', 'class', 'teacher', 'droppedBy'])
            ->orderBy('drop_date', 'desc')
            ->paginate(20);

        return view('admin.students.history', compact('history'));
    }

    /**
     * Show form to drop a student (Teacher).
     */
    public function teacherDropForm(Student $student)
    {
        $teacher = Auth::user()->teacher;
        
        // Check if student belongs to teacher's class
        $class = Classes::where('id', $student->class_id)
            ->where('teacher_id', $teacher->id)
            ->first();
        
        if (!$class) {
            abort(403, 'Unauthorized access to this student.');
        }

        if ($student->is_dropped) {
            return redirect()->route('teacher.students.index')
                ->with('error', 'This student is already dropped.');
        }

        return view('teacher.students.drop', compact('student'));
    }

    /**
     * Process dropping a student (Teacher).
     */
    public function teacherDropStudent(Request $request, Student $student)
    {
        $teacher = Auth::user()->teacher;
        
        // Check if student belongs to teacher's class
        $class = Classes::where('id', $student->class_id)
            ->where('teacher_id', $teacher->id)
            ->first();
        
        if (!$class) {
            abort(403, 'Unauthorized access to this student.');
        }

        $request->validate([
            'reason' => 'required|string|max:100',
            'remarks' => 'nullable|string',
        ]);

        // Save the class_id before dropping
        $classId = $student->class_id;

        // Drop the student
        $student->is_dropped = true;
        $student->drop_date = now();
        $student->drop_reason = $request->reason;
        $student->drop_remarks = $request->remarks;
        $student->dropped_by = Auth::id();
        $student->save();

        // Save to history table
        DroppedStudent::create([
            'student_id' => $student->id,
            'class_id' => $classId,
            'teacher_id' => $teacher->id,
            'drop_date' => now(),
            'reason' => $request->reason,
            'remarks' => $request->remarks,
            'status' => 'dropped',
            'grades_snapshot' => json_encode($student->grades),
            'dropped_by' => Auth::id()
        ]);

        return redirect()->route('teacher.students.index')
            ->with('success', 'Student has been dropped from your class.');
    }
}