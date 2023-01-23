<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoAI extends Model
{
    use HasFactory;
    protected $table = 'photo_ai';
    public $timestamps = false;
}
