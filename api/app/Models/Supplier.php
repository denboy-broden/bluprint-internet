<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    protected $fillable = [
        'supplier_id', 'company_name', 'contact_name',
        'phone', 'email', 'status',
    ];

    public function purchaseOrders(): HasMany { return $this->hasMany(PurchaseOrder::class); }
}
