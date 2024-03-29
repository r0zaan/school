@extends('frontend.layouts.master')

@section('content')
    <style>
        span.price-dc {
            text-decoration: line-through;
            color: #b3b3b3 !important;
        }

        .hidden {
            display: none;
        }

        .color-display div {
            height: 25px;
            width: 25px;
            border-radius: 20px;
            display: inline-block;
            margin: 10px;
            border: 1px solid black;
        }

    </style>
    <div class="hero-wrap hero-bread" style="background-image: url({{url('frontend/images/bg_6.jpg')}});">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span class="mr-2"><a
                                    href="index.html">Product</a></span> <span>Product Single</span></p>
                    <h1 class="mb-0 bread">Product Single</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                @foreach($product->colorImages()->get() as $key => $image)
                    <div class="col-lg-6 mb-5 ftco-animate image-view-product @if($key != 0) hidden @endif"
                         id="imageVisible{{$image->id}}">
                        <a href="{{url($image->image)}}" class="image-popup "><img
                                    src="{{url($image->image)}}" class="img-fluid"
                                    alt="Colorlib Template"></a>
                    </div>
                @endforeach

                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <h3>{{$product->name}}</h3>
                    <div class="rating d-flex">
                        <p class="text-left mr-4">
                            <a href="#" class="mr-2">5.0</a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                        </p>
                        <p class="text-left mr-4">
                            <a href="#" class="mr-2" style="color: #000;">100 <span
                                        style="color: #bbb;">Rating</span></a>
                        </p>
                        <p class="text-left">
                            <a href="#" class="mr-2" style="color: #000;">500 <span style="color: #bbb;">Sold</span></a>
                        </p>
                    </div>
                    @if(isset($product->discount_percentage))
                        <p class="price">
                            <span class="mr-2 price-dc">Rs {{$product->price}}</span>
                            <span
                                    class="price-sale">Rs {{$product->discount_price}}</span></p>
                    @else
                        <p class="price"><span>Rs  {{$product->price}}</span></p>
                    @endif
                    {!! $product->description !!}
                    <div class="row mt-4">
                        <div class="col-md-12 ">Color</div>

                        <div class="col-md-12 color-display">
                            @foreach($product->colorImages()->get() as $key => $color)
                                <a href="JavaScript:void(0);" class="changeColor test" data-id="{{$color->id}}">
                                    <div style="background-color: {{$color->color_code}};"></div>
                                </a>
                            @endforeach
                        </div>
                        <div class="col-md-6">
                            <div class="form-group d-flex">
                                <div class="select-wrap">
                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                    <select name="" id="" class="form-control">
                                        <option value="">Small</option>
                                        <option value="">Medium</option>
                                        <option value="">Large</option>
                                        <option value="">Extra Large</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="input-group col-md-6 d-flex mb-3">
                                <span class="input-group-btn mr-2">
                                <button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
                                <i class="ion-ios-remove"></i>
                                </button>
                                </span>
                            <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1"
                                   min="1" max="100">
                            <span class="input-group-btn ml-2">
                                <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                <i class="ion-ios-add"></i>
                                </button>
                                </span>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <p style="color: #000;">{{$product->colorImages()->sum('quantity')}} piece available</p>
                        </div>
                    </div>
                    <p><a href="cart.html" class="btn btn-black py-3 px-5">Add to Cart</a></p>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h2 class="mb-4">Ralated Products</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm col-md-6 col-lg ftco-animate">
                    <div class="product">
                        <a href="#" class="img-prod"><img class="img-fluid" src="images/product-1.jpg"
                                                          alt="Colorlib Template">
                            <span class="status">30%</span>
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 px-3">
                            <h3><a href="#">Floral Jackquard Pullover</a></h3>
                            <div class="d-flex">
                                <div class="pricing">
                                    <p class="price"><span class="mr-2 price-dc">$120.00</span><span class="price-sale">$80.00</span>
                                    </p>
                                </div>
                                <div class="rating">
                                    <p class="text-right">
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                    </p>
                                </div>
                            </div>
                            <p class="bottom-area d-flex px-3">
                                <a href="#" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i
                                                class="ion-ios-add ml-1"></i></span></a>
                                <a href="#" class="buy-now text-center py-2">Buy now<span><i
                                                class="ion-ios-cart ml-1"></i></span></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm col-md-6 col-lg ftco-animate">
                    <div class="product">
                        <a href="#" class="img-prod"><img class="img-fluid" src="images/product-2.jpg"
                                                          alt="Colorlib Template">
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 px-3">
                            <h3><a href="#">Floral Jackquard Pullover</a></h3>
                            <div class="d-flex">
                                <div class="pricing">
                                    <p class="price"><span>$120.00</span></p>
                                </div>
                                <div class="rating">
                                    <p class="text-right">
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                    </p>
                                </div>
                            </div>
                            <p class="bottom-area d-flex px-3">
                                <a href="#" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i
                                                class="ion-ios-add ml-1"></i></span></a>
                                <a href="#" class="buy-now text-center py-2">Buy now<span><i
                                                class="ion-ios-cart ml-1"></i></span></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm col-md-6 col-lg ftco-animate">
                    <div class="product">
                        <a href="#" class="img-prod"><img class="img-fluid" src="images/product-3.jpg"
                                                          alt="Colorlib Template">
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 px-3">
                            <h3><a href="#">Floral Jackquard Pullover</a></h3>
                            <div class="d-flex">
                                <div class="pricing">
                                    <p class="price"><span>$120.00</span></p>
                                </div>
                                <div class="rating">
                                    <p class="text-right">
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                    </p>
                                </div>
                            </div>
                            <p class="bottom-area d-flex px-3">
                                <a href="#" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i
                                                class="ion-ios-add ml-1"></i></span></a>
                                <a href="#" class="buy-now text-center py-2">Buy now<span><i
                                                class="ion-ios-cart ml-1"></i></span></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm col-md-6 col-lg ftco-animate">
                    <div class="product">
                        <a href="#" class="img-prod"><img class="img-fluid" src="images/product-4.jpg"
                                                          alt="Colorlib Template">
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 px-3">
                            <h3><a href="#">Floral Jackquard Pullover</a></h3>
                            <div class="d-flex">
                                <div class="pricing">
                                    <p class="price"><span>$120.00</span></p>
                                </div>
                                <div class="rating">
                                    <p class="text-right">
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                    </p>
                                </div>
                            </div>
                            <p class="bottom-area d-flex px-3">
                                <a href="#" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i
                                                class="ion-ios-add ml-1"></i></span></a>
                                <a href="#" class="buy-now text-center py-2">Buy now<span><i
                                                class="ion-ios-cart ml-1"></i></span></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(function () {

            $(document).on('click', '.test', function () {
                var id = $(this).attr('data-id');
                var data = '#imageVisible' + id;
                $('.image-view-product').each(function () {
                    if (!$(this).hasClass('hidden')) {
                        $(this).addClass('hidden');
                    }
                });
                $(data).removeClass('hidden')
            })
        })

    </script>
@endsection