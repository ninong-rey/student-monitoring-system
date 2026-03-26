<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'class_name', 'section', 'academic_year', 'semester',
        'teacher_id', 'subject_id'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function grades()
{
    return $this->hasMany(Grade::class, 'class_id');
}

    public function getFullClassNameAttribute()
    {
        return $this->class_name . ' - ' . $this->section . ' (' . $this->academic_year . ')';
    }
}