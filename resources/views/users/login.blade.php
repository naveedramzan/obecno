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
                            
                            <!-- Login form -->
                            <div class="form-section">
                                <h2 class="login-title">Sign in to your account</h2>
                                {{ Form::open(['url' => 'login', 'method' => 'post', 'class' => 'login-form-container']) }}
                                <div class="form-container">
                                    <div class="text-field">
                                        <div class="label">
                                            <span class="field-label">Email / Phone / ID</span>
                                        </div>
                                        <div class="field" id="input-field">
                                            <input type="text" name="username" class="input-text" id="email-input" required="required" placeholder="Enter your email, phone, or ID">
                                            <i class="fas fa-circle-check success-icon" style="display: none;"></i>
                                        </div>
                                        
                                    </div>
                                    <div class="field-message hide" id="email-field-message" ></div>
                                    <div class="text-field hide" id="password">
                                        <div class="label">
                                            <span class="field-label">Password</span>
                                        </div>
                                        <div class="field" id="input-field">
                                            <input type="password" name="password" class="input-text" id="password-input" required="required" placeholder="Enter your Password">
                                            <i class="fas fa-circle-check success-icon" style="display: none;"></i>
                                        </div>
                                    </div>
                                    <div class="field-message" id="field-message" style="display: none;"></div>
                                    
                                    <button class="continue-button" id="continue">
                                        <span class="button-text">Continue</span>
                                    </button>
                                    <center class="forgot-password-link">
                                        <a href="{{ url('/forgot-password') }}">Forgot Password</a>
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
            $('#email-input').on('blur keyup', function() {
                let email = $(this).val().trim();

                if (email === '') {
                    $('#email-field-message').html('❌ Email/Phone/Id field is empty');
                    $('#password').addClass('hide');
                } 
                else if (email.length < 5) {
                    $('#email-field-message').html('⚠️ Email/Phone/Id must be at least 5 characters long');
                    $('#password').addClass('hide');
                } 
                else {
                    $('#email-field-message').html('✅ Email/Phone/Id looks good');
                    $('#password').removeClass('hide');
                }
                $('#email-field-message').removeClass('hide')
            });

            $('#continue').on('click', function(e){
                e.preventDefault();
                let username = $('#email-input').val().trim();
                let password = $('#password-input').val();
                let error = '';

                if (username === '' || username.length < 5) {
                    error = 'Please enter a valid Email/Phone/ID (min 5 chars).';
                    $('#email-field-message').html('❌ ' + error).removeClass('hide');
                    $('#password').addClass('hide');
                    return;
                }

                if (password === '') {
                    $('#field-message').text('❌ Password is required.').show();
                    return;
                }

                // All good, submit the form
                $('.login-form-container').submit();
            });

        });
    </script>
    <style>
      .header{
        display:none;
      }
    </style>
@endsection