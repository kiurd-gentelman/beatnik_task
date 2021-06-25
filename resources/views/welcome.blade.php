<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!--    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/slick.css')}}" />
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/slick-theme.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}" />

</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('welcome')}}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
            </ul>
        </div>
    </div>

</nav>
@if($categories && $home_banner)
    <!--category-->
    <div>
        <div class="nav container" id="myTab" role="tablist">
            <ul class="nav mx-auto">
                @php
                    $d = 0;
                @endphp
                @forelse($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link {{($d==0)?'active':''}}" id="home-tab{{$category->id}}" data-toggle="tab" href="#home{{$category->id}}" role="tab" aria-controls="home{{$category->id}}" aria-selected="{{($d== 0)?'true':'false'}}">
                            <img class="nav-link active" src="{{Storage::url($category->image)}}" width="120px">
                        </a>
                    </li>
                    @php $d++@endphp
                @empty
                    <li class="nav-item">
                        No Data Found
                    </li>
                @endforelse
            </ul>
        </div>
        <div class="w-100">
            <p class="custom-offer-badge d-flex align-items-center justify-content-center" id="custom-offer-badge">
                Get 3% Daily Cash back with Apple Card. And pay for your new Apple Watch over 24 months, interest‑free when you choose Apple Card Monthly Installments.*
                <a href="#">Learn more></a>
            </p>
        </div>

        <div class="container tab-content" id="myTabContent">
            @php $c= 0  @endphp
            @forelse($categories as $category)
                <div class="tab-pane fade {{$c== 0?'show active':''}}" id="home{{$category->id}}" role="tabpanel" aria-labelledby="home-tab{{$category->id}}">
                    <!--carusel start-->


                    <div id="carouselExampleControls{{$category->id}}" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner ">
                            @php $a=0; @endphp
                            @forelse($category->product as $product)
                                <div class="carousel-item {{($a== 0 )?'active':''}}">
                                    {{--                        <img class="d-block w-100" src="{{Storage::url($product->image)}}" alt="First slide" style="">--}}

                                    <div class="row">
                                        <div class="col-md-6 banner-content text-white">
                                            <div class="d-flex align-items-center justify-content-center h-100">
                                                <div class="d-block ">
                                                    <h2>{{$product->name}}</h2>
                                                </div>
                                                <div class="d-block "><a class="btn btn-sm btn-danger " href="{{route('view_details',$product->id)}}"> buy Now</a></div>

                                            </div>

                                        </div>
                                        <div class="col-md-6"> <img class="d-block w-100" src="{{Storage::url($product->image)}}" alt="First slide"></div>
                                    </div>
                                </div>
                                @php $a++@endphp
                            @empty
                                No
                            @endforelse
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls{{$category->id}}" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls{{$category->id}}" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                    <!--carusel end-->

                </div>
                @php $c++@endphp
            @empty
                no
            @endforelse
        </div>
    </div>

    {{--Home Banner--}}

    <section>
        <div id="carouselExampleControls" class="carousel slide mt-5 container" data-ride="carousel">
            <h1 class="text-center">Which Apple Watch is right for you?</h1>
            <div class="carousel-inner">
                @php $banner_count = 0 @endphp
                @forelse($home_banner as $banner_item)
                    <div class="carousel-item {{($banner_count == 0 )?'active':''}}">
                        <div class="row">
                            <div class="col-md-6 banner-content text-white">
                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <h1>{{$banner_item->content}}</h1>
                                    <a href="{{route('view_details',$banner_item->product_id)}}" class="btn btn-danger">Buy Now</a>
                                </div>

                            </div>
                            <div class="col-md-6"> <img class="d-block w-100" src="{{Storage::url($banner_item->image)}}" alt="First slide"></div>
                        </div>

                        @php $banner_count++@endphp
                    </div>
                @empty
                    no data
                @endforelse
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>

    <section style="height: max-content;  display: block;">
        <div style=" height: 200px; width: 200px; top: 50%; position: relative;">
            {{--        <img src="https://help.apple.com/assets/600F108EB67A7B74502B78B5/600F1093B67A7B74502B78C6/en_US/24feed96eca1791c2815bc0132497e32.png" alt="" style=" height: 200px; width: 200px;">--}}
        </div>
        <div class="container slick-slider mt-5">
            @forelse($category->product as $slide_product)
                <div class="" style="width: 18rem">
                    <div>
                        <img src="{{Storage::url($slide_product->image)}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">
                            <h3>Apple Watch Series 6</h3>
                            <p><b> From $399</b></p>
                            <p> 44mm or 40mm case size Always-On Retina display

                            <p>GPS + Cellular1 GPS</p>
                            <p> Blood Oxygen app2 ECG app3 High and low heart rate notifications
                            </p>

                            <p>Irregular heart rhythm notification4 Supports Family Setup5 (GPS + Cellular models) Water resistant 50 meters6</p>
                            <div>
                                <a href="{{route('view_details',$slide_product->id)}}" class="btn btn-primary rounded">buy now</a>
                            </div>
                            <a  class=" ">Learn more> </a>
                        </div>
                    </div>
                </div>
            @empty
                no
            @endforelse
            <div class=" " style="width: 18rem;">
                <div>
                    <img src="https://s.alicdn.com/@sc04/kf/H2fe05c67095e465db387bc3dae6c18e35.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">
                        <h3>Apple Watch Series 6</h3>
                        <p><b> From $399</b></p>
                        </p>
                        <p> 44mm or 40mm case size Always-On Retina display GPS + Cellular1 GPS Blood Oxygen app2 ECG app3 High and low heart rate notifications Irregular heart rhythm notification4 Supports Family Setup5 (GPS + Cellular models) Water resistant
                            50 meters6</p>
                        <div>
                            <a href="#" class="btn btn-primary rounded">buy</a>
                        </div>
                        <a href="#" class=" ">Learn more> </a>
                    </div>
                </div>
            </div>
        </div>

    </section>

    @else
    Please go for create Category and product and all banner otherwise page gives some warning!!
    <a href="{{route('home')}}" class="text-danger">Got to admin</a>
@endif

<footer class="footer-area footer--light mt-4">
    <div class="footer-big">
        <!-- start .container -->
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <div class="footer-widget">
                        <div class="widget-about">
                            <img src="http://placehold.it/250x80" alt="" class="img-fluid">
                            <p>Apple Card Monthly Installments (ACMI) is a payment option available to select at checkout for certain Apple products purchased at Apple Store locations, apple.com, the Apple Store app, or by calling 1-800-MY-APPLE, and is subject to credit approval and credit limit. See https://support.apple.com/kb/HT211204 for more information about eligible products. Variable APRs for Apple Card other than ACMI range from 10.99% to 21.99% based on creditworthiness. Rates as of April 1, 2020. If you choose the pay-in-full or one-time-payment option for an ACMI eligible purchase instead of choosing ACMI as the payment option at checkout, that purchase will be subject to the variable APR assigned to your Apple Card. Taxes and shipping are not included in ACMI and are subject to your card’s variable APR. See the Apple Card Customer Agreement for more information. ACMI is not available for purchases made online at the following special stores: Apple Employee Purchase Plan; participating corporate Employee Purchase Programs; Apple at Work for small businesses; Government, and Veterans and Military Purchase Programs. iPhone activation required on iPhone purchases made at an Apple Store with one of these national carriers: AT&T, Sprint, Verizon, or T-Mobile.
                                Wireless service plan required for cellular service. Contact your service provider for more details. Connection may vary based on network availability. International roaming is not supported. Check apple.com/watch/cellular for participating wireless carriers and eligibility. See support.apple.com/en-us/HT207578 for additional setup instructions.
                                Blood Oxygen app measurements are not intended for medical use, including self-diagnosis or consultation with a doctor, and are only designed for general fitness and wellness purposes.
                                The ECG app is available on Apple Watch Series 4 and later (not including Apple Watch SE) with the latest version of iOS and watchOS. See apple.com/watch for compatibility details. ECG is not intended for use by people under 22 years old. With the ECG app, Apple Watch is capable of generating an ECG similar to a single-lead electrocardiogram.
                                Irregular rhythm notification requires the latest version of watchOS and iOS. It is not intended for use by people under 22 years old or those who have been previously diagnosed with atrial fibrillation (Afib).
                                Not all features will be available if the Apple Watch is set up through Family Setup. Wireless service plan required for cellular service. Contact your service provider for more details. Check apple.com/watch/cellular for participating wireless carriers and eligibility.
                                Apple Watch Series 6, Apple Watch SE, and Apple Watch Series 3 have a water resistance rating of 50 meters under ISO standard 22810:2010. This means that they may be used for shallow-water activities like swimming in a pool or ocean. However, they should not be used for scuba diving, waterskiing, or other activities involving high-velocity water or submersion below shallow depth.
                                $9.99/month after free trial. No commitment. Plan automatically renews after trial until cancelled.
                                Trade‑in value based on an Apple Watch Series 5 Stainless Steel 44MM Cellular in good condition. Must be at least 18. Offer may not be available in all stores and not all devices are eligible for credit. Apple reserves the right to refuse or limit the quantity of any device for any reason. In‑store trade‑in requires presentation of a valid, government‑issued photo ID (local law may require saving this information). Value of your current device may be applied toward purchase of a new Apple device. Additional terms at apple.com/trade-in.
                                The Apple One free trial includes only services that you are not currently using through a free trial or a subscription. Plan automatically renews after trial until cancelled. Restrictions and other terms apply.
                                To access and use all the features of Apple Card, you must add Apple Card to Wallet on an iPhone or iPad with iOS or iPadOS 13.2 or later. Update to the latest version of iOS or iPadOS by going to Settings > General > Software Update. Tap Download and Install.
                                Available for qualifying applicants in the United States.
                                Apple Card is issued by Goldman Sachs Bank USA, Salt Lake City Branch.
                                Case and band combinations can be made within collections (Apple Watch, Apple Watch Nike, and Apple Watch Hermès) only.
                                Apple Watch Series 6, Apple Watch SE, and Apple Watch Series 3 require an iPhone 6s or later with iOS 14 or later.
                                Features are subject to change. Some features, applications, and services may not be available in all regions or all languages. View complete list.</p>
                            <ul class="contact-details">
                                <li>
                                    <span class="icon-earphones"></span> Call Us:
                                    <a href="tel:344-755-111">344-755-111</a>
                                </li>
                                <li>
                                    <span class="icon-envelope-open"></span>
                                    <a href="mailto:support@aazztech.com">support@aazztech.com</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Ends: .footer-widget -->
                </div>
                <!-- end /.col-md-4 -->
                <div class="col-md-3 col-sm-4">
                    <div class="footer-widget">
                        <div class="footer-menu footer-menu--1">
                            <h4 class="footer-widget-title">Popular Category</h4>
                            <ul>
                                <li>
                                    <a href="#">Wordpress</a>
                                </li>
                                <li>
                                    <a href="#">Plugins</a>
                                </li>
                                <li>
                                    <a href="#">Joomla Template</a>
                                </li>
                                <li>
                                    <a href="#">Admin Template</a>
                                </li>
                                <li>
                                    <a href="#">HTML Template</a>
                                </li>
                            </ul>
                        </div>
                        <!-- end /.footer-menu -->
                    </div>
                    <!-- Ends: .footer-widget -->
                </div>
                <!-- end /.col-md-3 -->

                <div class="col-md-3 col-sm-4">
                    <div class="footer-widget">
                        <div class="footer-menu">
                            <h4 class="footer-widget-title">Our Company</h4>
                            <ul>
                                <li>
                                    <a href="#">About Us</a>
                                </li>
                                <li>
                                    <a href="#">How It Works</a>
                                </li>
                                <li>
                                    <a href="#">Affiliates</a>
                                </li>
                                <li>
                                    <a href="#">Testimonials</a>
                                </li>
                                <li>
                                    <a href="#">Contact Us</a>
                                </li>
                                <li>
                                    <a href="#">Plan &amp; Pricing</a>
                                </li>
                                <li>
                                    <a href="#">Blog</a>
                                </li>
                            </ul>
                        </div>
                        <!-- end /.footer-menu -->
                    </div>
                    <!-- Ends: .footer-widget -->
                </div>
                <!-- end /.col-lg-3 -->

                <div class="col-md-3 col-sm-4">
                    <div class="footer-widget">
                        <div class="footer-menu no-padding">
                            <h4 class="footer-widget-title">Help Support</h4>
                            <ul>
                                <li>
                                    <a href="#">Support Forum</a>
                                </li>
                                <li>
                                    <a href="#">Terms &amp; Conditions</a>
                                </li>
                                <li>
                                    <a href="#">Support Policy</a>
                                </li>
                                <li>
                                    <a href="#">Refund Policy</a>
                                </li>
                                <li>
                                    <a href="#">FAQs</a>
                                </li>
                                <li>
                                    <a href="#">Buyers Faq</a>
                                </li>
                                <li>
                                    <a href="#">Sellers Faq</a>
                                </li>
                            </ul>
                        </div>
                        <!-- end /.footer-menu -->
                    </div>
                    <!-- Ends: .footer-widget -->
                </div>
                <!-- Ends: .col-lg-3 -->

            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </div>
    <!-- end /.footer-big -->

    <div class="mini-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright-text">
                        <p>© 2018
                            <a href="#">DigiPro</a>. All rights reserved. Created by
                            <a href="#">AazzTech</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{asset('assets/js/slick.min.js')}}"></script>
<script>
    $('.slick-slider').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3
    });
</script>
</body>

</html>
