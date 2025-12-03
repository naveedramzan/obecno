@extends('company-admin')
@section('content')
   
  <div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <div class="body-content">
        <div class="overview-content-wrapper">
            <div class="dashboard-section">
                <div class="dashboard-content">
                    <div class="page-header" style="margin-bottom: 32px; width: 100%; max-width: 1200px; margin-left: auto; margin-right: auto; padding: 0 16px; box-sizing: border-box;">
                        <h1 class="page-title" style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 24px; line-height: 1.5em; color: #192839; text-align: left;">
                            Profile
                        </h1>
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

                    <div class="profile-container" style="width: 100%; max-width: 1200px; margin: 0 auto; padding: 0 16px; box-sizing: border-box;">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="profile-card" style="width: 100%; background-color: #FFFFFF; border: 1px solid #E3E7EB; border-radius: 16px; padding: 32px; box-sizing: border-box;">
                                
                                @if($errors->any())
                                    <div class="alert alert-danger" style="margin-bottom: 24px; padding: 12px 16px; background-color: #F8D7DA; color: #842029; border-radius: 8px; border: 1px solid #F5C2C7;">
                                        <ul class="mb-0" style="margin: 0; padding-left: 20px;">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="profile-header" style="display: flex; align-items: center; gap: 24px; margin-bottom: 32px; padding-bottom: 24px; border-bottom: 1px solid #E3E7EB;">
                                    <div class="profile-avatar" style="position: relative; width: 120px; height: 120px; border-radius: 50%; background-color: #B6F2D5; display: flex; align-items: center; justify-content: center; overflow: hidden; flex-shrink: 0;">
                                        @if($user->photo && file_exists(public_path('users/' . $user->id . '/' . $user->photo)))
                                            <img id="photo-preview" src="/users/{{ $user->id }}/{{ $user->photo }}" alt="{{ $user->title }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                                        @else
                                            <img id="photo-preview" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='120' height='120'%3E%3Crect fill='%23B6F2D5' width='120' height='120'/%3E%3Ctext x='50%25' y='50%25' text-anchor='middle' dy='.3em' fill='%23545861' font-size='40'%3E{{ strtoupper(substr($user->title ?? 'U', 0, 1)) }}%3C/text%3E%3C/svg%3E" alt="{{ $user->title }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                                        @endif
                                        <label for="photo" style="position: absolute; bottom: 0; right: 0; background-color: #2C2E33; color: white; border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; cursor: pointer; border: 2px solid white; z-index: 10;">
                                            <i class="fas fa-camera" style="font-size: 14px;"></i>
                                        </label>
                                        <input type="file" name="photo" id="photo" accept="image/*" style="display: none;" onchange="previewPhoto(this)">
                                    </div>
                                    <div class="profile-info" style="text-align: left; flex: 1;">
                                        <h2 style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 24px; line-height: 1.5em; color: #192839; margin-bottom: 8px; text-align: left;">
                                            {{ $user->title ?? 'N/A' }}
                                        </h2>
                                        <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; line-height: 1.5em; color: #545861; margin-bottom: 4px; text-align: left;">
                                            {{ $user->email ?? 'N/A' }}
                                        </p>
                                        @if($user->username)
                                            <p style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 14px; line-height: 1.5em; color: #545861; text-align: left;">
                                                Username: {{ $user->username }}
                                            </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="profile-details">
                                    <h3 style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 18px; line-height: 1.5em; color: #192839; margin-bottom: 16px; text-align: left;">
                                        Personal Information
                                    </h3>
                                    
                                    <div class="details-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
                                        <div class="detail-row" style="display: flex; flex-direction: column; gap: 8px;">
                                            <label style="font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; line-height: 1.5em; color: #545861; text-align: left;">
                                                Full Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $user->title) }}" required style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; line-height: 1.5em; color: #192839; padding: 12px 16px; background-color: #FFFFFF; border: 1px solid #E3E7EB; border-radius: 8px; text-align: left; width: 100%; box-sizing: border-box;">
                                        </div>

                                        <div class="detail-row" style="display: flex; flex-direction: column; gap: 8px;">
                                            <label style="font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; line-height: 1.5em; color: #545861; text-align: left;">
                                                Email Address
                                            </label>
                                            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" readonly disabled style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; line-height: 1.5em; color: #545861; padding: 12px 16px; background-color: #F7F9FA; border: 1px solid #E3E7EB; border-radius: 8px; text-align: left; width: 100%; box-sizing: border-box; cursor: not-allowed;">
                                        </div>

                                        <div class="detail-row" style="display: flex; flex-direction: column; gap: 8px;">
                                            <label style="font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; line-height: 1.5em; color: #545861; text-align: left;">
                                                Username
                                            </label>
                                            <input type="text" name="username" id="username" class="form-control" value="{{ $user->username ?? '' }}" readonly disabled style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; line-height: 1.5em; color: #545861; padding: 12px 16px; background-color: #F7F9FA; border: 1px solid #E3E7EB; border-radius: 8px; text-align: left; width: 100%; box-sizing: border-box; cursor: not-allowed;">
                                        </div>

                                        <div class="detail-row" style="display: flex; flex-direction: column; gap: 8px;">
                                            <label style="font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; line-height: 1.5em; color: #545861; text-align: left;">
                                                Phone Number
                                            </label>
                                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $user->phone) }}" style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; line-height: 1.5em; color: #192839; padding: 12px 16px; background-color: #FFFFFF; border: 1px solid #E3E7EB; border-radius: 8px; text-align: left; width: 100%; box-sizing: border-box;">
                                        </div>

                                        <div class="detail-row" style="display: flex; flex-direction: column; gap: 8px;">
                                            <label style="font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; line-height: 1.5em; color: #545861; text-align: left;">
                                                Country
                                            </label>
                                            <select name="country_id" id="country_id" class="form-control" style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; line-height: 1.5em; color: #192839; padding: 12px 16px; background-color: #FFFFFF; border: 1px solid #E3E7EB; border-radius: 8px; text-align: left; width: 100%; box-sizing: border-box;">
                                                <option value="">Select Country</option>
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->id }}" {{ old('country_id', $user->country_id) == $country->id ? 'selected' : '' }}>
                                                        {{ $country->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="detail-row" style="display: flex; flex-direction: column; gap: 8px;">
                                            <label style="font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; line-height: 1.5em; color: #545861; text-align: left;">
                                                City
                                            </label>
                                            <select name="city_id" id="city_id" class="form-control" style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; line-height: 1.5em; color: #192839; padding: 12px 16px; background-color: #FFFFFF; border: 1px solid #E3E7EB; border-radius: 8px; text-align: left; width: 100%; box-sizing: border-box;">
                                                <option value="">Select City</option>
                                                @foreach($cities as $city)
                                                    <option value="{{ $city->id }}" data-country-id="{{ $city->country_id }}" {{ old('city_id', $user->city_id) == $city->id ? 'selected' : '' }}>
                                                        {{ $city->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="detail-row" style="display: flex; flex-direction: column; gap: 8px;">
                                            <label style="font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; line-height: 1.5em; color: #545861; text-align: left;">
                                                Date of Birth
                                            </label>
                                            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ old('date_of_birth', $user->date_of_birth ? $user->date_of_birth->format('Y-m-d') : '') }}" style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; line-height: 1.5em; color: #192839; padding: 12px 16px; background-color: #FFFFFF; border: 1px solid #E3E7EB; border-radius: 8px; text-align: left; width: 100%; box-sizing: border-box;">
                                        </div>

                                        <div class="detail-row" style="display: flex; flex-direction: column; gap: 8px;">
                                            <label style="font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; line-height: 1.5em; color: #545861; text-align: left;">
                                                CNIC / Unique Identifier
                                            </label>
                                            <input type="text" name="cnic" id="cnic" class="form-control" value="{{ old('cnic', $user->cnic) }}" style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 16px; line-height: 1.5em; color: #192839; padding: 12px 16px; background-color: #FFFFFF; border: 1px solid #E3E7EB; border-radius: 8px; text-align: left; width: 100%; box-sizing: border-box;">
                                        </div>
                                    </div>
                                </div>

                                <div class="profile-actions" style="margin-top: 32px; padding-top: 24px; border-top: 1px solid #E3E7EB; display: flex; gap: 12px; justify-content: flex-start;">
                                    <button type="submit" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; background-color: #2C2E33; color: #FFFFFF; text-decoration: none; border: none; border-radius: 8px; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 15px; transition: background-color 0.2s ease; cursor: pointer; text-align: left;">
                                        <i class="fas fa-save"></i>
                                        Save Changes
                                    </button>
                                    <a href="{{ route('change-password') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; background-color: #F7F9FA; color: #192839; text-decoration: none; border: 1px solid #E3E7EB; border-radius: 8px; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 15px; transition: background-color 0.2s ease; text-align: left;">
                                        <i class="fas fa-key"></i>
                                        Change Password
                                    </a>
                                    <a href="{{ route('dashboard') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; background-color: #F7F9FA; color: #192839; text-decoration: none; border: 1px solid #E3E7EB; border-radius: 8px; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 15px; transition: background-color 0.2s ease; text-align: left;">
                                        Back to Dashboard
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

  <script>
    function previewPhoto(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('photo-preview').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Filter cities based on selected country
    document.getElementById('country_id').addEventListener('change', function() {
        var selectedCountryId = this.value;
        var citySelect = document.getElementById('city_id');
        var options = citySelect.getElementsByTagName('option');
        
        // Show/hide cities based on country
        for (var i = 1; i < options.length; i++) {
            var cityCountryId = options[i].getAttribute('data-country-id');
            if (selectedCountryId === '' || cityCountryId === selectedCountryId) {
                options[i].style.display = '';
            } else {
                options[i].style.display = 'none';
            }
        }
        
        // Reset city selection if it doesn't match the selected country
        if (selectedCountryId !== '') {
            var selectedCityCountryId = citySelect.options[citySelect.selectedIndex].getAttribute('data-country-id');
            if (selectedCityCountryId !== selectedCountryId) {
                citySelect.value = '';
            }
        }
    });

    // Initialize city filter on page load
    document.addEventListener('DOMContentLoaded', function() {
        var countrySelect = document.getElementById('country_id');
        if (countrySelect.value) {
            countrySelect.dispatchEvent(new Event('change'));
        }
    });
  </script>

  <style>
    .form-control:focus {
        outline: none;
        border-color: #2C2E33;
        box-shadow: 0 0 0 3px rgba(44, 46, 51, 0.1);
    }
    .form-control[readonly] {
        background-color: #F7F9FA !important;
        cursor: not-allowed;
    }
    @media (max-width: 768px) {
        .details-grid {
            grid-template-columns: 1fr !important;
        }
    }
  </style>
@endsection
