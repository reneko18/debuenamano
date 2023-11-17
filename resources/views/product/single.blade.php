@extends('includes.baseform')
@section('title')
{{ $product->meta_title }} - De Buena Mano
@endsection

@push('lezada-css')
	<!-- FontAwesome CSS -->
	<link href="{{ url('lezada/css/font-awesome.min.css')}}" rel="stylesheet">

	<!-- Ionicons CSS -->
	<link href="{{ url('lezada/css/ionicons.min.css')}}" rel="stylesheet">

	<!-- Themify CSS -->
	<link href="{{ url('lezada/css/themify-icons.css')}}" rel="stylesheet">

	<!-- Plugins CSS -->
	<link href="{{ url('lezada/css/plugins.css')}}" rel="stylesheet">

	<!-- Helper CSS -->
	<link href="{{ url('lezada/css/helper.css')}}" rel="stylesheet">

	<!-- Main CSS -->
	<link href="{{ url('lezada/css/main.css')}}" rel="stylesheet">

	<!-- Modernizer JS -->
	<script src="{{ url('lezada/js/vendor/modernizr-2.8.3.min.js')}}"></script>
@endpush

@section('content')
    <section class="container">
        <div class="row">
            <div class="col-md-6">
                <img class="img-fluid" src="{{ asset('img/test-img-single.png') }}" alt="test-img-single">
            </div>
            <div class="col-md-6">
                <div class="encabezado-producto bg-blanco-verdoso">
                    <span class="sku"><b>SKU</b> {{ $product->sku }}</span>
                    <h1>{{$product->name}}</h1>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid mr-10" src="{{ asset('img/test-user-sp.png') }}" alt="test-user">
                        <span><b>Publicado por {{ $product->user->name }} {{ $product->user->lastname }}</b> - hace dos semanas</span>
                    </div>
                    <p class="descripcion">
                        {{ $product->description }}
                    </p>
                </div>

                <div class="row d-flex align-items-center mb-60">
                    <div class="col-4">
                        <span class="precio">$ {{ number_format($product->price,0,',', '.') }}</span>
                    </div>
                    <div class="col-8 d-flex justify-content-end">					
							<add-cart-product :product-id="{{ $product->id }}"/>						
							{{-- <a href="{{ route("checkout.index",$product->slug) }}" class="btn boton-principal">añadir a tu carro</a> --}}                      
                        <button class="btn boton-favoritos">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="0 0 18 16" fill="none">
                                <path d="M15.6215 1.57252C13.7867 0.0089339 11.058 0.290179 9.37385 2.02787L8.71426 2.70755L8.05468 2.02787C6.3739 0.290179 3.64181 0.0089339 1.80702 1.57252C-0.295619 3.36713 -0.406108 6.58806 1.47555 8.53333L7.95423 15.2229C8.37275 15.6549 9.05243 15.6549 9.47094 15.2229L15.9496 8.53333C17.8346 6.58806 17.7241 3.36713 15.6215 1.57252Z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="detalle-producto mb-60">
                    <div class="tabs-product">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">CARACTERISTICAS</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">DETALLES</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col">
                                        <div>
                                            <span class="title-in-tab">Categoría</span>
                                            <span class="txt-in-tab">{{ $product->category->name }}</span>
                                        </div>
                                        <div>
                                            <span class="title-in-tab">Género</span>
                                            <span class="txt-in-tab">Unisex</span>
                                        </div>
                                        <div>
                                            <span class="title-in-tab">Tiempo de uso</span>
                                            <span class="txt-in-tab">{{ $product->used_time}}</span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div>
                                            <span class="title-in-tab">Marca</span>
                                            <span class="txt-in-tab">{{ $product->brand}}</span>
                                        </div>
                                        <div>
                                            <span class="title-in-tab">Edad</span>
                                            <span class="txt-in-tab">Recién nacido a 2 años</span>
                                        </div>
                                        <div>
                                            <span class="title-in-tab">Estado</span>
                                            <span class="txt-in-tab">{{ $product->status->name }}</span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div>
                                            <span class="title-in-tab">Modelo</span>
                                            <span class="txt-in-tab">7888-207</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="col">
                                    <div>
                                        <span class="title-in-tab">Dimensiones y peso</span>
                                        <div class="row">
                                            <div class="col">
                                                <span>largo: {{$product->length}} cm</span>
                                            </div>
                                            <div class="col">
                                                <span>ancho: {{$product->width}} cm</span>
                                            </div>
                                            <div class="col">
                                                <span>altura: {{$product->height}} cm</span>
                                            </div>
                                            <div class="col">
                                                <span>peso: {{$product->weight}}kg</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="title-in-tab">Observación</span>
                                        <p>{{$product->remark}}</p>
                                    </div>
                                    <div>
                                        <span class="title-in-tab">Recomendación</span>
                                        <p>{{$product->advice}}</p>
                                    </div>

                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="container">
        <h2>Artículos Sugeridos</h2>
		<!--=============================================
		=            shop page content         =
		=============================================-->

		<div class="shop-page-content mt-100 mb-100">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 order-2 order-lg-1 d-none">
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
													<img src="assets/images/products/product-furniture-2-100x100.jpg" class="img-fluid" alt="">
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
													<img src="assets/images/products/product-furniture-11-100x100.jpg" class="img-fluid" alt="">
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
													<img src="assets/images/products/soccer-4-100x100.jpg" class="img-fluid" alt="">
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
					<div class="col-lg-12 order-1 order-lg-2 mb-md-80 mb-sm-80">

						<div class="row product-isotope shop-product-wrap four-column">
                            @foreach($allp as $ap)
							<!--=======  single product  =======-->
							<div class="col-12 col-lg-3 col-md-6 col-sm-6 mb-45 hot sale">
								<div class="single-product">
									<!--=======  single product image  =======-->

									<div class="single-product__image">
										<a class="image-wrap" href="shop-product-basic.html">
											<img src="{{ asset('img/test-img-single.png') }}" class="img-fluid" alt="">
											<img src="{{ asset('img/test-img-single.png') }}" class="img-fluid" alt="">
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
											<h3> <a href="shop-product-basic.html">{{ $ap->name }}</a></h3>
											<a href="#">Select options</a>
										</div>
										<div class="price">
											<span class="discounted-price">$ {{ number_format($ap->price,0,',', '.') }}</span>
										</div>
									</div>

									<!--=======  End of single product content  =======-->
								</div>
								<div class="single-product--list">
									<!--=======  single product image  =======-->

									<div class="single-product__image">
										<a class="image-wrap" href="shop-product-basic.html">
											<img src="{{ asset('img/test-user-sp.png') }}" class="img-fluid" alt="">
											<img src="{{ asset('img/test-user-sp.png') }}" class="img-fluid" alt="">
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
											<h3> <a href="shop-product-basic.html">High-waist Trousers</a></h3>
										</div>
										<div class="price">
											<span class="main-price discounted">$160.00</span>
											<span class="discounted-price">$180.00</span>
										</div>
										<p class="short-desc"> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laudantium
											consequuntur voluptatem ad molestiae. Expedita nesciunt quam totam, sapiente eveniet consectetur
											voluptas quas harum impedit quia quibusdam tempora ab facilis. Non assumenda veritatis,
										</p>

										<a href="#" class="lezada-button lezada-button--medium">ADD TO CART</a>

									</div>

									<!--=======  End of single product content  =======-->
								</div>
							</div>
							<!--=======  End of single product  =======-->
                            @endforeach
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--=====  End of shop page content  ======-->
    </section>
@endsection

@push('lezada-js')
	<!-- jQuery JS -->
	<script src="{{ url('lezada/js/vendor/jquery.min.js')}}"></script>

	<!-- Popper JS -->
	<script src="{{ url('lezada/js/popper.min.js')}}"></script>

	<!-- Bootstrap JS -->
	<script src="{{ url('lezada/js/bootstrap.min.js')}}"></script>

	<!-- Plugins JS -->
	<script src="{{ url('lezada/js/plugins.js')}}"></script>

	<!-- Main JS -->
	<script src="{{ url('lezada/js/main.js')}}"></script>
@endpush