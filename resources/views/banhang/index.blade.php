@extends('layouts.master')

@section('content')


	<div class="rev-slider">
	<div class="fullwidthbanner-container">
					<div class="fullwidthbanner">
						<div class="bannercontainer" >
					    <div class="banner" >
								<ul>
									<!-- THE FIRST SLIDE -->
									<li data-transition="boxfade" data-slotamount="20" class="active-revslide" style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
						            <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined" data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined" data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined" data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined" data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined" data-oheight="undefined">
													<div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" data-lazydone="undefined" src="/source/image/slide/banner1.jpg" data-src="/source/image/slide/banner1.jpg" style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('/source/image/slide/banner1.jpg'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
													</div>
												</div>

						        </li>
								<li data-transition="boxfade" data-slotamount="20" class="active-revslide" style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
						          <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined" data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined" data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined" data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined" data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined" data-oheight="undefined">
												<div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" data-lazydone="undefined" src="/source/image/slide/banner1.jpg" data-src="/source/image/slide/banner1.jpg" style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('/source/image/slide/banner1.jpg'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
											</div>
											</div>

								<li data-transition="boxfade" data-slotamount="20" class="active-revslide" style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
						            <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined" data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined" data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined" data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined" data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined" data-oheight="undefined">
													<div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" data-lazydone="undefined" src="/source/image/slide/banner1.jpg" data-src="/source/image/slide/banner1.jpg" style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('/source/image/slide/banner1.jpg'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
												</div>
											</div>

						        </li>

								<li data-transition="boxfade" data-slotamount="20" class="active-revslide current-sr-slide-visible" style="width: 100%; height: 100%; overflow: hidden; visibility: inherit; opacity: 1; z-index: 20;">
						            <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined" data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined" data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined" data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined" data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined" data-oheight="undefined">
													<div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" data-lazydone="undefined" src="/source/image/slide/banner1.jpg" data-src="/source/image/slide/banner1.jpg" style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('/source/image/slide/banner1.jpg'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
												</div>
											</div>

						        </li>
								</ul>
							</div>
						</div>

						<div class="tp-bannertimer"></div>
					</div>
				</div>
				<!--slider-->
	</div>
	<!-- resources/views/banhang/index.blade.php -->
<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
            <div class="row">
                @php $stt = 0; @endphp
                @foreach($new_products as $new_product)
                    @php $stt++; @endphp
                    <div class="col-sm-3">
                        <div class="single-item">
                            @if($new_product->promotion_price != 0)
                                <div class="ribbon-wrapper">
                                    <div class="ribbon sale">Sale</div>
                                </div>
                            @endif
                            <div class="single-item-header">
                                <a href="{{ route('banhang.productDetail', $new_product->id) }}">
                                    <img src="{{ asset('source/image/product/' . $new_product->image) }}" alt="{{ $new_product->name }}" height="250px">
                                </a>
                            </div>
                            <div class="single-item-body">
                                <p class="single-item-title">{{ $new_product->name }}</p>
                                <p class="single-item-price" style="font-size: 15px; font-weight: bold;">
                                    @if($new_product->promotion_price == 0)
                                        <span class="flash-sale">{{ number_format($new_product->unit_price) }} đồng</span>
                                    @else
                                        <span class="flash-del">{{ number_format($new_product->unit_price) }} đồng</span>
                                        <span class="flash-sale">{{ number_format($new_product->promotion_price) }} đồng</span>
                                    @endif
                                </p>
                            </div>
                            <div class="single-item-caption">
                                <a class="add-to-cart pull-left" href="{{ route('banhang.addtocart',$new_product->id) }}"><i class="fa fa-shopping-cart"></i></a>
                                <a class="beta-btn primary" href="{{ route('banhang.productDetail', $new_product->id) }}">Chi tiết <i class="fa fa-chevron-right"></i></a>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    @if($stt % 4 == 0)
                        <div class="space40">&nbsp;</div>
                    @endif
                @endforeach
            </div> <!-- .beta-products-list -->
        </div> <!-- .main-content -->
    </div> <!-- #content -->
</div> <!-- .container -->

@endsection





