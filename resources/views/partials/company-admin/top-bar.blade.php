<div class="header-container">
    <div class="header">
        <div class="header-wrapper">
            <div class="header-left">
                
                <div class="mobile-menu-button">
                    <button class="hamburger-btn" aria-label="Toggle mobile menu">
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                    </button>
                </div>
            
                <div class="logo-section">
                    <a href="{{ url('/') }}">
                        <img src="/front/images/logo.png" alt="Obecno Logo" class="header-logo">
                    </a>
                </div>
            </div>
            @if(auth()->check() === true)
                @php
                    $userRoles = \Session::get('loggedInUserRoles', []);
                    $isCompanyAdmin = in_array('3', $userRoles);
                @endphp
                <div class="header-center">
                    <nav class="navigation-menu">
                        @if($isCompanyAdmin)
                            <div class="menu-item {{ request()->routeIs('dashboard') && !request()->routeIs('office-locations.*') && !request()->routeIs('employees.*') ? 'active' : '' }}" onclick="window.location='{{ route('dashboard') }}'">
                                <span class="menu-text">Overview</span>
                            </div>
                            <div class="menu-item {{ request()->routeIs('office-locations.*') || request()->is('office-locations*') ? 'active' : '' }}" onclick="window.location='{{ route('office-locations.index') }}'">
                                <span class="menu-text">Offices & Locations</span>
                            </div>
                            <div class="menu-item {{ request()->routeIs('employees.*') || request()->is('employees*') ? 'active' : '' }}" onclick="window.location='{{ route('employees.index') }}'">
                                <span class="menu-text">Employees</span>
                            </div>
                            <div class="menu-item {{ request()->routeIs('calendar') ? 'active' : '' }}" onclick="window.location='{{ route('calendar') }}'">
                                <span class="menu-text">Calendar</span>
                            </div>
                            <div class="menu-item">
                                <span class="menu-text">Reports</span>
                            </div>
                            <div class="menu-item {{ request()->routeIs('settings') ? 'active' : '' }}" onclick="window.location='{{ route('settings') }}'">
                                <span class="menu-text">Settings</span>
                            </div>
                            <div class="menu-item {{ request()->routeIs('payments') ? 'active' : '' }}" onclick="window.location='{{ route('payments') }}'">
                                <span class="menu-text">Payments</span>
                            </div>
                        @else
                            <div class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}" onclick="window.location='{{ route('dashboard') }}'">
                                <span class="menu-text">Dashboard</span>
                            </div>
                            <div class="menu-item {{ request()->routeIs('mark-attendance') ? 'active' : '' }}" onclick="window.location='{{ route('mark-attendance') }}'">
                                <span class="menu-text">Mark Attendance</span>
                            </div>
                            <div class="menu-item {{ request()->routeIs('apply-leave') ? 'active' : '' }}" onclick="window.location='{{ route('apply-leave') }}'">
                                <span class="menu-text">Apply Leave</span>
                            </div>
                            <div class="menu-item" onclick="window.location='{{ route('logout') }}'">
                                <span class="menu-text">Logout</span>
                            </div>
                        @endif
                    </nav>
                </div>
            <div class="header-right">
                @php
                    $userRoles = \Session::get('loggedInUserRoles', []);
                    $isCompanyAdmin = in_array('3', $userRoles);
                    $companyIds = \Session::get('loggedInUserCompanies', []);
                    if (empty($companyIds) && auth()->check()) {
                        $userRolesData = \App\Models\User_Userrole::where('user_id', auth()->user()->id)->get();
                        $companyIds = $userRolesData->pluck('company_id')->unique()->toArray();
                    }
                    $companies = \App\Models\Company::whereIn('id', $companyIds)->get();
                    $currentCompanyId = !empty($companyIds) ? $companyIds[0] : null;
                    $currentCompany = $currentCompanyId ? \App\Models\Company::find($currentCompanyId) : null;
                @endphp
                
                @if($isCompanyAdmin)
                <div class="add-menu-section" id="addMenuDropdown">
                    <button class="action-button add-button" onclick="toggleAddMenuDropdown()">
                    <i class="fas fa-plus"></i>
                </button>
                    <div class="add-menu-dropdown" id="addMenu">
                        <div class="add-menu-header">
                            <h3>Quick Add</h3>
                        </div>
                        <div class="add-menu-list">
                            <a href="{{ route('companies.create') }}" class="add-menu-item">
                                <div class="add-menu-icon">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                                <div class="add-menu-content">
                                    <div class="add-menu-title">Create Company</div>
                                    <div class="add-menu-description">Create a new company</div>
                                </div>
                                <i class="fas fa-chevron-right add-menu-arrow"></i>
                            </a>
                            <a href="{{ route('office-locations.create') }}" class="add-menu-item">
                                <div class="add-menu-icon">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div class="add-menu-content">
                                    <div class="add-menu-title">Add Office Location</div>
                                    <div class="add-menu-description">Create a new office location</div>
                                </div>
                                <i class="fas fa-chevron-right add-menu-arrow"></i>
                            </a>
                            <a href="{{ route('employees.create') }}" class="add-menu-item">
                                <div class="add-menu-icon">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="add-menu-content">
                                    <div class="add-menu-title">Add Employee</div>
                                    <div class="add-menu-description">Add a new employee to your company</div>
                                </div>
                                <i class="fas fa-chevron-right add-menu-arrow"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                @if(auth()->check() && $companies->count() > 1 && $isCompanyAdmin)
                <div class="company-switcher-section" id="companySwitcherDropdown">
                    <button class="action-button company-switcher-button" onclick="toggleCompanySwitcher()">
                        @if($currentCompany && $currentCompany->photo)
                            <img src="/companies/{{ $currentCompany->id }}/{{ $currentCompany->photo }}" alt="{{ $currentCompany->title }}" style="width: 24px; height: 24px; border-radius: 50%; object-fit: cover; flex-shrink: 0;">
                        @else
                            <i class="fas fa-building"></i>
                        @endif
                        <span class="company-name">{{ $currentCompany ? $currentCompany->title : 'Select Company' }}</span>
                        <i class="fas fa-chevron-down" style="font-size: 10px; margin-left: 8px;"></i>
                    </button>
                    <div class="company-switcher-dropdown" id="companySwitcherMenu">
                        <div class="company-switcher-header">
                            <h3>Switch Company</h3>
                        </div>
                        <div class="company-switcher-list">
                            @foreach($companies as $company)
                                <a href="{{ route('companies.switch', $company->id) }}" class="company-switcher-item {{ $currentCompanyId == $company->id ? 'active' : '' }}">
                                    <div class="company-switcher-icon">
                                        @if($company->photo)
                                            <img src="/companies/{{ $company->id }}/{{ $company->photo }}" alt="{{ $company->title }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                                        @else
                                            <i class="fas fa-building"></i>
                                        @endif
                                    </div>
                                    <div class="company-switcher-content">
                                        <div class="company-switcher-title">{{ $company->title }}</div>
                                        @if($currentCompanyId == $company->id)
                                            <div class="company-switcher-badge">Current</div>
                                        @endif
                                    </div>
                                    @if($currentCompanyId == $company->id)
                                        <i class="fas fa-check company-switcher-check"></i>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                
                <div class="notifications-section" id="notificationsDropdown">
                    <button class="action-button notification-button" onclick="toggleNotificationsDropdown()">
                        <i class="fa-solid fa-bell"></i>
                        @if(auth()->check() && auth()->user()->unreadNotifications->count() > 0)
                            <span class="notification-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
                        @endif
                    </button>
                    <div class="notifications-dropdown" id="notificationsMenu">
                        <div class="notifications-header">
                            <h3>Notifications</h3>
                            @if(auth()->check() && auth()->user()->unreadNotifications->count() > 0)
                                <button class="mark-all-read-btn" onclick="markAllAsRead()">Mark all as read</button>
                            @endif
                        </div>
                        <div class="notifications-list">
                            @if(auth()->check() && auth()->user()->notifications->count() > 0)
                                @foreach(auth()->user()->notifications->take(10) as $notification)
                                    <div class="notification-item {{ $notification->read_at ? 'read' : 'unread' }}" onclick="markAsRead('{{ $notification->id }}')">
                                        <div class="notification-icon">
                                            <i class="fas fa-{{ $notification->data['icon'] ?? 'bell' }}"></i>
                                        </div>
                                        <div class="notification-content">
                                            <div class="notification-title">{{ $notification->data['title'] ?? 'Notification' }}</div>
                                            <div class="notification-message">{{ $notification->data['message'] ?? 'You have a new notification' }}</div>
                                            <div class="notification-time">{{ $notification->created_at->diffForHumans() }}</div>
                                        </div>
                                        @if(!$notification->read_at)
                                            <div class="notification-dot"></div>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="notification-empty">
                                    <i class="fas fa-bell-slash"></i>
                                    <p>No notifications</p>
                                </div>
                            @endif
                        </div>
                        @if(auth()->check() && auth()->user()->notifications->count() > 10)
                            <div class="notifications-footer">
                                <a href="#" class="view-all-link">View all notifications</a>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="user-profile" id="userProfileDropdown">
                    <div class="user-avatar" onclick="toggleUserDropdown()">
                        <img src="/users/{{ auth()->user()->id }}/{{ auth()->user()->photo }}" alt="{{ auth()->user()->title }}" class="avatar-image">
                    </div>
                    <div class="user-dropdown-menu" id="userDropdownMenu">
                        <a href="{{ route('profile') }}" class="dropdown-item">
                            <i class="fas fa-user"></i>
                            <span>Profile</span>
                        </a>
                        <a href="{{ route('change-password') }}" class="dropdown-item">
                            <i class="fas fa-key"></i>
                            <span>Password</span>
                        </a>
                        @php
                            $userRoles = \Session::get('loggedInUserRoles', []);
                            $isCompanyAdmin = in_array('3', $userRoles);
                        @endphp
                        @if($isCompanyAdmin)
                        <a href="{{ route('companies.index') }}" class="dropdown-item">
                            <i class="fas fa-building"></i>
                            <span>My Companies</span>
                        </a>
                        @endif
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="mobile-menu-overlay"></div>
    <div class="mobile-menu">
        <div class="mobile-menu-header">
            
            <button class="mobile-menu-close" aria-label="Close mobile menu">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <nav class="mobile-navigation">
            
            <div class="mobile-menu-item {{ request()->routeIs('dashboard') && !request()->routeIs('office-locations.*') && !request()->routeIs('employees.*') ? 'active' : '' }}" onclick="window.location='{{ route('dashboard') }}'">
                <span class="mobile-menu-text">Overview</span>
                <i class="fas fa-chevron-right mobile-menu-arrow"></i>
            </div>
            <div class="mobile-menu-item {{ request()->routeIs('office-locations.*') || request()->is('office-locations*') ? 'active' : '' }}" onclick="window.location='{{ route('office-locations.index') }}'">
                <span class="mobile-menu-text">Offices & Locations</span>
                <i class="fas fa-chevron-right mobile-menu-arrow"></i>
            </div>
            <div class="mobile-menu-item {{ request()->routeIs('employees.*') || request()->is('employees*') ? 'active' : '' }}" onclick="window.location='{{ route('employees.index') }}'">
                <span class="mobile-menu-text">Employees</span>
                <i class="fas fa-chevron-right mobile-menu-arrow"></i>
            </div>
            <div class="mobile-menu-item {{ request()->routeIs('calendar') ? 'active' : '' }}" onclick="window.location='{{ route('calendar') }}'">
                <span class="mobile-menu-text">Calendar</span>
                <i class="fas fa-chevron-right mobile-menu-arrow"></i>
            </div>
            <div class="mobile-menu-item">
                <span class="mobile-menu-text">Reports</span>
                <i class="fas fa-chevron-right mobile-menu-arrow"></i>
            </div>
            <div class="mobile-menu-item {{ request()->routeIs('settings') ? 'active' : '' }}" onclick="window.location='{{ route('settings') }}'">
                <span class="mobile-menu-text">Settings</span>
                <i class="fas fa-chevron-right mobile-menu-arrow"></i>
            </div>
            <div class="mobile-menu-item {{ request()->routeIs('payments') ? 'active' : '' }}" onclick="window.location='{{ route('payments') }}'">
                <span class="mobile-menu-text">Payments</span>
                <i class="fas fa-chevron-right mobile-menu-arrow"></i>
            </div>
        </nav>
    </div>
</div>

<script>
    // User dropdown toggle functionality
    function toggleUserDropdown() {
        const dropdownMenu = document.getElementById('userDropdownMenu');
        if (dropdownMenu) {
            dropdownMenu.classList.toggle('show');
        }
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const userProfile = document.getElementById('userProfileDropdown');
        const dropdownMenu = document.getElementById('userDropdownMenu');
        
        if (userProfile && dropdownMenu && !userProfile.contains(event.target)) {
            dropdownMenu.classList.remove('show');
        }
    });

    // Close dropdown on escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const dropdownMenu = document.getElementById('userDropdownMenu');
            if (dropdownMenu) {
                dropdownMenu.classList.remove('show');
            }
            const notificationsMenu = document.getElementById('notificationsMenu');
            if (notificationsMenu) {
                notificationsMenu.classList.remove('show');
            }
            const addMenu = document.getElementById('addMenu');
            if (addMenu) {
                addMenu.classList.remove('show');
            }
            const companySwitcherMenu = document.getElementById('companySwitcherMenu');
            if (companySwitcherMenu) {
                companySwitcherMenu.classList.remove('show');
            }
        }
    });

    // Company switcher dropdown toggle functionality
    function toggleCompanySwitcher() {
        const companySwitcherMenu = document.getElementById('companySwitcherMenu');
        if (companySwitcherMenu) {
            companySwitcherMenu.classList.toggle('show');
        }
    }

    // Add menu dropdown toggle functionality
    function toggleAddMenuDropdown() {
        const addMenu = document.getElementById('addMenu');
        if (addMenu) {
            addMenu.classList.toggle('show');
        }
    }

    // Notifications dropdown toggle functionality
    function toggleNotificationsDropdown() {
        const notificationsMenu = document.getElementById('notificationsMenu');
        if (notificationsMenu) {
            notificationsMenu.classList.toggle('show');
        }
    }

    // Close company switcher dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const companySwitcherSection = document.getElementById('companySwitcherDropdown');
        const companySwitcherMenu = document.getElementById('companySwitcherMenu');
        
        if (companySwitcherSection && companySwitcherMenu && !companySwitcherSection.contains(event.target)) {
            companySwitcherMenu.classList.remove('show');
        }
    });

    // Close add menu dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const addMenuSection = document.getElementById('addMenuDropdown');
        const addMenu = document.getElementById('addMenu');
        
        if (addMenuSection && addMenu && !addMenuSection.contains(event.target)) {
            addMenu.classList.remove('show');
        }
    });

    // Close notifications dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const notificationsSection = document.getElementById('notificationsDropdown');
        const notificationsMenu = document.getElementById('notificationsMenu');
        
        if (notificationsSection && notificationsMenu && !notificationsSection.contains(event.target)) {
            notificationsMenu.classList.remove('show');
        }
    });

    // Mark notification as read
    function markAsRead(notificationId) {
        fetch('/notifications/' + notificationId + '/read', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    // Mark all notifications as read
    function markAllAsRead() {
        fetch('/notifications/read-all', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>

<style>
    .company-switcher-section {
        position: relative;
        margin-right: 8px;
    }

    .company-switcher-button {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        background-color: #F7F9FA;
        border: 1px solid #E3E7EB;
        border-radius: 8px;
        color: #192839;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .company-switcher-button:hover {
        background-color: #E9EBEF;
        border-color: #D1D5DB;
    }

    .company-name {
        max-width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .company-switcher-dropdown {
        display: none;
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        width: 280px;
        background-color: #FFFFFF;
        border: 1px solid #E3E7EB;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        z-index: 1000;
        overflow: hidden;
    }

    .company-switcher-dropdown.show {
        display: block;
    }

    .company-switcher-header {
        padding: 16px 20px;
        border-bottom: 1px solid #E3E7EB;
        background-color: #F7F9FA;
    }

    .company-switcher-header h3 {
        margin: 0;
        font-size: 16px;
        font-weight: 600;
        color: #192839;
    }

    .company-switcher-list {
        max-height: 300px;
        overflow-y: auto;
        padding: 8px 0;
    }

    .company-switcher-item {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        text-decoration: none;
        color: inherit;
        transition: background-color 0.2s;
        border-bottom: 1px solid #F7F9FA;
    }

    .company-switcher-item:last-child {
        border-bottom: none;
    }

    .company-switcher-item:hover {
        background-color: #F7F9FA;
    }

    .company-switcher-item.active {
        background-color: #F0F9FF;
    }

    .company-switcher-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: #E3E7EB;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        flex-shrink: 0;
        color: #545861;
    }

    .company-switcher-item.active .company-switcher-icon {
        background-color: #2C2E33;
        color: #FFFFFF;
    }

    .company-switcher-content {
        flex: 1;
        min-width: 0;
    }

    .company-switcher-title {
        font-size: 14px;
        font-weight: 600;
        color: #192839;
        margin-bottom: 2px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .company-switcher-badge {
        font-size: 11px;
        color: #2C2E33;
        font-weight: 500;
    }

    .company-switcher-check {
        font-size: 14px;
        color: #2C2E33;
        margin-left: 8px;
        flex-shrink: 0;
    }

    .add-menu-section {
        position: relative;
    }

    .add-menu-dropdown {
        display: none;
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        width: 280px;
        background-color: #FFFFFF;
        border: 1px solid #E3E7EB;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        z-index: 1000;
        overflow: hidden;
    }

    .add-menu-dropdown.show {
        display: block;
    }

    .add-menu-header {
        padding: 16px 20px;
        border-bottom: 1px solid #E3E7EB;
        background-color: #F7F9FA;
    }

    .add-menu-header h3 {
        margin: 0;
        font-size: 16px;
        font-weight: 600;
        color: #192839;
    }

    .add-menu-list {
        padding: 8px 0;
    }

    .add-menu-item {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        text-decoration: none;
        color: inherit;
        transition: background-color 0.2s;
        border-bottom: 1px solid #F7F9FA;
    }

    .add-menu-item:last-child {
        border-bottom: none;
    }

    .add-menu-item:hover {
        background-color: #F7F9FA;
    }

    .add-menu-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #E3E7EB;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        flex-shrink: 0;
        color: #545861;
    }

    .add-menu-item:hover .add-menu-icon {
        background-color: #2C2E33;
        color: #FFFFFF;
    }

    .add-menu-content {
        flex: 1;
        min-width: 0;
    }

    .add-menu-title {
        font-size: 14px;
        font-weight: 600;
        color: #192839;
        margin-bottom: 2px;
    }

    .add-menu-description {
        font-size: 12px;
        color: #8B8E94;
        line-height: 1.4;
    }

    .add-menu-arrow {
        font-size: 12px;
        color: #8B8E94;
        margin-left: 8px;
        flex-shrink: 0;
    }

    .notifications-section {
        position: relative;
    }

    .notification-button {
        position: relative;
    }

    .notification-badge {
        position: absolute;
        top: -4px;
        right: -4px;
        background-color: #dc3545;
        color: white;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        font-size: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
    }

    .notifications-dropdown {
        display: none;
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        width: 360px;
        max-height: 500px;
        background-color: #FFFFFF;
        border: 1px solid #E3E7EB;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        z-index: 1000;
        overflow: hidden;
    }

    .notifications-dropdown.show {
        display: block;
    }

    .notifications-header {
        padding: 16px 20px;
        border-bottom: 1px solid #E3E7EB;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #F7F9FA;
    }

    .notifications-header h3 {
        margin: 0;
        font-size: 16px;
        font-weight: 600;
        color: #192839;
    }

    .mark-all-read-btn {
        background: none;
        border: none;
        color: #2C2E33;
        font-size: 12px;
        cursor: pointer;
        padding: 4px 8px;
        border-radius: 4px;
        transition: background-color 0.2s;
    }

    .mark-all-read-btn:hover {
        background-color: #E3E7EB;
    }

    .notifications-list {
        max-height: 400px;
        overflow-y: auto;
    }

    .notification-item {
        display: flex;
        align-items: flex-start;
        padding: 12px 20px;
        border-bottom: 1px solid #F7F9FA;
        cursor: pointer;
        transition: background-color 0.2s;
        position: relative;
    }

    .notification-item:hover {
        background-color: #F7F9FA;
    }

    .notification-item.unread {
        background-color: #F0F9FF;
    }

    .notification-item.read {
        opacity: 0.7;
    }

    .notification-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #E3E7EB;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        flex-shrink: 0;
        color: #545861;
    }

    .notification-item.unread .notification-icon {
        background-color: #2C2E33;
        color: #FFFFFF;
    }

    .notification-content {
        flex: 1;
        min-width: 0;
    }

    .notification-title {
        font-size: 14px;
        font-weight: 600;
        color: #192839;
        margin-bottom: 4px;
    }

    .notification-message {
        font-size: 13px;
        color: #545861;
        margin-bottom: 4px;
        line-height: 1.4;
    }

    .notification-time {
        font-size: 11px;
        color: #8B8E94;
    }

    .notification-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: #2C2E33;
        position: absolute;
        top: 16px;
        right: 16px;
    }

    .notification-empty {
        padding: 48px 20px;
        text-align: center;
        color: #8B8E94;
    }

    .notification-empty i {
        font-size: 48px;
        margin-bottom: 12px;
        opacity: 0.5;
    }

    .notification-empty p {
        margin: 0;
        font-size: 14px;
    }

    .notifications-footer {
        padding: 12px 20px;
        border-top: 1px solid #E3E7EB;
        text-align: center;
        background-color: #F7F9FA;
    }

    .view-all-link {
        color: #2C2E33;
        text-decoration: none;
        font-size: 13px;
        font-weight: 500;
    }

    .view-all-link:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .notifications-dropdown {
            width: 320px;
            right: -10px;
        }
    }
</style>