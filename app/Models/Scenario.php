<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scenario extends Model
{
    use HasFactory;

    protected $table = 'scenarios';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'background_info',
        'other_requirements',
        'lvl_highest',
        'lvl_lowest',
        'plr_most',
        'plr_least',
        'admin_desc',
        'world_id',
        'created_at',
        'updated_at',
    ];

    public function world()
    {
        return $this->belongsTo(worlds::class, 'world_id', 'id');
    }
}
