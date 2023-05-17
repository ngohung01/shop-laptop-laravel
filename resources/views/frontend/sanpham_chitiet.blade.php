@extends('layouts.frontend')

@section('title', $sanpham->tensanpham)

@section('content')
	<div class="breadcrumb_section bg_gray page-title-mini">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6">
					<div class="page-title">
						<h1>{{ $sanpham->tensanpham }}</h1>
					</div>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb justify-content-md-end">
						<li class="breadcrumb-item"><a href="{{ route('frontend') }}">Trang chủ</a></li>
						<li class="breadcrumb-item"><a href="{{ route('frontend.sanpham.danhmuc', ['tenloai_slug' => $loaisanpham->tenloai_slug]) }}">{{ $loaisanpham->tenloai }}</a></li>
						{{-- <li class="breadcrumb-item active">{{ $sanpham->tensanpham }}</li> --}}
					</ol>
				</div>
			</div>
		</div>
	</div>
	
	<div class="main_content">
		<div class="section">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6 mb-4 mb-md-0">
						<div class="product-image">
							<div class="product_img_box">
								<img id="product_img" src="{{ env('APP_URL') . '/storage/app/' . $sanpham->hinhanh }}" data-zoom-image="{{ env('APP_URL') . '/storage/app/' . $sanpham->hinhanh }}" />
								<a href="" class="product_img_zoom" title="Zoom">
									<span class="linearicons-zoom-in"></span>
								</a>
							</div>
							<div id="pr_item_gallery" class="product_gallery_item slick_slider" data-slides-to-show="4" data-slides-to-scroll="1" data-infinite="false">
								@foreach ($sanphamlienquan as $item)
									<div class="item">
										<a href="{{ route('frontend.sanpham.chitiet', ['tenloai_slug' => $item->LoaiSanPham->tenloai_slug, 'tensanpham_slug' => $item->tensanpham_slug]) }}" class="product_gallery_item active" data-image="{{ env('APP_URL') . '/storage/app/' . $item->hinhanh }}" data-zoom-image="assets/images/product_zoom_img1.jpg">
											<img src="{{ env('APP_URL') . '/storage/app/' . $item->hinhanh }}" />
										</a>
									</div>
								@endforeach
								{{-- <div class="item">
									<a href="#" class="product_gallery_item active" data-image="{{ env('APP_URL') . '/storage/app/' . $sanpham->hinhanh }}" data-zoom-image="assets/images/product_zoom_img1.jpg">
										<img src="{{ env('APP_URL') . '/storage/app/' . $sanpham->hinhanh }}" />
									</a>
								</div>
								<div class="item">
									<a href="#" class="product_gallery_item active" data-image="{{ env('APP_URL') . '/storage/app/' . $sanpham->hinhanh }}" data-zoom-image="assets/images/product_zoom_img1.jpg">
										<img src="{{ env('APP_URL') . '/storage/app/' . $sanpham->hinhanh }}" />
									</a>
								</div>
								<div class="item">
									<a href="#" class="product_gallery_item active" data-image="{{ env('APP_URL') . '/storage/app/' . $sanpham->hinhanh }}" data-zoom-image="assets/images/product_zoom_img1.jpg">
										<img src="{{ env('APP_URL') . '/storage/app/' . $sanpham->hinhanh }}" />
									</a>
								</div>
								<div class="item">
									<a href="#" class="product_gallery_item active" data-image="{{ env('APP_URL') . '/storage/app/' . $sanpham->hinhanh }}" data-zoom-image="assets/images/product_zoom_img1.jpg">
										<img src="{{ env('APP_URL') . '/storage/app/' . $sanpham->hinhanh }}" />
									</a>
								</div>
								<div class="item">
									<a href="#" class="product_gallery_item active" data-image="{{ env('APP_URL') . '/storage/app/' . $sanpham->hinhanh }}" data-zoom-image="assets/images/product_zoom_img1.jpg">
										<img src="{{ env('APP_URL') . '/storage/app/' . $sanpham->hinhanh }}" />
									</a>
								</div>
								<div class="item">
									<a href="#" class="product_gallery_item active" data-image="{{ env('APP_URL') . '/storage/app/' . $sanpham->hinhanh }}" data-zoom-image="assets/images/product_zoom_img1.jpg">
										<img src="{{ env('APP_URL') . '/storage/app/' . $sanpham->hinhanh }}" />
									</a>
								</div> --}}
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="pr_detail">
							<div class="product_description">
								<h4 class="product_title">{{ $sanpham->tensanpham }}</h4>
								<div class="product_price">
									<span class="price">{{ number_format($sanpham->dongia) }}<sup>đ</sup></span>
									<del>{{ number_format($sanpham->dongia * 1.3) }}<sup>đ</sup></del>
									<div class="on_sale">
										<span>Giảm giá 13%</span>
									</div>
								</div>
								<div class="rating_wrap">
									<div class="rating">
										<div class="product_rate" style="width:80%"></div>
									</div>
									<span class="rating_num">(100)</span>
								</div>
								<div class="pr_desc">
									<p>{{$sanpham->motasanpham}}</p>
								</div>
								<div class="product_sort_info">
									<ul>
										<li><i class="linearicons-shield-check"></i> 1 năm bảo hành theo nhà sản xuất</li>
										<li><i class="linearicons-sync"></i> 30 ngày đổi trả</li>
										<li><i class="linearicons-bag-dollar"></i> Hỗ trợ giao hàng tận nơi</li>
									</ul>
								</div>
								
								<div class="pr_switch_wrap">
									<span class="switch_lable">Dung lượng</span>
									<div class="product_size_switch">
										<span>16GB</span>
										<span>32GB</span>
										<span>64GB</span>
										<span>128GB</span>
										<span>512GB</span>
									</div>
								</div>
							</div>
							<hr />
							<div class="cart_extra">
								{{-- <!-- <div class="cart-product-quantity">
								@foreach(Cart::content() as $value)
									<div class="quantity">
										<a class="minus" href="{{ route('frontend.giohang.giam', ['row_id' => $value->rowId]) }}">-</a>
										<input type="text" name="qty" value="{{ $value->qty }}" class="qty" size="4" />
										<a class="plus" href="{{ route('frontend.giohang.tang', ['row_id' => $value->rowId]) }}">+</a>
									</div>
									@endforeach
								</div> --> --}}
								<div class="cart_btn">
									<a href="{{ route('frontend.giohang.them', ['tensanpham_slug' => $sanpham->tensanpham_slug]) }}" class="btn btn-fill-out btn-addtocart" type="button"><i class="icon-basket-loaded"></i> Thêm vào giỏ hàng</a>
									<a class="add_compare" href="#"><i class="icon-shuffle"></i></a>
									<div class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="false"></div>
									<div class="fb-share-button" data-href="{{$url_canonical}}" data-layout="button_count" data-size="small"><a target="_blank" href="{{$url_canonical}}" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
								</div>
							</div>
							<hr />
							<ul class="product-meta">
								<li>SKU: <a href="#">BE45VGRT</a></li>
								<li>Danh mục: <a href="#">{{ $loaisanpham->tenloai }}</a></li>
								<li>Tags: <a href="#" rel="tag">{{ $loaisanpham->tenloai_slug }}</a>, <a href="#" rel="tag">printed</a></li>
							</ul>
							<div class="product_share">
								<span>Chia sẻ:</span>
								<ul class="social_icons">
									<li><a href="#"><i class="ion-social-facebook"></i></a></li>
									<li><a href="#"><i class="ion-social-twitter"></i></a></li>
									<li><a href="#"><i class="ion-social-googleplus"></i></a></li>
									<li><a href="#"><i class="ion-social-youtube-outline"></i></a></li>
									<li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="large_divider clearfix"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="tab-style3">
							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="Description-tab" data-toggle="tab" href="#Description" role="tab" aria-controls="Description" aria-selected="true">Thông tin sản phẩm</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="Additional-info-tab" data-toggle="tab" href="#Additional-info" role="tab" aria-controls="Additional-info" aria-selected="false">Thông số kỹ thuật</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="Reviews-tab" data-toggle="tab" href="#Reviews" role="tab" aria-controls="Reviews" aria-selected="false">Đánh giá ({{$dg->count()}})</a>
								</li>
							</ul>
							<div class="tab-content shop_info_tab">
								<div class="tab-pane fade show active" id="Description" role="tabpanel" aria-labelledby="Description-tab">
									<p>Bài viết mô tả về sản phẩm <b>{{ $sanpham->tensanpham }}</b> .</p>
									 @if (!empty($sanpham->motasanpham))
										 <p>{{$sanpham->motasanpham}}</p>
									 @else
									 <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Vivamus bibendum magna Lorem ipsum dolor sit amet, consectetur adipiscing elit.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
									 <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
									 @endif
								</div>
								<div class="tab-pane fade" id="Additional-info" role="tabpanel" aria-labelledby="Additional-info-tab">
									<table class="table table-bordered">
										<tr>
											<td>Capacity</td>
											<td>5 Kg</td>
										</tr>
										<tr>
											<td>Color</td>
											<td>Black, Brown, Red,</td>
										</tr>
										<tr>
											<td>Water Resistant</td>
											<td>Yes</td>
										</tr>
										<tr>
											<td>Material</td>
											<td>Artificial Leather</td>
										</tr>
									</table>
								</div>
								<div class="tab-pane fade" id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">
									<div class="comments">
										<h5 class="product_tab_title">Có {{$dg->count()}} đánh giá cho sản phẩm <span>{{ $sanpham->tensanpham }}</span></h5>
										@foreach($dg as $value)
										<ul class="list_none comment_list mt-4">
											<li>
												
												<div class="comment_img">
													<img src="{{ asset('public/assets/images/avatar.png') }}" />
												</div>
												<div class="comment_block">
													<div class="rating_wrap">
														<div class="rating">
															{{-- Đánh giá --}}
															<div class="product_rate" style="width:60%"></div>
														</div>
													</div>
													<p class="customer_meta">
														<span class="review_author">{{$value->name}}</span>
														<span class="comment-date">{{$value->created_at->format('d/m/Y')}}</span>
													</p>
													<div class="description">
														<p>{{$value->noidung}}</p>
													</div>
												</div>
											</li>
										</ul>
										@endforeach
									</div>
									<div class="review_form field_form">
										<h5>Đánh giá của bạn</h5>
										<form class="row mt-3" action="{{route('frontend.sanpham.danhgia')}}" method="post" enctype="multipart/form-data">
										@csrf
											<div class="form-group col-12">
												<div class="star_rating" name = "rate">
													<span data-value="1"><i class="far fa-star"></i></span>
													<span data-value="2"><i class="far fa-star"></i></span>
													<span data-value="3"><i class="far fa-star"></i></span>
													<span data-value="4"><i class="far fa-star"></i></span>
													<span data-value="5"><i class="far fa-star"></i></span>
												</div>
											</div>
											<div class="form-group col-12">
											<input type="hidden" name ="id" value="{{$sanpham->id}}"/>
												<textarea required="required" placeholder="Nội dung đánh giá *" class="form-control" name="message" rows="4"></textarea>
											</div>
											<div class="form-group col-md-6">
												<input required="required" placeholder="Họ và tên *" class="form-control" name="name" type="text">
											</div>
											<div class="form-group col-md-6">
												<input required="required" placeholder="Địa chỉ Email *" class="form-control" name="email" type="email">
											</div>
											<div class="form-group col-12">
												<button type="submit" class="btn btn-fill-out" name="submit">Gởi đánh giá</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="small_divider"></div>
						<div class="divider"></div>
						<div class="medium_divider"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="heading_s1">
							<h3>Sản phẩm liên quan</h3>
						</div>
						<div class="releted_product_slider carousel_slider owl-carousel owl-theme" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
							@foreach($sanphamlienquan as $value)
								<div class="item">
									<div class="product">
										<span class="pr_flash">Mới</span>
										<div class="product_img">
											<a href="{{ route('frontend.sanpham.chitiet', ['tenloai_slug' => $value->LoaiSanPham->tenloai_slug, 'tensanpham_slug' => $value->tensanpham_slug]) }}">
												<img src="{{ env('APP_URL') . '/storage/app/' . $value->hinhanh }}" />
											</a>
											<div class="product_action_box">
												<ul class="list_none pr_action_btn">
													<li class="add-to-cart"><a href="{{ route('frontend.giohang.them', ['tensanpham_slug' => $value->tensanpham_slug]) }}"><i class="icon-basket-loaded"></i> Thêm vào giỏ hàng</a></li>
													<li><a href="#" class="popup-ajax"><i class="icon-shuffle"></i></a></li>
													<li><a href="#" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
													<li><a href="#"><i class="icon-heart"></i></a></li>
												</ul>
											</div>
										</div>
										<div class="product_info">
											<h6 class="product_title">
												<a href="{{ route('frontend.sanpham.chitiet', ['tenloai_slug' => $value->LoaiSanPham->tenloai_slug, 'tensanpham_slug' => $value->tensanpham_slug]) }}">{{ $value->tensanpham }}</a>
											</h6>
											<div class="product_price">
												<span class="price">{{ number_format($value->dongia) }}<sup>đ</sup></span>
												<del>{{ number_format($value->dongia * 1.3) }}<sup>đ</sup></del>
												<div class="on_sale">
													<span>Giảm giá 13%</span>
												</div>
											</div>
											<div class="rating_wrap">
												<div class="rating">
													<div class="product_rate" style="width:80%"></div>
												</div>
												<span class="rating_num">(100)</span>
											</div>
											<div class="pr_desc">
												<p>Mô tả ngắn gọn về sản phẩm {{ $value->tensanpham }}.</p>
											</div>
											<div class="pr_switch_wrap">
												<div class="product_color_switch">
													<span class="active" data-color="#87554B"></span>
													<span data-color="#333333"></span>
													<span data-color="#DA323F"></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection