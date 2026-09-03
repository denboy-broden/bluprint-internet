<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'audit_id', 'timestamp', 'actor_type', 'actor_id',
        'action', 'target_type', 'target_id', 'domain',
        'risk_level', 'before_state', 'after_state', 'reason',
        'approval_id', 'result', 'details',
    ];

    protected $casts = [
        'timestamp' => 'datetime',
        'before_state' => 'array',
        'after_state' => 'array',
    ];
}
