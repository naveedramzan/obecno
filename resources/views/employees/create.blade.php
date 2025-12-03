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
                            <h1 class="page-title">Add New Employee</h1>
                            <div class="page-actions">
                                <a href="{{ route('employees.index') }}" class="btn btn-secondary">
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

                                    <form action="{{ route('employees.store') }}" method="POST">
                                        @csrf
                                        
                                        <div class="form-group">
                                            <label for="company_id">Company <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{ $defaultCompany->title }}" readonly disabled>
                                            <input type="hidden" name="company_id" value="{{ $defaultCompany->id }}">
                                            <small class="form-text text-muted">Your company is automatically selected and cannot be changed.</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="title">Employee Name <span class="text-danger">*</span></label>
                                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required placeholder="Enter employee name">
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email Address <span class="text-danger">*</span></label>
                                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required placeholder="employee@example.com">
                                        </div>

                                        <div class="form-group">
                                            <label for="userrole_id">Role <span class="text-danger">*</span></label>
                                            <select name="userrole_id" id="userrole_id" class="form-control" required>
                                                <option value="">Select Role</option>
                                                @foreach($userroles as $userrole)
                                                    <option value="{{ $userrole->id }}" {{ old('userrole_id') == $userrole->id ? 'selected' : '' }}>
                                                        {{ $userrole->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="department_id">Department</label>
                                            <select name="department_id" id="department_id" class="form-control">
                                                <option value="">Select Department (Optional)</option>
                                                @foreach($departments as $department)
                                                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                                        {{ $department->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="office_location_id">Office Location</label>
                                            <select name="office_location_id" id="office_location_id" class="form-control">
                                                <option value="">Select Office Location (Optional)</option>
                                                @foreach($officeLocations as $location)
                                                    <option value="{{ $location->id }}" data-city-id="{{ $location->city_id }}" data-country-id="{{ $location->city?->country_id }}" {{ old('office_location_id') == $location->id ? 'selected' : '' }}>
                                                        {{ $location->title }}
                                                        @if($location->city)
                                                            - {{ $location->city->title }}
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="form-text text-muted">Selecting an office location will automatically set the employee's city and country.</small>
                                        </div>

                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save"></i>
                                                <span>Create Employee</span>
                                            </button>
                                            <a href="{{ route('employees.index') }}" class="btn btn-secondary">
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
@endsection

