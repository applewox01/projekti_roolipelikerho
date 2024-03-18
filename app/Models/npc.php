<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class npc extends Model
{
    use HasFactory;

    protected $table = 'npc';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'scenario_id',
        'data',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'data' => 'array'
    ];

    public function scenario()
    {
        return $this->belongsTo(scenario::class);
    }
}
