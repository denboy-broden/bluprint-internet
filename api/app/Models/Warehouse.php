<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Warehouse extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'warehouse_id', 'name', 'address', 'status',
    ];

    public function stock(): HasMany { return $this->hasMany(Stock::class); }
}
