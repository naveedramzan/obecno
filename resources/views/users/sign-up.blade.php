@extends('layout')
@section('content')
   
  <section>
    <!-- Swiper-->
    <div class="fluid-container" style="background:url('front/images/slider/slider-02.jpg'); background-size: cover; height:865px; width:100%;">
      <div class="">
        <div class="col-md-10 col-lg-7">
          <div class="box-animation">
            <h2>Register Yourself and Sync with Google, Microsoft, or any CRM!</h2>
                @include('partials.messages')   
                {{ Form::open(['url' => 'sign-up', 'method' => 'post']) }}
                <div class="card-group d-block d-md-flex row">
                <div class="alert alert-danger hide" id="message">Please fill empty fields!</div>
                <div class="card col-md-7 p-4 mb-0 " id="step1">
                    <h4></h4>
                    <div class="card-body">
                    <div class="input-group mb-4"><span class="input-group-text">
                        <svg class="icon">
                        <use xlink:href="/node_modules/@coreui/icons/sprites/free.svg#cil-group"></use>
                        </svg></span>
                        <input class="form-control" value="" name="company_name" type="text" placeholder="Company Name">
                    </div>
                    <div class="input-group mb-4"><span class="input-group-text">
                        <svg class="icon">
                            <use xlink:href="/node_modules/@coreui/icons/sprites/free.svg#cil-options"></use>
                        </svg></span>
                        <input class="form-control" value="" name="slug" type="text" placeholder="Enter your Permalink/Slug/Sub Link">
                    </div>
                    <div class="input-group mb-4"><span class="input-group-text">
                        <svg class="icon">
                            <use xlink:href="/node_modules/@coreui/icons/sprites/brand.svg#cib-typo3"></use>
                        </svg></span>
                        <select name="category_id" class="form-control">
                            <option value="" selected="selected">Select Category</option>
                            @foreach($allCats as $ac)
                            <option value="{{ $ac->id }}">{{ $ac->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-4"><span class="input-group-text">
                        <svg class="icon">
                            <use xlink:href="/node_modules/@coreui/icons/sprites/free.svg#cil-map"></use>
                        </svg></span>
                        <select name="country_id" class="form-control">
                            <option value="" selected="selected">Select Country</option>
                            @foreach($allCountry as $ac)
                            <option value="{{ $ac->id }}">{{ $ac->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6">
                        <button class="btn btn-primary px-4 button" type="button">Next</button>
                        </div>
                        
                    </div>
                    </div>
                </div>

                <div class="card col-md-7 p-4 mb-0  hide" id="step2">
                    <div class="card-body">
                    <div class="input-group mb-4"><span class="input-group-text">
                        <svg class="icon">
                        <use xlink:href="/node_modules/@coreui/icons/sprites/brand.svg#cib-about-me"></use>
                        </svg></span>
                        <input class="form-control" value="" name="your_name" type="text" placeholder="Your Name">
                    </div>
                    <div class="input-group mb-4"><span class="input-group-text">
                        <svg class="icon">
                            <use xlink:href="/node_modules/@coreui/icons/sprites/free.svg#cil-phone"></use>
                        </svg></span>
                        <input class="form-control" value="" name="phone" type="text" placeholder="Phone">
                    </div>
                    <div class="input-group mb-4"><span class="input-group-text">
                        <svg class="icon">
                            <use xlink:href="/node_modules/@coreui/icons/sprites/free.svg#cil-user"></use>
                        </svg></span>
                        <input class="form-control" value="" name="username" type="text" placeholder="Email Address">
                    </div>
                    <div class="input-group mb-4"><span class="input-group-text">
                        <svg class="icon">
                            <use xlink:href="/node_modules/@coreui/icons/sprites/free.svg#cil-lock-locked"></use>
                        </svg></span>
                        <input class="form-control" value="" name="password" type="password" placeholder="Password">
                    </div>
                    <div class="row">
                        <div class="col-6">
                        <button class="btn btn-primary px-4" type="submit">Sign Up</button>
                        </div>
                        <div class="col-6 text-end">
                        <a class="btn btn-link px-0 cancel" >Cancel</a>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                {{ Form::close() }}
            
          </div>
        </div>

        
      </div>
    </div>
  </section>
  <style>
    .box-animation{
        padding-top:100px !important;
    }
  </style>
<script>
    $(document).ready(function(){
        $('[type=text],select').keydown(function(){
            $('#message').addClass('hide');
        })
        $('.button').click(function(){
            var id = $(this).parent().parent().parent().parent().attr('id');
            if(id == 'step1'){
                if($('[name=company_name]').val() == ''){
                    $('[name=company_name]').css('border', '1px solid red');
                    $('#message').removeClass('hide');
                }else if($('[name=slug]').val() == ''){
                    $('[name=slug]').css('border', '1px solid red');
                    $('#message').removeClass('hide');
                }else if($('[name=category_id]').val() == ''){
                    $('[name=category_id]').css('border', '1px solid red');
                    $('#message').removeClass('hide');
                }else if($('[name=country_id]').val() == ''){
                    $('[name=country_id]').css('border', '1px solid red');
                    $('#message').removeClass('hide');
                }else{
                    $('#message').addClass('hide');
                    $('#step1').addClass('hide');
                    $('#step2').removeClass('hide');
                }                
            }
        });
        $('.cancel').click(function(){
            $('#step2').addClass('hide');
            $('#step1').removeClass('hide');
        })
    });
</script>
@endsection