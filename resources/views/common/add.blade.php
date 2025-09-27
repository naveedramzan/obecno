@extends('admin')
@section('content')
   
   <div class="wrapper d-flex flex-column min-vh-100 bg-light">
      
      @include('partials.nav')
      
      <div class="container-lg">
        <div class="car"></div>
        <div class="card mb-4">
          <div class="card-header"><strong>{{ ucwords($table) }}</strong><span class="small ms-1">Add Record</span></div>
          <div class="card-body">
            <div class="example">
              <div class="tab-content rounded-bottom">
                <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-387">
                {{ Form::open(['url' => 'admin-add-'.$table, 'method' => 'post', 'files'=>'true']) }}
                  <table class="table">
                    <tbody>
                        @foreach($schema as $s)
                          
                          @php 
                            if($table == 'sprints'){
                              $notShow[] = 'calculated_credits';
                              $notShow[] = 'category_wise_points_json';
                              $notShow[] = 'overall_percentage';
                              $notShow[] = 'feedback_comments';
                            }
                          @endphp
                            @if(!in_array($s->Field, $notShow))
                            <tr>
                                <td>{{ ucwords(str_replace('_id', '', str_replace('_', ' ', $s->Field))) }}</td>
                                <td>
                                  @php 
                                    if($s->Type == 'date'){
                                      $fieldType = 'date';
                                    }else if($s->Type == 'time'){
                                      $fieldType = 'time';
                                    }else if($s->Type == 'text'){
                                      $fieldType = 'textarea';
                                    }else{
                                      $fieldType = 'text';
                                    }
                                  @endphp
                                  @if(strpos($s->Field, '_id') > -1)
                                    @php 
                                      $fieldNameSingluar = str_replace('_id', '', $s->Field);
                                      if($fieldNameSingluar == 'approved_user' || $fieldNameSingluar == 'referral_user'){
                                        $fieldNameSingluar = 'user';
                                      }
                                      $fieldName = getPlural($fieldNameSingluar);
                                      
                                      echo getCombo($fieldName, '', $s->Field);                                      
                                    @endphp
                                  @elseif(strpos($s->Field, 'photo') > -1)
                                     {{ Form::file($s->Field); }}
                                  @else
                                    @if($fieldType == 'textarea')
                                      <textarea class="form-control" name="{{ $s->Field }}" @if($s->Null == 'NO') required="required" @endif  placeholder="Enter {{ ucwords(str_replace('_id', '', $s->Field)) }}"></textarea>
                                    @else
                                      <input class="form-control" name="{{ $s->Field }}" @if($s->Null == 'NO') required="required" @endif type="{{ $fieldType }}" placeholder="Enter {{ ucwords(str_replace('_id', '', $s->Field)) }}">
                                    @endif
                                  @endif
                                </td>
                            </tr>
                            @endif
                        @endforeach
                        @if($table == 'sessions')
                        <tr>
                          <td colspan="2">
                            <img id="add-more" style="cursor:pointer; float:right;" src="/admin/assets/add.png">
                            <br>
                            <table width="100%" id="assets">
                              <tr class="first"><td>Attach Assets: </td><td>{{ getCombo('assets', '','asset_id[]') }}</td></tr>
                            </table>
                          </td>
                        </tr>
                        @endif 
                        <tr>
                            <td align="right"><a href="{{ url('/admin-list-'.$table) }}" class="btn btn-link px-0" type="button">Back</a></td>
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
<script src="/plugins/jQuery/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    $('#add-more').on('click', function(){
      var tr = '<tr>' + $('.first').html() + '</tr>';
      $('#assets').closest('table').append(tr);
    });
  });
</script>
@endsection