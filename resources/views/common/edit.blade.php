@extends('admin')
@section('content')
   
   <div class="wrapper d-flex flex-column min-vh-100 bg-light">
      
      @include('partials.nav')
      
      <div class="container-lg">
        <div class="car"></div>
        <div class="card mb-4">
          <div class="card-header"><strong>{{ ucwords($table) }}</strong><span class="small ms-1">Edit Record</span> # {{ $id }}</div>
          @include('partials.messages')   
          <div class="card-body">
            <div class="example">
              <div class="tab-content rounded-bottom">
                <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-387">
                {{ Form::open(['url' => 'admin-edit-'.$table.'/'.$id, 'method' => 'post', 'files'=>'true']) }}
                  <table class="table">
                    <tbody>
                        @foreach($schema as $s)
                          @php 
                              if($table == 'sprints'){
                                $notShow[] = 'pointsetting_id';
                                $notShow[] = 'actual_points';
                                $notShow[] = 'calculated_points';
                                $notShow[] = 'percentage';
                                $notShow[] = 'feedback_comments';
                              }
                            @endphp
                            @if(!in_array($s->Field, $notShow))
                            <tr>
                                <td>{{ ucwords(str_replace('_', ' ', $s->Field)) }}</td>
                                <td>
                                  @php 
                                    if($s->Type == 'date'){
                                      $fieldType = 'date';
                                    }else if($s->Type == 'text'){
                                      $fieldType = 'textarea';
                                    }else{
                                      $fieldType = 'text';
                                    }
                                  @endphp
                                  @if(strpos($s->Field, '_id') > -1)
                                    @php 
                                      $fieldNameSingluar = str_replace('_id', '', $s->Field);
                                      $fieldName = getPlural($fieldNameSingluar);
                                      echo getCombo($fieldName, $record->{$s->Field}, $s->Field) 
                                    @endphp
                                  @elseif(strpos($s->Field, 'photo') > -1)
                                    {{ Form::file($s->Field); }}
                                    @if($table.'/'.$record->id.'/'.$record->{$s->Field})
                                    <img src="{{ '/'.$table.'/'.$record->id.'/'.$record->{$s->Field} }}" width="100" style="background:#fff; border:1px solid #ccc; border-radius:4px;">
                                    @endif
                                  @else
                                    @if($fieldType == 'textarea')
                                      <textarea class="form-control" name="{{ $s->Field }}" @if($s->Null == 'NO') required="required" @endif  placeholder="Enter {{ ucwords(str_replace('_id', '', $s->Field)) }}">{{ $record->{$s->Field} }}</textarea>
                                    @else
                                      <input class="form-control" value="{{ $record->{$s->Field} }}" name="{{ $s->Field }}" @if($s->Null == 'NO') required="required" @endif type="{{ $fieldType }}" placeholder="Enter {{ ($s->Field == 'credits')?'Min and Max Price':ucwords(str_replace('_id', '', $s->Field)); }}">
                                    @endif
                                  @endif
                                </td>
                            </tr>
                            @endif
                        @endforeach
                        <tr>
                            <td align="right"><a href="{{ url('/admin-list-'.$table) }}" class="btn btn-link px-0" type="button">Back</a></td>
                            <td><button class="btn btn-primary px-4" type="submit">Update</button></td>
                            
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