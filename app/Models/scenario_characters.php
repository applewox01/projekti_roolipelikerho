<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class scenario_characters extends Model
{
    use HasFactory;

    protected $fillable = [
        'character_id',
        'scenario_id',
        'created_at',
        'updated_at',
    ];

    public function characters()
    {
        return $this->belongsTo(characters::class, 'character_id', 'id');
    }

    public function scenarios()
    {
        return $this->belongsTo(Scenario::class, 'scenario_id', 'id');
    }
}
