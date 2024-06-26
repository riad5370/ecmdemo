<!DOCTYPE html>
<html lang="zxx">
<head>
	<meta charset="utf-8" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="author" content="Themezhub" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="{{asset('frontend')}}/img/logomain.png">
    <title>SRCodeX Ecommerce Demo</title>
    <!-- Custom CSS -->
    @include('frontend.include.style')
    @stack('css')
</head>
	
<body>
	<!--Start of Tawk.to Script-->
	<script type="text/javascript">
		var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
		(function(){
		var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
		s1.async=true;
		s1.src='https://embed.tawk.to/64c347bd94cf5d49dc66e816/1h6dd0g3i';
		s1.charset='UTF-8';
		s1.setAttribute('crossorigin','*');
		s0.parentNode.insertBefore(s1,s0);
		})();
	</script>
	<!--End of Tawk.to Script-->
	
    <div class="preloader"></div>
    <div id="main-wrapper">
            
		@include('frontend.include.header')	
		@yield('body')
				
		<!--Footer Start-->
		@include('frontend.include.footer')
		<!--Footer End-->
				
		<!--whishlist and cart page-->
		@include('frontend.include.default')
	</div>
	<!-- All Jquery -->
	@include('frontend.include.script')
    @stack('js')
</body>
</html>