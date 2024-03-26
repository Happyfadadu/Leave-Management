@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Apply Leave Request') }}</div>

                <div class="card-body">
                <form method="POST" action="{{ route('submitLeaveRequest') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="employee_code" class="form-label">{{ __('Employee Code') }}</label>
                            <input type="text" class="form-control" id="employee_code" name="employee_code" required>
                        </div>

                        <div class="mb-3">
                            <label for="from_date" class="form-label">{{ __('From Date') }}</label>
                            <input type="date" class="form-control" id="from_date" name="from_date" required>
                        </div>

                        <div class="mb-3">
                            <label for="to_date" class="form-label">{{ __('To Date') }}</label>
                            <input type="date" class="form-control" id="to_date" name="to_date" required>
                        </div>

                        <div class="mb-3">
                            <label for="leave_type" class="form-label">{{ __('Leave Type') }}</label>
                            <select class="form-select" id="leave_type" name="leave_type" required>
                                <option value="">Select Leave Type</option>
                                <!-- Populate options dynamically from leave type master table -->
                                @foreach($leaveTypes as $leaveType)
                                <option value="{{ $leaveType->leaveType }}">{{ $leaveType->leaveType }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="comment" class="form-label">{{ __('Comments') }}</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3" maxlength="300"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection