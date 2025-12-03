@extends('layout')
@section('content')
   
  <div class="signup-page">
        <div class="body">
            <div class="wrapper">
                <div class="signup-section">
                    <div class="signup-container">
                    {{ Form::open(['url' => 'sign-up', 'method' => 'post', 'class' => 'signup-form-container']) }}
                        <div class="signup-form">
                            <div class="form-content">
                                <!-- Logo -->
                                <div class="logo-container">
                                    <img src="/front/images/logo.png" alt="Obecno Logo" class="logo">
                                </div>
                                
                                <!-- Header section -->
                                <div class="header-section">
                                    <h2 class="signup-title">Get Started with <span class="primary-o">o</span>becno</h2>
                                    <p class="signup-description">Set up the Company's information.</p>
                                </div>
                                
                            <!-- Email Field -->
                            <div class="text-field" id="company-title">
                                <div class="label">
                                    <span class="field-label">Company Title</span>
                                    <span class="required-asterisk">*</span>
                                </div>
                                <div class="field" id="email-field">
                                    <i class="fas fa-building field-icon"></i>
                                    <input type="text" class="input-text" id="company-name" name="company_name" placeholder="Enter your Company Name">
                                </div>
                            </div>
                            
                            <div class="text-field" id="head-office">
                                <div class="label">
                                    <span class="field-label">Head Office</span>
                                    <span class="required-asterisk">*</span>
                                </div>
                                <div class="field" id="location-field">
                                    <i class="fas fa-map"></i>
                                    <input type="text" class="input-text" id="company-address" name="company_address" placeholder="Enter address">
                                    
                                </div>
                                <div class="field" id="location-field">
                                    <i class="fas fa-map"></i>
                                    <select name="city_id" id="city_id">
                                        <option value="" selected="selected">Select Location</option>
                                        @php $cities = getResultOnQuery("select c.id, concat(c.title,', ', ct.title) as title from cities c join countries ct on ct.id = c.country_id"); @endphp
                                        @foreach($cities as $c)
                                            <option value="{{ $c->id }}">{{ $c->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                               
                            
                            <div class="text-field hide" id="admin-details">
                                <div class="field" >
                                    <i class="fas fa-map"></i>
                                    <input type="text" class="input-text" name="your_name" id="full-name" placeholder="Enter Your Name">
                                </div>

                                <div class="field">
                                    <i class="fas fa-map"></i>
                                    <select name="userrole_id" id="userrole_id">
                                        <option value="" selected="selected">Select Your Role</option>
                                        @php $cities = getResultOnQuery("select * from userroles where company_id is null and is_show = '1'"); @endphp
                                        @foreach($cities as $c)
                                            <option value="{{ $c->id }}">{{ $c->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="label" style="margin-top:20px;">
                                    <span class="field-label">Contact Details</span>
                                    <span class="required-asterisk">*</span>
                                </div>
                                
                                <div class="field" >
                                    <i class="fas fa-map"></i>
                                    <input type="email" class="input-text" id="email-address" name="email" placeholder="Enter Email Address">
                                    
                                </div>
                                <div class="field" >
                                    <i class="fas fa-map"></i>
                                    <input type="text" class="input-text" id="telephone" name="phone" placeholder="Enter Telephone">
                                </div>
                            </div>

                            <div class="field-message" id="email-field-message" ></div>

                            <div class="button-group">
                                <button class="continue-button" id="continue-button" >
                                    <span class="button-text">Next</span>
                                </button>
                            </div>

                            <!-- Need Help Section -->
                            <div class="help-section">
                                <span class="help-text">Need help?</span>
                                <a href="#" class="contact-support-link">Contact Support</a>
                            </div>
                        </div>
                    {{ Form::close() }}        
                            
                        <a style="margin-top:50px;" href="/" class="back">Back</a>
                    </div>
                    
                        <!-- Promotion Graphics -->
                    <div class="promotion-graphics">
                        <div class="promotion-content">
                            <h2 class="promotion-title"> {{ allSettings()['siteSlogan'] }}</h2>
                            <p class="promotion-description">Track attendance across all locations or remote teams in one clear, organized view.</p>
                            <div class="phone-mockup">
                                <img src="assets/phone-image-updated-56586a.png" alt="Obecno App Preview" class="phone-image">
                            </div>
                            <p class="app-availability">Apps Available on Apple & Android Devices</p>
                        </div>
                    </div>

                        
                </div>
            </div>
        </div>
    </div>
    <script src="/front/js/jquery371.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $('#continue-button').on('click', function(e) {
                e.preventDefault(); // prevent form submission

				let isAdminStepVisible = !$('#admin-details').hasClass('hide');
				let error = '';

				if (!isAdminStepVisible) {
					// Step 1: Company validation
					let name = $('#company-name').val().trim();
					let address = $('#company-address').val().trim();
					let city = $('#city_id').val();

					// Validate company name
					if (name === '') {
						error = 'Company name is required.';
					}
					else if (name.length < 3) {
						error = 'Company name must be at least 3 characters long.';
					}
					// Validate company address
					else if (address === '') {
						error = 'Company address is required.';
					}
					else if (address.length < 10) {
						error = 'Company address must be at least 10 characters long.';
					}
					else if (address.indexOf(',') === -1) {
						error = 'Company address must include at least one comma.';
					}
					// Validate city dropdown
					else if (city === '' || city === null || city === '0') {
						error = 'Please select a city.';
					}

					if (error !== '') {
						$('#email-field-message').text('❌ ' + error).show();
						$('#company-title, #head-office').removeClass('hide');
						$('#admin-details').addClass('hide');
					} else {
						$('#email-field-message').hide();
						$('#company-title, #head-office').addClass('hide');
						$('#admin-details').removeClass('hide');
					}
				} else {
					// Step 2: Admin/user validation
					let fullName = $('#full-name').val().trim();
					let role = $('#userrole_id').val();
					let email = $('#email-address').val().trim();
					let phone = $('#telephone').val().trim();

					let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
					let digitCount = (phone.match(/\d/g) || []).length;

					if (fullName === '') {
						error = 'Full name is required.';
					}
					else if (fullName.length < 3) {
						error = 'Full name must be at least 3 characters long.';
					}
					else if (role === '' || role === null || role === '0') {
						error = 'Please select your role.';
					}
					else if (email === '') {
						error = 'Email is required.';
					}
					else if (!emailRegex.test(email)) {
						error = 'Please enter a valid email address.';
					}
					else if (phone === '') {
						error = 'Phone number is required.';
					}
					else if (digitCount < 10) {
						error = 'Phone number must have at least 10 digits.';
					}

					if (error !== '') {
						$('#email-field-message').text('❌ ' + error).show();
						$('#admin-details').removeClass('hide');
					} else {
						$('#email-field-message').hide();
						// All validations passed - submit the form
						$('form').submit();
					}
				}
            });
        });
    </script>
    <style>
      .header{
        display:none;
      }
      .signup-form-container{
        width:50% !important
      }
    </style>
@endsection