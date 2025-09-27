<div class="row company-detail">
    <h1>
        {{ $companyDetail->title }}
        <img src="/companies/{{ $companyDetail->id }}/{{ $companyDetail->photo }}" class="company-logo">
    </h1>
    <h3>Overview</h3>
    <p>{{ $companyDetail->description }}</p>
    
    <p><b>Expertise: </b>{{ $companyDetail->expertise }}</p>
    <p class="col-sm-3 col-lg-6"><b>Team Size: </b>{{ $companyDetail->team_size }}</p>
    <p class="col-sm-3 col-lg-6"><b>Category: </b>{{ @$categoryDetail->title }}</p>
    <p class="col-sm-3 col-lg-6"><b>Locations: </b>{{ ($countriesList)?implode(', ', $countriesList):'' }}</p>
    <p class="col-sm-3 col-lg-6"><b>URL: </b><a target="_blank" href="{{ $companyDetail->website }}">{{ $companyDetail->website }}</a></p>

    <h3>Services</h3>
    <div class="row">            
        @foreach($services as $ac)
            @php 
                $catDetail = getRecordOnId('categories', $ac->category_id);
            @endphp
        <div class="col-sm-6 col-lg-3 rss">
            <div class="card mb-4">
                <div class="card-body lazy pb-0 d-flex justify-content-between align-items-start">
                  <div class="service">
                    <a href="http://{{ $catDetail->slug}}.{{ getDomain() }}/{{ $slug }}{{ '/by-service-'.$ac->slug }}" title="Browse by Service">
                    {{ $ac->title }}
                    <img src="/services/{{ $ac->id }}/{{ $ac->photo }}">
                    </a>
                    <div class="clearfix"></div>
                  </div>                      
                </div>
            </div>
        </div>
        @endforeach           
    </div>     
</div>
