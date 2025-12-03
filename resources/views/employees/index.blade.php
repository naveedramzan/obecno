@extends('company-admin')
@section('content')
   
  <div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <div class="body-content">
        <div class="overview-content-wrapper">
            <div class="dashboard-section">
                <div class="dashboard-content">
                    <!-- Page Header -->
                    <div class="page-header-section">
                        <div class="page-header-content">
                            <h1 class="page-title">Employees</h1>
                            <div class="page-actions">
                                <a href="{{ route('employees.upload') }}" class="btn btn-success" style="background: #28a745; margin-right: 0.5rem;">
                                    <i class="fas fa-upload"></i>
                                    <span>Upload Employees</span>
                                </a>
                                <a href="{{ route('employees.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                    <span>Add New Employee</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Employees List -->
                    <div class="dashboard-main-content">
                        <div class="center-column">
                            <div class="center-column-wrapper">
                                <div class="attendance-widget">
                                    <div class="attendance-header">
                                        <div class="header-left">
                                            <div class="attendance-search">
                                                <div class="search-field">
                                                    <i class="fas fa-search"></i>
                                                    <input type="text" id="search-input" placeholder="Search employees..." class="search-input">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="attendance-content">
                                        @if(session('error'))
                                            <div class="alert alert-danger" style="margin-bottom: 1.5rem; padding: 1rem; border-radius: 4px; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;">
                                                {{ session('error') }}
                                            </div>
                                        @endif

                                        @if(session('success'))
                                            <div class="alert alert-success" style="margin-bottom: 1.5rem; padding: 1rem; border-radius: 4px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb;">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        
                                        <!-- Employees List Items -->
                                        <div class="attendance-list" id="employees-list">
                                            @forelse($employees as $employee)
                                                @php
                                                    $userRole = $employee->userRoles->first();
                                                    $role = $userRole ? $userRole->userrole : null;
                                                    $department = $userRole ? $userRole->department : null;
                                                @endphp
                                                <div class="attendance-list-item employee-item">
                                                    <div class="employee-info">
                                                        <div class="employee-name">
                                                            <span class="name">{{ $employee->title }}</span>
                                                            @if($role)
                                                                <span class="team">[{{ $role->title }}]</span>
                                                            @endif
                                                            @if($department)
                                                                <span class="team" style="color: #321FDB;">[{{ $department->title }}]</span>
                                                            @endif
                                                        </div>
                                                        <div class="location-details">
                                                            <div class="detail-item">
                                                                <i class="fas fa-envelope"></i>
                                                                <span>{{ $employee->email }}</span>
                                                            </div>
                                                            @if($employee->city)
                                                                <div class="detail-item">
                                                                    <i class="fas fa-city"></i>
                                                                    <span>{{ $employee->city->title }}</span>
                                                                </div>
                                                            @endif
                                                            @if($employee->country)
                                                                <div class="detail-item">
                                                                    <i class="fas fa-flag"></i>
                                                                    <span>{{ $employee->country->title }}</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="edit-icon" style="display: flex; gap: 8px;">
                                                        <a href="{{ route('employees.show', $employee->id) }}" title="View Attendance">
                                                            <img src="front/icons/alarm-exclamation.svg" alt="View Attendance" class="edit-icon-svg" style="width: 18px; height: 18px;">
                                                        </a>
                                                        <a href="{{ route('employees.edit', $employee->id) }}" title="Edit Employee">
                                                            <img src="front/icons/edit-icon.svg" alt="Edit" class="edit-icon-svg">
                                                        </a>
                                                    </div>
                                                    <div class="employee-actions">
                                                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to remove this employee from the company?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="action-btn delete-btn" style="background: none; border: none; cursor: pointer;">
                                                                <i class="fas fa-trash" style="color: #dc3545;"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="empty-state">
                                                    <i class="fas fa-users"></i>
                                                    <p class="empty-text">No employees found. Add your first employee!</p>
                                                    <a href="{{ route('employees.create') }}" class="btn btn-primary">
                                                        <i class="fas fa-plus"></i>
                                                        <span>Add Employee</span>
                                                    </a>
                                                </div>
                                            @endforelse
                                        </div>
                                        
                                        <!-- Pagination -->
                                        @if($employees->hasPages())
                                            <div class="pagination-section">
                                                <div class="pagination">
                                                    @if($employees->onFirstPage())
                                                        <button class="pagination-btn prev-btn" disabled>
                                                            <i class="fas fa-chevron-left"></i>
                                                        </button>
                                                    @else
                                                        <a href="{{ $employees->previousPageUrl() }}" class="pagination-btn prev-btn">
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
                                                        <a href="{{ $employees->url(1) }}" class="pagination-page">01</a>
                                                        @if($startPage > 2)
                                                            <span class="pagination-page">...</span>
                                                        @endif
                                                    @endif
                                                    
                                                    @foreach(range($startPage, $endPage) as $page)
                                                        @if($page == $currentPage)
                                                            <button class="pagination-page active">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</button>
                                                        @else
                                                            <a href="{{ $employees->url($page) }}" class="pagination-page">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</a>
                                                        @endif
                                                    @endforeach
                                                    
                                                    @if($endPage < $lastPage)
                                                        @if($endPage < $lastPage - 1)
                                                            <span class="pagination-page">...</span>
                                                        @endif
                                                        <a href="{{ $employees->url($lastPage) }}" class="pagination-page">{{ str_pad($lastPage, 2, '0', STR_PAD_LEFT) }}</a>
                                                    @endif
                                                    
                                                    @if($employees->hasMorePages())
                                                        <a href="{{ $employees->nextPageUrl() }}" class="pagination-btn next-btn">
                                                            <i class="fas fa-chevron-right"></i>
                                                        </a>
                                                    @else
                                                        <button class="pagination-btn next-btn" disabled>
                                                            <i class="fas fa-chevron-right"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                        
                                        <div class="add-employee-section">
                                            <a href="{{ route('employees.create') }}" class="add-employee-btn">
                                                <i class="fas fa-plus"></i>
                                                <span>Add Employee</span>
                                            </a>
                                        </div>
                                    </div>
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
    .page-header-section {
        margin-bottom: 2rem;
    }
    .page-header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem 0;
    }
    .page-title {
        font-size: 1.75rem;
        font-weight: 600;
        color: #1a1a1a;
        margin: 0;
    }
    .page-actions .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        transition: background 0.2s;
    }
    .page-actions .btn:hover {
        background: #0056b3;
    }
    .location-details {
        margin-top: 0.5rem;
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .detail-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: #666;
    }
    .detail-item i {
        color: #999;
    }
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
    }
    .empty-state i {
        font-size: 3rem;
        color: #ccc;
        margin-bottom: 1rem;
    }
    .empty-text {
        color: #666;
        margin-bottom: 1.5rem;
    }
    .delete-btn {
        padding: 0.5rem;
    }
    .delete-btn:hover {
        opacity: 0.7;
    }
  </style>

  <script>
    // Search functionality
    document.getElementById('search-input')?.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const items = document.querySelectorAll('.employee-item');
        
        items.forEach(item => {
            const text = item.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });
  </script>
@endsection

