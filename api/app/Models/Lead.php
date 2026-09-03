<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'lead_id', 'full_name', 'phone', 'source',
        'status', 'lead_score',
    ];

    protected $casts = [
        'lead_score' => 'integer',
    ];
}
