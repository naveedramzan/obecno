@extends('layout')
@section('content')
   
<div class="wrapper d-flex flex-column min-vh-100 bg-light company">
  <div class="body flex-grow-1 px-3">      
      <div class="container-lg">
        @include('partials.company')
      </div>
      <div class="container-lg">
        <div class="row company-detail">
        <h3>Services</h3>
        <div class="row">            
            @foreach($services as $ac)
                <div class="col-sm-6 col-lg-3 rss">
                <div class="card mb-4">
                    <div class="card-body lazy pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <a href="{{ url('/by-service-'.$ac->slug) }}" title="Browse by Service">
                        {{ $ac->title }}
                        <img src="services/{{ $ac->id }}/{{ $ac->photo }}">
                        </a>
                        <div class="clearfix"></div>
                    </div>                      
                    </div>
                </div>
                </div>
            @endforeach            
        </div>     
        </div>
      </div>
    </div>
  </div>

@endsection