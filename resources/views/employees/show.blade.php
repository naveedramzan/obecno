@extends('company-admin')
@section('content')
   
  <div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <div class="body-content">
        <div class="overview-content-wrapper">
            <div class="dashboard-section">
                <div class="dashboard-content">
                    <div class="employee-attendance-section" style="width: 100%;">
                        <div class="attendance-card" style="background: #fff; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                            <!-- Header -->
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                                <div>
                                    <h2 style="margin: 0; color: #333;">Attendance - {{ $employee->title }}</h2>
                                    @php
                                        $userRole = $employee->userRoles->first();
                                        $department = $userRole && $userRole->department ? $userRole->department->title : 'No Department';
                                    @endphp
                                    <p style="margin: 0.5rem 0 0 0; color: #666; font-size: 14px;">{{ $department }}</p>
                                </div>
                                <a href="{{ route('employees.index') }}" class="btn btn-secondary" style="padding: 10px 24px; border-radius: 6px; border: 1px solid #ddd; background: #f8f9fa; color: #333; text-decoration: none; cursor: pointer;">
                                    <i class="fas fa-arrow-left"></i> Back to Employees
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
                            
                            <!-- Date Filter -->
                            <div style="margin-bottom: 2rem; padding: 1rem; background: #f8f9fa; border-radius: 8px;">
                                <h3 style="margin-bottom: 1rem; color: #333; font-size: 18px;">Filter by Date Range</h3>
                                <form method="GET" action="{{ route('employees.show', $employee->id) }}" style="display: grid; grid-template-columns: 1fr 1fr auto; gap: 1rem; align-items: end;">
                                    <div class="form-group">
                                        <label for="start_date" style="display: block; margin-bottom: 0.5rem; color: #333; font-weight: 600;">Start Date</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;" value="{{ $startDate }}" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="end_date" style="display: block; margin-bottom: 0.5rem; color: #333; font-weight: 600;">End Date</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;" value="{{ $endDate }}" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" style="padding: 10px 24px; border-radius: 6px; border: none; background: #007bff; color: white; cursor: pointer; height: fit-content;">
                                            <i class="fas fa-filter"></i> Filter
                                        </button>
                                    </div>
                                </form>
                            </div>
                            
                            <!-- Attendance Records -->
                            <div>
                                <h3 style="margin-bottom: 1rem; color: #333;">Attendance Records</h3>
                                <div class="attendance-list" style="overflow-x: auto;">
                                    <table style="width: 100%; border-collapse: collapse;">
                                        <thead>
                                            <tr style="border-bottom: 2px solid #eee; background: #f8f9fa;">
                                                <th style="padding: 12px; text-align: left; color: #666; font-weight: 600;">Date</th>
                                                <th style="padding: 12px; text-align: left; color: #666; font-weight: 600;">Check In</th>
                                                <th style="padding: 12px; text-align: left; color: #666; font-weight: 600;">Check Out</th>
                                                <th style="padding: 12px; text-align: left; color: #666; font-weight: 600;">Hours Worked</th>
                                                <th style="padding: 12px; text-align: left; color: #666; font-weight: 600;">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($attendanceRecords as $record)
                                                @php
                                                    // Calculate hours worked
                                                    $hoursWorked = 0;
                                                    $isToday = date('Y-m-d', strtotime($record->checkin)) == date('Y-m-d');
                                                    
                                                    if ($record->checkout) {
                                                        // If checked out, calculate from check-in to checkout
                                                        $checkInTime = strtotime($record->created_at);
                                                        $checkOutTime = strtotime($record->checkout);
                                                        $hoursWorked = round(($checkOutTime - $checkInTime) / 3600, 2);
                                                    } elseif ($isToday && $record->created_at) {
                                                        // If today and not checked out, calculate from check-in to current time
                                                        $checkInTime = strtotime($record->created_at);
                                                        $currentTime = time();
                                                        $hoursWorked = round(($currentTime - $checkInTime) / 3600, 2);
                                                    } else {
                                                        // Use stored hours_worked for past dates
                                                        $hoursWorked = (float)$record->hours_worked;
                                                    }
                                                    
                                                    // Format hours and minutes
                                                    $hours = floor($hoursWorked);
                                                    $minutes = round(($hoursWorked - $hours) * 60);
                                                    $hoursDisplay = $hours . ':' . str_pad($minutes, 2, '0', STR_PAD_LEFT);
                                                @endphp
                                                <tr style="border-bottom: 1px solid #f0f0f0;" data-record-id="{{ $record->id }}" data-checkin-time="{{ $record->created_at }}" data-is-today="{{ $isToday ? 'true' : 'false' }}">
                                                    <td style="padding: 12px;">{{ date('M d, Y', strtotime($record->checkin)) }}</td>
                                                    <td style="padding: 12px;">{{ $record->created_at ? date('h:i A', strtotime($record->created_at)) : '-' }}</td>
                                                    <td style="padding: 12px;">{{ $record->checkout ? date('h:i A', strtotime($record->checkout)) : '-' }}</td>
                                                    <td style="padding: 12px;" class="hours-worked-cell">
                                                        @if($record->checkout || !$isToday)
                                                            {{ number_format($hoursWorked, 2) }} hrs
                                                        @else
                                                            <span class="dynamic-hours">{{ number_format($hoursWorked, 2) }} hrs</span>
                                                        @endif
                                                    </td>
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
                                                        No attendance records found for the selected date range
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                
                                <!-- Pagination -->
                                @if($attendanceRecords->hasPages())
                                    <div class="pagination-section" style="margin-top: 1.5rem; display: flex; justify-content: center;">
                                        <div class="pagination">
                                            @if($attendanceRecords->onFirstPage())
                                                <button class="pagination-btn prev-btn" disabled style="opacity: 0.5; cursor: not-allowed; background: transparent; border: none; color: inherit;">
                                                    <i class="fas fa-chevron-left"></i>
                                                </button>
                                            @else
                                                <a href="{{ $attendanceRecords->appends(request()->query())->previousPageUrl() }}" class="pagination-btn prev-btn" style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-chevron-left"></i>
                                                </a>
                                            @endif
                                            
                                            @php
                                                $currentPage = $attendanceRecords->currentPage();
                                                $lastPage = $attendanceRecords->lastPage();
                                                $startPage = max(1, $currentPage - 2);
                                                $endPage = min($lastPage, $currentPage + 2);
                                            @endphp
                                            
                                            @if($startPage > 1)
                                                <a href="{{ $attendanceRecords->appends(request()->query())->url(1) }}" class="pagination-page" style="text-decoration: none; color: inherit;">01</a>
                                                @if($startPage > 2)
                                                    <button class="pagination-page" disabled style="opacity: 0.5; cursor: default; background: transparent; border: none;">...</button>
                                                @endif
                                            @endif
                                            
                                            @for($page = $startPage; $page <= $endPage; $page++)
                                                @if($page == $currentPage)
                                                    <button class="pagination-page active">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</button>
                                                @else
                                                    <a href="{{ $attendanceRecords->appends(request()->query())->url($page) }}" class="pagination-page" style="text-decoration: none; color: inherit;">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</a>
                                                @endif
                                            @endfor
                                            
                                            @if($endPage < $lastPage)
                                                @if($endPage < $lastPage - 1)
                                                    <button class="pagination-page" disabled style="opacity: 0.5; cursor: default; background: transparent; border: none;">...</button>
                                                @endif
                                                <a href="{{ $attendanceRecords->appends(request()->query())->url($lastPage) }}" class="pagination-page" style="text-decoration: none; color: inherit;">{{ str_pad($lastPage, 2, '0', STR_PAD_LEFT) }}</a>
                                            @endif
                                            
                                            @if($attendanceRecords->hasMorePages())
                                                <a href="{{ $attendanceRecords->appends(request()->query())->nextPageUrl() }}" class="pagination-btn next-btn" style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-chevron-right"></i>
                                                </a>
                                            @else
                                                <button class="pagination-btn next-btn" disabled style="opacity: 0.5; cursor: not-allowed; background: transparent; border: none; color: inherit;">
                                                    <i class="fas fa-chevron-right"></i>
                                                </button>
                                            @endif
                                        </div>
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

<style>
    .pagination {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .pagination-btn, .pagination-page {
        padding: 0.5rem 0.75rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        background: white;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 36px;
    }
    .pagination-page.active {
        background: #007bff;
        color: white;
        border-color: #007bff;
    }
    .pagination-btn:hover:not(:disabled), .pagination-page:hover:not(:disabled) {
        background: #f8f9fa;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to update hours worked for today's records
    function updateTodayHours() {
        const todayRows = document.querySelectorAll('tr[data-is-today="true"]');
        
        todayRows.forEach(row => {
            const checkoutCell = row.querySelector('td:nth-child(3)');
            const hoursCell = row.querySelector('.hours-worked-cell .dynamic-hours');
            
            // Only update if not checked out and has dynamic hours element
            if (checkoutCell && checkoutCell.textContent.trim() === '-' && hoursCell) {
                const checkinTimeStr = row.getAttribute('data-checkin-time');
                
                if (checkinTimeStr) {
                    const checkinDate = new Date(checkinTimeStr);
                    const currentTime = new Date();
                    const timeDiff = (currentTime.getTime() - checkinDate.getTime()) / (1000 * 60 * 60); // Difference in hours
                    
                    if (timeDiff >= 0) {
                        hoursCell.textContent = `${timeDiff.toFixed(2)} hrs`;
                    }
                }
            }
        });
    }

    // Update hours every minute
    setInterval(updateTodayHours, 60000);

    // Initial update on load
    updateTodayHours();
});
</script>

@endsection

