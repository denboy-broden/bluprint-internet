<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Technician extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'tech_id', 'full_name', 'phone', 'skills', 'status',
    ];

    public function tickets(): HasMany { return $this->hasMany(Ticket::class, 'assigned_tech'); }
    public function workOrders(): HasMany { return $this->hasMany(WorkOrder::class); }
}
