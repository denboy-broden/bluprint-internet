<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JournalEntry extends Model
{
    protected $fillable = [
        'entry_id', 'entry_date', 'description', 'reference',
        'created_by', 'approved_by', 'status',
    ];

    protected $casts = [
        'entry_date' => 'date',
    ];

    public function lineItems(): HasMany { return $this->hasMany(JournalLineItem::class); }
}
