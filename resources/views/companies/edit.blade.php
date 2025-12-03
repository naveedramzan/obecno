@extends('company-admin')
@section('content')
   
  <div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <div class="body-content">
        <div class="overview-content-wrapper">
            <div class="dashboard-section">
                <div class="dashboard-content">
                    <!-- Page Header -->
                    <div class="page-header" style="margin-bottom: 32px; width: 100%; max-width: 1200px; margin-left: auto; margin-right: auto; padding: 0 16px; box-sizing: border-box;">
                        <h1 class="page-title" style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 24px; line-height: 1.5em; color: #192839; text-align: left;">
                            Edit Company
                        </h1>
                        <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; line-height: 1.5em; color: #545861; margin-top: 8px; text-align: left;">
                            Update company information
                        </p>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success" style="margin-bottom: 24px; padding: 12px 16px; background-color: #D1E7DD; color: #0F5132; border-radius: 8px; border: 1px solid #BADBCC; width: 100%; max-width: 1200px; margin-left: auto; margin-right: auto; padding-left: 16px; padding-right: 16px; box-sizing: border-box;">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-error" style="margin-bottom: 24px; padding: 12px 16px; background-color: #F8D7DA; color: #842029; border-radius: 8px; border: 1px solid #F5C2C7; width: 100%; max-width: 1200px; margin-left: auto; margin-right: auto; padding-left: 16px; padding-right: 16px; box-sizing: border-box;">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="form-container" style="width: 100%; max-width: 1200px; margin: 0 auto; padding: 0 16px; box-sizing: border-box;">
                        <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-card" style="width: 100%; background-color: #FFFFFF; border: 1px solid #E3E7EB; border-radius: 16px; padding: 32px; box-sizing: border-box;">
                                
                                @if($errors->any())
                                    <div class="alert alert-danger" style="margin-bottom: 24px; padding: 12px 16px; background-color: #F8D7DA; color: #842029; border-radius: 8px; border: 1px solid #F5C2C7;">
                                        <ul class="mb-0" style="margin: 0; padding-left: 20px;">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="form-row" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 24px;">
                                    <div class="form-group">
                                        <label for="title" style="display: block; margin-bottom: 8px; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; line-height: 1.5em; color: #545861; text-align: left;">
                                            Company Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $company->title) }}" required placeholder="Enter company name" style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; line-height: 1.5em; color: #192839; padding: 12px 16px; background-color: #FFFFFF; border: 1px solid #E3E7EB; border-radius: 8px; text-align: left; width: 100%; box-sizing: border-box;">
                                    </div>

                                    <div class="form-group">
                                        <label for="founded_year" style="display: block; margin-bottom: 8px; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; line-height: 1.5em; color: #545861; text-align: left;">
                                            Founded Year <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" name="founded_year" id="founded_year" class="form-control" value="{{ old('founded_year', $company->founded) }}" required placeholder="Enter founded year" min="1800" max="{{ date('Y') }}" style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; line-height: 1.5em; color: #192839; padding: 12px 16px; background-color: #FFFFFF; border: 1px solid #E3E7EB; border-radius: 8px; text-align: left; width: 100%; box-sizing: border-box;">
                                    </div>
                                </div>

                                <div class="form-group" style="margin-bottom: 24px;">
                                    <label for="description" style="display: block; margin-bottom: 8px; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; line-height: 1.5em; color: #545861; text-align: left;">
                                        Description <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="description" id="description" class="form-control" rows="5" required placeholder="Enter company description" style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; line-height: 1.5em; color: #192839; padding: 12px 16px; background-color: #FFFFFF; border: 1px solid #E3E7EB; border-radius: 8px; text-align: left; width: 100%; box-sizing: border-box; resize: vertical;">{{ old('description', $company->description) }}</textarea>
                                </div>

                                <div class="form-row" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 24px;">
                                    <div class="form-group">
                                        <label for="website" style="display: block; margin-bottom: 8px; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; line-height: 1.5em; color: #545861; text-align: left;">
                                            Website <span class="text-danger">*</span>
                                        </label>
                                        <input type="url" name="website" id="website" class="form-control" value="{{ old('website', $company->website) }}" required placeholder="https://example.com" style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; line-height: 1.5em; color: #192839; padding: 12px 16px; background-color: #FFFFFF; border: 1px solid #E3E7EB; border-radius: 8px; text-align: left; width: 100%; box-sizing: border-box;">
                                    </div>

                                    <div class="form-group">
                                        <label for="team_size" style="display: block; margin-bottom: 8px; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; line-height: 1.5em; color: #545861; text-align: left;">
                                            Team Size <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" name="team_size" id="team_size" class="form-control" value="{{ old('team_size', $company->team_size) }}" required placeholder="Enter team size" min="1" style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; line-height: 1.5em; color: #192839; padding: 12px 16px; background-color: #FFFFFF; border: 1px solid #E3E7EB; border-radius: 8px; text-align: left; width: 100%; box-sizing: border-box;">
                                    </div>
                                </div>

                                <div class="form-group" style="margin-bottom: 24px;">
                                    <label for="photo" style="display: block; margin-bottom: 8px; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; line-height: 1.5em; color: #545861; text-align: left;">
                                        Company Logo
                                    </label>
                                    @if($company->photo)
                                        <div style="margin-bottom: 12px;">
                                            <img id="photoPreview" src="/companies/{{ $company->id }}/{{ $company->photo }}" alt="Company Logo" style="max-width: 150px; max-height: 150px; border-radius: 8px; border: 1px solid #E3E7EB; object-fit: cover;">
                                        </div>
                                    @else
                                        <div style="margin-bottom: 12px;">
                                            <img id="photoPreview" src="" alt="Company Logo Preview" style="max-width: 150px; max-height: 150px; border-radius: 8px; border: 1px solid #E3E7EB; object-fit: cover; display: none;">
                                        </div>
                                    @endif
                                    <input type="file" name="photo" id="photo" class="form-control" accept="image/*" onchange="previewPhoto(this)" style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; line-height: 1.5em; color: #192839; padding: 12px 16px; background-color: #FFFFFF; border: 1px solid #E3E7EB; border-radius: 8px; text-align: left; width: 100%; box-sizing: border-box;">
                                    <small style="display: block; margin-top: 4px; font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 12px; color: #545861;">
                                        Accepted formats: JPEG, PNG, JPG, GIF. Max size: 2MB
                                    </small>
                                </div>

                                <div class="form-actions" style="display: flex; gap: 12px; justify-content: flex-start; margin-top: 32px; padding-top: 24px; border-top: 1px solid #E3E7EB;">
                                    <button type="submit" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; background-color: #2C2E33; color: #FFFFFF; text-decoration: none; border: none; border-radius: 8px; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 15px; transition: background-color 0.2s ease; cursor: pointer; text-align: left;">
                                        <i class="fas fa-save"></i>
                                        Update Company
                                    </button>
                                    <a href="{{ route('companies.index') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; background-color: #F7F9FA; color: #192839; text-decoration: none; border: 1px solid #E3E7EB; border-radius: 8px; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 15px; transition: background-color 0.2s ease; text-align: left;">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

  <style>
    .form-control:focus {
        outline: none;
        border-color: #2C2E33;
        box-shadow: 0 0 0 3px rgba(44, 46, 51, 0.1);
    }
    .text-danger {
        color: #dc3545;
    }
  </style>

  <script>
    function previewPhoto(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('photoPreview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
  </script>
@endsection

