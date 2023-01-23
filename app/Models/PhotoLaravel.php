<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoLaravel extends Model
{
    use HasFactory;
    protected $table = 'photo_laravel';
    public $timestamps = false;
}
