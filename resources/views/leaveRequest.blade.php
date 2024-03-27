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
                            <input type="text" class="form-control @error('employee_code') is-invalid @enderror" id="employee_code" name="employee_code" required>
                            @error('employee_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="from_date" class="form-label">{{ __('From Date') }}</label>
                            <input type="date" class="form-control @error('from_date') is-invalid @enderror" id="from_date" name="from_date" required>
                            @error('from_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="to_date" class="form-label">{{ __('To Date') }}</label>
                            <input type="date" class="form-control @error('to_date') is-invalid @enderror" id="to_date" name="to_date" required>
                            @error('to_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="leave_type" class="form-label">{{ __('Leave Type') }}</label>
                            <select class="form-select @error('leave_type') is-invalid @enderror" id="leave_type" name="leave_type" required>
                                <option value="">Select Leave Type</option>
                                <!-- Populate options dynamically from leave type master table -->
                                @foreach($leaveTypes as $leaveType)
                                <option value="{{ $leaveType->leaveType }}">{{ $leaveType->leaveType }}</option>
                                @endforeach
                            </select>
                            @error('leave_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="comment" class="form-label">{{ __('Comments') }}</label>
                            <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" rows="3" maxlength="300"></textarea>
                            @error('comment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection