@extends('company-admin')
@section('content')
   
   <div class="wrapper d-flex flex-column min-vh-100 bg-light">
      
      @include('partials.nav')
      
      <div class="container-lg">
        <div class="car"></div>
        <div class="card mb-4">
          <div class="card-header"><strong>{{ ucwords($table) }}</strong><span class="small ms-1">Change Password</span></div>
          <div class="card-body">
          @include('partials.messages')   
            <div class="example">
              <div class="tab-content rounded-bottom">
                <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-387">
                {{ Form::open(['url' => 'change-password', 'method' => 'post']) }}
                  <table class="table">
                    <tbody>
                      <tr>
                        <td><label>Current Password: </label></td>
                        <td><input type="password" required="required" name="current_password" class="form-control"></td>
                      </tr>
                      <tr>
                        <td><label>New Password: </label></td>
                        <td><input type="password" required="required" name="new_password" class="form-control"></td>
                      </tr>
                      <tr>
                        <td><label>Confirm New Password: </label></td>
                        <td><input type="password" required="required" name="confirm_new_password" class="form-control"></td>
                      </tr>
                      <tr>
                          <td align="right"><a href="{{ url('/dashboard') }}" class="btn btn-link px-0" type="button">Back</a></td>
                          <td><button class="btn btn-primary px-4" type="submit">Submit</button></td>
                      </tr>
                    </tbody>
                  </table>
                {{ Form::close() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection