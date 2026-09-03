<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'service_id', 'customer_id', 'package_id',
        'olt_id', 'ont_id', 'router_id', 'status',
        'installed_at', 'service_type', 'speed_mbps',
    ];

    protected $casts = [
        'installed_at' => 'datetime',
        'speed_mbps' => 'integer',
    ];

    public function customer(): BelongsTo { return $this->belongsTo(Customer::class); }
    public function package(): BelongsTo { return $this->belongsTo(Package::class); }
    public function tickets() { return $this->hasMany(Ticket::class); }
}
