<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ isset( $page_title) ?  $page_title .' |  '.config('app.name') :  $system_settings->meta_title  }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ isset($page_meta_description) ? $page_meta_description : $system_settings->meta_description }}">
    <meta name="keywords" content="{{ isset($system_settings->meta_tag_keywords) ? $system_settings->meta_tag_keywords : 'cleanse,detox,flattummy,flattummy tea ng,slimming tea' }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="canonical" href="{{ Config('app.url') }}">

     <!-- Favicone Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
	<link rel="icon" href="/img/favicon.ico" type="image/x-icon">
	<link rel="icon" type="image/png" href="/img/favicon-96x96.png">
	<link rel="apple-touch-icon" href="/img/favicon-96x96.png">

	

   

    <!-- CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
	<!-- Main CSS File -->
	<link rel="stylesheet" href="/css/style.min.css?version={{ str_random(6) }}">
	<link rel="stylesheet" type="text/css" href="/vendor/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="/css/skins/skin-default.css?version={{ str_random(6) }}">

    @yield('page-css')
    <link href="/css/custom.css?version={{ str_random(6) }}" rel="stylesheet" type="text/css" />
    <meta property="og:site_name" content="hautesignatures Co">
    <meta property="og:url" content="https://hautesignatures.com/">
    <meta property="og:title" content=" hautesignatures">
    <meta property="og:type" content="website">
    <meta property="og:description" content="{{ isset($page_meta_description) ? $page_meta_description : $system_settings->meta_description }}">
    <meta property="og:image:alt" content="">
    <meta name="twitter:site" content="@hautesignatures">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ isset($page_meta_description) ? $page_meta_description : $system_settings->meta_description }}">
    <meta name="twitter:description" content="{{ isset($page_meta_description) ? $page_meta_description : $system_settings->meta_description }}">
    <script>
		Window.user = {
			user: {!! auth()->check() ? auth()->user() : 0000 !!},
			loggedIn: {!! auth()->check() ? 1 : 0 !!},
			settings: {!! isset($system_settings) ? $system_settings : '' !!},
			token: '{!! csrf_token() !!}'
		}
	</script>
</head>
<body class="">
	<div id="app" class="page-wrapper">
		

		<header class="header fixed-top">
			<div class="header-middle">
				<div class="container">
					<div class="header-left w-lg-max ml-auto ml-lg-0">
						<div class="header-icon header-search header-search-inline header-search-category">
							<a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
							<form action="/search" method="get">
								<div class="header-search-wrapper">
									<input type="search" class="form-control" name="q" id="q" placeholder="Search..." required>
									<button class="btn icon-search-3 p-0" type="submit"></button>
								</div><!-- End .header-search-wrapper -->
							</form>
						</div><!-- End .header-search -->
					</div><!-- End .header-left -->

					<div class="header-center order-first order-lg-0 ml-0 ml-lg-auto">
						<button class="mobile-menu-toggler" type="button">
							<i class="icon-menu"></i>
						</button>
						<a href="/" class="logo">
							<img src="{{ $system_settings->logo_path() }}" alt="{{ Config('app.name') }} Logo">
						</a>
					</div><!-- End .header-center -->
                    <nav-icon    />

				</div><!-- End .container -->
			</div><!-- End .header-middle -->

			<div class="header-bottom sticky-header d-none d-lg-block">
				<div class="container">
					<nav class="main-nav d-flex w-lg-max   justify-content-center">
						<ul class="menu">
							
                            @foreach( $global_categories   as  $category)

                                <li>
                                   <a class="{{ strtolower($category->name) == 'christmas shop' ? 'text-danger' : '' }}" href="/products/{{ $category->slug }}">{{ $category->name }}</a>
                                   @if ($category->isCategoryHaveMultipleChildren())

                                    <div class="megamenu megamenu-fixed-width">
                                        <div class="row">
										    <div class="col-lg-9">
											    <div class="row">
													@foreach (  $category->children as $children)
													<div class="col-lg-3">
														<a href="/products/{{ $children->slug }}" class="category-heading"><b>{{ $children->name !== 'No Heading' ? $children->name : '' }} </b></a>
														@if ($children->children->count())
															<ul class="submenu">
																@foreach (  $children->children as $children)
																	<li><a href="/products/{{ $children->slug }}">{{ ucfirst($children->name) }}</a></li>
																@endforeach
															</ul>
														@endif
													</div><!-- End .col-lg-4 -->
													@endforeach
		                                        </div>
											</div>
											
											<div class="col-lg-3">
												<div class="col-lg-12 p-0">
												   <a href="{{ $category->image_custom_link }}"><img src="{{ $category->image }}" alt="{{ $category->image }}" class="product-promo" ></a>
												</div><!-- End .col-lg-4 -->
											</div>
										   

                                        </div><!-- End .row -->
                                    </div><!-- End .megamenu -->
                                    @elseif ( !$category->isCategoryHaveMultipleChildren() && $category->children->count() )
                                        <ul  >
                                            @foreach (  $category->children as $children)
                                               <li class="nav-children color--primary  {{ strtolower($category->name) == 'christmas shop' ? 'pl-5' : '' }}"><a href="/products/{{ $children->slug }}">{{ $children->name }}</a></li>
                                            @endforeach 
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
						</ul>
					</nav>
				</div><!-- End .container -->
			</div><!-- End .header-bottom -->
		</header><!-- End .header -->
        <main class="main main-page">
          @yield('content')
        </main> 

		

		<footer class="footer">
			<div class="footer-middle">
				<div class="container-fluid">
					<div class="row">
							
							<div class="col-sm-6 col-xl-6">
								<div class="widget widget-newsletter">
									<h4 class="widget-title">Subscribe to our newsletter.</h4>
									<p>Get all the latest information on events, sales and offers. Sign up for newsletter today.</p>
									<news-letter />

								</div>
								<p>
									<div class="contact-widget follow">
										<div class="social-icons">
											<a href="https://facebook.com/hautesignatures.ng/" class="social-icon" target="_blank"><i class="fab fa-facebook-f"></i></a>
											<a href="https://instagram.com/hautesignatures.ng?igshid=zqjic4sfh041" class="social-icon" target="_blank"><i class="fab fa-instagram"></i></a>
											<a href="https://wa.me/2348092907541" class="social-icon" target="_blank"><i class="fab fa-whatsapp"></i></a>
										</div><!-- End .social-icons -->
									</div>
								</p>
							</div>

							<div class="col-lg-6 col-md-6">
							   <div class="row ">
									@foreach($footer_info as $info)
										<div class="col-sm-4 col-6 col-lg-4">
											<div class="widget">
												<h2 class="widget-title">{{ title_case($info->title) }}</h2>
												@if($info->children->count())
												<ul class="">
														@foreach($info->children as $info)
															<li>
																<a href="{{ $info->link }}">
																	{{ $info->title }}
																</a>
															</li>
														@endforeach
													</ul>
												@endif
												
											</div><!-- End .widget -->
										</div><!-- End .col-sm-6 -->
									@endforeach
								</div>
							</div>

							
					</div><!-- End .row -->
				</div><!-- End .container -->
			</div><!-- End .footer-middle -->

			<div class="footer-bottom">
				<div class="container d-flex justify-content-center align-items-center flex-wrap">
					<p class="footer-copyright py-3 pr-4 mb-0">© {{ config('app.name') }}. 2020. All Rights Reserved</p>
					@if ( auth()->check() && auth()->user()->isAdmin() )
					  <p class="footer-copyright py-3 pr-4 mb-0"><a target="_blank" href="/admin" >Go to Admin</a></p>
					@endif
				</div><!-- End .container -->
			</div><!-- End .footer-bottom -->
        </footer>

			
    </div><!-- End .page-wrapper -->

	<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

	<div class="mobile-menu-container">
		<div class="mobile-menu-wrapper">
			<span class="mobile-menu-close"><i class="icon-cancel"></i></span>
			<nav class="mobile-nav">
				<ul class="mobile-menu">
				@foreach( $global_categories   as  $category)
				    <li>
						<a href="/products/{{ $category->slug }}">{{ $category->name }}</a>
						@if ($category->isCategoryHaveMultipleChildren())
							<ul>
							    @foreach (  $category->children as $children)

								<li>
								<a href="/products/{{ $children->slug }}" class="category-heading">{{ $children->name }} </a>
								   @if ($children->children->count())
										<ul>
										    @foreach (  $children->children as $children)
                                                <li><a href="/products/{{ $children->slug }}">{{ $children->name }}</a></li>
                                            @endforeach
										</ul>
									@endif
								</li>
								@endforeach
							</ul>
						@elseif ( !$category->isCategoryHaveMultipleChildren() && $category->children->count() )
							<ul>
								@foreach (  $category->children as $children)
									<li><a class="category-heading" href="/products/{{ $children->slug }}">{{ $children->name }}</a></li>
								@endforeach 
							</ul>
						@endif
					</li>
					
				@endforeach
				</ul>
			</nav><!-- End .mobile-nav -->

			
		</div><!-- End .mobile-menu-wrapper -->
	</div><!-- End .mobile-menu-container -->


	

	

	<!-- Add Cart Modal -->
	<div class="modal fade" id="addCartModal" tabindex="-1" role="dialog" aria-labelledby="addCartModal" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-body add-cart-box text-center">
			<p>Product Added<br></p>
			<h4 id="productTitle"></h4>
			<img src="" id="productImage" width="100" height="100" alt="adding cart image">
			<div class="btn-actions">
				<a href=""><button class="btn-primary" data-dismiss="modal">Continue</button></a>
			</div>
		  </div>
		</div>
	  </div>
	</div>

	<a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

	<!-- Plugins JS File -->
	<script src="/js/app.js?version={{ str_random(6) }}" type="text/javascript"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	<!-- Main JS File -->
	<script src="/js/main.min.js?version={{ str_random(6) }}"></script>
	<script src="{{ asset('js/loadProducts.jquery.js') }}"></script> 

    @yield('page-scripts')
    <script type="text/javascript">
        @yield('inline-scripts')
    </script>
</body>
</html>










