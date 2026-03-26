<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Student;
use App\Models\Score;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{
    /**
     * Display a listing of grades for the teacher.
     */
    public function index()
    {
        $teacher = Auth::user()->teacher;
        
        // Get all classes taught by this teacher
        $classes = Classes::where('teacher_id', $teacher->id)
            ->with(['subject', 'students'])
            ->get();

        return view('teacher.grades.index', compact('classes'));
    }

    /**
     * Show grades for a specific class.
     */
    public function classGrades(Classes $class)
    {
        $teacher = Auth::user()->teacher;
        
        // Ensure the teacher owns this class
        if ($class->teacher_id !== $teacher->id) {
            abort(403, 'Unauthorized access to this class.');
        }

        // Get all students in this class with their scores and grades
        $students = Student::where('class_id', $class->id)
            ->with(['scores' => function($query) use ($class) {
                $query->where('class_id', $class->id);
            }, 'grades' => function($query) use ($class) {
                $query->where('class_id', $class->id);
            }])
            ->get();

        // Get all assessment types for this class
        $assessmentTypes = Score::where('class_id', $class->id)
            ->select('assessment_type', DB::raw('COUNT(DISTINCT assessment_name) as count'))
            ->groupBy('assessment_type')
            ->get();

        return view('teacher.grades.class', compact('class', 'students', 'assessmentTypes'));
    }

    /**
     * Calculate grades for a class.
     */
    public function calculate(Request $request, Classes $class)
    {
        $teacher = Auth::user()->teacher;
        
        // Ensure the teacher owns this class
        if ($class->teacher_id !== $teacher->id) {
            abort(403, 'Unauthorized access to this class.');
        }

        $students = Student::where('class_id', $class->id)->get();

        foreach ($students as $student) {
            // Get all scores for this student in this class
            $scores = Score::where('student_id', $student->id)
                ->where('class_id', $class->id)
                ->get();

            if ($scores->isEmpty()) {
                continue;
            }

            // Group scores by assessment type and calculate weighted average
            $totalWeightedScore = 0;
            $totalPercentage = 0;

            foreach ($scores as $score) {
                $weightedScore = ($score->score / $score->max_score) * $score->percentage;
                $totalWeightedScore += $weightedScore;
                $totalPercentage += $score->percentage;
            }

            // Calculate final grade (assuming total percentage should be 100)
            $finalGrade = $totalPercentage > 0 ? ($totalWeightedScore / $totalPercentage) * 100 : 0;
            
            // Determine remarks
            $remarks = $finalGrade >= 75 ? 'Passed' : 'Failed';

            // Update or create grade record
            Grade::updateOrCreate(
                [
                    'student_id' => $student->id,
                    'class_id' => $class->id,
                ],
                [
                    'prelim_grade' => $request->has('prelim') ? $finalGrade : null,
                    'midterm_grade' => $request->has('midterm') ? $finalGrade : null,
                    'final_grade' => $request->has('final') ? $finalGrade : null,
                    'average_grade' => $finalGrade,
                    'remarks' => $remarks,
                ]
            );
        }

        return redirect()->route('teacher.grades.class', $class)
            ->with('success', 'Grades calculated successfully.');
    }

    /**
     * Store a new score.
     */
    public function storeScore(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'assessment_type' => 'required|string',
            'assessment_name' => 'required|string',
            'score' => 'required|numeric',
            'max_score' => 'required|numeric',
            'percentage' => 'required|numeric',
        ]);

        $teacher = Auth::user()->teacher;
        $class = Classes::find($request->class_id);

        // Ensure the teacher owns this class
        if ($class->teacher_id !== $teacher->id) {
            abort(403, 'Unauthorized access to this class.');
        }

        // Get all students in this class
        $students = Student::where('class_id', $request->class_id)->get();

        foreach ($students as $student) {
            Score::create([
                'student_id' => $student->id,
                'class_id' => $request->class_id,
                'assessment_type' => $request->assessment_type,
                'assessment_name' => $request->assessment_name,
                'score' => $request->score,
                'max_score' => $request->max_score,
                'percentage' => $request->percentage,
                'assessment_date' => now(),
            ]);
        }

        return redirect()->back()
            ->with('success', 'Scores added successfully for all students.');
    }

    /**
     * Update a specific score.
     */
    public function updateScore(Request $request, Score $score)
    {
        $request->validate([
            'score' => 'required|numeric',
        ]);

        $teacher = Auth::user()->teacher;
        $class = $score->class;

        // Ensure the teacher owns this class
        if ($class->teacher_id !== $teacher->id) {
            abort(403, 'Unauthorized access.');
        }

        $score->update([
            'score' => $request->score,
        ]);

        return redirect()->back()
            ->with('success', 'Score updated successfully.');
    }

    /**
     * Export grades to PDF/Excel.
     */
    public function export(Classes $class)
    {
        $teacher = Auth::user()->teacher;
        
        // Ensure the teacher owns this class
        if ($class->teacher_id !== $teacher->id) {
            abort(403, 'Unauthorized access to this class.');
        }

        $students = Student::where('class_id', $class->id)
            ->with('grades')
            ->get();

        // For now, just return a view that can be printed
        return view('teacher.grades.export', compact('class', 'students'));
    }
}