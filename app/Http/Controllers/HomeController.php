<?php

namespace App\Http\Controllers;

use App\Models\LeaveBalance;
use App\Models\LeaveMaster;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the applic\ation dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $employee_code = auth()->user()->employee_code;
        $leaveBalances = LeaveBalance::where('employee_code', $employee_code)->get();

        // Pass the leave balance data to the view
        return view('home', compact('leaveBalances'));
    }

    public function leaveRequest()
    {
        $leaveTypes = LeaveMaster::all();
        info($leaveTypes);

        return view('leaveRequest', compact('leaveTypes'));
    }
}
