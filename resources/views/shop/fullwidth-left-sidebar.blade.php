@extends('includes.base')

@section('content')
<body>
	
	@include('includes.nav')

	<!--=======  breadcrumb area =======-->

	<div class="breadcrumb-area breadcrumb-bg-2 pt-50 pb-70">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="breadcrumb-title">Shop</h1>

					<!--=======  breadcrumb list  =======-->

					<ul class="breadcrumb-list">
						<li class="breadcrumb-list__item"><a href="index.html">HOME</a></li>
						<li class="breadcrumb-list__item breadcrumb-list__item--active">PRODUCTS</li>
					</ul>

					<!--=======  End of breadcrumb list  =======-->

				</div>
			</div>
		</div>
	</div>

	<!--=======  End of breadcrumb area =======-->

	<!--=============================================
    =            shop page content         =
    =============================================-->

	<div class="shop-page-wrapper">

		<!--=======  shop page header  =======-->

		<div class="shop-page-header">
			<div class="container wide">
				<div class="row align-items-center">

					<div class="col-12 col-lg-7 col-md-10 d-none d-md-block">
						<!--=======  fitler titles  =======-->
						<div class="filter-title filter-title--type-two">
							<ul class="product-filter-menu">
								<li class="active" data-filter="*">All</li>
								<li data-filter=".hot">hot products</li>
								<li data-filter=".new">new products</li>
								<li data-filter=".sale">sale products</li>
							</ul>
						</div>
						<!--=======  End of fitler titles  =======-->
					</div>

					<div class="col-12 col-lg-5 col-md-2">
						<!--=======  filter icons  =======-->

						<div class="filter-icons">
							<!--=======  filter dropdown  =======-->

							<div class="single-icon filter-dropdown">
								<select class="nice-select">
									<option value="0">Default sorting</option>
									<option value="1">Sort ny popularity</option>
									<option value="0">Sort by average rating</option>
									<option value="0">Sort by latest</option>
									<option value="0">Sort by price: low to high</option>
									<option value="0">Sort by price: high to low</option>
								</select>
							</div>

							<!--=======  End of filter dropdown  =======-->

							<!--=======  grid icons  =======-->

							<div class="single-icon grid-icons">
								<a data-target="five-column" class="active" href="javascript:void(0)"><i
										class="ti-layout-grid4-alt"></i></a>
								<a data-target="four-column" href="javascript:void(0)"><i class="ti-layout-grid3-alt"></i></a>
								<a data-target="three-column" href="javascript:void(0)"><i class="ti-layout-grid2-alt"></i></a>
								<a data-target="list" href="javascript:void(0)"><i class="ti-view-list"></i></a>
							</div>

							<!--=======  End of grid icons  =======-->

							<!--=======  advance filter icon  =======-->

							<div class="single-icon advance-filter-icon">
								<a href="javascript:void(0)" id="advance-filter-active-btn"><i class="ion-android-funnel"></i>
									Filters</a>
							</div>

							<!--=======  End of advance filter icon  =======-->
						</div>

						<!--=======  End of filter icons  =======-->
					</div>

				</div>
			</div>
		</div>

		<!--=======  End of shop page header  =======-->

		<!--=============================================
        =            shop advance filter area         =
        =============================================-->

		<div class="shop-advance-filter-area" id="shop-advance-filter-area">
			<div class="shop-advance-filter-wrapper pt-50">
				<div class="container">
					<div class="row">
						<div class="col-lg-2 col-md-4 col-sm-6 mb-50">
							<!--=======  single advance filte  =======-->

							<div class="single-filter-widget">
								<h2 class="single-filter-widget--title">Sort by</h2>
								<ul class="single-filter-widget--list">
									<li><a href="#">Default</a></li>
									<li><a href="#">Popularity</a></li>
									<li><a href="#">Average rating</a></li>
									<li><a href="#">Newness</a></li>
									<li><a href="#">Price: low to high</a></li>
									<li><a href="#">Price: high to low</a></li>
								</ul>
							</div>

							<!--=======  End of single advance filte  =======-->
						</div>

						<div class="col-lg-2 col-md-4 col-sm-6 mb-50">
							<!--=======  single advance filte  =======-->

							<div class="single-filter-widget">
								<h2 class="single-filter-widget--title">Categories</h2>
								<ul class="single-filter-widget--list single-filter-widget--list--category">
									<li class="has-children">
										<a href="shop-left-sidebar.html">Cosmetic </a> <span class="quantity">5</span>
										<ul>
											<li><a href="shop-left-sidebar.html">For body</a></li>
											<li><a href="shop-left-sidebar.html">Make up</a></li>
											<li><a href="shop-left-sidebar.html">New</a></li>
											<li><a href="shop-left-sidebar.html">Perfumes</a></li>
										</ul>
									</li>
									<li class="has-children">
										<a href="shop-left-sidebar.html">Furniture </a> <span class="quantity">23</span>
										<ul>
											<li><a href="shop-left-sidebar.html">Sofas</a></li>
											<li><a href="shop-left-sidebar.html">Armchairs</a></li>
											<li><a href="shop-left-sidebar.html">Desk Chairs</a></li>
											<li><a href="shop-left-sidebar.html">Dining Chairs</a></li>
										</ul>
									</li>
									<li><a href="shop-left-sidebar.html">Watches </a> <span class="quantity">12</span></li>
								</ul>
							</div>

							<!--=======  End of single advance filte  =======-->
						</div>

						<div class="col-lg-2 col-md-4 col-sm-6 mb-50">
							<!--=======  single advance filte  =======-->

							<div class="single-filter-widget">
								<h2 class="single-filter-widget--title">Price filter</h2>
								<ul class="single-filter-widget--list">
									<li><a href="#">All</a></li>
									<li><a href="#">$0.00 - $70.00</a></li>
									<li><a href="#">$70.00 - $140.00</a></li>
									<li><a href="#">$140.00 - $210.00</a></li>
									<li><a href="#">$210.00 - $280.00</a></li>
									<li><a href="#">$280.00 - $350.00</a></li>
								</ul>
							</div>

							<!--=======  End of single advance filte  =======-->
						</div>

						<div class="col-lg-2 col-md-4 col-sm-6 mb-50">
							<!--=======  single advance filte  =======-->

							<div class="single-filter-widget">
								<h2 class="single-filter-widget--title">Color</h2>
								<ul class="single-filter-widget--list single-filter-widget--list--color">
									<li><a class="active" href="#" data-tippy="Black" data-tippy-inertia="true"
											data-tippy-animation="shift-away" data-tippy-delay="50" data-tippy-arrow="true"
											data-tippy-theme="sharpborder"><span class="color-picker black"></span></a></li>
									<li><a href="#" data-tippy="Blue" data-tippy-inertia="true" data-tippy-animation="shift-away"
											data-tippy-delay="50" data-tippy-arrow="true" data-tippy-theme="sharpborder"><span
												class="color-picker blue"></span></a></li>
									<li><a href="#" data-tippy="Brown" data-tippy-inertia="true" data-tippy-animation="shift-away"
											data-tippy-delay="50" data-tippy-arrow="true" data-tippy-theme="sharpborder"><span
												class="color-picker brown"></span></a></li>
									<li><a href="#" data-tippy="Gold" data-tippy-inertia="true" data-tippy-animation="shift-away"
											data-tippy-delay="50" data-tippy-arrow="true" data-tippy-theme="sharpborder"><span
												class="color-picker gold"></span></a></li>
									<li><a href="#" data-tippy="Green Coral" data-tippy-inertia="true" data-tippy-animation="shift-away"
											data-tippy-delay="50" data-tippy-arrow="true" data-tippy-theme="sharpborder"><span
												class="color-picker green-coral"></span></a></li>
									<li><a href="#" data-tippy="Grey" data-tippy-inertia="true" data-tippy-animation="shift-away"
											data-tippy-delay="50" data-tippy-arrow="true" data-tippy-theme="sharpborder"><span
												class="color-picker grey"></span></a></li>
									<li><a href="#" data-tippy="Oak" data-tippy-inertia="true" data-tippy-animation="shift-away"
											data-tippy-delay="50" data-tippy-arrow="true" data-tippy-theme="sharpborder"><span
												class="color-picker oak"></span></a></li>
									<li><a href="#" data-tippy="Pink" data-tippy-inertia="true" data-tippy-animation="shift-away"
											data-tippy-delay="50" data-tippy-arrow="true" data-tippy-theme="sharpborder"><span
												class="color-picker pink"></span></a></li>
									<li><a href="#" data-tippy="Silver" data-tippy-inertia="true" data-tippy-animation="shift-away"
											data-tippy-delay="50" data-tippy-arrow="true" data-tippy-theme="sharpborder"><span
												class="color-picker silver"></span></a></li>
									<li><a href="#" data-tippy="White" data-tippy-inertia="true" data-tippy-animation="shift-away"
											data-tippy-delay="50" data-tippy-arrow="true" data-tippy-theme="sharpborder"><span
												class="color-picker white"></span></a></li>
								</ul>
							</div>

							<!--=======  End of single advance filte  =======-->
						</div>

						<div class="col-lg-2 col-md-4 col-sm-6 mb-50">
							<!--=======  single advance filte  =======-->

							<div class="single-filter-widget">
								<h2 class="single-filter-widget--title">Size</h2>
								<ul class="single-filter-widget--list single-filter-widget--list--size">
									<li><a href="#">L</a> <span class="quantity">5</span></li>
									<li><a href="#">M</a> <span class="quantity">5</span></li>
									<li><a href="#">S</a> <span class="quantity">5</span></li>
									<li><a href="#">XS</a> <span class="quantity">5</span></li>
								</ul>
							</div>

							<!--=======  End of single advance filte  =======-->
						</div>

						<div class="col-lg-2 col-md-4 col-sm-6 mb-50">
							<!--=======  single advance filte  =======-->

							<div class="single-filter-widget">
								<h2 class="single-filter-widget--title">Brands</h2>
								<ul class="single-filter-widget--list single-filter-widget--list--brand">
									<li><a href="#">Alliop</a> <span class="quantity">(12)</span></li>
									<li><a href="#">Burberry</a> <span class="quantity">(15)</span></li>
									<li><a href="#">Catmen</a> <span class="quantity">(13)</span></li>
									<li><a href="#">Houdini</a> <span class="quantity">(10)</span></li>
									<li><a href="#">Love</a> <span class="quantity">(70)</span></li>
									<li><a href="#">Made</a> <span class="quantity">(15)</span></li>
								</ul>
							</div>

							<!--=======  End of single advance filte  =======-->
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--=====  End of shop advance filter area  ======-->

		<!--=============================================
		=            shop page content         =
		=============================================-->

		<div class="shop-page-content mt-100 mb-100">
			<div class="container wide">
				<div class="row">
					<div class="col-xl-3 col-lg-3 order-2 order-lg-1">
						<!--=======  page sidebar  =======-->

						<div class="page-sidebar">
							<!--=======  single sidebar widget  =======-->

							<div class="single-sidebar-widget mb-40">
								<!--=======  search widget  =======-->

								<div class="search-widget">
									<form action="#">
										<input type="search" placeholder="Search products ...">
										<button type="button"><i class="ion-android-search"></i></button>
									</form>
								</div>

								<!--=======  End of search widget  =======-->
							</div>


							<!--=======  End of single sidebarwidget  =======-->

							<!--=======  single sidebar widget  =======-->

							<div class="single-sidebar-widget mb-40">
								<h2 class="single-sidebar-widget--title">Categories</h2>
								<ul class="single-sidebar-widget--list single-sidebar-widget--list--category">
									<li class="has-children">
										<a href="shop-left-sidebar.html">Cosmetic </a> <span class="quantity">5</span>
										<ul>
											<li><a href="shop-left-sidebar.html">For body</a></li>
											<li><a href="shop-left-sidebar.html">Make up</a></li>
											<li><a href="shop-left-sidebar.html">New</a></li>
											<li><a href="shop-left-sidebar.html">Perfumes</a></li>
										</ul>
									</li>
									<li class="has-children">
										<a href="shop-left-sidebar.html">Furniture </a> <span class="quantity">23</span>
										<ul>
											<li><a href="shop-left-sidebar.html">Sofas</a></li>
											<li><a href="shop-left-sidebar.html">Armchairs</a></li>
											<li><a href="shop-left-sidebar.html">Desk Chairs</a></li>
											<li><a href="shop-left-sidebar.html">Dining Chairs</a></li>
										</ul>
									</li>
									<li><a href="shop-left-sidebar.html">Watches </a> <span class="quantity">12</span></li>
									<li><a href="shop-left-sidebar.html">Bags </a> <span class="quantity">22</span></li>
									<li><a href="shop-left-sidebar.html">Uncategorized </a> <span class="quantity">14</span></li>
								</ul>
							</div>

							<!--=======  End of single sidebar widget  =======-->

							<!--=======  single sidebar widget  =======-->

							<div class="single-sidebar-widget mb-40">
								<h2 class="single-sidebar-widget--title">Filters</h2>
								<div class="sidebar-price">
									<div id="price-range"></div>
									<div class="output-wrapper mt-20">
										<input type="text" id="price-amount" class="price-amount" readonly>
										<a class="price-range-button" href="#"><i class="ion-android-funnel"></i> Filter</a>
									</div>
								</div>
							</div>

							<!--=======  End of single sidebar widget  =======-->

							<!--=======  single sidebar widget  =======-->

							<div class="single-sidebar-widget mb-40">
								<h2 class="single-sidebar-widget--title">Popular products</h2>

								<!--=======  widget product wrapper  =======-->

								<div class="widget-product-wrapper">
									<!--=======  single widget product  =======-->
									<div class="single-widget-product-wrapper">
										<div class="single-widget-product">
											<!--=======  image  =======-->

											<div class="single-widget-product__image">
												<a href="shop-product-basic.html">
													<img src="{{ url('lezada/images/products/product-furniture-2-100x100.jpg')}}" class="img-fluid" alt="">
												</a>
											</div>

											<!--=======  End of image  =======-->

											<!--=======  content  =======-->

											<div class="single-widget-product__content">

												<div class="single-widget-product__content__top">
													<h3 class="product-title"><a href="shop-product-basic.html">Wooden Table</a></h3>
													<div class="price">
														<span class="main-price discounted">$270.00</span>
														<span class="discounted-price">$220.00</span>
													</div>
													<div class="rating">
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star-outline"></i>
														<i class="ion-android-star-outline"></i>
														<i class="ion-android-star-outline"></i>
													</div>
												</div>

											</div>

											<!--=======  End of content  =======-->
										</div>
									</div>

									<!--=======  End of single widget product  =======-->

									<!--=======  single widget product  =======-->
									<div class="single-widget-product-wrapper">
										<div class="single-widget-product">
											<!--=======  image  =======-->

											<div class="single-widget-product__image">
												<a href="shop-product-basic.html">
													<img src="{{ url('lezada/images/products/product-furniture-11-100x100.jpg')}}" class="img-fluid" alt="">
												</a>
											</div>

											<!--=======  End of image  =======-->

											<!--=======  content  =======-->

											<div class="single-widget-product__content">

												<div class="single-widget-product__content__top">
													<h3 class="product-title"><a href="shop-product-basic.html">Sofa with cushion</a></h3>
													<div class="price">
														<span class="main-price discounted">$660.00</span>
														<span class="discounted-price">$600.00</span>
													</div>
													<div class="rating">
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
													</div>
												</div>



											</div>

											<!--=======  End of content  =======-->
										</div>
									</div>

									<!--=======  End of single widget product  =======-->

									<!--=======  single widget product  =======-->
									<div class="single-widget-product-wrapper">
										<div class="single-widget-product">
											<!--=======  image  =======-->

											<div class="single-widget-product__image">
												<a href="shop-product-basic.html">
													<img src="{{ url('lezada/images/products/soccer-4-100x100.jpg')}}" class="img-fluid" alt="">
												</a>
											</div>

											<!--=======  End of image  =======-->

											<!--=======  content  =======-->

											<div class="single-widget-product__content">

												<div class="single-widget-product__content__top">
													<h3 class="product-title"><a href="shop-product-basic.html">High waist trousers</a></h3>
													<div class="price">
														<span class="main-price discounted">$36.00</span>
														<span class="discounted-price">$33.00</span>
													</div>
													<div class="rating">
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star-outline"></i>
													</div>
												</div>


											</div>

											<!--=======  End of content  =======-->
										</div>
									</div>
									<!--=======  End of single widget product  =======-->
								</div>

								<!--=======  End of widget product wrapper  =======-->
							</div>

							<!--=======  End of single sidebar widget  =======-->

							<!--=======  single sidebar widget  =======-->

							<div class="single-sidebar-widget">
								<h2 class="single-sidebar-widget--title">Tags</h2>

								<div class="tag-container">
									<a href="#">bags</a>
									<a href="#">chair</a>
									<a href="#">clock</a>
									<a href="#">comestic</a>
									<a href="#">fashion</a>
									<a href="#">furniture</a>
									<a href="#">holder</a>
									<a href="#">mask</a>
									<a href="#">men</a>
									<a href="#">oil</a>
								</div>
							</div>

							<!--=======  End of single sidebar widget  =======-->
						</div>

						<!--=======  End of page sidebar  =======-->
					</div>
					<div class="col-xl-9 col-lg-9 order-1 order-lg-2 mb-md-80 mb-sm-80">

						<div class="row product-isotope shop-product-wrap five-column">

							<!--=======  single product  =======-->
							@foreach ($product as $p)
							<div class="col-12 col-lg-is-5 col-md-6 col-sm-6 mb-45 hot sale">
								<div class="single-product">
									<!--=======  single product image  =======-->

									<div class="single-product__image">
										<a class="image-wrap" href="shop-product-basic.html">
											<img src="{{ url('lezada/images/products/cloth-1-1-600x800.jpg')}}" class="img-fluid" alt="">
											<img src="{{ url('lezada/images/products/cloth-1-2-600x800.jpg')}}" class="img-fluid" alt="">
										</a>

										<div class="single-product__floating-badges">
											<span class="onsale">-10%</span>
											<span class="hot">hot</span>
										</div>

										<div class="single-product__floating-icons">
											<span class="wishlist"><a href="#" data-tippy="Add to wishlist" data-tippy-inertia="true"
													data-tippy-animation="shift-away" data-tippy-delay="50" data-tippy-arrow="true"
													data-tippy-theme="sharpborder" data-tippy-placement="left"><i
														class="ion-android-favorite-outline"></i></a></span>

											<span class="compare"><a href="#" data-tippy="Compare" data-tippy-inertia="true"
													data-tippy-animation="shift-away" data-tippy-delay="50" data-tippy-arrow="true"
													data-tippy-theme="sharpborder" data-tippy-placement="left"><i
														class="ion-ios-shuffle-strong"></i></a></span>

											<span class="quickview"><a class="cd-trigger" href="#qv-1" data-tippy="Quick View"
													data-tippy-inertia="true" data-tippy-animation="shift-away" data-tippy-delay="50"
													data-tippy-arrow="true" data-tippy-theme="sharpborder" data-tippy-placement="left"><i
														class="ion-ios-search-strong"></i></a></span>
										</div>


									</div>

									<!--=======  End of single product image  =======-->

									<!--=======  single product content  =======-->

									<div class="single-product__content">
										<div class="single-product__variations">
											<div class="size-container mb-5">
												<span class="size">L</span>
												<span class="size">M</span>
												<span class="size">S</span>
												<span class="size">XS</span>
											</div>
											<div class="color-container">
												<span class="black"></span>
												<span class="blue"></span>
												<span class="yellow"></span>
											</div>
											<!-- <a href="#" class="clear-link">clear</a> -->
										</div>
										<div class="title">
											<h3> <a href="shop-product-basic.html">{{ $p->name }}</a></h3>
											<a href="#">Select options</a>
										</div>
										<div class="price">
											<span class="main-price">$ {{ number_format($p->price,0,',', '.') }}</span>
										</div>
									</div>

									<!--=======  End of single product content  =======-->
								</div>
								<div class="single-product--list">
									<!--=======  single product image  =======-->

									<div class="single-product__image">
										<a class="image-wrap" href="shop-product-basic.html">
											<img src="{{ url('lezada/images/products/cloth-1-1-600x800.jpg')}}" class="img-fluid" alt="">
											<img src="{{ url('lezada/images/products/cloth-1-2-600x800.jpg')}}" class="img-fluid" alt="">
										</a>

										<div class="single-product__floating-badges">
											<span class="onsale">-10%</span>
											<span class="hot">hot</span>
										</div>

										<div class="single-product__floating-icons">
											<span class="wishlist"><a href="#" data-tippy="Add to wishlist" data-tippy-inertia="true"
													data-tippy-animation="shift-away" data-tippy-delay="50" data-tippy-arrow="true"
													data-tippy-theme="sharpborder" data-tippy-placement="bottom"><i
														class="ion-android-favorite-outline"></i></a></span>

											<span class="compare"><a href="#" data-tippy="Compare" data-tippy-inertia="true"
													data-tippy-animation="shift-away" data-tippy-delay="50" data-tippy-arrow="true"
													data-tippy-theme="sharpborder" data-tippy-placement="bottom"><i
														class="ion-ios-shuffle-strong"></i></a></span>

											<span class="quickview"><a class="cd-trigger" href="#qv-1" data-tippy="Quick View"
													data-tippy-inertia="true" data-tippy-animation="shift-away" data-tippy-delay="50"
													data-tippy-arrow="true" data-tippy-theme="sharpborder" data-tippy-placement="bottom"><i
														class="ion-ios-search-strong"></i></a></span>
										</div>

										<div class="single-product__variations">
											<div class="size-container mb-5">
												<span class="size">L</span>
												<span class="size">M</span>
												<span class="size">S</span>
												<span class="size">XS</span>
											</div>
											<div class="color-container">
												<span class="black"></span>
												<span class="blue"></span>
												<span class="yellow"></span>
											</div>
											<!-- <a href="#" class="clear-link">clear</a> -->
										</div>

									</div>

									<!--=======  End of single product image  =======-->

									<!--=======  single product content  =======-->

									<div class="single-product__content">

										<div class="title">
											<h3> <a href="shop-product-basic.html">{{ $p->name }}</a></h3>
										</div>
										<div class="price">
											<span class="main-price">$ {{ number_format($p->price,0,',', '.') }}</span>										
										</div>
										<p class="short-desc">{{ $p->description }}</p>

										<a href="#" class="lezada-button lezada-button--medium">ADD TO CART</a>

									</div>

									<!--=======  End of single product content  =======-->
								</div>
							</div>
							@endforeach
							<!--=======  End of single product  =======-->


						</div>

						<div class="row">
							<div class="col-lg-12 text-center mt-30">
								<a class="lezada-button lezada-button--medium lezada-button--icon--left" href="#"><i
										class="ion-android-add"></i> MORE</a>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

		<!--=====  End of shop page content  ======-->
	</div>

	<!--=====  End of shop page content  ======-->



	<!--=============================================
	=            footer area         =
	=============================================-->

	<div class="footer-container footer-one pt-100 pb-50">
		<div class="container wide">
			<div class="row">
				<div class="col footer-single-widget">
					<!--=======  copyright text  =======-->
					<!--=======  logo  =======-->

					<div class="logo">
						<img src="{{ url('lezada/images/logo.png')}}" class="img-fluid" alt="">
					</div>

					<!--=======  End of logo  =======-->

					<!--=======  copyright text  =======-->

					<div class="copyright-text">
						<p> &copy; <script>document.write(new Date().getFullYear() + ' ');</script> lezada. <span>All Rights Reserved</span></p>
					</div>

					<!--=======  End of copyright text  =======-->

					<!--=======  End of copyright text  =======-->
				</div>
				<div class="col footer-single-widget">
					<!--=======  single widget  =======-->
					<h5 class="widget-title">ABOUT</h5>

					<!--=======  footer navigation container  =======-->

					<div class="footer-nav-container">
						<nav>
							<ul>
								<li><a href="#">About us</a></li>
								<li><a href="#">Store location</a></li>
								<li><a href="#">Contact</a></li>
								<li><a href="#">Orders tracking</a></li>
							</ul>
						</nav>
					</div>

					<!--=======  End of footer navigation container  =======-->

					<!--=======  single widget  =======-->
				</div>
				<div class="col footer-single-widget">
					<!--=======  single widget  =======-->
					<h5 class="widget-title">USEFUL LINKS</h5>

					<!--=======  footer navigation container  =======-->

					<div class="footer-nav-container">
						<nav>
							<ul>
								<li><a href="#">Returns</a></li>
								<li><a href="#">Support Policy</a></li>
								<li><a href="#">Size guide</a></li>
								<li><a href="#">FAQs</a></li>
							</ul>
						</nav>
					</div>

					<!--=======  End of footer navigation container  =======-->

					<!--=======  single widget  =======-->
				</div>

				<div class="col footer-single-widget">
					<!--=======  single widget  =======-->
					<h5 class="widget-title">FOLLOW US ON</h5>

					<!--=======  footer navigation container  =======-->

					<div class="footer-nav-container footer-social-links">
						<nav>
							<ul>
								<li><a href="//twitter.com"><i class="fa fa-twitter"></i> Twitter</a></li>
								<li><a href="//facebook.com"> <i class="fa fa-facebook"></i> Facebook</a></li>
								<li><a href="//instagram.com"><i class="fa fa-instagram"></i> Instagram</a></li>
								<li><a href="//youtube.com"> <i class="fa fa-youtube"></i> Youtube</a></li>
							</ul>
						</nav>
					</div>

					<!--=======  End of footer navigation container  =======-->


					<!--=======  single widget  =======-->
				</div>
				<div class="col footer-single-widget">
					<!--=======  single widget  =======-->

					<div class="footer-subscription-widget">
						<h2 class="footer-subscription-title">Subscribe.</h2>
						<p class="subscription-subtitle">Subscribe to our newsletter to receive news on update.</p>

						<!--=======  subscription form  =======-->

						<div class="subscription-form">
							<form id="mc-form" class="mc-form">
								<input type="email" placeholder="Your email address" required>
								<button type="submit"><i class="ion-ios-arrow-thin-right"></i></button>
							</form>
						</div>

						<!--=======  End of subscription form  =======-->

						<!-- mailchimp-alerts Start -->

						<div class="mailchimp-alerts">
							<div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
							<div class="mailchimp-success"></div><!-- mailchimp-success end -->
							<div class="mailchimp-error"></div><!-- mailchimp-error end -->
						</div><!-- mailchimp-alerts end -->

					</div>

					<!--=======  End of single widget  =======-->
				</div>
			</div>
		</div>
	</div>

	<!--=====  End of footer area  ======-->

	<!--=============================================
	=            overlay items         =
	=============================================-->

	<!--=======  about overlay  =======-->

	<div class="header-offcanvas about-overlay" id="about-overlay">
		<div class="overlay-close inactive"></div>
		<div class="overlay-content">

			<!--=======  close icon  =======-->

			<span class="close-icon" id="about-close-icon">
				<a href="javascript:void(0)">
					<i class="ti-close"></i>
				</a>
			</span>

			<!--=======  End of close icon  =======-->

			<!--=======  overlay content container  =======-->

			<div class="overlay-content-container d-flex flex-column justify-content-between h-100">
				<!--=======  widget wrapper  =======-->

				<div class="widget-wrapper">
					<!--=======  single widget  =======-->

					<div class="single-widget">
						<h2 class="widget-title">About Us</h2>
						<p>At Lezada, we put a strong emphasis on simplicity, quality and usefulness of fashion products over other
							factors. Our fashion items never get outdated. They are not short-lived as normal fashion clothes.</p>
					</div>

					<!--=======  End of single widget  =======-->
				</div>

				<!--=======  End of widget wrapper  =======-->

				<!--=======  contact widget  =======-->

				<div class="contact-widget">
					<p class="email"><a href="mailto:contact@lezada.com">contact@lezada.com</a></p>
					<p class="phone">(+00) 123 567990</p>

					<div class="social-icons">
						<ul>
							<li><a href="//www.twitter.com" data-tippy="Twitter" data-tippy-inertia="true"
									data-tippy-animation="shift-away" data-tippy-delay="50" data-tippy-arrow="true"
									data-tippy-theme="sharpborder" target="_blank"><i class="fa fa-twitter"></i></a></li>
							<li><a href="//www.facebook.com" data-tippy="Facebook" data-tippy-inertia="true"
									data-tippy-animation="shift-away" data-tippy-delay="50" data-tippy-arrow="true"
									data-tippy-theme="sharpborder" target="_blank"><i class="fa fa-facebook"></i></a></li>
							<li><a href="//www.instagram.com" data-tippy="Instagram" data-tippy-inertia="true"
									data-tippy-animation="shift-away" data-tippy-delay="50" data-tippy-arrow="true"
									data-tippy-theme="sharpborder" target="_blank"><i class="fa fa-instagram"></i></a></li>
							<li><a href="//www.youtube.com" data-tippy="Youtube" data-tippy-inertia="true"
									data-tippy-animation="shift-away" data-tippy-delay="50" data-tippy-arrow="true"
									data-tippy-theme="sharpborder" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
						</ul>
					</div>
				</div>

				<!--=======  End of contact widget  =======-->
			</div>

			<!--=======  End of overlay content container  =======-->
		</div>
	</div>

	<!--=======  End of about overlay  =======-->

	<!--=======  wishlist overlay  =======-->

	<div class="wishlist-overlay" id="wishlist-overlay">
		<div class="wishlist-overlay-close inactive"></div>
		<div class="wishlist-overlay-content">
			<!--=======  close icon  =======-->

			<span class="close-icon" id="wishlist-close-icon">
				<a href="javascript:void(0)">
					<i class="ion-android-close"></i>
				</a>
			</span>

			<!--=======  End of close icon  =======-->

			<!--=======  offcanvas wishlist content container  =======-->

			<div class="offcanvas-cart-content-container">
				<h3 class="cart-title">Wishlist</h3>

				<div class="cart-product-wrapper">
					<div class="cart-product-container ps-scroll">
						<!--=======  single cart product  =======-->

						<div class="single-cart-product">
							<span class="cart-close-icon">
								<a href="#"><i class="ti-close"></i></a>
							</span>
							<div class="image">
								<a href="shop-product-basic.html">
									<img src="{{ url('lezada/images/cart-product-image/01.jpg')}}" class="img-fluid" alt="">
								</a>
							</div>
							<div class="content">
								<h5><a href="shop-product-basic.html">Dark Brown Leather Watch</a></h5>
								<p><span class="main-price discounted">$200.00</span> <span class="discounted-price">$180.00</span></p>

							</div>
						</div>

						<!--=======  End of single cart product  =======-->
						<!--=======  single cart product  =======-->

						<div class="single-cart-product">
							<span class="cart-close-icon">
								<a href="#"><i class="ti-close"></i></a>
							</span>
							<div class="image">
								<a href="shop-product-basic.html">
									<img src="{{ url('lezada/images/cart-product-image/02.jpg')}}" class="img-fluid" alt="">
								</a>
							</div>
							<div class="content">
								<h5><a href="shop-product-basic.html">Dining Chair</a></h5>
								<p><span class="main-price discounted">$300.00</span> <span class="discounted-price">$220.00</span></p>

							</div>
						</div>

						<!--=======  End of single cart product  =======-->
						<!--=======  single cart product  =======-->

						<div class="single-cart-product">
							<span class="cart-close-icon">
								<a href="#"><i class="ti-close"></i></a>
							</span>
							<div class="image">
								<a href="shop-product-basic.html">
									<img src="{{ url('lezada/images/cart-product-image/03.jpg')}}" class="img-fluid" alt="">
								</a>
							</div>
							<div class="content">
								<h5><a href="shop-product-basic.html">Creative Wooden Stand</a></h5>
								<p><span class="main-price discounted">$100.00</span> <span class="discounted-price">$80.00</span></p>

							</div>
						</div>

						<!--=======  End of single cart product  =======-->
						<!--=======  single cart product  =======-->

						<div class="single-cart-product">
							<span class="cart-close-icon">
								<a href="#"><i class="ti-close"></i></a>
							</span>
							<div class="image">
								<a href="shop-product-basic.html">
									<img src="{{ url('lezada/images/cart-product-image/01.jpg')}}" class="img-fluid" alt="">
								</a>
							</div>
							<div class="content">
								<h5><a href="shop-product-basic.html">Dark Brown Leather Watch</a></h5>
								<p><span class="main-price discounted">$200.00</span> <span class="discounted-price">$180.00</span></p>

							</div>
						</div>

						<!--=======  End of single cart product  =======-->
						<!--=======  single cart product  =======-->

						<div class="single-cart-product">
							<span class="cart-close-icon">
								<a href="#"><i class="ti-close"></i></a>
							</span>
							<div class="image">
								<a href="shop-product-basic.html">
									<img src="{{ url('lezada/images/cart-product-image/02.jpg')}}" class="img-fluid" alt="">
								</a>
							</div>
							<div class="content">
								<h5><a href="shop-product-basic.html">Creative Wooden Stand</a></h5>
								<p><span class="main-price discounted">$200.00</span> <span class="discounted-price">$180.00</span></p>

							</div>
						</div>

						<!--=======  End of single cart product  =======-->
					</div>

					<!--=======  cart buttons  =======-->

					<div class="cart-buttons">
						<a href="shop-wishlist.html">view wishlist</a>
					</div>

					<!--=======  End of cart buttons  =======-->
				</div>
			</div>

			<!--=======  End of offcanvas wishlist content container   =======-->
		</div>
	</div>

	<!--=======  End of wishlist overlay  =======-->

	<!--=======  cart overlay  =======-->

	<div class="cart-overlay" id="cart-overlay">
		<div class="cart-overlay-close inactive"></div>
		<div class="cart-overlay-content">
			<!--=======  close icon  =======-->

			<span class="close-icon" id="cart-close-icon">
				<a href="javascript:void(0)">
					<i class="ion-android-close"></i>
				</a>
			</span>

			<!--=======  End of close icon  =======-->

			<!--=======  offcanvas cart content container  =======-->

			<div class="offcanvas-cart-content-container">
				<h3 class="cart-title">Cart</h3>

				<div class="cart-product-wrapper">
					<div class="cart-product-container ps-scroll">
						<!--=======  single cart product  =======-->

						<div class="single-cart-product">
							<span class="cart-close-icon">
								<a href="#"><i class="ti-close"></i></a>
							</span>
							<div class="image">
								<a href="shop-product-basic.html">
									<img src="{{ url('lezada/images/cart-product-image/01.jpg')}}" class="img-fluid" alt="">
								</a>
							</div>
							<div class="content">
								<h5><a href="shop-product-basic.html">Dark Brown Leather Watch</a></h5>
								<p><span class="cart-count">2 x </span> <span class="discounted-price">$180.00</span></p>

							</div>
						</div>

						<!--=======  End of single cart product  =======-->
						<!--=======  single cart product  =======-->

						<div class="single-cart-product">
							<span class="cart-close-icon">
								<a href="#"><i class="ti-close"></i></a>
							</span>
							<div class="image">
								<a href="shop-product-basic.html">
									<img src="{{ url('lezada/images/cart-product-image/02.jpg')}}" class="img-fluid" alt="">
								</a>
							</div>
							<div class="content">
								<h5><a href="shop-product-basic.html">Dining Chair</a></h5>
								<p><span class="cart-count">2 x </span> <span class="discounted-price">$220.00</span></p>

							</div>
						</div>

						<!--=======  End of single cart product  =======-->
						<!--=======  single cart product  =======-->

						<div class="single-cart-product">
							<span class="cart-close-icon">
								<a href="#"><i class="ti-close"></i></a>
							</span>
							<div class="image">
								<a href="shop-product-basic.html">
									<img src="lezada/images/cart-product-image/03.jpg" class="img-fluid" alt="">
								</a>
							</div>
							<div class="content">
								<h5><a href="shop-product-basic.html">Creative Wooden Stand</a></h5>
								<p><span class="cart-count">2 x </span> <span class="discounted-price">$80.00</span></p>

							</div>
						</div>

						<!--=======  End of single cart product  =======-->
						<!--=======  single cart product  =======-->

						<div class="single-cart-product">
							<span class="cart-close-icon">
								<a href="#"><i class="ti-close"></i></a>
							</span>
							<div class="image">
								<a href="shop-product-basic.html">
									<img src="{{ url('lezada/images/cart-product-image/01.jpg')}}" class="img-fluid" alt="">
								</a>
							</div>
							<div class="content">
								<h5><a href="shop-product-basic.html">Dark Brown Leather Watch</a></h5>
								<p><span class="cart-count">2 x </span> <span class="discounted-price">$180.00</span></p>

							</div>
						</div>

						<!--=======  End of single cart product  =======-->
						<!--=======  single cart product  =======-->

						<div class="single-cart-product">
							<span class="cart-close-icon">
								<a href="#"><i class="ti-close"></i></a>
							</span>
							<div class="image">
								<a href="shop-product-basic.html">
									<img src="{{ url('lezada/images/cart-product-image/02.jpg')}}" class="img-fluid" alt="">
								</a>
							</div>
							<div class="content">
								<h5><a href="shop-product-basic.html">Creative Wooden Stand</a></h5>
								<p><span class="cart-count">2 x </span> <span class="discounted-price">$180.00</span></p>

							</div>
						</div>

						<!--=======  End of single cart product  =======-->
					</div>

					<!--=======  subtotal calculation  =======-->

					<p class="cart-subtotal">
						<span class="subtotal-title">Subtotal:</span>
						<span class="subtotal-amount">$200.00</span>
					</p>

					<!--=======  End of subtotal calculation  =======-->

					<!--=======  cart buttons  =======-->

					<div class="cart-buttons">
						<a href="shop-cart.html">view cart</a>
						<a href="shop-checkout.html">checkout</a>
					</div>

					<!--=======  End of cart buttons  =======-->

					<!--=======  free shipping text  =======-->

					<p class="free-shipping-text">
						Free Shipping on All Orders Over $100!
					</p>

					<!--=======  End of free shipping text  =======-->
				</div>
			</div>

			<!--=======  End of offcanvas cart content container   =======-->
		</div>
	</div>

	<!--=======  End of cart overlay  =======-->


	<!--=======  search overlay  =======-->

	<div class="search-overlay" id="search-overlay">

		<!--=======  close icon  =======-->

		<span class="close-icon search-close-icon">
			<a href="javascript:void(0)" id="search-close-icon">
				<i class="ti-close"></i>
			</a>
		</span>

		<!--=======  End of close icon  =======-->

		<!--=======  search overlay content  =======-->

		<div class="search-overlay-content">
			<div class="input-box">
				<form action="index.html">
					<input type="search" placeholder="Search Products...">
				</form>
			</div>
			<div class="search-hint">
				<span># Hit enter to search or ESC to close</span>
			</div>
		</div>

		<!--=======  End of search overlay content  =======-->
	</div>

	<!--=======  End of search overlay  =======-->

	<!--=====  End of overlay items  ======-->


	<!--=============================================
	=            quick view         =
	=============================================-->

	<div id="qv-1" class="cd-quick-view">
		<div class="cd-slider-wrapper">
			<ul class="cd-slider">
				<li class="selected"><img src="{{ url('lezada/images/products/cloth-1-2-600x800.jpg')}}" alt="Product 2"></li>
				<li><img src="{{ url('lezada/images/products/cloth-1-1-600x800.jpg')}}" alt="Product 1"></li>
			</ul> <!-- cd-slider -->

			<ul class="cd-slider-pagination">
				<li class="active"><a href="#0">1</a></li>
				<li><a href="#1">2</a></li>
			</ul> <!-- cd-slider-pagination -->

			<ul class="cd-slider-navigation">
				<li><a class="cd-prev" href="#0">Prev</a></li>
				<li><a class="cd-next" href="#0">Next</a></li>
			</ul> <!-- cd-slider-navigation -->
		</div> <!-- cd-slider-wrapper -->

		<div class="lezada-item-info cd-item-info ps-scroll">

			<h2 class="item-title">{{ $p->name }}</h2>
			<p class="price">
				<span class="main-price">$ {{ number_format($p->price,0,',', '.') }}</span>				
			</p>

			<p class="description">{{ $p->description }}</p>

			<span class="quickview-title">Quantity:</span>
			<div class="pro-qty d-inline-block mb-40">
				<input type="text" value="1">
			</div>

			<div class="add-to-cart-btn mb-25">

				<button class="lezada-button lezada-button--medium">add to cart</button>
			</div>

			<div class="quick-view-other-info">
				<table>
					<tr class="single-info">
						<td class="quickview-title">SKU: </td>
						<td class="quickview-value">{{ $p->sku }}</td>
					</tr>
					<tr class="single-info">
						<td class="quickview-title">Categories: </td>
						<td class="quickview-value">
							<a href="#">Fashion</a>,
							<a href="#">Men</a>,
							<a href="#">Sunglasses</a>
						</td>
					</tr>
					<tr class="single-info">
						<td class="quickview-title">Tags: </td>
						<td class="quickview-value">
							<a href="#">Fashion</a>,
							<a href="#">Men</a>
						</td>
					</tr>
					<tr class="single-info">
						<td class="quickview-title">Share on: </td>
						<td class="quickview-value">
							<ul class="quickview-social-icons">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
							</ul>
						</td>
					</tr>
				</table>
			</div>


		</div> <!-- cd-item-info -->
		<a href="#0" class="cd-close">Close</a>
	</div>
	@endsection
	