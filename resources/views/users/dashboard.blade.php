@extends('company-admin')
@section('content')
   
  <div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <div class="body-content">
        <div class="overview-content-wrapper">
            <div class="dashboard-section">
                <div class="dashboard-content">
                    @if(session('success'))
                        <div class="alert alert-success" style="padding: 12px 16px; margin-bottom: 1.5rem; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 8px;">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger" style="padding: 12px 16px; margin-bottom: 1.5rem; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 8px;">
                            {{ session('error') }}
                        </div>
                    @endif
                    <!-- Widget Stats Section -->
                    <div class="widget-stats-section">
                        <div class="widget-stats-grid">
                            <!-- Present Today Widget -->
                            <div class="stats-widget present-today-widget">
                                <div class="widget-icon">
                                    <img src="front/icons/thumbs-up.svg" alt="Users" class="widget-icon-svg">
                                </div>
                                <div class="widget-content">
                                    <div class="widget-label">Present Today</div>
                                    <div class="widget-value">
                                        <span class="current-value">{{ $stats['present'] ?? 0 }}</span>
                                        <span class="separator">/</span>
                                        <span class="total-value">{{ $stats['total'] ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Active Widget -->
                            <div class="stats-widget active-widget">
                                <div class="widget-icon">
                                    <img src="front/icons/users.svg" alt="Users" class="widget-icon-svg">
                                </div>
                                <div class="widget-content">
                                    <div class="widget-label">Active</div>
                                    <div class="widget-value">
                                        <span class="current-value">{{ $stats['active'] ?? 0 }}</span>
                                    </div>
                                </div>
                                <div class="widget-action">
                                    <button class="action-icon-button">
                                        <img src="front/icons/arrow-up-right.svg" alt="Arrow" class="action-icon-svg">
                                    </button>
                                </div>
                            </div>
                            
                            <!-- On Break Widget -->
                            <div class="stats-widget on-break-widget">
                                <div class="widget-icon">
                                    <img src="front/icons/mug-hot.svg" alt="Mug Hot" class="widget-icon-svg">
                                </div>
                                <div class="widget-content">
                                    <div class="widget-label">On Break</div>
                                    <div class="widget-value">
                                        <span class="current-value break-value">{{ $stats['onBreak'] ?? 0 }}</span>
                                    </div>
                                </div>
                                <div class="widget-action">
                                    <button class="action-icon-button">
                                        <img src="front/icons/arrow-up-right.svg" alt="Arrow" class="action-icon-svg">
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Late Check-in Widget -->
                            <div class="stats-widget late-checkin-widget">
                                <div class="widget-icon">
                                    <img src="front/icons/alarm-exclamation.svg" alt="Alarm" class="widget-icon-svg">
                                </div>
                                <div class="widget-content">
                                    <div class="widget-label">Late </div>
                                    <div class="widget-value">
                                        <span class="current-value late-value">{{ $stats['late'] ?? 0 }}</span>
                                    </div>
                                </div>
                                <div class="widget-action">
                                    <button class="action-icon-button">
                                        <img src="front/icons/arrow-up-right.svg" alt="Arrow" class="action-icon-svg">
                                    </button>
                                </div>
                            </div>
                            
                            <!-- On Leaves Widget -->
                            <div class="stats-widget on-leaves-widget">
                                <div class="widget-icon">
                                    <img src="front/icons/calendar-heart.svg" alt="Calendar Heart" class="widget-icon-svg">
                                </div>
                                <div class="widget-content">
                                    <div class="widget-label">On Leaves</div>
                                    <div class="widget-value">
                                        <span class="current-value leaves-value">{{ $stats['onLeaves'] ?? 0 }}</span>
                                    </div>
                                </div>
                                <div class="widget-action">
                                    <button class="action-icon-button">
                                        <img src="front/icons/arrow-up-right.svg" alt="Arrow" class="action-icon-svg">
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Absent Widget -->
                            <div class="stats-widget absent-widget">
                                <div class="widget-icon">
                                    <img src="front/icons/user-circle-minus.svg" alt="User Circle Minus" class="widget-icon-svg">
                                </div>
                                <div class="widget-content">
                                    <div class="widget-label">Absent</div>
                                    <div class="widget-value">
                                        <span class="current-value absent-value">{{ $stats['absent'] ?? 0 }}</span>
                                    </div>
                                </div>
                                <div class="widget-action">
                                    <button class="action-icon-button">
                                        <img src="front/icons/arrow-up-right.svg" alt="Arrow" class="action-icon-svg">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Additional Dashboard Sections -->
                    <div class="dashboard-main-content">
                        <!-- Center Column - Attendance List -->
                        <div class="center-column">
                            <div class="center-column-wrapper">
                                <div class="attendance-widget">
                                <div class="attendance-header">
                                    <div class="header-left">
                                        <div class="attendance-search">
                                            <div class="search-field">
                                                <i class="fas fa-search"></i>
                                                <input type="text" id="employee-search-input" placeholder="Search employees..." class="search-input">
                                            </div>
                                        </div>
                                        <div class="date-filter">
                                            <div class="date-filter-field" onclick="toggleCalendar()">
                                                <i class="fas fa-calendar-day"></i>
                                                <span id="date-range-text">{{ date('M d, Y', strtotime($selectedDate ?? date('Y-m-d'))) }}</span>
                                                <i class="fas fa-chevron-down date-arrow" id="date-arrow"></i>
                                            </div>
                                            <div class="calendar-dropdown" id="calendar-dropdown">
                                                <div class="calendar-header">
                                                    <button class="calendar-nav-btn" onclick="changeMonth(-1)">
                                                        <i class="fas fa-chevron-left"></i>
                                                    </button>
                                                    <span class="calendar-month-year" id="calendar-month-year">October 2024</span>
                                                    <button class="calendar-nav-btn" onclick="changeMonth(1)">
                                                        <i class="fas fa-chevron-right"></i>
                                                    </button>
                                                </div>
                                                <div class="calendar-grid">
                                                    <div class="calendar-weekdays">
                                                        <div class="calendar-weekday">Sun</div>
                                                        <div class="calendar-weekday">Mon</div>
                                                        <div class="calendar-weekday">Tue</div>
                                                        <div class="calendar-weekday">Wed</div>
                                                        <div class="calendar-weekday">Thu</div>
                                                        <div class="calendar-weekday">Fri</div>
                                                        <div class="calendar-weekday">Sat</div>
                                                    </div>
                                                    <div class="calendar-days" id="calendar-days">
                                                        <!-- Calendar days will be generated by JavaScript -->
                                                    </div>
                                                </div>
                                                <div class="calendar-actions">
                                                    <button class="calendar-action-btn" onclick="selectDateRange('today')">Today</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="header-right">
                                        <div class="location-filter">
                                            <div class="filter-field">
                                                <span class="filter-text">All Locations</span>
                                                <i class="fas fa-chevron-down filter-arrow" id="location-arrow"></i>
                                            </div>
                                            <div class="location-dropdown" id="location-dropdown">
                                                <div class="dropdown-item" data-value="all" data-location-id="">All Locations</div>
                                                @foreach($officeLocations as $location)
                                                    <div class="dropdown-item" data-value="{{ $location->title }}" data-location-id="{{ $location->id }}">
                                                        {{ $location->title }}
                                                        @if($location->city)
                                                            - {{ $location->city->title }}
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="filters-dropdown hide">
                                            <div class="filter-field">
                                                <span class="filter-text">Filters</span>
                                                <i class="fas fa-chevron-down filter-arrow" id="filters-arrow"></i>
                                            </div>
                                            <div class="filters-dropdown-menu" id="filters-dropdown-menu">
                                                <div class="dropdown-item" data-value="All">All Status</div>
                                                <div class="dropdown-item" data-value="Present">Present</div>
                                                <div class="dropdown-item" data-value="On Break">On Break</div>
                                                <div class="dropdown-item" data-value="Late">Late</div>
                                                <div class="dropdown-item" data-value="Checked Out">Checked Out</div>
                                                <div class="dropdown-item" data-value="On Leave">On Leave</div>
                                                <div class="dropdown-item" data-value="Working">Working</div>
                                                <div class="dropdown-item" data-value="No Show">No Show / Absent</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Teams Tags Section -->
                                <div class="teams-section">
                                    <div class="teams-tags">
                                        <div class="team-tag active" data-department="all">
                                            <span>All</span>
                                        </div>
                                        @foreach($departments as $department)
                                            <div class="team-tag" data-department="{{ $department->id }}">
                                                <span>{{ $department->title }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                
                                <div class="attendance-content">
                                    <!-- Attendance List Items -->
                                    <div class="attendance-list">
                                        @forelse($employees as $employee)
                                            @php
                                                $userRole = $employee->userRoles->first();
                                                $department = $userRole && $userRole->department ? $userRole->department->title : 'No Department';
                                                $departmentId = $userRole && $userRole->department ? $userRole->department->id : null;
                                                $locationId = $userRole && $userRole->location_id ? $userRole->location_id : null;
                                                $attendance = isset($todayAttendance[$employee->id]) ? $todayAttendance[$employee->id] : null;
                                                $checkInTime = $attendance && isset($attendance->checkin) ? date('H:i', strtotime($attendance->checkin)) : null;
                                                $checkOutTime = $attendance && $attendance->checkout ? date('H:i', strtotime($attendance->checkout)) : null;
                                                $todayLeave = isset($todayLeaves[$employee->id]) ? $todayLeaves[$employee->id] : null;
                                                
                                                // Calculate if employee is late
                                                $isLate = false;
                                                if ($attendance && $checkInTime && $companySettings && $companySettings->check_in_time) {
                                                    // Get expected check-in time
                                                    $expectedCheckIn = $companySettings->check_in_time;
                                                    
                                                    // Get grace period in minutes
                                                    $gracePeriodMinutes = 0;
                                                    if ($companySettings->grace_period) {
                                                        switch($companySettings->grace_period) {
                                                            case 'no-grace':
                                                                $gracePeriodMinutes = 0;
                                                                break;
                                                            case '5-min':
                                                                $gracePeriodMinutes = 5;
                                                                break;
                                                            case '10-min':
                                                                $gracePeriodMinutes = 10;
                                                                break;
                                                            case '15-min':
                                                                $gracePeriodMinutes = 15;
                                                                break;
                                                            case '30-min':
                                                                $gracePeriodMinutes = 30;
                                                                break;
                                                        }
                                                    }
                                                    
                                                    // Calculate allowed check-in time (expected + grace period)
                                                    $expectedDateTime = new \DateTime($expectedCheckIn);
                                                    $expectedDateTime->modify("+{$gracePeriodMinutes} minutes");
                                                    $allowedCheckInTime = $expectedDateTime->format('H:i');
                                                    
                                                    // Compare actual check-in time with allowed time
                                                    $actualCheckInDateTime = new \DateTime($checkInTime);
                                                    $allowedCheckInDateTime = new \DateTime($allowedCheckInTime);
                                                    
                                                    if ($actualCheckInDateTime > $allowedCheckInDateTime) {
                                                        $isLate = true;
                                                    }
                                                }
                                            @endphp
                                            <div class="attendance-list-item" data-department-id="{{ $departmentId }}" data-location-id="{{ $locationId }}">
                                            <div class="employee-info">
                                                <div class="employee-name">
                                                        <span class="name">{{ $employee->title }} - {{ $department }}</span>
                                                    <div class="status-indicator">
                                                        <div class="status-dot"></div>
                                                    </div>
                                                </div>
                                                @if($todayLeave)
                                                <div class="leave-status" style="display: flex; align-items: center; gap: 4px; margin-top: 4px; font-size: 12px; color: #ffc107; font-weight: 600;">
                                                    <i class="fas fa-calendar-check" style="font-size: 10px;"></i>
                                                    <span>On Leave ({{ $todayLeave->leave_type_name ?? 'Leave' }})</span>
                                                </div>
                                                @elseif($attendance)
                                                <div class="attendance-times" style="display: flex; gap: 12px; margin-top: 4px; font-size: 12px; color: #545861;">
                                                    <span style="display: flex; align-items: center; gap: 4px;">
                                                        <i class="fas fa-sign-in-alt" style="font-size: 10px;"></i>
                                                        <strong>In:</strong> {{ $checkInTime }}
                                                    </span>
                                                    @if($checkOutTime)
                                                    <span style="display: flex; align-items: center; gap: 4px;">
                                                        <i class="fas fa-sign-out-alt" style="font-size: 10px;"></i>
                                                        <strong>Out:</strong> {{ $checkOutTime }}
                                                    </span>
                                                    @endif
                                                </div>
                                                @endif
                                            </div>
                                            <div class="edit-icon">
                                                    <a href="{{ route('update-attendance', $employee->id) }}" style="text-decoration: none; color: inherit;" title="Update Attendance">
                                                <img src="front/icons/edit-icon.svg" alt="Update Attendance" class="edit-icon-svg">
                                                    </a>
                                            </div>
                                            <div class="employee-status">
                                                <div class="status-badge">
                                                    @if($todayLeave)
                                                        <span style="color: #ffc107; font-weight: 600;">On Leave</span>
                                                    @elseif($attendance)
                                                        @if($isLate)
                                                            <span style="color: #dc3545; font-weight: 600;">LATE</span>
                                                        @else
                                                            <span style="color: #28a745; font-weight: 600;">PRESENT</span>
                                                        @endif
                                                    @else
                                                        <span style="color: #dc3545; font-weight: 600;">Absent</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="employee-actions hide">
                                                <button class="action-btn">
                                                    <i class="fas fa-chevron-right"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @empty
                                            <div class="attendance-list-item" style="text-align: center; padding: 2rem;">
                                            <div class="employee-info">
                                                <div class="employee-name">
                                                        <span class="name" style="color: #999;">No employees found for this company</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                    
                                    <!-- Pagination -->
                                    @if($employees->hasPages())
                                    <div class="pagination-section">
                                        <div class="pagination">
                                            @if($employees->onFirstPage())
                                                <button class="pagination-btn prev-btn" disabled style="opacity: 0.5; cursor: not-allowed; background: transparent; border: none; color: inherit;">
                                                    <i class="fas fa-chevron-left"></i>
                                                </button>
                                            @else
                                                <a href="{{ $employees->previousPageUrl() }}" class="pagination-btn prev-btn" style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-chevron-left"></i>
                                                </a>
                                            @endif
                                            
                                            @php
                                                $currentPage = $employees->currentPage();
                                                $lastPage = $employees->lastPage();
                                                $startPage = max(1, $currentPage - 2);
                                                $endPage = min($lastPage, $currentPage + 2);
                                            @endphp
                                            
                                            @if($startPage > 1)
                                                <a href="{{ $employees->url(1) }}" class="pagination-page" style="text-decoration: none; color: inherit;">01</a>
                                                @if($startPage > 2)
                                                    <button class="pagination-page" disabled style="opacity: 0.5; cursor: default; background: transparent; border: none;">...</button>
                                                @endif
                                            @endif
                                            
                                            @for($page = $startPage; $page <= $endPage; $page++)
                                                @if($page == $currentPage)
                                                    <button class="pagination-page active">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</button>
                                                @else
                                                    <a href="{{ $employees->url($page) }}" class="pagination-page" style="text-decoration: none; color: inherit;">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</a>
                                                @endif
                                            @endfor
                                            
                                            @if($endPage < $lastPage)
                                                @if($endPage < $lastPage - 1)
                                                    <button class="pagination-page" disabled style="opacity: 0.5; cursor: default; background: transparent; border: none;">...</button>
                                                @endif
                                                <a href="{{ $employees->url($lastPage) }}" class="pagination-page" style="text-decoration: none; color: inherit;">{{ str_pad($lastPage, 2, '0', STR_PAD_LEFT) }}</a>
                                            @endif
                                            
                                            @if($employees->hasMorePages())
                                                <a href="{{ $employees->nextPageUrl() }}" class="pagination-btn next-btn" style="text-decoration: none; color: inherit; display: inline-flex; align-items: center; justify-content: center;">
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
                                    
                                    <div class="add-employee-section">
                                        <button class="add-employee-btn" onclick="window.location.href='{{ route('employees.create') }}'">
                                            <i class="fas fa-plus"></i>
                                            <span>Add Employee</span>
                                        </button>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                            </div>
                        </div>
                        
                        <!-- Right Column - Sidebar Widgets -->
                        <div class="right-column">
                            <!-- Complete Setup Widget -->
                            <div class="setup-widget">
                                <div class="setup-header">
                                    <h3 class="setup-title">Complete Setup</h3>
                                    <span class="setup-progress">2/6 Completed</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill"></div>
                                </div>
                                <div class="setup-actions">
                                    <button class="dismiss-button">
                                        <i class="fas fa-check"></i>
                                        <span>Complete & dismiss</span>
                                    </button>
                                    <button class="setup-continue-button">
                                        <span>Continue</span>
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Alerts Widget -->
                            <div class="alerts-widget">
                                <div class="alerts-header">
                                    <div class="alerts-title-section">
                                        <h3 class="alerts-title">Alerts</h3>
                                        <div class="alert-badge">06</div>
                                    </div>
                                    <button class="view-all-button">
                                        <span>View All</span>
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Leave Requests Widget -->
                            <div class="leave-requests-widget">
                                <div class="leave-header">
                                    <h3 class="leave-title">Leave Requests</h3>
                                    <div class="alert-badge" style="background: #007bff; color: white; border-radius: 12px; padding: 4px 8px; font-size: 12px; font-weight: 600;">
                                        {{ count($leaveRequests) }}
                                    </div>
                                </div>
                                <div class="leave-content">
                                    @forelse($leaveRequests as $leaveRequest)
                                        <div class="leave-request-item" style="padding: 12px; margin-bottom: 8px; background: #F7F9FA; border-radius: 8px; border: 1px solid #E3E7EB;">
                                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 8px;">
                                                <div style="flex: 1;">
                                                    <div style="font-weight: 600; color: #192839; margin-bottom: 4px; font-size: 14px;">
                                                        {{ $leaveRequest->employee_name }}
                                                    </div>
                                                    <div style="font-size: 12px; color: #545861; margin-bottom: 2px;">
                                                        <i class="fas fa-calendar-alt" style="margin-right: 4px;"></i>
                                                        {{ date('M d', strtotime($leaveRequest->start_date)) }} - {{ date('M d, Y', strtotime($leaveRequest->end_date)) }}
                                                    </div>
                                                    <div style="font-size: 12px; color: #545861;">
                                                        <i class="fas fa-tag" style="margin-right: 4px;"></i>
                                                        {{ $leaveRequest->leave_type_name ?? 'N/A' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="display: flex; gap: 8px; margin-top: 8px;">
                                                <form action="{{ route('leave.approve', $leaveRequest->id) }}" method="POST" style="flex: 1;">
                                                    @csrf
                                                    <button type="submit" class="btn-approve" style="width: 100%; padding: 8px; background: #28a745; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: 600;">
                                                        <i class="fas fa-check"></i> Approve
                                                    </button>
                                                </form>
                                                <form action="{{ route('leave.reject', $leaveRequest->id) }}" method="POST" style="flex: 1;">
                                                    @csrf
                                                    <button type="submit" class="btn-reject" style="width: 100%; padding: 8px; background: #dc3545; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: 600;">
                                                        <i class="fas fa-times"></i> Reject
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="empty-state">
                                            <i class="fas fa-folder-open"></i>
                                            <p class="empty-text">No Leave request</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            
                            <!-- Suggestions Widget -->
                            <div class="suggestions-widget">
                                <div class="suggestions-slider">
                                    <!-- Slide 1 -->
                                    <div class="suggestion-slide active">
                                        <div class="suggestion-icon">
                                            <i class="fas fa-lightbulb"></i>
                                        </div>
                                        <h3 class="suggestion-title">Multiple Locations</h3>
                                        <p class="suggestion-description">Create as many Offices or Locations you need to track your employees</p>
                                    </div>
                                    
                                    <!-- Slide 2 -->
                                    <div class="suggestion-slide">
                                        <div class="suggestion-icon">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <h3 class="suggestion-title">Team Management</h3>
                                        <p class="suggestion-description">Easily manage your team members and their attendance across different locations</p>
                                    </div>
                                    
                                    <!-- Slide 3 -->
                                    <div class="suggestion-slide">
                                        <div class="suggestion-icon">
                                            <i class="fas fa-chart-line"></i>
                                        </div>
                                        <h3 class="suggestion-title">Analytics & Reports</h3>
                                        <p class="suggestion-description">Get detailed insights and reports on employee attendance patterns and trends</p>
                                    </div>
                                    
                                    <!-- Slide 4 -->
                                    <div class="suggestion-slide">
                                        <div class="suggestion-icon">
                                            <i class="fas fa-mobile-alt"></i>
                                        </div>
                                        <h3 class="suggestion-title">Mobile App</h3>
                                        <p class="suggestion-description">Download our mobile app for easy check-in and check-out on the go</p>
                                    </div>
                                </div>
                                
                                <!-- Slider Controls -->
                                <div class="suggestion-dots">
                                    <div class="dot active" data-slide="0"></div>
                                    <div class="dot" data-slide="1"></div>
                                    <div class="dot" data-slide="2"></div>
                                    <div class="dot" data-slide="3"></div>
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
        // Navigation menu functionality
        const menuItems = document.querySelectorAll('.menu-item');
        
        menuItems.forEach(item => {
            item.addEventListener('click', function() {
                // Remove active class from all items
                menuItems.forEach(menuItem => menuItem.classList.remove('active'));
                
                // Add active class to clicked item
                this.classList.add('active');
                
                // Get the menu text for navigation
                const menuText = this.querySelector('.menu-text').textContent;
                console.log('Navigating to:', menuText);
            });
        });

        // Action buttons functionality
        const addButton = document.querySelector('.add-button');
        const notificationButton = document.querySelector('.notification-button');
        
        addButton.addEventListener('click', function() {
            console.log('Add button clicked');
            // Add functionality here
        });
        
        notificationButton.addEventListener('click', function() {
            console.log('Notification button clicked');
            // Notification functionality here
        });

        // User profile functionality
        const userProfile = document.querySelector('.user-profile');
        
        userProfile.addEventListener('click', function() {
            console.log('User profile clicked');
            // User profile dropdown functionality here
        });

        // Suggestions slider functionality
        const suggestionSlides = document.querySelectorAll('.suggestion-slide');
        const suggestionDots = document.querySelectorAll('.dot');
        let currentSlide = 0;

        function showSlide(index) {
            // Remove active class from all slides and dots
            suggestionSlides.forEach(slide => slide.classList.remove('active'));
            suggestionDots.forEach(dot => dot.classList.remove('active'));
            
            // Add active class to current slide and dot
            suggestionSlides[index].classList.add('active');
            suggestionDots[index].classList.add('active');
            
            currentSlide = index;
        }

        // Add click event listeners to dots
        suggestionDots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                showSlide(index);
            });
        });

        // Auto-advance slider every 4 seconds
        setInterval(() => {
            currentSlide = (currentSlide + 1) % suggestionSlides.length;
            showSlide(currentSlide);
        }, 4000);

        // Mobile menu functionality
        const hamburgerBtn = document.querySelector('.hamburger-btn');
        const mobileMenu = document.querySelector('.mobile-menu');
        const mobileMenuOverlay = document.querySelector('.mobile-menu-overlay');
        const mobileMenuClose = document.querySelector('.mobile-menu-close');
        const mobileMenuItems = document.querySelectorAll('.mobile-menu-item');

        // Toggle mobile menu
        function toggleMobileMenu() {
            mobileMenu.classList.toggle('active');
            mobileMenuOverlay.classList.toggle('active');
            document.body.classList.toggle('menu-open');
            
            // Animate hamburger button
            hamburgerBtn.classList.toggle('active');
        }

        // Close mobile menu
        function closeMobileMenu() {
            mobileMenu.classList.remove('active');
            mobileMenuOverlay.classList.remove('active');
            document.body.classList.remove('menu-open');
            hamburgerBtn.classList.remove('active');
        }

        // Event listeners for mobile menu
        hamburgerBtn.addEventListener('click', toggleMobileMenu);
        hamburgerBtn.addEventListener('touchend', function(e) {
            e.preventDefault();
            toggleMobileMenu();
        });
        
        mobileMenuClose.addEventListener('click', closeMobileMenu);
        mobileMenuClose.addEventListener('touchend', function(e) {
            e.preventDefault();
            closeMobileMenu();
        });
        
        mobileMenuOverlay.addEventListener('click', closeMobileMenu);
        mobileMenuOverlay.addEventListener('touchend', function(e) {
            e.preventDefault();
            closeMobileMenu();
        });

        // Mobile menu item clicks
        mobileMenuItems.forEach(item => {
            const handleItemClick = function() {
                // Remove active class from all mobile menu items
                mobileMenuItems.forEach(menuItem => menuItem.classList.remove('active'));
                
                // Add active class to clicked item
                this.classList.add('active');
                
                // Update desktop menu as well
                const menuText = this.querySelector('.mobile-menu-text').textContent;
                menuItems.forEach(desktopItem => {
                    if (desktopItem.querySelector('.menu-text').textContent === menuText) {
                        menuItems.forEach(item => item.classList.remove('active'));
                        desktopItem.classList.add('active');
                    }
                });
                
                // Close mobile menu after selection
                closeMobileMenu();
                
                console.log('Mobile navigation to:', menuText);
            };
            
            item.addEventListener('click', handleItemClick);
            item.addEventListener('touchend', function(e) {
                e.preventDefault();
                handleItemClick.call(this);
            });
        });

        // Close mobile menu on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && mobileMenu.classList.contains('active')) {
                closeMobileMenu();
            }
        });

        // Location and Filters dropdown functionality
        const locationFilter = document.querySelector('.location-filter .filter-field');
        const locationDropdown = document.getElementById('location-dropdown');
        const locationArrow = document.getElementById('location-arrow');
        const locationItems = document.querySelectorAll('#location-dropdown .dropdown-item');

        const filtersDropdown = document.querySelector('.filters-dropdown .filter-field');
        const filtersMenu = document.getElementById('filters-dropdown-menu');
        const filtersArrow = document.getElementById('filters-arrow');
        const filtersItems = document.querySelectorAll('#filters-dropdown-menu .dropdown-item');

        // Location dropdown functionality
        locationFilter.addEventListener('click', function() {
            locationDropdown.classList.toggle('show');
            locationArrow.classList.toggle('rotated');
            
            // Close filters dropdown if open
            filtersMenu.classList.remove('show');
            filtersArrow.classList.remove('rotated');
        });

        locationItems.forEach(item => {
            item.addEventListener('click', function() {
                const selectedText = this.getAttribute('data-value') === 'all' ? 'All Locations' : this.textContent.trim();
                const locationId = this.getAttribute('data-location-id');
                const filterText = locationFilter.querySelector('.filter-text');
                filterText.textContent = selectedText;
                
                locationDropdown.classList.remove('show');
                locationArrow.classList.remove('rotated');
                
                // Filter employees by location
                const attendanceListItems = document.querySelectorAll('.attendance-list-item');
                if (locationId === '' || locationId === null) {
                    // Show all employees
                    attendanceListItems.forEach(item => {
                        item.style.display = '';
                    });
                } else {
                    // Filter by location ID (we'll need to add data-location-id to employee items)
                    attendanceListItems.forEach(item => {
                        const itemLocationId = item.getAttribute('data-location-id');
                        if (itemLocationId === locationId) {
                            item.style.display = '';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                }
                
                console.log('Location selected:', selectedText, 'Location ID:', locationId);
            });
        });

        // Filters dropdown functionality
        filtersDropdown.addEventListener('click', function() {
            filtersMenu.classList.toggle('show');
            filtersArrow.classList.toggle('rotated');
            
            // Close location dropdown if open
            locationDropdown.classList.remove('show');
            locationArrow.classList.remove('rotated');
        });

        filtersItems.forEach(item => {
            item.addEventListener('click', function() {
                const selectedText = this.textContent;
                const filterText = filtersDropdown.querySelector('.filter-text');
                filterText.textContent = selectedText;
                
                filtersMenu.classList.remove('show');
                filtersArrow.classList.remove('rotated');
                
                console.log('Filter selected:', selectedText);
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            if (!locationFilter.contains(event.target)) {
                locationDropdown.classList.remove('show');
                locationArrow.classList.remove('rotated');
            }
            
            if (!filtersDropdown.contains(event.target)) {
                filtersMenu.classList.remove('show');
                filtersArrow.classList.remove('rotated');
            }
            
            if (!event.target.closest('.date-filter')) {
                const calendar = document.getElementById('calendar-dropdown');
                const dateArrow = document.getElementById('date-arrow');
                if (calendar) {
                    calendar.classList.remove('show');
                    dateArrow.classList.remove('rotated');
                }
            }
        });

        // Team tags functionality
        const teamTags = document.querySelectorAll('.team-tag');
        
        teamTags.forEach(tag => {
            tag.addEventListener('click', function() {
                // Remove active class from all tags
                teamTags.forEach(teamTag => teamTag.classList.remove('active'));
                
                // Add active class to clicked tag
                this.classList.add('active');
                
                // Get the department filter
                const departmentId = this.getAttribute('data-department');
                const teamName = this.querySelector('span').textContent;
                
                // Get all attendance list items
                const attendanceListItems = document.querySelectorAll('.attendance-list-item');
                
                // Filter employees by department
                if (departmentId === 'all') {
                    // Show all employees
                    attendanceListItems.forEach(item => {
                        item.style.display = '';
                    });
                } else {
                    // Filter by department ID
                    attendanceListItems.forEach(item => {
                        const itemDepartmentId = item.getAttribute('data-department-id');
                        if (itemDepartmentId === departmentId) {
                            item.style.display = '';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                }
                
                console.log('Department filter selected:', teamName);
            });
        });

        // Search functionality
        const searchInput = document.getElementById('employee-search-input');
        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase().trim();
                const attendanceListItems = document.querySelectorAll('.attendance-list-item');
                
                attendanceListItems.forEach(item => {
                    const employeeName = item.querySelector('.employee-name .name')?.textContent.toLowerCase() || '';
                    const department = item.querySelector('.employee-name .team')?.textContent.toLowerCase() || '';
                    const searchText = employeeName + ' ' + department;
                    
                    if (searchText.includes(searchTerm)) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        }

        // Calendar functionality
        let currentDate = new Date('{{ $selectedDate ?? date("Y-m-d") }}');
        let selectedStartDate = new Date('{{ $selectedDate ?? date("Y-m-d") }}');
        let selectedEndDate = null;

        function toggleCalendar() {
            const calendar = document.getElementById('calendar-dropdown');
            const arrow = document.getElementById('date-arrow');
            
            if (calendar.classList.contains('show')) {
                calendar.classList.remove('show');
                arrow.classList.remove('rotated');
            } else {
                // Close other dropdowns
                locationDropdown.classList.remove('show');
                locationArrow.classList.remove('rotated');
                filtersMenu.classList.remove('show');
                filtersArrow.classList.remove('rotated');
                
                calendar.classList.add('show');
                arrow.classList.add('rotated');
                generateCalendar();
            }
        }

        function generateCalendar() {
            const calendarDays = document.getElementById('calendar-days');
            const monthYear = document.getElementById('calendar-month-year');
            
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();
            
            monthYear.textContent = currentDate.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
            
            const firstDay = new Date(year, month, 1);
            const lastDay = new Date(year, month + 1, 0);
            const startDate = new Date(firstDay);
            startDate.setDate(startDate.getDate() - firstDay.getDay());
            
            calendarDays.innerHTML = '';
            
            for (let i = 0; i < 42; i++) {
                const date = new Date(startDate);
                date.setDate(startDate.getDate() + i);
                
                const dayElement = document.createElement('div');
                dayElement.className = 'calendar-day';
                dayElement.textContent = date.getDate();
                dayElement.onclick = () => selectDate(date);
                
                if (date.getMonth() !== month) {
                    dayElement.classList.add('other-month');
                }
                
                if (date.toDateString() === new Date().toDateString()) {
                    dayElement.classList.add('today');
                }
                
                if (selectedStartDate && date.toDateString() === selectedStartDate.toDateString()) {
                    dayElement.classList.add('selected');
                }
                
                calendarDays.appendChild(dayElement);
            }
        }

        function changeMonth(direction) {
            currentDate.setMonth(currentDate.getMonth() + direction);
            generateCalendar();
        }

        function selectDate(date) {
            selectedStartDate = date;
            selectedEndDate = null;
            
            updateDateRangeText();
            generateCalendar();
            
            // Reload page with selected date
            const selectedDateStr = date.toISOString().split('T')[0];
            const url = new URL(window.location.href);
            url.searchParams.set('date', selectedDateStr);
            window.location.href = url.toString();
            
            // Close calendar after selection
            const calendar = document.getElementById('calendar-dropdown');
            const dateArrow = document.getElementById('date-arrow');
            calendar.classList.remove('show');
            dateArrow.classList.remove('rotated');
        }

        function updateDateRangeText() {
            const dateRangeText = document.getElementById('date-range-text');
            
            if (selectedStartDate) {
                const dateStr = selectedStartDate.toLocaleDateString('en-US', { day: 'numeric', month: 'short', year: 'numeric' });
                dateRangeText.textContent = dateStr;
            } else {
                dateRangeText.textContent = '{{ date("M d, Y") }}';
            }
        }

        function selectDateRange(range) {
            const today = new Date();
            
            if (range === 'today') {
                selectedStartDate = new Date(today);
                selectedEndDate = null;
                
                // Reload page with today's date
                const todayStr = today.toISOString().split('T')[0];
                const url = new URL(window.location.href);
                url.searchParams.set('date', todayStr);
                window.location.href = url.toString();
            }
            
            updateDateRangeText();
            generateCalendar();
            
            // Close calendar
            const calendar = document.getElementById('calendar-dropdown');
            const dateArrow = document.getElementById('date-arrow');
            calendar.classList.remove('show');
            dateArrow.classList.remove('rotated');
        }
        
        // Initialize calendar with selected date
        document.addEventListener('DOMContentLoaded', function() {
            updateDateRangeText();
            generateCalendar();
        });

        // Attendance list item functionality
        const attendanceListItemsAll = document.querySelectorAll('.attendance-list-item');
        
        attendanceListItemsAll.forEach(item => {
            item.addEventListener('click', function() {
                console.log('Attendance item clicked');
                // Add functionality for expanding/collapsing employee details
            });
        });

        // Action button functionality
        const actionButtons = document.querySelectorAll('.action-btn');
        
        actionButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation(); // Prevent triggering the parent item click
                console.log('Action button clicked');
                // Add functionality for employee actions
            });
        });

        // Edit icon functionality
        const editIcons = document.querySelectorAll('.edit-icon');
        
        editIcons.forEach(icon => {
            icon.addEventListener('click', function(e) {
                e.stopPropagation(); // Prevent triggering the parent item click
                console.log('Edit icon clicked');
                // Add functionality for editing employee details
            });
        });

        // Alert icon functionality
        const alertIcons = document.querySelectorAll('.alert-icon');
        
        alertIcons.forEach(icon => {
            icon.addEventListener('click', function(e) {
                e.stopPropagation(); // Prevent triggering the parent item click
                console.log('Alert icon clicked');
                // Add functionality for viewing alerts or notifications
            });
        });

        console.log('Header component loaded');
    </script>
@endsection