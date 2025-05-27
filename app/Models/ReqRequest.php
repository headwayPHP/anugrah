<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReqRequest extends Model
{
    use HasFactory;

    protected $table = 'req_requests';

    protected $fillable = [
        'name',
        'dob',
        'gender',
        'phone',
        'email',
        'address',
        'city',
        'status',
    ];

    protected $casts = [
        'dob' => 'date', // Optional: if you want to work with Carbon for DOB
    ];
}
