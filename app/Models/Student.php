<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'first_name', 'last_name', 'middle_name',
        'birth_date', 'gender', 'address', 'contact_number',
        'guardian_name', 'guardian_contact', 'class_id'
    ];

    protected $casts = [
        'birth_date' => 'date'
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function getFullNameAttribute()
    {
        return $this->last_name . ', ' . $this->first_name . ' ' . $this->middle_name;
    }
}