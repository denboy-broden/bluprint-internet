<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Incident extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'incident_id', 'pop_id', 'olt_id', 'router_id', 'title',
        'description', 'severity', 'status', 'affected_customers',
        'root_cause', 'recommendation',
    ];

    protected $casts = [
        'affected_customers' => 'integer',
    ];

    public function pop(): BelongsTo { return $this->belongsTo(Pop::class); }
}
