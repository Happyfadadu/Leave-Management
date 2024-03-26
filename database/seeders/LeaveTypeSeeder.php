<?php

namespace Database\Seeders;

use App\Models\LeaveMaster;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LeaveMaster::create([
            'id' => 1,
            'leaveType' => 'Privilege Leave (PL) / Earned Leave (EL) / Annual Leave (AL)',
        ]);

        LeaveMaster::create([
            'id' => 2,
            'leaveType' => 'Casual Leave (CL)',
        ]);

        LeaveMaster::create([
            'id' => 3,
            'leaveType' => 'Sick Leave (SL)',
        ]);
    }
}
