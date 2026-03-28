<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DroppedStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'class_id', 'teacher_id', 'drop_date',
        'reason', 'remarks', 'status', 'grades_snapshot', 'dropped_by'
    ];

    protected $casts = [
        'drop_date' => 'date',
        'grades_snapshot' => 'array'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function droppedBy()
    {
        return $this->belongsTo(User::class, 'dropped_by');
    }
}