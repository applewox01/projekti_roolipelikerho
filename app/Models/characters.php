<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class characters extends Model
{
    use HasFactory;

    protected $table = 'characters';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'race',
        'level',
        'class',
        'player_name',
        'notes',
        'created_at',
        'updated_at',
    ];
}
