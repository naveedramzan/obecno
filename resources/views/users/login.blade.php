@extends('layout')
@section('content')
   

   <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            @include('partials.messages')   
            {{ Form::open(['url' => 'login', 'method' => 'post']) }}
            <div class="card-group d-block d-md-flex row">
              
              <div class="card col-md-7 p-4 mb-0">
                <div class="card-body">
                  <h3>Login</h3>
                  <p class="text-medium-emphasis">Sign In to your account</p>
                  <div class="input-group mb-3"><span class="input-group-text">
                      <svg class="icon">
                        <use xlink:href="/node_modules/@coreui/icons/sprites/free.svg#cil-user"></use>
                      </svg></span>
                    <input class="form-control" value="naveed.ramzan@gmail.com" name="username" type="text" placeholder="Username">
                  </div>
                  <div class="input-group mb-4"><span class="input-group-text">
                      <svg class="icon">
                        <use xlink:href="/node_modules/@coreui/icons/sprites/free.svg#cil-lock-locked"></use>
                      </svg></span>
                    <input class="form-control" value="admin" name="password" type="password" placeholder="Password">
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <button class="btn btn-primary px-4" type="submit">Login</button>
                    </div>
                    <div class="col-6 text-end">
                      <a class="btn btn-link px-0" href="{{ url('forgot-password') }}" >Forgot password?</a>
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

   
@endsection