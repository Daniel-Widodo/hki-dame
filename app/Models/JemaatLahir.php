<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JemaatLahir extends Model
{
    use HasFactory;
    protected $table = 'jemaat_lahir';
    protected $guarded = ['id'];

    protected $attributes = [
    ];
}
