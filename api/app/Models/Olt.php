<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Olt extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'olt_id', 'pop_id', 'name', 'model',
        'serial_number', 'status', 'ip_address',
    ];

    public function pop(): BelongsTo { return $this->belongsTo(Pop::class); }
    public function onts(): HasMany { return $this->hasMany(Ont::class); }
}
