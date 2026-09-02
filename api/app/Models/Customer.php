<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = [
        'customer_id', 'full_name', 'phone', 'email',
        'id_number', 'address', 'address_lat', 'address_lng',
        'status', 'package_id',
    ];

    protected $casts = [
        'status' => 'string',
        'address_lat' => 'decimal:8',
        'address_lng' => 'decimal:8',
    ];

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
