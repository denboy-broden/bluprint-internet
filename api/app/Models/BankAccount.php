<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BankAccount extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'account_id', 'bank_name', 'account_number',
        'account_name', 'balance', 'currency', 'status',
    ];

    protected $casts = [
        'balance' => 'decimal:2',
    ];
}
