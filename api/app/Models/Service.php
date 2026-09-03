<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'service_id', 'customer_id', 'package_id',
        'status', 'install_date', 'activation_date',
        'suspension_date', 'termination_date',
        'pppoe_username', 'pppoe_password',
        'assigned_ip', 'vlan_id',
    ];

    protected $casts = [
        'install_date' => 'date',
        'activation_date' => 'date',
        'suspension_date' => 'date',
        'termination_date' => 'date',
        'vlan_id' => 'integer',
    ];

    public function customer(): BelongsTo { return $this->belongsTo(Customer::class); }
    public function package(): BelongsTo { return $this->belongsTo(Package::class); }
    public function tickets(): HasMany { return $this->hasMany(Ticket::class); }
    public function invoices(): HasMany { return $this->hasMany(Invoice::class); }
}
