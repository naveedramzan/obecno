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
                            <h1 class="page-title">Add New Office Location</h1>
                            <div class="page-actions">
                                <a href="{{ route('office-locations.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i>
                                    <span>Back to List</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Form Section -->
                    <div class="dashboard-main-content">
                        <div class="center-column">
                            <div class="center-column-wrapper">
                                <div class="form-widget">
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form action="{{ route('office-locations.store') }}" method="POST">
                                        @csrf
                                        
                                        <div class="form-group">
                                            <label for="company_id">Company <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{ $defaultCompany->title }}" readonly disabled>
                                            <input type="hidden" name="company_id" value="{{ $defaultCompany->id }}">
                                            <small class="form-text text-muted">Your company is automatically selected and cannot be changed.</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="title">Location Name / Title <span class="text-danger">*</span></label>
                                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required placeholder="e.g., Main Office, Branch Office">
                                        </div>

                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea name="address" id="address" class="form-control" rows="3" placeholder="Enter full address">{{ old('address') }}</textarea>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group">
                                                <label for="country_id">Country</label>
                                                <select name="country_id" id="country_id" class="form-control">
                                                    <option value="">Select Country</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                                            {{ $country->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="city_id">City</label>
                                                <select name="city_id" id="city_id" class="form-control">
                                                    <option value="">Select City</option>
                                                    @foreach($cities as $city)
                                                        <option value="{{ $city->id }}" data-country-id="{{ $city->country_id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                                            {{ $city->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" placeholder="+1 234 567 8900">
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="office@example.com">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="lat_lon">Latitude & Longitude</label>
                                            <input type="text" name="lat_lon" id="lat_lon" class="form-control" value="{{ old('lat_lon') }}" placeholder="e.g., 40.7128, -74.0060">
                                            <small class="form-text text-muted">Format: latitude, longitude (comma separated)</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="timezone_id">Timezone</label>
                                            <select name="timezone_id" id="timezone_id" class="form-control">
                                                <option value="">Select Timezone</option>
                                                @foreach($timezones as $timezone)
                                                    <option value="{{ $timezone->id }}" {{ old('timezone_id') == $timezone->id ? 'selected' : '' }}>
                                                        {{ $timezone->title }} ({{ $timezone->timezone }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save"></i>
                                                <span>Create Location</span>
                                            </button>
                                            <a href="{{ route('office-locations.index') }}" class="btn btn-secondary">
                                                <span>Cancel</span>
                                            </a>
                                        </div>
                                    </form>
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
        background: #6c757d;
        color: white;
        border: none;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        transition: background 0.2s;
    }
    .page-actions .btn:hover {
        background: #5a6268;
    }
    .form-widget {
        background: white;
        border-radius: 8px;
        padding: 2rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .form-group {
        margin-bottom: 1.5rem;
    }
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }
    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #333;
    }
    .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
    }
    .form-control:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
    }
    .form-control[readonly] {
        background-color: #e9ecef;
        cursor: not-allowed;
    }
    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }
    .form-actions .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
    }
    .btn-primary {
        background: #007bff;
        color: white;
    }
    .btn-primary:hover {
        background: #0056b3;
    }
    .btn-secondary {
        background: #6c757d;
        color: white;
    }
    .btn-secondary:hover {
        background: #5a6268;
    }
    .alert {
        padding: 1rem;
        border-radius: 4px;
        margin-bottom: 1.5rem;
    }
    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    .alert-danger {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    .text-danger {
        color: #dc3545;
    }
    .form-text {
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
  </style>

  <script>
    // Filter cities based on selected country
    document.getElementById('country_id')?.addEventListener('change', function() {
        const countryId = this.value;
        const citySelect = document.getElementById('city_id');
        const cities = citySelect.querySelectorAll('option[data-country-id]');
        
        cities.forEach(city => {
            if (countryId === '' || city.getAttribute('data-country-id') === countryId) {
                city.style.display = '';
            } else {
                city.style.display = 'none';
            }
        });
        
        // Reset city selection if it doesn't match the country
        if (countryId && citySelect.value) {
            const selectedCity = citySelect.options[citySelect.selectedIndex];
            if (selectedCity.getAttribute('data-country-id') !== countryId) {
                citySelect.value = '';
            }
        }
    });
  </script>
@endsection

