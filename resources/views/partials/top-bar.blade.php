<div class="fluid-container">
    <header class="navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar">
        
        <a class="navbar-brand mr-0 mr-md-2" href="{{ url('/') }}" aria-label="Bootstrap" style="float:left;">
            <img src="/front/images/logo.png" width="200" style="float:left;">    
        </a>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="float:right;">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link py-0" href="{{ url('/') }}" style="line-height:40px;float:left; padding-right:30px;">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCats" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Categories
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownCats">
                        <a class="dropdown-item" href="http://{{ getDomain()}}">Main Site</a>
                        @foreach(allCategories() as $key => $value)
                            <a class="dropdown-item" href="http://{{ $key }}.{{ getDomain()}}">{{ $value }}</a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownComps" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Companies
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownComps">
                        <a class="dropdown-item" href="http://{{ getDomain()}}">Main Site</a>
                        @if(@$allCompaniesHomepage)
                            @foreach($allCompaniesHomepage as $ach)
                                <a class="dropdown-item" href="{{ url('/') }}/{{ $ach->slug }}">{{ $ach->title }}</a>
                            @endforeach
                        @endif
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link py-0" href="{{ url('/product-features') }}" style="line-height:40px;float:left; padding-right:30px;">Features</a></li>
                <li class="nav-item"><a class="nav-link py-0" href="{{ url('/about-us') }}" style="line-height:40px;float:left; padding-right:30px;">About Us</a></li>
                
                <li class="nav-item"><a class="nav-link py-0" href="{{ url('/login') }}" style="line-height:40px;float:left; padding-right:30px;">Login</a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
        
        
    </header>    
</div>
<script src="{{ url('/') }}/plugins/jQuery/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#navbarDropdown').click(function(){
            $('[aria-labelledby=navbarDropdown]').toggle();
        });
    });
</script>