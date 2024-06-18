<!-- ============================================================== -->
<script src="{{asset('frontend')}}/js/jquery.min.js"></script>
<script src="{{asset('frontend')}}/js/popper.min.js"></script>
<script src="{{asset('frontend')}}/js/bootstrap.min.js"></script>
<script src="{{asset('frontend')}}/js/ion.rangeSlider.min.js"></script>
<script src="{{asset('frontend')}}/js/slick.js"></script>
<script src="{{asset('frontend')}}/js/slider-bg.js"></script>
<script src="{{asset('frontend')}}/js/lightbox.js"></script> 
<script src="{{asset('frontend')}}/js/smoothproducts.js"></script>
<script src="{{asset('frontend')}}/js/snackbar.min.js"></script>
<script src="{{asset('frontend')}}/js/jQuery.style.switcher.js"></script>
<script src="{{asset('frontend')}}/js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->	
<script>
    function openWishlist() {
        document.getElementById("Wishlist").style.display = "block";
    }
    function closeWishlist() {
        document.getElementById("Wishlist").style.display = "none";
    }
</script>

<script>
    function openCart() {
        document.getElementById("Cart").style.display = "block";
    }
    function closeCart() {
        document.getElementById("Cart").style.display = "none";
    }
</script>

<script>
    function openSearch() {
        document.getElementById("Search").style.display = "block";
    }
    function closeSearch() {
        document.getElementById("Search").style.display = "none";
    }
</script>

   <!-- ======== searching product ======== -->	
    <script>
        $('#search_btn').click(function(){
            var search_input = $('#search_input').val();
            var category_id = $('input[class="category_id"]:checked').attr('value');
            var color_id = $('input[class="color_idd"]:checked').attr('value');
            var size_id = $('input[class="size_idd"]:checked').attr('value');
            var min = $('#min').val();
            var max = $('#max').val();
            var short = $('#short').val();
            var link = "{{ route('search') }}"+"?q="+search_input+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id+"&min="+min+"&max="+max+"&short="+short;
            window.location.href = link;
        });
        $('#price_btn').click(function(){
            var search_input = $('#search_input').val();
            var category_id = $('input[class="category_id"]:checked').attr('value');
            var color_id = $('input[class="color_idd"]:checked').attr('value');
            var size_id = $('input[class="size_idd"]:checked').attr('value');
            var min = $('#min').val();
            var max = $('#max').val();
            var short = $('#short').val();
            var link = "{{ route('search') }}"+"?q="+search_input+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id+"&min="+min+"&max="+max+"&short="+short;
            window.location.href = link;
        });
        $('.category_id').click(function(){
            var search_input = $('#search_input').val();
            var category_id = $('input[class="category_id"]:checked').attr('value');
            var color_id = $('input[class="color_idd"]:checked').attr('value');
            var size_id = $('input[class="size_idd"]:checked').attr('value');
            var min = $('#min').val();
            var max = $('#max').val();
            var short = $('#short').val();
            var link = "{{ route('search') }}"+"?q="+search_input+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id+"&min="+min+"&max="+max+"&short="+short;
            window.location.href = link;
        });
        $('.color_idd').click(function(){
            var search_input = $('#search_input').val();
            var category_id = $('input[class="category_id"]:checked').attr('value');
            var color_id = $('input[class="color_idd"]:checked').attr('value');
            var size_id = $('input[class="size_idd"]:checked').attr('value');
            var min = $('#min').val();
            var max = $('#max').val();
            var short = $('#short').val();
            var link = "{{ route('search') }}"+"?q="+search_input+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id+"&min="+min+"&max="+max+"&short="+short;
            window.location.href = link;
        });
        $('.size_idd').click(function(){
            var search_input = $('#search_input').val();
            var category_id = $('input[class="category_id"]:checked').attr('value');
            var color_id = $('input[class="color_idd"]:checked').attr('value');
            var size_id = $('input[class="size_idd"]:checked').attr('value');
            var min = $('#min').val();
            var max = $('#max').val();
            var short = $('#short').val();
            var link = "{{ route('search') }}"+"?q="+search_input+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id+"&min="+min+"&max="+max+"&short="+short;
            window.location.href = link;
        });
        $('#short').change(function(){
            var search_input = $('#search_input').val();
            var category_id = $('input[class="category_id"]:checked').attr('value');
            var color_id = $('input[class="color_idd"]:checked').attr('value');
            var size_id = $('input[class="size_idd"]:checked').attr('value');
            var min = $('#min').val();
            var max = $('#max').val();
            var short = $('#short').val();
            var link = "{{ route('search') }}"+"?q="+search_input+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id+"&min="+min+"&max="+max+"&short="+short;
            window.location.href = link;
        });
    </script>
	