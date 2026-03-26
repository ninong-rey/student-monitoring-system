<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'class_id', 'prelim_grade', 'midterm_grade',
        'final_grade', 'average_grade', 'remarks'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function class()
    {
        // THIS IS THE ONLY LINE YOU NEED TO CHANGE
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function calculateRemarks()
    {
        if ($this->average_grade >= 75) {
            $this->remarks = 'Passed';
        } else {
            $this->remarks = 'Failed';
        }
        return $this->remarks;
    }
}