@extends('includes.base')

@section('content')

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
						<li class="breadcrumb-list__item"><a href="shop-left-sidebar.html">SHOP</a></li>
						<li class="breadcrumb-list__item breadcrumb-list__item--active">SHOP PRODUCT</li>
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

	<div class="shop-page-wrapper mt-100 mb-100">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<!--=======  shop product content  =======-->

					<div class="shop-product">
						<div class="row pb-100">
							<div class="col-lg-6 mb-md-70 mb-sm-70">
								<!--=======  shop product big image gallery  =======-->

								<div class="shop-product__big-image-gallery-wrapper mb-30">

									<!--=======  shop product gallery icons  =======-->

									<div class="single-product__floating-badges single-product__floating-badges--shop-product">
										<span class="hot">hot</span>
									</div>


									<div class="shop-product-rightside-icons">
										<span class="wishlist-icon">
											<a href="#" data-tippy="Add to wishlist" data-tippy-placement="left" data-tippy-inertia="true"
												data-tippy-animation="shift-away" data-tippy-delay="50" data-tippy-arrow="true"
												data-tippy-theme="sharpborder"><i class="ion-android-favorite-outline"></i></a>
										</span>
										<span class="enlarge-icon">
											<a class="btn-zoom-popup" href="#" data-tippy="Click to enlarge" data-tippy-placement="left"
												data-tippy-inertia="true" data-tippy-animation="shift-away" data-tippy-delay="50"
												data-tippy-arrow="true" data-tippy-theme="sharpborder"><i class="ion-android-expand"></i></a>
										</span>
									</div>

									<!--=======  End of shop product gallery icons  =======-->

									<div class="shop-product__big-image-gallery-slider">

										<!--=======  single image  =======-->

										<div class="single-image">
											<img src="{{ url('lezada/images/shop-product/soccer-1.png')}}" class="img-fluid" alt="">
										</div>

										<!--=======  End of single image  =======-->

										<!--=======  single image  =======-->

										<div class="single-image">
											<img src="{{ url('lezada/images/shop-product/soccer-2.png')}}" class="img-fluid" alt="">
										</div>

										<!--=======  End of single image  =======-->

										<!--=======  single image  =======-->

										<div class="single-image">
											<img src="{{ url('lezada/images/shop-product/soccer-3.png')}}" class="img-fluid" alt="">
										</div>

										<!--=======  End of single image  =======-->

										<!--=======  single image  =======-->

										<div class="single-image">
											<img src="{{ url('lezada/images/shop-product/soccer-4.jpg')}}" class="img-fluid" alt="">
										</div>

										<!--=======  End of single image  =======-->

										<!--=======  single image  =======-->

										<div class="single-image">
											<img src="{{ url('lezada/images/shop-product/soccer-5.png')}}" class="img-fluid" alt="">
										</div>

										<!--=======  End of single image  =======-->

										<!--=======  single image  =======-->

										<div class="single-image">
											<img src="{{ url('lezada/images/shop-product/trendcoat-1.jpg')}}" class="img-fluid" alt="">
										</div>

										<!--=======  End of single image  =======-->

										<!--=======  single image  =======-->

										<div class="single-image">
											<img src="{{ url('lezada/images/shop-product/trendcoat-2.jpg')}}" class="img-fluid" alt="">
										</div>

										<!--=======  End of single image  =======-->
									</div>

								</div>

								<!--=======  End of shop product big image gallery  =======-->

								<!--=======  shop product small image gallery  =======-->

								<div class="shop-product__small-image-gallery-wrapper">

									<div class="shop-product__small-image-gallery-slider">

										<!--=======  single image  =======-->

										<div class="single-image">
											<img src="{{ url('lezada/images/shop-product/soccer-1-100x100.png')}}" class="img-fluid" alt="">
										</div>

										<!--=======  End of single image  =======-->

										<!--=======  single image  =======-->

										<div class="single-image">
											<img src="{{ url('lezada/images/shop-product/soccer-2-100x100.png')}}" class="img-fluid" alt="">
										</div>

										<!--=======  End of single image  =======-->

										<!--=======  single image  =======-->

										<div class="single-image">
											<img src="{{ url('lezada/images/shop-product/soccer-3-100x100.png')}}" class="img-fluid" alt="">
										</div>

										<!--=======  End of single image  =======-->

										<!--=======  single image  =======-->

										<div class="single-image">
											<img src="{{ url('lezada/images/shop-product/soccer-4-100x100.jpg')}}" class="img-fluid" alt="">
										</div>

										<!--=======  End of single image  =======-->

										<!--=======  single image  =======-->

										<div class="single-image">
											<img src="{{ url('lezada/images/shop-product/soccer-5-100x100.png')}}" class="img-fluid" alt="">
										</div>

										<!--=======  End of single image  =======-->

										<!--=======  single image  =======-->

										<div class="single-image">
											<img src="{{ url('lezada/images/shop-product/trendcoat-1-100x100.jpg')}}" class="img-fluid" alt="">
										</div>

										<!--=======  End of single image  =======-->

										<!--=======  single image  =======-->

										<div class="single-image">
											<img src="{{ url('lezada/images/shop-product/trendcoat-2-100x100.jpg')}}" class="img-fluid" alt="">
										</div>

										<!--=======  End of single image  =======-->
									</div>

								</div>

								<!--=======  End of shop product small image gallery  =======-->
							</div>

							<div class="col-lg-6">
								<!--=======  shop product description  =======-->

								<div class="shop-product__description">
									<!--=======  shop product navigation  =======-->

									<div class="shop-product__navigation">
										<a href="shop-product-basic.html"><i class="ion-ios-arrow-thin-left"></i></a>
										<a href="shop-product-basic.html"><i class="ion-ios-arrow-thin-right"></i></a>
									</div>

									<!--=======  End of shop product navigation  =======-->

									<!--=======  shop product rating  =======-->

									<div class="shop-product__rating mb-15">
										<span class="product-rating">
											<i class="active ion-android-star"></i>
											<i class="active ion-android-star"></i>
											<i class="active ion-android-star"></i>
											<i class="active ion-android-star"></i>
											<i class="ion-android-star-outline"></i>
										</span>

										<span class="review-link ml-20">
											<a href="#">(3 customer reviews)</a>
										</span>
									</div>

									<!--=======  End of shop product rating  =======-->

									<!--=======  shop product title  =======-->

									<div class="shop-product__title mb-15">
										<h2>{{ $product->name }}</h2>
										<p>Nombre: {{ $product->user->name }}</p>
										<p>Categoria: {{ $product->category->name }}</p>
										<p>Estado: {{ $product->status->name }}</p>										
										<p><span>Largo: {{ $product->length }}</span> <span>Ancho: {{ $product->width }}</span> <span>Alto: {{ $product->height }}</span></p>
										<p>Peso: {{ $product->weight }}</p>
									</div>

									<!--=======  End of shop product title  =======-->

									<!--=======  shop product price  =======-->

									<div class="shop-product__price mb-30">
										<span class="main-price">$ {{ number_format($product->price,0,',', '.') }}</span>										
									</div>

									<!--=======  End of shop product price  =======-->

									<!--=======  shop product short description  =======-->

									<div class="shop-product__short-desc mb-50">
                                        {{ $product->description }}
									</div>

									<!--=======  End of shop product short description  =======-->

									<!--=======  shop product size block  =======-->

									<div class="shop-product__block shop-product__block--size mb-20">
										<div class="shop-product__block__title">Size: </div>
										<div class="shop-product__block__value">
											<div class="shop-product-size-list">
												<span class="single-size">L</span>
												<span class="single-size">M</span>
												<span class="single-size">S</span>
												<span class="single-size">XS</span>
											</div>
										</div>
									</div>

									<!--=======  End of shop product size block  =======-->

									<!--=======  shop product color block  =======-->

									<div class="shop-product__block shop-product__block--color mb-20">
										<div class="shop-product__block__title">Color: </div>
										<div class="shop-product__block__value">
											<div class="shop-product-color-list">

												<ul class="single-filter-widget--list single-filter-widget--list--color">
													<li class="mb-0 pt-0 pb-0 mr-10"><a class="active" href="#"><span
																class="color-picker black"></span></a></li>
													<li class="mb-0 pt-0 pb-0 mr-10"><a href="#"><span class="color-picker blue"></span></a></li>
													<li class="mb-0 pt-0 pb-0 mr-10"><a href="#"><span class="color-picker brown"></span></a></li>

												</ul>
											</div>
										</div>
									</div>

									<!--=======  End of shop product color block  =======-->

									<!--=======  shop product quantity block  =======-->

									<div class="shop-product__block shop-product__block--quantity mb-40">
										<div class="shop-product__block__title">Quantity: </div>
										<div class="shop-product__block__value">
											<div class="pro-qty d-inline-block mx-0 pt-0">
												<input type="text" value="1">
											</div>
										</div>
									</div>

									<!--=======  End of shop product quantity block  =======-->

									<!--=======  shop product buttons  =======-->

									<div class="shop-product__buttons mb-40">
										<a class="lezada-button lezada-button--medium" href="#">add to cart</a>
										<a class="lezada-compare-button ml-20" href="#" data-tippy="Compare" data-tippy-inertia="true"
											data-tippy-animation="shift-away" data-tippy-delay="50" data-tippy-placement="left"
											data-tippy-arrow="true" data-tippy-theme="sharpborder"><i class="ion-ios-shuffle"></i></a>
									</div>

									<!--=======  End of shop product buttons  =======-->

									<!--=======  shop product brands  =======-->

									<div class="shop-product__brands mb-20">

										<a href="#">
											<img src="{{ url('lezada/images/brands/brand-1.png')}}" class="img-fluid" alt="">
										</a>

										<a href="#">
											<img src="{{ url('lezada/images/brands/brand-2.png')}}" class="img-fluid" alt="">
										</a>

									</div>

									<!--=======  End of shop product brands  =======-->

									<!--=======  other info table  =======-->

									<div class="quick-view-other-info pb-0">
										<table>
											<tr class="single-info">
												<td class="quickview-title">SKU: </td>
												<td class="quickview-value">{{ $product->sku }}</td>
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

									<!--=======  End of other info table  =======-->
								</div>

								<!--=======  End of shop product description  =======-->
							</div>
						</div>

						<div class="row">
							<div class="col-lg-12">
								<!--=======  shop product description tab  =======-->

								<div class="shop-product__description-tab pt-100">
									<!--=======  tab navigation  =======-->

									<div class="tab-product-navigation tab-product-navigation--product-desc mb-50">
										<div class="nav nav-tabs justify-content-center" id="nav-tab2" role="tablist">
											<a class="nav-item nav-link active" id="product-tab-1" data-bs-toggle="tab" href="#product-series-1"
												role="tab" aria-selected="true">Description</a>
											<a class="nav-item nav-link" id="product-tab-2" data-bs-toggle="tab" href="#product-series-2"
												role="tab" aria-selected="false">Additional information</a>
											<a class="nav-item nav-link" id="product-tab-3" data-bs-toggle="tab" href="#product-series-3"
												role="tab" aria-selected="false">Reviews (3)</a>
										</div>
									</div>

									<!--=======  End of tab navigation  =======-->

									<!--=======  tab content  =======-->

									<div class="tab-content" id="nav-tabContent2">

										<div class="tab-pane fade show active" id="product-series-1" role="tabpanel"
											aria-labelledby="product-tab-1">
											<!--=======  shop product long description  =======-->

											<div class="shop-product__long-desc mb-30">
												<p>{{ $product->description }}</p>
											</div>

											<!--=======  End of shop product long description  =======-->
										</div>

										<div class="tab-pane fade" id="product-series-2" role="tabpanel" aria-labelledby="product-tab-2">
											<!--=======  shop product additional information  =======-->

											<div class="shop-product__additional-info">
												<table class="shop-attributes">
													<tbody>
														<tr>
															<th>Size</th>
															<td>
																<p>L, M, S, XS</p>
															</td>
														</tr>
														<tr>
															<th>Color</th>
															<td>
																<p>Black, Blue, Brown</p>
															</td>
														</tr>
													</tbody>
												</table>
											</div>

											<!--=======  End of shop product additional information  =======-->
										</div>

										<div class="tab-pane fade" id="product-series-3" role="tabpanel" aria-labelledby="product-tab-3">
											<!--=======  shop product reviews  =======-->

											<div class="shop-product__review">
												<h2 class="review-title mb-20">3 reviews for High-waist Trousers</h2>

												<!--=======  single review  =======-->

												<div class="single-review">
													<div class="single-review__image">
														<img src="{{ url('lezada/images/user/user1.jpeg')}}" class="img-fluid" alt="">
													</div>
													<div class="single-review__content">
														<!--=======  rating  =======-->

														<div class="shop-product__rating">
															<span class="product-rating">
																<i class="active ion-android-star"></i>
																<i class="active ion-android-star"></i>
																<i class="active ion-android-star"></i>
																<i class="active ion-android-star"></i>
																<i class="ion-android-star-outline"></i>
															</span>
														</div>

														<!--=======  End of rating  =======-->

														<!--=======  username and date  =======-->

														<p class="username">Scott James <span class="date">/ April 5, 2022</span></p>

														<!--=======  End of username and date  =======-->

														<!--=======  message  =======-->

														<p class="message">
															Thanks for always keeping your HTML themes up to date. Your level of support and
															dedication is second to none.
														</p>

														<!--=======  End of message  =======-->
													</div>
												</div>

												<!--=======  End of single review  =======-->

												<!--=======  single review  =======-->

												<div class="single-review">
													<div class="single-review__image">
														<img src="{{ url('lezada/images/user/user2.jpeg')}}" class="img-fluid" alt="">
													</div>
													<div class="single-review__content">
														<!--=======  rating  =======-->

														<div class="shop-product__rating">
															<span class="product-rating">
																<i class="active ion-android-star"></i>
																<i class="active ion-android-star"></i>
																<i class="active ion-android-star"></i>
																<i class="active ion-android-star"></i>
																<i class="ion-android-star-outline"></i>
															</span>
														</div>

														<!--=======  End of rating  =======-->

														<!--=======  username and date  =======-->

														<p class="username">Owen Christ <span class="date">/ April 7, 2022</span></p>

														<!--=======  End of username and date  =======-->

														<!--=======  message  =======-->

														<p class="message">
															I didn’t expect this poster to arrive folded. Now there are lines on the poster and one
															sad Ninja.
														</p>

														<!--=======  End of message  =======-->
													</div>
												</div>

												<!--=======  End of single review  =======-->

												<!--=======  single review  =======-->

												<div class="single-review">
													<div class="single-review__image">
														<img src="{{ url('lezada/images/user/user3.jpeg')}}" class="img-fluid" alt="">
													</div>
													<div class="single-review__content">
														<!--=======  rating  =======-->

														<div class="shop-product__rating">
															<span class="product-rating">
																<i class="active ion-android-star"></i>
																<i class="active ion-android-star"></i>
																<i class="active ion-android-star"></i>
																<i class="active ion-android-star"></i>
																<i class="ion-android-star-outline"></i>
															</span>
														</div>

														<!--=======  End of rating  =======-->

														<!--=======  username and date  =======-->

														<p class="username">Edna Watson <span class="date">/ April 5, 2022</span></p>

														<!--=======  End of username and date  =======-->

														<!--=======  message  =======-->

														<p class="message">
															Can’t wait to start mixin’ with this one! Irba-irr-Up-up-up-up-date your theme!
														</p>

														<!--=======  End of message  =======-->
													</div>
												</div>

												<!--=======  End of single review  =======-->

												<h2 class="review-title mb-20">Add a review</h2>
												<p class="text-center">Your email address will not be published. Required fields are marked *
												</p>

												<!--=======  review form  =======-->

												<div class="lezada-form lezada-form--review">
													<form action="#">
														<div class="row">
															<div class="col-lg-6 mb-20">
																<input type="text" placeholder="Name *" required>
															</div>
															<div class="col-lg-6 mb-20">
																<input type="email" placeholder="Email *" required>
															</div>
															<div class="col-lg-12 mb-20">
																<span class="rating-title mr-30">YOUR RATING</span>
																<span class="product-rating">

																	<i class="active ion-android-star-outline"></i>
																	<i class="active ion-android-star-outline"></i>
																	<i class="active ion-android-star-outline"></i>
																	<i class="active ion-android-star-outline"></i>
																	<i class="active ion-android-star-outline"></i>
																</span>
															</div>
															<div class="col-lg-12 mb-20">
																<textarea cols="30" rows="10" placeholder="Your review *"></textarea>
															</div>
															<div class="col-lg-12 text-center">
																<button type="submit" class="lezada-button lezada-button--medium">submit</button>
															</div>
														</div>
													</form>
												</div>

												<!--=======  End of review form  =======-->


											</div>

											<!--=======  End of shop product reviews  =======-->
										</div>

									</div>

									<!--=======  End of tab content  =======-->
								</div>

								<!--=======  End of shop product description tab  =======-->
							</div>
						</div>
					</div>

					<!--=======  End of shop product content  =======-->
				</div>
			</div>
		</div>
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
									<img src="{{ url('lezada/images/cart-product-image/03.jpg')}}" class="img-fluid" alt="">
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
@endsection