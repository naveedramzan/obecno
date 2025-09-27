@if(auth()->check() == true)
  @if(\Session::get('loggedInUserRoles') && in_array('1', \Session::get('loggedInUserRoles')))
  <div class="sidebar sidebar-fixed" id="sidebar">
        <div class="sidebar-brand d-none d-md-flex">
          <img src="/front/images/logo.png" width="200" style="border-radius:5px; margin:10px;"> 
        </div>
        <h5>Welcome {{ auth()->user()->title }}</h5>
        <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
          <li class="nav-item"><a class="nav-link" href="{{ url('/dashboard') }}">
            <svg class="nav-icon">
              <use xlink:href="/node_modules/@coreui/icons/sprites/free.svg#cil-speedometer"></use>
            </svg> Dashboard</a>
            <!-- <span class="badge badge-sm bg-info ms-auto">NEW</span> -->
          </li>

          <li class="nav-title">Main Items</li>
          
          <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-users') }}"><span class="nav-icon"></span> Users</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-companies') }}"><span class="nav-icon"></span> Companies/Tanents</a></li>
          <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
              <svg class="nav-icon">
                <use xlink:href="/node_modules/@coreui/icons/sprites/free.svg#cil-puzzle"></use>
              </svg> Subscription/Billing</a>
            <ul class="nav-group-items">
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-payments') }}"><span class="nav-icon"></span> Payments</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-invoices') }}"><span class="nav-icon"></span> Invoices</a></li>              
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-discounts') }}"><span class="nav-icon"></span> Discounts</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-subscriptions') }}"><span class="nav-icon"></span> Subscriptions</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-subscriptionplans') }}"><span class="nav-icon"></span> Subscription Plans</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-subscriptionplanhistory') }}"><span class="nav-icon"></span> Subscription Plans History</a></li>
            </ul>
          </li>
          <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
              <svg class="nav-icon">
                <use xlink:href="/node_modules/@coreui/icons/sprites/free.svg#cil-puzzle"></use>
              </svg> ATT Module</a>
            <ul class="nav-group-items">
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-attendance') }}"><span class="nav-icon"></span> Attendance</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-holidays') }}"><span class="nav-icon"></span> Holidays</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-employees') }}"><span class="nav-icon"></span> Employees</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-leaves') }}"><span class="nav-icon"></span> Employee Leaves</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-wages') }}"><span class="nav-icon"></span> Employee Wages</a></li>
            </ul>
          </li>
          <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
              <svg class="nav-icon">
                <use xlink:href="/node_modules/@coreui/icons/sprites/free.svg#cil-puzzle"></use>
              </svg> APP Module</a>
            <ul class="nav-group-items">
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-appointments') }}"><span class="nav-icon"></span> Appointments</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-sessions') }}"><span class="nav-icon"></span> Sessions</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-services') }}"><span class="nav-icon"></span> Services</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-assets') }}"><span class="nav-icon"></span> Assets</a></li>
            </ul>
          </li>
          <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
              <svg class="nav-icon">
                <use xlink:href="/node_modules/@coreui/icons/sprites/free.svg#cil-puzzle"></use>
              </svg> Settings</a>
            <ul class="nav-group-items">
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-cms') }}"><span class="nav-icon"></span> CMS Content</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-appointmentstatuses') }}"><span class="nav-icon"></span> Appointment Statuses</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-cities') }}"><span class="nav-icon"></span> Cities</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-countries') }}"><span class="nav-icon"></span> Countries</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-settings') }}"><span class="nav-icon"></span> Settings</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-userroles') }}"><span class="nav-icon"></span> Userroles</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-assettypes') }}"><span class="nav-icon"></span> Assets Types</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-leavetypes') }}"><span class="nav-icon"></span> Leaves Types</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-departments') }}"><span class="nav-icon"></span> Departments</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-employmenttypes') }}"><span class="nav-icon"></span> Employee Types</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-categories') }}"><span class="nav-icon"></span> Categories</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-timezones') }}"><span class="nav-icon"></span> Timezones</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-currencies') }}"><span class="nav-icon"></span> Currencies</a></li>
            </ul>
          </li>
          <hr>
          
          <li class="nav-item"><a class="nav-link" href="{{ url('/logout') }}" target="_top">
            <svg class="nav-icon">
              <use xlink:href="/node_modules/@coreui/icons/sprites/free.svg#cil-account-logout"></use>
            </svg> Logout</a>
          </li>
          
        </ul>
        <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
      </div>
  @elseif(\Session::get('loggedInUserRoles') && in_array('3', \Session::get('loggedInUserRoles')))
    <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
      <h3>Welcome </h3>
        <div class="sidebar-brand d-none d-md-flex">
          <img src="/front/images/schedule-sync.png" width="200" style="border-radius:5px; margin:10px;"> 
        </div>
        <h5>Welcome {{ auth()->user()->title }}</h5>
        <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
          <li class="nav-item"><a class="nav-link" href="{{ url('/dashboard') }}">
            <svg class="nav-icon">
              <use xlink:href="/node_modules/@coreui/icons/sprites/free.svg#cil-speedometer"></use>
            </svg> Dashboard</a>
            <!-- <span class="badge badge-sm bg-info ms-auto">NEW</span> -->
          </li>

          <li class="nav-title">Main Items</li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-appointments') }}"><span class="nav-icon"></span> Appointments</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-sessions') }}"><span class="nav-icon"></span> Sessions</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-services') }}"><span class="nav-icon"></span> Services</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-assets') }}"><span class="nav-icon"></span> Assets</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-users?type=2') }}"><span class="nav-icon"></span> Customers Users</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-users?type=3') }}"><span class="nav-icon"></span> Staff Users</a></li>
          <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
              <svg class="nav-icon">
                <use xlink:href="/node_modules/@coreui/icons/sprites/free.svg#cil-puzzle"></use>
              </svg> Settings</a>
            <ul class="nav-group-items">
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-cms') }}"><span class="nav-icon"></span> CMS Content</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/admin-list-companies') }}"><span class="nav-icon"></span> YourCompany Details</a></li>
            </ul>
          </li>
          <hr>
          
          <li class="nav-item"><a class="nav-link" href="{{ url('/logout') }}" target="_top">
            <svg class="nav-icon">
              <use xlink:href="/node_modules/@coreui/icons/sprites/free.svg#cil-account-logout"></use>
            </svg> Logout</a>
          </li>
          
        </ul>
        <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
      </div>
  @endif
@endif