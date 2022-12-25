<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TerminateReason extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
}
