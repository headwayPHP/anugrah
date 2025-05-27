<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id',
        'name',
        'email',
        'phone',
        'dob',
        'kit_given',
        'status'
    ];

    protected $casts = [
        'dob' => 'date',
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function course()
    {
        return $this->hasOneThrough(
            Course::class,
            Batch::class,
            'id', // Foreign key on batches table
            'id', // Foreign key on courses table
            'batch_id', // Local key on students table
            'course_id' // Local key on batches table
        );
    }

    public function scopeActive($query)
    {
        return $query->where('status', '1');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function getAgeAttribute()
    {
        return $this->dob->age;
    }
}
