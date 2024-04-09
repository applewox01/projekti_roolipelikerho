<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class worlds extends Model
{
    use HasFactory;

    protected $table = 'worlds';
    protected $fillable = ['name'];
}
