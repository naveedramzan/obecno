<!-- CoreUI and necessary plugins-->
    <script src="/node_modules/@coreui/coreui/dist/js/coreui.bundle.min.js"></script>
    <script src="/node_modules/simplebar/dist/simplebar.min.js"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="/node_modules/@coreui/utils/dist/coreui-utils.js"></script>
    <script src="{{ asset('admin/js/main.js') }}"></script>
    <script src="{{ asset('plugins/jQuery/jquery.min.js') }}"></script>
    <script> 
        $(document).ready(function(){
            $('.header-toggler').click(function(){
                if($('#sidebar').hasClass('hide') == true){
                    $('#sidebar').removeClass('hide');
                }else{
                    $('#sidebar').addClass('hide');
                }
            })
        });
    </script>