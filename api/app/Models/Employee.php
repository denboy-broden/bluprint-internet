<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'employee_id', 'full_name', 'email', 'phone',
        'role', 'department', 'hire_date', 'status',
    ];

    protected $casts = [
        'hire_date' => 'date',
    ];
}
