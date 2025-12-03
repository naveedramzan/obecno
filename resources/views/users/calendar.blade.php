@extends('company-admin')
@section('content')
   
  <div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <div class="body-content">
        <div class="overview-content-wrapper">
            <div class="dashboard-section">
                <div class="dashboard-content">
                    <div class="calendar-section" style="width: 100%;">
                        <div class="calendar-card" style="background: #fff; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                            <!-- Header -->
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                                <div>
                                    <h2 style="margin: 0; color: #333;">Calendar</h2>
                                    @if($country)
                                        <p style="margin: 0.5rem 0 0 0; color: #666; font-size: 14px;">Holidays for {{ $country->title }}</p>
                                    @endif
                                </div>
                                <div style="display: flex; gap: 1rem; align-items: center;">
                                    <!-- Month/Year Navigation -->
                                    <div style="display: flex; gap: 0.5rem; align-items: center;">
                                        <a href="{{ route('calendar', ['month' => $selectedMonth == 1 ? 12 : $selectedMonth - 1, 'year' => $selectedMonth == 1 ? $selectedYear - 1 : $selectedYear]) }}" 
                                           style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; text-decoration: none; color: #333; background: #f8f9fa;">
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                        <span style="padding: 8px 16px; font-weight: 600; color: #333;">
                                            {{ $selectedDate->format('F Y') }}
                                        </span>
                                        <a href="{{ route('calendar', ['month' => $selectedMonth == 12 ? 1 : $selectedMonth + 1, 'year' => $selectedMonth == 12 ? $selectedYear + 1 : $selectedYear]) }}" 
                                           style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; text-decoration: none; color: #333; background: #f8f9fa;">
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </div>
                                    <a href="{{ route('dashboard') }}" class="btn btn-secondary" style="padding: 10px 24px; border-radius: 6px; border: 1px solid #ddd; background: #f8f9fa; color: #333; text-decoration: none; cursor: pointer;">
                                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                                    </a>
                                </div>
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
                            
                            <!-- Calendar View -->
                            <div class="calendar-container">
                                @php
                                    $firstDay = new \DateTime($selectedDate->format('Y-m-01'));
                                    $lastDay = new \DateTime($selectedDate->format('Y-m-t'));
                                    $startDate = clone $firstDay;
                                    $startDate->modify('-' . $firstDay->format('w') . ' days'); // Start from Sunday
                                    
                                    // Create arrays for leaves and holidays by date
                                    $leavesByDate = [];
                                    foreach ($leaves as $leave) {
                                        $start = new \DateTime($leave->start_date);
                                        $end = new \DateTime($leave->end_date);
                                        $current = clone $start;
                                        while ($current <= $end) {
                                            $dateKey = $current->format('Y-m-d');
                                            if (!isset($leavesByDate[$dateKey])) {
                                                $leavesByDate[$dateKey] = [];
                                            }
                                            $leavesByDate[$dateKey][] = $leave;
                                            $current->modify('+1 day');
                                        }
                                    }
                                    
                                    $holidaysByDate = [];
                                    foreach ($holidays as $holiday) {
                                        $dateKey = date('Y-m-d', strtotime($holiday->holiday_date));
                                        $holidaysByDate[$dateKey] = $holiday;
                                    }
                                @endphp
                                
                                <table style="width: 100%; border-collapse: collapse; table-layout: fixed;">
                                    <thead>
                                        <tr style="background: #f8f9fa; border-bottom: 2px solid #e3e7eb;">
                                            <th style="padding: 12px; text-align: center; color: #666; font-weight: 600; width: 14.28%;">Sun</th>
                                            <th style="padding: 12px; text-align: center; color: #666; font-weight: 600; width: 14.28%;">Mon</th>
                                            <th style="padding: 12px; text-align: center; color: #666; font-weight: 600; width: 14.28%;">Tue</th>
                                            <th style="padding: 12px; text-align: center; color: #666; font-weight: 600; width: 14.28%;">Wed</th>
                                            <th style="padding: 12px; text-align: center; color: #666; font-weight: 600; width: 14.28%;">Thu</th>
                                            <th style="padding: 12px; text-align: center; color: #666; font-weight: 600; width: 14.28%;">Fri</th>
                                            <th style="padding: 12px; text-align: center; color: #666; font-weight: 600; width: 14.28%;">Sat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for($week = 0; $week < 6; $week++)
                                            <tr>
                                                @for($day = 0; $day < 7; $day++)
                                                    @php
                                                        $currentDate = clone $startDate;
                                                        $currentDate->modify('+' . ($week * 7 + $day) . ' days');
                                                        $dateKey = $currentDate->format('Y-m-d');
                                                        $isCurrentMonth = $currentDate->format('Y-m') == $selectedDate->format('Y-m');
                                                        $isToday = $dateKey == date('Y-m-d');
                                                        $dayLeaves = $leavesByDate[$dateKey] ?? [];
                                                        $dayHoliday = $holidaysByDate[$dateKey] ?? null;
                                                    @endphp
                                                    <td style="padding: 8px; border: 1px solid #e3e7eb; vertical-align: top; height: 120px; background: {{ $isCurrentMonth ? '#fff' : '#f8f9fa' }}; position: relative;">
                                                        <div style="font-weight: 600; margin-bottom: 4px; color: {{ $isCurrentMonth ? ($isToday ? '#007bff' : '#333') : '#999' }};">
                                                            {{ $currentDate->format('j') }}
                                                        </div>
                                                        
                                                        @if($dayHoliday)
                                                            <div style="background: #ffc107; color: #856404; padding: 4px 6px; border-radius: 4px; font-size: 11px; margin-bottom: 4px; font-weight: 600;">
                                                                <i class="fas fa-star" style="font-size: 9px;"></i> {{ $dayHoliday->title }}
                                                            </div>
                                                        @endif
                                                        
                                                        @if(!empty($dayLeaves))
                                                            <div style="max-height: 80px; overflow-y: auto;">
                                                                @foreach($dayLeaves as $leave)
                                                                    @php
                                                                        $isApproved = $leave->status == 'a';
                                                                        $leaveStyle = $isApproved 
                                                                            ? 'background: #28a745; color: white; border: none;' 
                                                                            : 'background: transparent; color: #ffc107; border: 2px dashed #ffc107;';
                                                                    @endphp
                                                                    <div style="{{ $leaveStyle }} padding: 3px 6px; border-radius: 4px; font-size: 10px; margin-bottom: 3px; cursor: pointer;" 
                                                                         title="{{ $leave->employee_name }} - {{ $leave->leave_type_name ?? 'Leave' }} ({{ $isApproved ? 'Approved' : 'Pending' }})">
                                                                        <i class="fas fa-calendar-check" style="font-size: 8px;"></i> 
                                                                        {{ strlen($leave->employee_name) > 15 ? substr($leave->employee_name, 0, 15) . '...' : $leave->employee_name }}
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </td>
                                                @endfor
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Legend -->
                            <div style="margin-top: 2rem; padding: 1rem; background: #f8f9fa; border-radius: 8px; display: flex; gap: 2rem; flex-wrap: wrap;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div style="width: 20px; height: 20px; background: #ffc107; border-radius: 4px;"></div>
                                    <span style="font-size: 14px; color: #333;">Public Holiday</span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div style="width: 20px; height: 20px; background: #28a745; border-radius: 4px;"></div>
                                    <span style="font-size: 14px; color: #333;">Approved Leave</span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div style="width: 20px; height: 20px; background: transparent; border: 2px dashed #ffc107; border-radius: 4px;"></div>
                                    <span style="font-size: 14px; color: #333;">Pending Leave</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .calendar-container {
        overflow-x: auto;
    }
    
    .calendar-container table td:hover {
        background-color: #f0f9ff !important;
    }
    
    .calendar-container table td {
        transition: background-color 0.2s;
    }
</style>

@endsection

