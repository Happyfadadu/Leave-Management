<?php

namespace App\Http\Controllers;

use App\Models\EmployeeLeaveMaster;
use App\Models\EmployeeMaster;
use App\Models\LeaveBalance;
use App\Models\LeaveMaster;
use App\Models\NonWorkingDay;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function register(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'employee_code' => 'required|unique:employee_masters',
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:employee_masters',
            'email' => 'required|email|unique:employee_masters',
            'phone' => 'required',
            'password' => 'required|min:6', // minimum password length of 6 characters
            'confirm_password' => 'required|same:password', // must match the 'password' field
            'address' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip' => 'required',
        ]);

        // Remove the 'confirm_password' field from the validated data
        unset($validatedData['confirm_password']);

        // Insert the validated data into the database
        $employee = EmployeeMaster::create($validatedData);

        // Insert leave balances for the employee
        $leaveTypes = LeaveMaster::all();

        foreach ($leaveTypes as $leaveType) {
            $leaveBalance = 15; // Default leave balance for Privilege Leave (PL) / Earned Leave (EL) / Annual Leave (AL)
            if ($leaveType->leaveType == 'Casual Leave (CL)' || $leaveType->leaveType == 'Sick Leave (SL)') {
                $leaveBalance = 12; // Leave balance for Casual Leave (CL) and Sick Leave (SL)
            }

            LeaveBalance::create([
                'leave_type' => $leaveType->leaveType,
                'leave_balance' => $leaveBalance,
                'employee_master_id' => $employee->id,
            ]);
        }

        return response()->json(['message' => 'Employee registered successfully', 'employee' => $employee], 201);
    }

    public function availableLeaveBalance($employee_code)
    {
        $leaveBalances = LeaveBalance::where('employee_master_id', $employee_code)->get();

        if ($leaveBalances->isEmpty()) {
            return response()->json(['message' => 'Leave balances not found for this employee'], 404);
        }

        return response()->json($leaveBalances, 200);
    }

    public function login(Request $request)
    {
        // Validate the incoming data
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Authentication successful
            $user = Auth::user();
            return response()->json(['message' => 'Login successful', 'user' => $user], 200);
        } else {
            // Authentication failed
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

    public function storeLeave(Request $request)
    {
        info("call");
        // Validate the incoming data
        $validatedData = $request->validate([
            'leave_type' => 'required',
            'employee_code' => 'required',
            'from_date' => 'required|date|after_or_equal:today',
            'to_date' => 'required|date|after:from_date',
            'comment' => 'nullable',
        ]);

        // Get all dates between from_date and to_date
        $dates = $this->getDatesBetween($validatedData['from_date'], $validatedData['to_date']);
        info($dates);

        // Check each date against the NonWorkingDay table
        $nonWorkingDates = NonWorkingDay::whereIn('date', $dates)->pluck('date')->toArray();

        info($nonWorkingDates);
        // Calculate the number of days excluding non-working days
        $numberOfWorkingDays = count(array_diff($dates, $nonWorkingDates));

        info($numberOfWorkingDays);
        info('Employee Code: ' . $validatedData['employee_code']);
        info('Leave Type: ' . $validatedData['leave_type']);
        // Deduct leave balance
        $employeeLeaveBalance = LeaveBalance::where('employee_code', $validatedData['employee_code'])
            ->where('leave_type', $validatedData['leave_type'])
            ->first();
        // Check if a record was found
        if (!$employeeLeaveBalance) {
            return response()->json(['message' => 'Leave balance record not found'], 404);
        }

        // Now you can safely access the leave_balance property

        // Check if there are enough leaves available
        if ($employeeLeaveBalance->leave_balance < $numberOfWorkingDays) {
            return response()->json(['message' => 'Insufficient leave balance'], 400);
        }
        // Deduct the leaves
        $employeeLeaveBalance->leave_balance -= $numberOfWorkingDays;
        $employeeLeaveBalance->save();
        // Insert the record into the database
        EmployeeLeaveMaster::create([
            'leave_type' => $validatedData['leave_type'],
            'employee_code' => $validatedData['employee_code'],
            'from_date' => $validatedData['from_date'],
            'to_date' => $validatedData['to_date'],
            'number_of_days' => $numberOfWorkingDays,
            'comment' => $validatedData['comment'],
        ]);

        return redirect()->route('home')->with('success', 'Leave request submitted successfully');
    }

    private function getDatesBetween($startDate, $endDate)
    {
        $dates = [];
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);

        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $dates[] = $date->toDateString();
        }

        return $dates;
    }
}
