@extends('company-admin')
@section('content')
   
  <div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <div class="body-content">
        <div class="overview-content-wrapper">
            <div class="dashboard-section">
                <div class="dashboard-content">
                    <div class="update-attendance-section" style="width: 100%;">
                        <div class="attendance-card" style="background: #fff; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                                <h2 style="margin: 0; color: #333;">Update Attendance - {{ $employee->title }}</h2>
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary" style="padding: 10px 24px; border-radius: 6px; border: 1px solid #ddd; background: #f8f9fa; color: #333; text-decoration: none; cursor: pointer;">
                                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                                </a>
                            </div>
                            
                            @if(session('success'))
                                <div class="alert alert-success" style="padding: 12px; margin-bottom: 1.5rem; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 6px;">
                                    {{ session('success') }}
                                </div>
                            @endif
                            
                            @if(session('error'))
                                <div class="alert alert-danger" style="padding: 12px; margin-bottom: 1.5rem; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 6px;">
                                    {{ session('error') }}
                                </div>
                            @endif
                            
                            @if($errors->any())
                                <div class="alert alert-danger" style="padding: 12px; margin-bottom: 1.5rem; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 6px;">
                                    <ul style="margin: 0; padding-left: 20px;">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            
                            <!-- Add/Update Attendance Form -->
                            <div style="margin-bottom: 2rem;">
                                <h3 style="margin-bottom: 1rem; color: #333;">Add/Update Attendance</h3>
                                <form method="POST" action="{{ route('attendance.save', $employee->id) }}">
                                    @csrf
                                    
                                    @php
                                        $selectedDate = old('attendance_date', date('Y-m-d'));
                                        $isToday = $selectedDate == date('Y-m-d');
                                        $checkInTimeValue = old('checkin_time');
                                        $checkOutTimeValue = old('checkout_time');
                                        
                                        // If it's today and there's attendance, use the actual check-in time
                                        if ($isToday && $todayAttendance && $todayAttendance->created_at) {
                                            $checkInTimeValue = $checkInTimeValue ?: date('H:i', strtotime($todayAttendance->created_at));
                                            $checkOutTimeValue = $checkOutTimeValue ?: ($todayAttendance->checkout ? date('H:i', strtotime($todayAttendance->checkout)) : '');
                                        } else {
                                            $checkInTimeValue = $checkInTimeValue ?: '09:00';
                                        }
                                    @endphp
                                    <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                                        <div class="form-group">
                                            <label for="attendance_date" style="display: block; margin-bottom: 0.5rem; color: #333; font-weight: 600;">Date</label>
                                            <input type="date" name="attendance_date" id="attendance_date" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;" value="{{ $selectedDate }}" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="checkin_time" style="display: block; margin-bottom: 0.5rem; color: #333; font-weight: 600;">Check In Time</label>
                                            <input type="time" name="checkin_time" id="checkin_time" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; {{ $isToday && $todayAttendance ? 'background-color: #f5f5f5; cursor: not-allowed;' : '' }}" value="{{ $checkInTimeValue }}" {{ $isToday && $todayAttendance ? 'readonly' : '' }} required>
                                            <small id="checkin_readonly_msg" style="color: #666; font-size: 12px; display: {{ $isToday && $todayAttendance ? 'block' : 'none' }}; margin-top: 4px;">Check-in time is locked for today's date</small>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="checkout_time" style="display: block; margin-bottom: 0.5rem; color: #333; font-weight: 600;">Check Out Time</label>
                                            <input type="time" name="checkout_time" id="checkout_time" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;" value="{{ $checkOutTimeValue }}">
                                        </div>
                                    </div>
                                    
                                    <div class="form-actions" style="display: flex; gap: 1rem; justify-content: flex-end;">
                                        <button type="submit" class="btn btn-primary" style="padding: 10px 24px; border-radius: 6px; border: none; background: #007bff; color: white; cursor: pointer;">
                                            <i class="fas fa-save"></i> Save Attendance
                                        </button>
                                    </div>
                                </form>
                            </div>
                            
                            <!-- Attendance History -->
                            <div>
                                <h3 style="margin-bottom: 1rem; color: #333;">Attendance History (Last 30 Days)</h3>
                                <div class="attendance-list" style="overflow-x: auto;">
                                    <table style="width: 100%; border-collapse: collapse;">
                                        <thead>
                                            <tr style="border-bottom: 2px solid #eee;">
                                                <th style="padding: 12px; text-align: left; color: #666;">Date</th>
                                                <th style="padding: 12px; text-align: left; color: #666;">Check In</th>
                                                <th style="padding: 12px; text-align: left; color: #666;">Check Out</th>
                                                <th style="padding: 12px; text-align: left; color: #666;">Hours Worked</th>
                                                <th style="padding: 12px; text-align: left; color: #666;">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($attendanceRecords as $record)
                                                <tr style="border-bottom: 1px solid #f0f0f0;">
                                                    <td style="padding: 12px;">{{ date('M d, Y', strtotime($record->checkin)) }}</td>
                                                    <td style="padding: 12px;">{{ $record->created_at ? date('h:i A', strtotime($record->created_at)) : '-' }}</td>
                                                    <td style="padding: 12px;">{{ $record->checkout ? date('h:i A', strtotime($record->checkout)) : '-' }}</td>
                                                    <td style="padding: 12px;">{{ $record->hours_worked ?? '0' }} hrs</td>
                                                    <td style="padding: 12px;">
                                                        @if($record->checkout)
                                                            <span style="color: #28a745; font-weight: 600;">Complete</span>
                                                        @else
                                                            <span style="color: #ffc107; font-weight: 600;">In Progress</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" style="padding: 2rem; text-align: center; color: #999;">
                                                        No attendance records found
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const attendanceDateInput = document.getElementById('attendance_date');
    const checkinTimeInput = document.getElementById('checkin_time');
    const checkoutTimeInput = document.getElementById('checkout_time');
    const todayDate = '{{ date('Y-m-d') }}';
    const todayCheckInTime = '{{ $isToday && $todayAttendance && $todayAttendance->created_at ? date('H:i', strtotime($todayAttendance->created_at)) : '' }}';
    const todayCheckOutTime = '{{ $isToday && $todayAttendance && $todayAttendance->checkout ? date('H:i', strtotime($todayAttendance->checkout)) : '' }}';
    
    attendanceDateInput.addEventListener('change', function() {
        const selectedDate = this.value;
        const isToday = selectedDate === todayDate;
        
        if (isToday && todayCheckInTime) {
            // It's today and there's a check-in record
            checkinTimeInput.value = todayCheckInTime;
            checkinTimeInput.readOnly = true;
            checkinTimeInput.style.backgroundColor = '#f5f5f5';
            checkinTimeInput.style.cursor = 'not-allowed';
            
            // Show/hide readonly message
            const readonlyMsg = document.getElementById('checkin_readonly_msg');
            if (readonlyMsg) {
                readonlyMsg.style.display = 'block';
            }
            
            // Set checkout time if available
            if (todayCheckOutTime) {
                checkoutTimeInput.value = todayCheckOutTime;
            }
        } else {
            // Not today or no check-in record
            checkinTimeInput.readOnly = false;
            checkinTimeInput.style.backgroundColor = '';
            checkinTimeInput.style.cursor = '';
            
            // Hide readonly message
            const readonlyMsg = document.getElementById('checkin_readonly_msg');
            if (readonlyMsg) {
                readonlyMsg.style.display = 'none';
            }
            
            // Reset to default if not today
            if (!isToday && !checkinTimeInput.value) {
                checkinTimeInput.value = '09:00';
            }
        }
    });
});
</script>

@endsection

