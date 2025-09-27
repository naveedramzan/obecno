@php 
    $breadcrumb['/dashboard'] = 'Home';
    
    $url = url()->current();
    if(strpos($url, 'edit-sprints')> -1){
        $table = 'sprints';
    }
    if(strpos($url, 'list-') > -1){
        $breadcrumb[] = ucwords(str_replace('_', ' ', $table)).' Records';
    }
    if(strpos($url, 'add-') > -1){
        $breadcrumb['/admin-list-'.$table] = ucwords(str_replace('_', ' ', $table)).' Records';
        $breadcrumb[] = 'Add '.ucwords(getSingular(str_replace('_', ' ', $table)));
    }
    if(strpos($url, 'edit-') > -1){
        $breadcrumb['/admin-list-'.$table] = ucwords(str_replace('_', ' ', $table)).' Records';
        $breadcrumb[] = 'Update '.ucwords(getSingular(str_replace('_', ' ', $table)));
    }
    if(strpos($url, 'shop-') > -1){
        $breadcrumb['/shop'] = 'Shop';
        $breadcrumb[] = 'Update '.ucwords(getSingular(str_replace('_', ' ', $table)));
    }
    if(strpos($url, 'shop') > -1){
        $breadcrumb[] = 'Shop';
    }
    if(strpos($url, 'my-cart') > -1){
        $breadcrumb['/shop'] = 'Shop';
        $breadcrumb[] = 'My Cart';
    }
    if(strpos($url, 'orders') > -1){        
        $breadcrumb[] = 'My Orders';
    }
    if(strpos($url, 'order-detail') > -1){        
        $breadcrumb['/my-orders'] = 'My Orders';
        $breadcrumb[] = 'Order Detail';
    }

@endphp
<ol class="breadcrumb my-0 ms-2">
    @foreach($breadcrumb as $key => $val)
        @if($key != null)
            <li class="breadcrumb-item"><a href="{{ url($key) }}"><span>{{ $val }}</span></a></li>  
        @else
            <li class="breadcrumb-item"><span>{{ $val }}</span></li>  
        @endif
    @endforeach
</ol>