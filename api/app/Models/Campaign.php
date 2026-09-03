<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'campaign_id', 'name', 'channel', 'budget',
        'cost_spent', 'start_date', 'end_date', 'status',
    ];

    protected $casts = [
        'budget' => 'decimal:2',
        'cost_spent' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}
