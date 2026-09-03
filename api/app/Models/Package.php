<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    protected $fillable = [
        'package_id', 'name', 'speed_down', 'speed_up',
        'price_monthly', 'description', 'is_active',
    ];

    protected $casts = [
        'speed_down' => 'integer',
        'speed_up' => 'integer',
        'price_monthly' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function services(): HasMany { return $this->hasMany(Service::class); }
}
