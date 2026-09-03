<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Router extends Model
{
    protected $fillable = [
        'router_id', 'pop_id', 'name', 'ip_address',
        'model', 'status',
    ];

    public function pop(): BelongsTo { return $this->belongsTo(Pop::class); }
}
