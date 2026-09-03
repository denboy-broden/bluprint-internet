<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pop extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'pop_id', 'name', 'area', 'address',
        'lat', 'lng', 'status',
    ];

    protected $casts = [
        'lat' => 'decimal:8',
        'lng' => 'decimal:8',
    ];

    public function olts(): HasMany { return $this->hasMany(Olt::class); }
    public function routers(): HasMany { return $this->hasMany(Router::class); }
}
