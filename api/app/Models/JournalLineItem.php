<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JournalLineItem extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'entry_id', 'account_code', 'debit', 'credit',
    ];

    protected $casts = [
        'debit' => 'decimal:2',
        'credit' => 'decimal:2',
    ];

    public function entry(): BelongsTo { return $this->belongsTo(JournalEntry::class, 'entry_id'); }
    public function account(): BelongsTo { return $this->belongsTo(ChartOfAccount::class, 'account_code', 'account_code'); }
}
