@extends('company-admin')
@section('content')
   
  <div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <div class="body-content">
        <div class="overview-content-wrapper">
            <div class="dashboard-section">
                <div class="dashboard-content">
                    <!-- Check In/Out Section -->
                    <div class="check-in-out-section" style="margin-bottom: 2rem;">
                        <div class="check-in-out-card" style="background: #fff; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                            <h2 style="margin-bottom: 1.5rem; color: #333;">Mark Attendance</h2>
                            <div class="check-in-out-buttons" style="display: flex; gap: 1rem; align-items: center;">
                                @if(!$todayCheckIn)
                                    <button id="checkInBtn" class="btn btn-primary" style="padding: 12px 32px; font-size: 16px; border-radius: 8px; border: none; background: #007bff; color: white; cursor: pointer;">
                                        <i class="fas fa-sign-in-alt"></i> CHECK IN
                                    </button>
                                @else
                                    @php
                                        $isCheckedOut = !empty($todayCheckIn->checkout);
                                    @endphp
                                    @if($isCheckedOut)
                                        <div style="padding: 12px 32px; font-size: 16px; border-radius: 8px; background: #e9ecef; color: #6c757d; cursor: not-allowed; display: inline-flex; align-items: center; gap: 8px;">
                                            <i class="fas fa-check-circle"></i> Already Checked Out
                                        </div>
                                        <div style="margin-left: 1rem; color: #666;">
                                            <div><strong>Checked in at:</strong> {{ date('h:i A', strtotime($todayCheckIn->created_at)) }}</div>
                                            <div><strong>Checked out at:</strong> {{ date('h:i A', strtotime($todayCheckIn->checkout)) }}</div>
                                        </div>
                                    @else
                                        <button id="checkOutBtn" class="btn btn-success" style="padding: 12px 32px; font-size: 16px; border-radius: 8px; border: none; background: #28a745; color: white; cursor: pointer;">
                                            <i class="fas fa-sign-out-alt"></i> CHECK OUT
                                        </button>
                                        <div style="margin-left: 1rem; color: #666;">
                                            <strong>Checked in at:</strong> {{ date('h:i A', strtotime($todayCheckIn->created_at)) }}
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- My Attendance Section -->
                    <div class="attendance-section">
                        <div class="attendance-card" style="background: #fff; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                            <h2 style="margin-bottom: 1.5rem; color: #333;">My Attendance - {{ date('F Y') }}</h2>
                            <div class="attendance-list" style="overflow-x: auto;">
                                <table style="width: 100%; border-collapse: collapse;">
                                    <thead>
                                        <tr style="border-bottom: 2px solid #eee;">
                                            <th style="padding: 12px; text-align: left; color: #666;">Date</th>
                                            <th style="padding: 12px; text-align: left; color: #666;">Expected Hours</th>
                                            <th style="padding: 12px; text-align: left; color: #666;">Actual Hours</th>
                                            <th style="padding: 12px; text-align: left; color: #666;">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($attendanceRecords as $dayData)
                                            @php
                                                $date = $dayData['date'];
                                                $attendance = $dayData['attendance'];
                                                
                                                // Determine status and calculate hours
                                                if ($attendance) {
                                                    $checkinTime = strtotime($attendance->created_at);
                                                    $isCheckedOut = !empty($attendance->checkout);
                                                    $status = $isCheckedOut ? 'Present' : 'Not Checked Out';
                                                    $expectedHours = $attendance->expected_hours ?? '8';
                                                    
                                                    // Calculate actual hours based on check-in and checkout
                                                    if ($isCheckedOut) {
                                                        // If checked out, calculate from check-in to checkout
                                                        $checkoutTime = strtotime($attendance->checkout);
                                                        $hoursWorked = round(($checkoutTime - $checkinTime) / 3600, 2);
                                                        $actualHours = number_format($hoursWorked, 2);
                                                    } else {
                                                        // If not checked out, calculate from check-in time to current time
                                                        // Only calculate if it's today's date
                                                        $today = date('Y-m-d');
                                                        if ($date == $today) {
                                                            $currentTime = time();
                                                            $hoursWorked = round(($currentTime - $checkinTime) / 3600, 2);
                                                            $actualHours = number_format($hoursWorked, 2);
                                                        } else {
                                                            // For past dates not checked out, show stored value or 0
                                                            $actualHours = number_format((float)($attendance->hours_worked ?? 0), 2);
                                                        }
                                                    }
                                                } else {
                                                    $status = 'Absent';
                                                    $expectedHours = '8'; // Default expected hours
                                                    $actualHours = '0';
                                                }
                                            @endphp
                                            <tr style="border-bottom: 1px solid #f0f0f0;" @if($date == date('Y-m-d') && $attendance && !$isCheckedOut) data-today-row="true" data-checkin-time="{{ $attendance->created_at }}" @endif>
                                                <td style="padding: 12px;">{{ date('M d, Y', strtotime($date)) }}</td>
                                                <td style="padding: 12px;">{{ $expectedHours }} hrs</td>
                                                <td style="padding: 12px;" @if($date == date('Y-m-d') && $attendance && !$isCheckedOut) class="actual-hours-cell" @endif>{{ $actualHours }} hrs</td>
                                                <td style="padding: 12px;">
                                                    @if($status == 'Present')
                                                        <span style="color: #28a745; font-weight: 600;">Present</span>
                                                    @elseif($status == 'Not Checked Out')
                                                        <span style="color: #ffc107; font-weight: 600;">Not Checked Out</span>
                                                    @else
                                                        <span style="color: #dc3545; font-weight: 600;">Absent</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" style="padding: 2rem; text-align: center; color: #999;">
                                                    No working days found for this month
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                
                                <!-- Pagination -->
                                @if($attendanceRecords->hasPages())
                                    <div style="margin-top: 1.5rem; display: flex; justify-content: center; align-items: center; gap: 0.5rem;">
                                        {{ $attendanceRecords->links() }}
                                    </div>
                                @endif
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
    const checkInBtn = document.getElementById('checkInBtn');
    const checkOutBtn = document.getElementById('checkOutBtn');
    
    if (checkInBtn) {
        checkInBtn.addEventListener('click', function() {
            if (confirm('Are you sure you want to check in?')) {
                fetch('{{ route("check-in") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
            }
        });
    }
    
    if (checkOutBtn) {
        checkOutBtn.addEventListener('click', function() {
            if (confirm('Are you sure you want to check out?')) {
                fetch('{{ route("check-out") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
            }
        });
    }
    
    // Update actual hours for today's row if checked in but not checked out
    function updateTodayHours() {
        const todayRow = document.querySelector('tr[data-today-row="true"]');
        if (todayRow) {
            const checkinTimeStr = todayRow.getAttribute('data-checkin-time');
            const actualHoursCell = todayRow.querySelector('.actual-hours-cell');
            
            if (actualHoursCell && checkinTimeStr) {
                // Parse the check-in time string to Date object
                const checkinDate = new Date(checkinTimeStr);
                const currentTime = new Date();
                const timeDiff = (currentTime.getTime() - checkinDate.getTime()) / (1000 * 60 * 60); // Difference in hours
                
                if (timeDiff >= 0) {
                    actualHoursCell.textContent = timeDiff.toFixed(2) + ' hrs';
                }
            }
        }
    }
    
    // Update hours every minute
    if (document.querySelector('tr[data-today-row="true"]')) {
        updateTodayHours(); // Update immediately
        setInterval(updateTodayHours, 60000); // Update every minute
    }
});
</script>

@endsection

