<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'class_id', 'assessment_type', 'assessment_name',
        'score', 'max_score', 'percentage', 'assessment_date'
    ];

    protected $casts = [
        'assessment_date' => 'date'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

    public function getPercentageScoreAttribute()
    {
        return ($this->score / $this->max_score) * 100;
    }

    public function getWeightedScoreAttribute()
    {
        return ($this->score / $this->max_score) * $this->percentage;
    }
}