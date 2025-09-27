@extends('layout')
@section('content')

@if($companyDetail != null && $slug != null)
<section>
  <div class=" fluid-container" style="background:url('front/images/banners/{{ @$categoryDetail->slug }}.jpg'); background-size: cover; height:865px; width:100%;">
   <div class="wrapper d-flex flex-column min-vh-100 ">
    <div class="body flex-grow-1 px-3">      
        <div class="container">
          @include('partials.company')
        </div>           
      </div>
    </div>
  </div>
  </section> 
@elseif($categoryDetail)
<section>
  <div class=" fluid-container" style="background:url('front/images/banners/{{ @$categoryDetail->slug }}.jpg'); background-size: cover; height:865px; width:100%;">
   <div class="wrapper d-flex flex-column min-vh-100 ">
    <div class="body flex-grow-1 px-3">      
        <div class="container">
          @include('partials.category')
        </div>           
      </div>
    </div>
  </div>
  </section>     
@endif 

  <section>
    <!-- Swiper-->
    <div class="fluid-container" style="background:url('front/images/slider/slider-01.jpg'); background-size: cover; height:865px; width:100%;">
      <div class="">
        <div class="col-md-10 col-lg-7">
          <div class="box-animation">
            <h2>Simplify Your Scheduling with ScheduleSync Today!</h2>
            <ul>
              <li>Easy Setup: Get started in minutes with our intuitive platform.</li>
              <li>Scalable Solutions: Whether you're a solo professional or managing multiple teams, we've got you covered.</li>
              <li>Global Compliance: Stay compliant with local regulations like HIPAA and GDPR, no matter where you operate.</li>
            </ul>
            <a class="btn btn-success" href="{{ url('/sign-up') }}">Sign up to explore more</a>
          </div>
        </div>
      </div>
    
  </section>
  @if($companyDetail == null && $slug == null)
  <br>
  <section>
    <div class="fluid-container" style="background:url('front/images/slider/slider-10.jpg'); background-size: cover; height:865px; width:100%;">
      <div class="">
        <div class="col-sm-3 col-lg-12">
          <div class="box-animation companies">
            
              @if(@$allCompaniesHomepage != null)
              <h2>Our Key Partners</h2>
              @foreach($allCompaniesHomepage as $ach)
                <div class="col-sm-3 company">
                  <a href="{{ url('/') }}/{{ $ach->slug }}">
                    <h5>{{ $ach->title }}</h5>
                    <img src="/companies/{{ $ach->id }}/{{ $ach->photo }}" width="100%">
                  </a>
                </div>
              @endforeach
              <div style="clear:both;"></div>
              <a class="btn btn-success view-more" href="{{ url('/partners') }}">View All</a>
              @endif
          </div>
        </div>
      </div>
  </section>
  @endif
@endsection