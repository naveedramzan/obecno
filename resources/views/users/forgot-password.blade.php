@extends('layout')
@section('content')
   

    <div class="master-page">
        <div class="body">
            <div class="wrapper">
                <div class="login-section" >
                    
                    <div class="login-container">
                        <div class="login-box">
                            <!-- Logo -->
                            <div class="logo-container">
                                <img src="/front/images/logo.png" alt="Obecno Logo" class="logo">
                            </div>
                            
                            <!-- Forgot Password form -->
                            <div class="form-section">
                                <h2 class="login-title">Forgot Password</h2>
                                <p style="text-align: center; color: #666; margin-bottom: 20px;">Enter your email address to reset your password</p>
                                {{ Form::open(['url' => 'forgot-password', 'method' => 'post', 'class' => 'forgot-password-form']) }}
                                <div class="form-container">
                                    <div class="text-field">
                                        <div class="label">
                                            <span class="field-label">Email Address</span>
                                        </div>
                                        <div class="field" id="input-field">
                                            <input type="email" name="email" class="input-text" id="email-input" required="required" placeholder="Enter your email address">
                                            <i class="fas fa-envelope field-icon"></i>
                                        </div>
                                    </div>
                                    <div class="field-message" id="email-field-message"></div>
                                    
                                    <button class="continue-button" id="submit-btn">
                                        <span class="button-text">Reset Password</span>
                                    </button>
                                    <center class="back-to-login-link">
                                        <a href="{{ url('/login') }}">Back to Login</a>
                                    </center>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                        
                        <!-- Sign up section -->
                        <div class="signup-section">
                            <span class="signup-text">Don't have an account ?</span>
                            <button class="get-started-button" onclick="window.location='{{ url('/sign-up') }}'">
                                <span class="button-text">Get Started</span>
                            </button>
                        </div>

                        <a href="/" class="back">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/front/js/jquery371.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            // Email validation on blur and keyup
            $('#email-input').on('blur keyup', function() {
                let email = $(this).val().trim();
                let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (email === '') {
                    $('#email-field-message').html('⚠️ Email field is empty').show();
                } 
                else if (!emailRegex.test(email)) {
                    $('#email-field-message').html('❌ Please enter a valid email address').show();
                } 
                else {
                    $('#email-field-message').html('✅ Email address looks good').show();
                }
            });

            // Submit button click handler
            $('#submit-btn').on('click', function(e){
                e.preventDefault();
                let email = $('#email-input').val().trim();
                let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (email === '') {
                    $('#email-field-message').html('❌ Email address is required').show();
                    return;
                }

                if (!emailRegex.test(email)) {
                    $('#email-field-message').html('❌ Please enter a valid email address').show();
                    return;
                }

                // All validations passed - submit the form
                $('.forgot-password-form').submit();
            });

        });
    </script>
    <style>
      .header{
        display:none;
      }
    </style>
@endsection