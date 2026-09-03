<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChartOfAccount extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'account_code', 'account_name', 'category',
        'parent_code', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function lineItems(): HasMany { return $this->hasMany(JournalLineItem::class, 'account_code', 'account_code'); }
}
