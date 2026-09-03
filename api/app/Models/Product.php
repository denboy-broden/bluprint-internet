<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'product_id', 'name', 'category', 'description',
        'unit', 'price_unit',
    ];

    protected $casts = [
        'price_unit' => 'decimal:2',
    ];

    public function stock(): HasMany { return $this->hasMany(Stock::class); }
    public function assets(): HasMany { return $this->hasMany(Asset::class); }
}
