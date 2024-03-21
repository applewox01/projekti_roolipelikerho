<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attachments extends Model
{
    use HasFactory;

    protected $table = 'attachments';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'scenario_id',
        'data',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'data' => 'array',
    ];
}
