<div class="row category-detail">
    <h1>{{ @$categoryDetail->title }}</h1>
    <h3>Overview</h3>
    <p>{{ @$categoryDetail->description }}</p>

    <h3>Listed Companies</h3>
    
    @foreach($allCompanies as $ac)
        <h5 class="brand col-sm-3">
            <a href="{{ url('/'.@$ac->slug) }}">
                <img src="/companies/{{ @$ac->id }}/{{ @$ac->photo }}" width="100">
                <br>
                {{ @$ac->title }}
            </a>
        </h5>
    @endforeach
</div>
