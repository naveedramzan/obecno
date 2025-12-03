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
                            <h1 class="page-title">Upload Employees</h1>
                            <div class="page-actions">
                                <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i>
                                    <span>Back to List</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Upload Section -->
                    <div class="dashboard-main-content">
                        <div class="center-column">
                            <div class="center-column-wrapper">
                                <div class="form-widget">
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if(session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
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

                                    <div class="upload-instructions">
                                        <h3>Upload Instructions</h3>
                                        <p>Upload a CSV file with the following columns:</p>
                                        <ul>
                                            <li><strong>Employee Name</strong> - Full name of the employee</li>
                                            <li><strong>Employee Job Role</strong> - Job role/title (will be created if doesn't exist)</li>
                                            <li><strong>Employee Email</strong> - Email address (must be unique)</li>
                                        </ul>
                                        <p><strong>Note:</strong> The first row should contain column headers. Employees will be assigned to the selected office location.</p>
                                        <a href="{{ asset('sample-employees.csv') }}" download class="btn btn-info" style="background: #17a2b8; color: white; text-decoration: none; padding: 0.5rem 1rem; border-radius: 4px; display: inline-block; margin-top: 0.5rem;">
                                            <i class="fas fa-download"></i> Download Sample CSV
                                        </a>
                                    </div>

                                    <form action="{{ route('employees.upload.process') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        
                                        <div class="form-group">
                                            <label for="company_id">Company <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{ $defaultCompany->title }}" readonly disabled>
                                            <input type="hidden" name="company_id" value="{{ $defaultCompany->id }}">
                                            <small class="form-text text-muted">Your company is automatically selected and cannot be changed.</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="office_location_id">Office Location <span class="text-danger">*</span></label>
                                            <select name="office_location_id" id="office_location_id" class="form-control" required>
                                                <option value="">Select Office Location</option>
                                                @foreach($officeLocations as $location)
                                                    <option value="{{ $location->id }}" {{ old('office_location_id') == $location->id ? 'selected' : '' }}>
                                                        {{ $location->title }}
                                                        @if($location->city)
                                                            - {{ $location->city->title }}
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="form-text text-muted">All employees will be assigned to this office location.</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="department_id">Default Department</label>
                                            <select name="department_id" id="department_id" class="form-control">
                                                <option value="">Select Department (Optional)</option>
                                                @foreach($departments as $department)
                                                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                                        {{ $department->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="form-text text-muted">All employees will be assigned to this department.</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="csv_file">CSV File <span class="text-danger">*</span></label>
                                            <input type="file" name="csv_file" id="csv_file" class="form-control" accept=".csv" required>
                                            <small class="form-text text-muted">Only CSV files are allowed.</small>
                                        </div>

                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-upload"></i>
                                                <span>Upload Employees</span>
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
    .upload-instructions {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }
    .upload-instructions h3 {
        margin-top: 0;
        margin-bottom: 1rem;
        color: #333;
    }
    .upload-instructions ul {
        margin: 0.5rem 0;
        padding-left: 1.5rem;
    }
    .upload-instructions li {
        margin: 0.5rem 0;
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
    input[type="file"] {
        padding: 0.5rem;
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

