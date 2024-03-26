@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Employee Leave Balance') }}</div>

                <div class="card-body">
                    @if($leaveBalances->isNotEmpty())
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Leave Type</th>
                                <th>Leave Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($leaveBalances as $leaveBalance)
                            <tr>
                                <td>{{ $leaveBalance->leave_type }}</td>
                                <td>{{ $leaveBalance->leave_balance }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p>No leave balance data found.</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection