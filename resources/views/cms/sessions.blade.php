@extends('layout')
@section('content')
   
<div class="wrapper d-flex flex-column min-vh-100 bg-light company">
  <div class="body flex-grow-1 px-3">      
      <div class="container-lg">
        @include('partials.company')
      </div>
      <div class="container-lg">
        <div class="row company-detail" style="height:100%;">
        <h3>Sessions for {{ $serviceDetails->title }}</h3>
        <div class="row"> 
          @php 
            if(count($sessions) == '1'){
              $classValue = '12';
            }else if(count($sessions) == '2'){
              $classValue = '6';
            }else if(count($sessions) > 3){
              $classValue = '3';
            }
          @endphp
          @foreach($sessions as $ac)
                <div class="col-sm-{{ $classValue}} col-sm-3 rss">
                <div class="card mb-4">
                    <div class="card-body lazy pb-0 d-flex justify-content-between align-items-start">
                      <div class="col-sm-12">
                          <p>{{ $ac->title }}</p>
                          <p>{{ dateConverter($ac->session_date) }} ({{ dateConverter($ac->start_time, 'H:i') }} to {{ dateConverter($ac->end_time, 'H:i') }})</p>

                          @php 
                            $slots = getResultOnQuery("select * from slots where session_id =".$ac->id);
                          @endphp 
                          <div class="slots">
                            @foreach($slots as $s)
                              @php 
                              $isBooked = getResultOnQuery("select * from appointments where slot_id = ".$s->id);
                              $bookingClass = 'available';                              
                              if($isBooked != null){
                                $bookingClass = 'booked';                                
                              }
                              @endphp
                              <div class="slot {{ $bookingClass }}" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <p>{{ $s->start_time }} to {{ $s->end_time }}</p>
                              </div>
                            @endforeach
                          </div>
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
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Book Appointment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="col-sm-3 col-lg-5" style="float:left;">
            <h4>Log-In Here</h4>
            <table class="table">
              <tr>
                <td>Email: </td>
                <td><input type="text" name="email" class="form-control" required="required" placeholder="Please enter your name!"></td>
              </tr>
              <tr>
                <td>Password: </td>
                <td><input type="password" name="password" class="form-control" required="required" placeholder="Please enter Password!"></td>
              </tr>
              <tr>
                <td colspan="2">
                  <button type="button" class="btn btn-primary" id="savecustomer">Log Me In</button>
                </td>
              </tr>
            </table>
          </div>
          <div class="col-sm-3 col-lg-6" style="float:right;">
            <h4>Sign-Up Here</h4>
            <table class="table">
              <tr>
                <td>Your Name: </td>
                <td><input type="text" name="customer_name" class="form-control" required="required" placeholder="Please enter customer name!"></td>
              </tr>
              <tr>
                <td>Your Email: </td>
                <td><input type="text" name="customer_email" class="form-control" required="required" placeholder="Please enter customer email!"></td>
              </tr>
              <tr>
                <td>Your Phone: </td>
                <td><input type="text" name="customer_phone" required="required" class="form-control" placeholder="Please enter customer phone!"></td>
              </tr>
              <tr>
                <td colspan="2">
                  <button type="button" class="btn btn-success" id="savecustomer">Register</button>
                </td>
              </tr>
            </table>
          </div>
          <div style="clear: both;"></div>
          
          <div class="alert alert-danger hide" id="customer-data-message">Please fill all fields!</div>
        </div>
        
      </div>
    </div>
  </div>
<script src="/plugins/jQuery/jquery.min.js"></script>
<script>
  $(document).ready(function(){  
    
    $('.slot.available').click(function(){
      $('#exampleModal').modal('show');
    });

    $('.btn-close, .txt-close').click(function(){
      $('#exampleModal').modal('hide');
    });
  });
</script>
@endsection