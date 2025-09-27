@extends('admin')
@section('content')
   
   <div class="wrapper d-flex flex-column min-vh-100 bg-light">
      
      @include('partials.nav')
      
      <div class="fluid-container" style="margin:0px 5px;">
        <div class="car"></div>
        <div class="card mb-4">
          <div class="card-header">
            <strong>{{ ucwords($table) }}</strong><span class="small ms-1">List View</span>
            @if($table == 'attendance')
            <a style="float:right;" title="Import" href="{{ url('import-attendance') }}"><img src="admin/assets/excel.png" width="16" style="margin-left:10px;"></a>
            
            @endif
            <a style="float:right;" title="Create Record" href="{{ url('admin-add-'.$table)}}{{ $id != null && $table != 'sprints' ? '/'.$id : ''}}"><img src="/admin/assets/add.png"></a>
            <div class="clearfix"></div>
          </div>
          @include('partials.messages')   
          <div class="card-body">
            <div class="example">
              <div class="tab-content rounded-bottom">
                <div class="tab-pane p-3 active preview" role="tabpanel" id="filters">
                  <h5>Filter Records</h5>
                {{ Form::open(['url' => 'admin-list-'.$table, 'method' => 'get']) }}
                  <div class="input-group mb-3">
                    <span>
                      <input class="form-control" name="textsearch" type="text" placeholder="Search Here">
                    </span>
                    <span>
                      <input class="form-control" type="submit" value="Go">
                    </span>
                  </div>
                {{ Form::close() }}
                <a href="{{ url('/admin-list-'.$table) }}">View All</a>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="example">
              <div class="tab-content rounded-bottom">
                <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-387">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        @foreach($fieldsList as $fl)
                          <th scope="col">{{ ucwords(str_replace('_id', '', str_replace('_', ' ', $fl))) }}</th>
                        @endforeach
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    @php 
                      $x = 1;
                      $depts = [];
                      $skills = [];
                      $status = ['active' => 0,
                                 'inactive' => 0,
                                ];                    
                    @endphp
                    
                    @foreach($listData as $ld)                      
                    
                      <tr>
                        <td scope="row">{{ $x }}</td>
                        
                        @foreach($fieldsList as $fl)
                        
                          @if(strpos($fl, '_id') > -1)
                            <td scope="col">
                              @php 
                                  $fieldNameSingluar = str_replace('_id', '', $fl);
                                  if($fieldNameSingluar == 'approved_user' || $fieldNameSingluar == 'referral_user'){
                                    $fieldNameSingluar = 'user';
                                  }
                                  $fieldName = getPlural($fieldNameSingluar);
                                  if($fieldName == 'subscriptions'){
                                    $recordTmp = getRecordOnId($fieldName,  $ld->$fl);
                                    echo dateConverter($recordTmp->start_date).' to '.dateConverter($recordTmp->end_date);
                                  }else{
                                    echo @getRecordOnId($fieldName,  $ld->$fl)->title;                                      
                                  }
                                  
                                @endphp
                            </td>
                          @elseif($fl == 'actual_hours' 
                               || $fl == 'expected_hours')
                            <td>{{ number_format($ld->$fl, 2) }}</td>
                          @elseif($fl == 'slot_duration')
                            <td>{{ $ld->$fl }} min</td>
                          @elseif($fl == 'credits')
                            <td>CP {{ number_format($ld->credits,2) }}</td>
                          @elseif(strpos($fl, 'date') > -1)
                            <td>{{ date('d-M-Y', strtotime($ld->$fl)) }}</td>
                          @elseif(strpos($fl, 'photo') > -1)
                            <td><img src="{{ $table.'/'.$ld->id.'/'.$ld->$fl }}" width="80" style="border:1px solid #ccc; border-radius:5px;"></td>
                          @elseif($fl == 'feedback')
                            <td>
                              @if($ld->overall_percentage == null)
                                Not Yet
                              @else
                                Done
                              @endif
                            </td>
                          @else 
                          <td scope="col">
                            {{ @$ld->$fl }} 
                            @if($fl == 'price') 
                                CP
                            @endif
                          </td>
                          @endif
                          
                        @endforeach
                        <td scope="col" class="action">
                          <a href="{{ url('admin-edit-'.$table.'/'.$ld->id) }}"><img src="/admin/assets/edit.png"></a>
                           | 
                           <a onclick="return confirm('Are you sure to delete this record?')" href="{{ url('admin-delete-'.$table.'/'.$ld->id) }}"><img src="/admin/assets/delete.png"></a>
                          @if($table == 'rssfeeds')
                            <a href="{{ url('admin-crone-'.$ld->id) }}">
                              <img src="/admin/assets/refresh.png" width="30">
                            </a>
                          @endif
                          @if($table == 'sessions')
                            | 
                            <a href="{{ url('admin-list-slots/'.$ld->id) }}">
                             <img src="/admin/assets/time-slot.svg" width="20">
                            </a>
                          @endif
                          @if($table == 'companies')
                            | 
                            <a href="{{ url('admin-list-locations/'.$ld->id) }}">
                             <img src="/admin/assets/building.png" width="20">
                            </a>
                          @endif
                        </td>
                      </tr>
                      <?php $x++ ?>
                      @endforeach
                     
                    </tbody>
                  </table>

                  <div class="d-flex justify-content-center">
                      {!! $listData->links('pagination::bootstrap-4') !!}
                  </div>
                  @if(count($depts) > 0)
                  <div class="bottom-stats col-sm-4 card mb-4" style="float:left;">
                    <table class="table" >
                      <tr>
                        <td>Department</td><td align="center">Total</td>
                      </tr>
                      @foreach($depts as $key => $val)
                        <tr>
                          <td>{{ $key }}</td>
                          <td align="center">{{ $val }}</td>
                        </tr>
                      @endforeach
                    </table>
                  </div>
                  @endif
                  @if(count($skills) > 0)
                  <div class="bottom-stats col-sm-4 card mb-4" style="float:left;">
                    <table class="table" >
                      <tr>
                        <td>Skills</td><td align="center">Total</td>
                      </tr>
                      @foreach($skills as $key => $val)
                        <tr>
                          <td>{{ $key }}</td>
                          <td align="center">{{ $val }}</td>
                        </tr>
                      @endforeach
                    </table>
                  </div>
                  @endif
                  
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

   
@endsection