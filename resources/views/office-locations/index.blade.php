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
                            <h1 class="page-title">Office & Locations</h1>
                            <div class="page-actions">
                                <a href="{{ route('office-locations.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                    <span>Add New Location</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Office Locations List -->
                    <div class="dashboard-main-content">
                        <div class="center-column">
                            <div class="center-column-wrapper">
                                <div class="attendance-widget">
                                    <div class="attendance-header">
                                        <div class="header-left">
                                            <div class="attendance-search">
                                                <div class="search-field">
                                                    <i class="fas fa-search"></i>
                                                    <input type="text" id="search-input" placeholder="Search locations..." class="search-input">
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
                                        
                                        <!-- Office Locations List Items -->
                                        <div class="attendance-list" id="locations-list">
                                            @forelse($officeLocations as $location)
                                                <div class="attendance-list-item location-item">
                                                    <div class="employee-info">
                                                        <div class="employee-name">
                                                            <span class="name">{{ $location->title }}</span>
                                                            @if($location->company)
                                                                <span class="team">[{{ $location->company->title }}]</span>
                                                            @endif
                                                        </div>
                                                        <div class="location-details">
                                                            @if($location->address)
                                                                <div class="detail-item">
                                                                    <i class="fas fa-map-marker-alt"></i>
                                                                    <span>{{ $location->address }}</span>
                                                                </div>
                                                            @endif
                                                            @if($location->city)
                                                                <div class="detail-item">
                                                                    <i class="fas fa-city"></i>
                                                                    <span>{{ $location->city->title }}</span>
                                                                </div>
                                                            @endif
                                                            @if($location->phone)
                                                                <div class="detail-item">
                                                                    <i class="fas fa-phone"></i>
                                                                    <span>{{ $location->phone }}</span>
                                                                </div>
                                                            @endif
                                                            @if($location->email)
                                                                <div class="detail-item">
                                                                    <i class="fas fa-envelope"></i>
                                                                    <span>{{ $location->email }}</span>
                                                                </div>
                                                            @endif
                                                            @if($location->timezone)
                                                                <div class="detail-item">
                                                                    <i class="fas fa-clock"></i>
                                                                    <span>{{ $location->timezone->name }}</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="edit-icon">
                                                        <a href="{{ route('office-locations.edit', $location->id) }}">
                                                            <img src="front/icons/edit-icon.svg" alt="Edit" class="edit-icon-svg">
                                                        </a>
                                                    </div>
                                                    <div class="employee-actions">
                                                        <form action="{{ route('office-locations.destroy', $location->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this location?');">
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
                                                    <i class="fas fa-building"></i>
                                                    <p class="empty-text">No office locations found. Create your first location!</p>
                                                    <a href="{{ route('office-locations.create') }}" class="btn btn-primary">
                                                        <i class="fas fa-plus"></i>
                                                        <span>Add Location</span>
                                                    </a>
                                                </div>
                                            @endforelse
                                        </div>
                                        
                                        <!-- Pagination -->
                                        @if($officeLocations->hasPages())
                                            <div class="pagination-section">
                                                <div class="pagination">
                                                    @if($officeLocations->onFirstPage())
                                                        <button class="pagination-btn prev-btn" disabled>
                                                            <i class="fas fa-chevron-left"></i>
                                                        </button>
                                                    @else
                                                        <a href="{{ $officeLocations->previousPageUrl() }}" class="pagination-btn prev-btn">
                                                            <i class="fas fa-chevron-left"></i>
                                                        </a>
                                                    @endif
                                                    
                                                    @php
                                                        $currentPage = $officeLocations->currentPage();
                                                        $lastPage = $officeLocations->lastPage();
                                                        $startPage = max(1, $currentPage - 2);
                                                        $endPage = min($lastPage, $currentPage + 2);
                                                    @endphp
                                                    
                                                    @if($startPage > 1)
                                                        <a href="{{ $officeLocations->url(1) }}" class="pagination-page">01</a>
                                                        @if($startPage > 2)
                                                            <span class="pagination-page">...</span>
                                                        @endif
                                                    @endif
                                                    
                                                    @foreach(range($startPage, $endPage) as $page)
                                                        @if($page == $currentPage)
                                                            <button class="pagination-page active">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</button>
                                                        @else
                                                            <a href="{{ $officeLocations->url($page) }}" class="pagination-page">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</a>
                                                        @endif
                                                    @endforeach
                                                    
                                                    @if($endPage < $lastPage)
                                                        @if($endPage < $lastPage - 1)
                                                            <span class="pagination-page">...</span>
                                                        @endif
                                                        <a href="{{ $officeLocations->url($lastPage) }}" class="pagination-page">{{ str_pad($lastPage, 2, '0', STR_PAD_LEFT) }}</a>
                                                    @endif
                                                    
                                                    @if($officeLocations->hasMorePages())
                                                        <a href="{{ $officeLocations->nextPageUrl() }}" class="pagination-btn next-btn">
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
                                            <a href="{{ route('office-locations.create') }}" class="add-employee-btn">
                                                <i class="fas fa-plus"></i>
                                                <span>Add Location</span>
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
        const items = document.querySelectorAll('.location-item');
        
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

