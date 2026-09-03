<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkOrder extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'work_order_id', 'ticket_id', 'customer_id', 'technician_id',
        'status', 'scheduled_date', 'completed_at', 'materials_used',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
        'completed_at' => 'datetime',
        'materials_used' => 'array',
    ];

    public function ticket(): BelongsTo { return $this->belongsTo(Ticket::class); }
    public function technician(): BelongsTo { return $this->belongsTo(Technician::class); }
}
