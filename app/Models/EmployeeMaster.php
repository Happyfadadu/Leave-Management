<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class EmployeeMaster extends Authenticatable
{
    use HasFactory;
    protected $table = 'employee_masters';

    protected $fillable = [
        'employee_code',
        'first_name',
        'last_name',
        'username',
        'email',
        'phone',
        'password',
        'address',
        'country',
        'state',
        'city',
        'zip',
    ];
}
