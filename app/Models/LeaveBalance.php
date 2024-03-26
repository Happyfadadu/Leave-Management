<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveBalance extends Model
{
    use HasFactory;
    protected $fillable = ['leave_type', 'leave_balance', 'employee_code'];

    public function employee()
    {
        return $this->belongsTo(EmployeeMaster::class);
    }
}
