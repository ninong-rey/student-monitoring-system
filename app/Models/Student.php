<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classes;
use App\Models\Score;
use App\Models\Grade;
use App\Models\User;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'first_name',
        'last_name',
        'middle_name',
        'birth_date',
        'gender',
        'address',
        'contact_number',
        'guardian_name',
        'guardian_contact',
        'class_id',

        // Drop student fields
        'is_dropped',
        'drop_date',
        'drop_reason',
        'drop_remarks',
        'dropped_by'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'drop_date' => 'datetime',
        'is_dropped' => 'boolean'
    ];

    /**
     * Student belongs to a class
     */
    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    /**
     * Student scores
     */
    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    /**
     * Student grades
     */
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    /**
     * User who dropped the student (Admin or Teacher)
     */
    public function droppedBy()
    {
        return $this->belongsTo(User::class, 'dropped_by');
    }

    /**
     * Get full name
     */
    public function getFullNameAttribute()
    {
        return $this->last_name . ', ' . $this->first_name . ' ' . $this->middle_name;
    }
}