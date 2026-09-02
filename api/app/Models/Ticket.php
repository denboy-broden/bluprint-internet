<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    protected $fillable = [
        'ticket_id', 'customer_id', 'service_id',
        'category', 'priority', 'status',
        'assigned_agent', 'assigned_tech',
        'description', 'resolution_notes',
        'sla_target_at', 'sla_breach',
    ];

    protected $casts = [
        'sla_target_at' => 'datetime',
        'sla_breach' => 'boolean',
    ];

    public function customer(): BelongsTo { return $this->belongsTo(Customer::class); }
    public function service(): BelongsTo { return $this->belongsTo(Service::class); }
}
