<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    // Define the table name if it's different from the default (optional)
    protected $table = 'activities';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'title',
        'content',
        'is_featured',
        'featured_image',
        'status',
    ];

    // Optionally, if you want to allow timestamps to be managed automatically
    public $timestamps = true;
}
