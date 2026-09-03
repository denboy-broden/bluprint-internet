<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ont extends Model
{
    protected $fillable = [
        'ont_id', 'olt_id', 'router_id', 'serial_number',
        'mac_address', 'status', 'customer_id', 'service_id',
        'assigned_ip', 'signal_dbm',
    ];

    protected $casts = [
        'signal_dbm' => 'decimal:2',
    ];

    public function customer(): BelongsTo { return $this->belongsTo(Customer::class); }
    public function service(): BelongsTo { return $this->belongsTo(Service::class); }
    public function olt(): BelongsTo { return $this->belongsTo(Olt::class); }
}
