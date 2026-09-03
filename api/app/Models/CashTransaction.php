<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashTransaction extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'transaction_id', 'type', 'amount', 'bank_account_id',
        'description', 'reference_id', 'created_by',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];
}
