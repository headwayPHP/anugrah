<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'batch_name',
        'start_date',
        'end_date',
        'day_of_week',
        'time',
        'mode',
        'location',
        'status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'day_of_week' => 'string',
    ];

    // Relationship with Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Scope for active batches
    public function scopeActive($query)
    {
        return $query->where('status', '1');
    }

    // Accessor for formatted date range
    public function getDateRangeAttribute()
    {
        return $this->start_date->format('M d, Y') . ' - ' . $this->end_date->format('M d, Y');
    }

    // Accessor for days of week as array
    public function getDaysArrayAttribute()
    {
        return $this->day_of_week ? explode(',', $this->day_of_week) : [];
    }
}
