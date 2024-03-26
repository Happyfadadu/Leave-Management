<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\EmployeeMaster;
use App\Models\LeaveBalance;
use App\Models\LeaveMaster;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        info("call");
        return Validator::make($data, [
            'employee_code' => ['required', 'string', 'unique:employee_masters'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'username' => ['required', 'string', 'unique:employee_masters'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:employee_masters'],
            'phone' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'same:password'],
            'address' => ['required', 'string'],
            'country' => ['required', 'string'],
            'state' => ['required', 'string'],
            'city' => ['required', 'string'],
            'zip' => ['required', 'string'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $employee =  EmployeeMaster::create([
            'employee_code' => $data['employee_code'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']), // Hash the password
            'address' => $data['address'],
            'country' => $data['country'],
            'state' => $data['state'],
            'city' => $data['city'],
            'zip' => $data['zip'],
        ]);

        $leaveTypes = LeaveMaster::all();

        foreach ($leaveTypes as $leaveType) {
            $leaveBalance = 15; // Default leave balance for Privilege Leave (PL) / Earned Leave (EL) / Annual Leave (AL)
            if ($leaveType->leaveType == 'Casual Leave (CL)' || $leaveType->leaveType == 'Sick Leave (SL)') {
                $leaveBalance = 12; // Leave balance for Casual Leave (CL) and Sick Leave (SL)
            }
            info("inside");
info($employee->employee_code);
            LeaveBalance::create([
                'leave_type' => $leaveType->leaveType,
                'leave_balance' => $leaveBalance,
                'employee_code' => $employee->employee_code,
            ]);
        }
        return $employee;
    }
}
