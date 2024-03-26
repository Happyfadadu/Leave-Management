<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeaveMaster extends Model
{
    use HasFactory;
    protected $fillable = ['leave_type', 'employee_code', 'from_date', 'to_date', 'number_of_days', 'comment'];

    public function employee()
    {
        return $this->belongsTo(EmployeeMaster::class);
    }
}
