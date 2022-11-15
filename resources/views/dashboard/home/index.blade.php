<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Store</title>
    <!-- favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('dashboard_files/assets/images/favicons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('dashboard_files/assets/images/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('dashboard_files/assets/images/favicons/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('dashboard_files/assets/images/favicons/site.webmanifest')}}">
    <!-- plugin styles -->
{{--    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">--}}
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
{{--    <link rel="stylesheet" href="{{asset('dashboard_files/assets/css/bootstrap.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('dashboard_files/assets/css/bootstrap.min.rtl.css')}}">
{{--    <link rel="stylesheet" href="{{asset('dashboard_files/assets/css/bootstrap-datepicker.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('dashboard_files/assets/css/bootstrap-datepicker.min.rtl.css')}}">
{{--    <link rel="stylesheet" href="{{asset('dashboard_files/assets/css/bootstrap-select.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('dashboard_files/assets/css/bootstrap-select.min.rtl.css')}}">
{{--    <link rel="stylesheet" href="{{asset('dashboard_files/assets/css/animate.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('dashboard_files/assets/css/animate.min.rtl.css')}}">
{{--    <link rel="stylesheet" href="{{asset('dashboard_files/assets/css/fontawesome-all.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('dashboard_files/assets/css/fontawesome-all.min.rtl.css')}}">
{{--    <link rel="stylesheet" href="{{asset('dashboard_files/assets/css/magnific-popup.css')}}">--}}
    <link rel="stylesheet" href="{{asset('dashboard_files/assets/css/magnific-popup.rtl.css')}}">
{{--    <link rel="stylesheet" href="{{asset('dashboard_files/assets/css/jquery.bxslider.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('dashboard_files/assets/css/jquery.bxslider.min.rtl.css')}}">
{{--    <link rel="stylesheet" href="{{asset('dashboard_files/assets/css/owl.carousel.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('dashboard_files/assets/css/owl.carousel.min.rtl.css')}}">
{{--    <link rel="stylesheet" href="{{asset('dashboard_files/assets/css/owl.theme.default.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('dashboard_files/assets/css/owl.theme.default.min.rtl.css')}}">
{{--    <link rel="stylesheet" href="{{asset('dashboard_files/assets/css/swiper.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('dashboard_files/assets/css/swiper.min.rtl.css')}}">
{{--    <link rel="stylesheet" href="{{asset('dashboard_files/assets/css/oapee-icons.css')}}">--}}
    <link rel="stylesheet" href="{{asset('dashboard_files/assets/css/oapee-icons.rtl.css')}}">
    <!-- template styles -->
{{--    <link rel="stylesheet" href="{{asset('dashboard_files/assets/css/style.css')}}">--}}
    <link rel="stylesheet" href="{{asset('dashboard_files/assets/css/style.rtl.css')}}">
{{--    <link rel="stylesheet" href="{{asset('dashboard_files/assets/css/responsive.css')}}">--}}
    <link rel="stylesheet" href="{{asset('dashboard_files/assets/css/responsive.rtl.css')}}">
</head>

<body>

    <div class="preloader">
        {{--<img src="{{url(Storage::url($loading->value ?? ''))}}" class="preloader__image" alt="">--}}
        <img src="{{ asset('storage/app/public/' . $loading->value )  }}" class="preloader__image" alt="">
    </div><!-- /.preloader -->

    <div class="page-wrapper">


        <header class="site-header-one stricky site-header-one__fixed-top">
            <div class="container-fluid">
                <div class="site-header-one__logo">
                    <a class="scrollToLink" href="#home">
                        {{--<img src="{{url(Storage::url($logo_header->value ?? ''))}}" width="136" alt="">--}}
                        <img src="{{ asset('storage/app/public/' . $logo_header->value) }}" width="136" alt="">
                    </a>
                    <span class="side-menu__toggler"><i class="fa fa-bars"></i></span><!-- /.side-menu__toggler -->
                </div><!-- /.site-header-one__logo -->
                <div class="main-nav__main-navigation one-page-scroll-menu">
                    <ul class="main-nav__navigation-box">
                        <li class="scrollToLink">
                            <a href="#home">الرئيسية</a>
                        </li>
                        <li class="scrollToLink"><a href="#features">الميزات</a></li>
                        <li class="scrollToLink"><a href="#screens">صور التطبيق</a></li>
                        <li class="scrollToLink"><a href="#question">الأسئلة المتكررة</a></li>
                    </ul><!-- /.main-nav__navigation-box -->
                </div><!-- /.main-nav__main-navigation -->
                <div class="main-nav__right">
                    <a href="tel:777-888-0000" class="main-nav__cta">
                        <img src="{{asset('dashboard_files/assets/images/shapes/header-phone-1-1.png')}}" alt="">
                        <span>
                            <i>متاح 24 ساعة</i>
                            <b>{{$phone->value ?? ''}}</b>
                        </span>
                    </a><!-- /.main-nav__cta -->
                    <a href="{{$download_link->value ?? ''}}" class="thm-btn main-nav__btn"><span>Download App</span></a>
                </div><!-- /.main-nav__right -->
            </div><!-- /.container-fluid -->
        </header><!-- /.site-header-one -->

        <section class="banner-one" id="home">

            <img src="{{asset('dashboard_files/assets/images/shapes/banner-shape-1-1.png')}}" class="banner-one__bg-shape-1" alt="">
            <img src="{{asset('dashboard_files/assets/images/shapes/banner-shape-1-2.png')}}" class="banner-one__bg-shape-2" alt="">
            <img src="{{asset('dashboard_files/assets/images/shapes/banner-shape-1-3.png')}}" class="banner-one__bg-shape-3" alt="">
            <img src="{{asset('dashboard_files/assets/images/shapes/banner-shape-1-4.png')}}" class="banner-one__bg-shape-4" alt="">
            <img src="{{asset('dashboard_files/assets/images/shapes/banner-shape-1-5.png')}}" class="banner-one__bg-shape-5" alt="">

            <div class="container">
                <div class="row">
                    <div class="col-lg-6 d-flex">
                        <div class="my-auto">
                            <div class="banner-one__content">
                                <h3>أهلا بكم في <br> {{$title->value ?? ''}}</h3>
                                <p>نوفر لك أفضل تجربة للتسوق الإلكتروني، <br>مع ضمان توصيل أي منتج خلال 24 ساعة أو أقل، إلى باب منزلك، في كل مناطق قطاع غزة.</p>
{{--                                <a href="#" class="thm-btn banner-one__btn"><span>Discover More</span></a>--}}
                                <!-- /.thm-btn banner-one__btn -->
                            </div><!-- /.banner-one__content -->
                        </div><!-- /.my-auto -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6 d-flex justify-content-end wow fadeInUp" data-wow-duration="1500ms">
                        <div class="banner-one__image">

                            {{--<img src="{{url(Storage::url($photo_home->value ?? ''))}}" alt="">--}}
                            <img src="{{ asset('storage/app/public/' . $photo_home->value) }}" alt="">

                        </div><!-- /.banner-one__image -->
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.banner-one -->

        <section class="service-one" id="features">
            <div class="container">
                <div class="block-title text-center">
                    <h3>يوفر متجر اليوكاس بعض <span>الميزات</span></h3>
{{--                    <p>Lorem ipsum is are many variations of pass of majority.</p>--}}
                </div><!-- /.block-title -->
                <div class="row">

                    @foreach($features as $feature)
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="0ms">
                        <div class="service-one__single">
                            <h3>{{$feature->value ?? ''}}</h3>
{{--                            <p>Lorem ipsum is are many variations of pass.</p>--}}
                            <div class="service-one__icon">
{{--                                <i class="oapee-icon-laptop"></i>--}}
                            </div><!-- /.service-one__icon -->
                        </div><!-- /.service-one__single -->
                    </div><!-- /.col-lg-3 col-md-6 col-sm-12 -->
                    @endforeach
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.service-one -->


        <section class="app-shot-one" id="screens">
            <div class="container-fluid">
                <div class="block-title text-center">
                    <h3> صور تطبيق<span> اليوكاس</span> </h3>
{{--                    <p>Lorem ipsum is are many variations of pass of majority.</p>--}}
                </div><!-- /.block-title text-center -->


                <div class="app-shot-one__carousel owl-theme owl-carousel thm__owl-carousel" data-options='{ "loop": true, "margin": 30, "nav": false, "dots": true, "autoWidth": false, "autoplay": true, "smartSpeed": 700, "autoplayTimeout": 5000, "autoplayHoverPause": true, "slideBy": 5, "responsive": {
                    "0": { "items": 1 },
                    "480": { "items": 2 },
                    "600": { "items": 3 },
                    "991": { "items": 4 },
                    "1000": { "items": 5 },
                    "1200": { "items": 5 }
                }}'>
                    @foreach($screen_shot as $item)
                    <div class="item">
                        {{--<img src="{{url(Storage::url($item->value ?? ''))}}" alt="Awesome Image" />--}}
                        <img src="{{ asset('storage/app/public/' . $item->value) }}" alt="Awesome Image" />
                    </div><!-- /.item -->
                    @endforeach
                </div><!-- /.app-shot-one__carousel owl-theme owl-carousel -->
            </div><!-- /.container-fluid -->
        </section><!-- /.app-shot-one -->


        <section class="faq-one" id="question">
            <div class="container">
                <div class="block-title text-center">
                    <h3>أكثر الأسئلة <span>المتكررة</span></h3>
{{--                    <p>Lorem ipsum is are many variations of pass of majority.</p>--}}
                </div><!-- /.block-title text-center -->
{{--                <div class="nav nav-tabs faq-one__post-filter">--}}
{{--                    <a href="#general" class="nav-link active thm-btn" data-toggle="tab"><span>General</span></a>--}}
{{--                    <a href="#web" class="nav-link  thm-btn" data-toggle="tab"><span>Web and Desktop</span></a>--}}
{{--                    <a href="#windows" class="nav-link  thm-btn" data-toggle="tab"><span>Windows Phone</span></a>--}}
{{--                    <a href="#android" class="nav-link  thm-btn" data-toggle="tab"><span>Andriod</span></a>--}}
{{--                </div><!-- /.nav nav-tabs faq-one__post-filter -->--}}
                <div class="tab-content">
                    <div class="tab-pane fade show active animated fadeInUp" id="general">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="accrodion-grp " data-grp-name="faq-accrodion-1">
                                    <div class="accrodion active ">
                                        <div class="accrodion-inner">
                                            <div class="accrodion-title">
                                                <h4>{{$question_1->value ?? ''}}</h4>
                                            </div>
                                            <div class="accrodion-content">
                                                <div class="inner">
                                                    <p>{{$answer_1->value ?? ''}}.</p>
                                                </div><!-- /.inner -->
                                            </div>
                                        </div><!-- /.accrodion-inner -->
                                    </div>
                                    <div class="accrodion  ">
                                        <div class="accrodion-inner">
                                            <div class="accrodion-title">
                                                <h4>{{$question_2->value ?? ''}}</h4>
                                            </div>
                                            <div class="accrodion-content">
                                                <div class="inner">
                                                    <p>{{$answer_2->value ?? ''}}.</p>
                                                </div><!-- /.inner -->
                                            </div>
                                        </div><!-- /.accrodion-inner -->
                                    </div>
                                    <div class="accrodion ">
                                        <div class="accrodion-inner">
                                            <div class="accrodion-title">
                                                <h4>{{$question_3->value ?? ''}}</h4>
                                            </div>
                                            <div class="accrodion-content">
                                                <div class="inner">
                                                    <p>{{$answer_3->value ?? ''}}.</p>
                                                </div><!-- /.inner -->
                                            </div>
                                        </div><!-- /.accrodion-inner -->
                                    </div>
                                </div>
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-6">
                                <div class="accrodion-grp " data-grp-name="faq-accrodion-2">
                                    <div class="accrodion  ">
                                        <div class="accrodion-inner">
                                            <div class="accrodion-title">
                                                <h4>{{$question_4->value ?? ''}}</h4>
                                            </div>
                                            <div class="accrodion-content">
                                                <div class="inner">
                                                    <p>{{$answer_4->value ?? ''}}.</p>
                                                </div><!-- /.inner -->
                                            </div>
                                        </div><!-- /.accrodion-inner -->
                                    </div>
                                    <div class="accrodion active ">
                                        <div class="accrodion-inner">
                                            <div class="accrodion-title">
                                                <h4>{{$question_5->value ?? ''}}</h4>
                                            </div>
                                            <div class="accrodion-content">
                                                <div class="inner">
                                                    <p>{{$answer_5->value ?? ''}}.</p>
                                                </div><!-- /.inner -->
                                            </div>
                                        </div><!-- /.accrodion-inner -->
                                    </div>
                                    <div class="accrodion ">
                                        <div class="accrodion-inner">
                                            <div class="accrodion-title">
                                                <h4>{{$question_6->value ?? ''}}</h4>
                                            </div>
                                            <div class="accrodion-content">
                                                <div class="inner">
                                                    <p>{{$answer_6->value ?? ''}}.</p>
                                                </div><!-- /.inner -->
                                            </div>
                                        </div><!-- /.accrodion-inner -->
                                    </div>
                                </div>
                            </div><!-- /.col-lg-6 -->
                        </div><!-- /.row -->
                    </div><!-- /.tab-pane fade show active animated fadeInUp -->
                </div><!-- /.tab-content -->
            </div><!-- /.container -->
        </section><!-- /.faq-one -->

        <section class="cta-one">
            <div class="container">
                {{--<img src="{{url(Storage::url($background_download->value ?? ''))}}" class="cta-one__bg-shape-1" alt="">--}}
                <img src="{{ asset('storage/app/public/' . $background_download->value) }}" class="cta-one__bg-shape-1" alt="">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="cta-one__content">
                            <h3>قم بتحميل التطبيق <br> واستمتع بالخدمات المقدمة </h3>
{{--                            <p>and get started with a free 1 month trial for your business</p>--}}
                        </div><!-- /.cta-one__content -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-4 d-flex ">
                        <div class="my-auto d-flex justify-content-end">
                            <a href="{{$download_link->value ?? ''}}" class="thm-btn cta-one__btn"><span>تحميل التطبيق الآن</span></a>
                            <!-- /.thm-btn cta-one__btn -->
                        </div><!-- /.my-auto -->
                    </div><!-- /.col-lg-6 -->

                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.cta-one -->

        <footer class="site-footer">
            <div class="site-footer__upper">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-6">
                            <div class="footer-widget footer-widget__about">
                                <a href="#home" class="logo">
                                    {{--<img src="{{url(Storage::url($logo->value ?? ''))}}" width="136" alt="">--}}
                                    <img src="{{ asset('storage/app/public/' . $logo->value) }}" width="136" alt="">
                                </a>
                                <p>أهلا بكم في متجر اليوكاس
                                   <br> نوفر لك أفضل تجربة للتسوق الإلكتروني،<br>
                                    </p>
                                <a href="{{$download_link->value ?? ''}}" class="thm-btn"><span>تحميل التطبيق</span></a><!-- /.thm-btn -->
                            </div><!-- /.footer-widget footer-widget__about -->
                        </div><!-- /.col-lg-4 -->
{{--                        <div class="col-xl-2 col-lg-6">--}}
{{--                            <div class="footer-widget footer-widget__links">--}}
{{--                                <h3 class="footer-widget__title">Explore</h3><!-- /.footer-widget__title -->--}}
{{--                                <ul class="list-unstyled footer-widget__links-list">--}}
{{--                                    <li><a href="#">About</a></li>--}}
{{--                                    <li><a href="#">Our Team</a></li>--}}
{{--                                    <li><a href="#">Contact</a></li>--}}
{{--                                    <li><a href="#">Services</a></li>--}}
{{--                                </ul><!-- /.list-unstyled footer-widget__links-list -->--}}
{{--                            </div><!-- /.footer-widget footer-widget__links -->--}}
{{--                        </div><!-- /.col-lg-2 -->--}}
                        <div class="col-xl-2 col-lg-6">
                            <div class="footer-widget footer-widget__contact">
                                <h3 class="footer-widget__title">تواصل معنا</h3><!-- /.footer-widget__title -->
                                <ul class="footer-widget__contact-list list-unstyled">
                                    <li>
                                        <i class="fa fa-phone-square"></i>
                                        <a href="tel:777-888-0000">{{$phone->value ?? ''}}</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-envelope"></i>
                                        <a href="mailto:needhelp@oapee.com">{{$email->value ?? ''}}</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-map-marker"></i>
                                        {{$address->value ?? ''}}
                                    </li>
                                </ul><!-- /.footer-widget__contact-list list-unstyled -->
                            </div><!-- /.footer-widget footer-widget__contact -->
                        </div><!-- /.col-lg-2 -->
{{--                        <div class="col-xl-4 col-lg-6">--}}
{{--                            <div class="footer-widget footer-widget__newsletter">--}}
{{--                                <h3 class="footer-widget__title">Newsletter</h3>--}}
{{--                                <form action="#" class="footer-widget__newsletter-form">--}}
{{--                                    <input type="text" placeholder="Email address" name="email">--}}
{{--                                    <button type="submit"><i class="fa fa-envelope"></i></button>--}}
{{--                                </form><!-- /.footer-widget__newsletter-form -->--}}
{{--                                <p>Sign up for our latest news & articles. We won’t give you spam mails.</p>--}}
{{--                            </div><!-- /.footer-widget footer-widget__newsletter -->--}}
{{--                        </div><!-- /.col-lg-4 -->--}}
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.site-footer__upper -->
            <div class="site-footer__bottom">
                <div class="container">
                    <div class="inner-container">
                        <p>© copyright 2022 by OnlineStore.com</p>
                        <div class="footer-social">
                            <a href="{{$facebook_link->value ?? ''}}"><i class="fab fa-facebook-square"></i></a>
                            <a href="{{$twitter_link->value ?? ''}}"><i class="fab fa-twitter"></i></a>
                            <a href="{{$instagram_link ?? ''}}"><i class="fab fa-instagram"></i></a>
                        </div><!-- /.footer-social -->
                    </div><!-- /.inner-container -->
                </div><!-- /.container -->
            </div><!-- /.site-footer__bottom -->
        </footer><!-- /.site-footer -->
    </div><!-- /.page-wrapper -->

    <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>

    <div class="side-menu__block">
        <div class="side-menu__block-overlay custom-cursor__overlay">
            <div class="cursor"></div>
            <div class="cursor-follower"></div>
        </div><!-- /.side-menu__block-overlay -->
        <div class="side-menu__block-inner ">
            <div class="side-menu__top justify-content-end">

                <a href="#" class="side-menu__toggler side-menu__close-btn"><img
                        src="{{asset('dashboard_files/assets/images/shapes/close-1-1.png')}}" alt=""></a>
            </div><!-- /.side-menu__top -->


            <nav class="mobile-nav__container">
                <!-- content is loading via js -->
            </nav>
            <div class="side-menu__sep"></div><!-- /.side-menu__sep -->
            <div class="side-menu__content">
                <p>Lorem Ipsum is simply dummy text the printing and setting industry. Lorm Ipsum has been the
                    industry's stanard dummy text ever. </p>
                <p><a href="mailto:needhelp@oapee.com">needhelp@oapee.com</a> <br> <a href="tel:888-999-0000">888 999
                        0000</a></p>
                <div class="side-menu__social">
                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                </div>
            </div><!-- /.side-menu__content -->
        </div><!-- /.side-menu__block-inner -->
    </div><!-- /.side-menu__block -->

    <!-- Plugin scripts -->
    <script src="{{asset('dashboard_files/assets/js/jquery-3.5.0.min.js')}}"></script>
    <script src="{{asset('dashboard_files/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('dashboard_files/assets/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('dashboard_files/assets/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('dashboard_files/assets/js/isotope.js')}}"></script>
    <script src="{{asset('dashboard_files/assets/js/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{asset('dashboard_files/assets/js/jquery.bxslider.min.js')}}"></script>
    <script src="{{asset('dashboard_files/assets/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('dashboard_files/assets/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('dashboard_files/assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('dashboard_files/assets/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('dashboard_files/assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('dashboard_files/assets/js/swiper.min.js')}}"></script>
    <script src="{{asset('dashboard_files/assets/js/jquery.easing.min.js')}}"></script>
    <script src="{{asset('dashboard_files/assets/js/TweenMax.min.js')}}"></script>
    <script src="{{asset('dashboard_files/assets/js/wow.js')}}"></script>
    <script src="{{asset('dashboard_files/assets/js/theme.js')}}"></script>
</body>

</html>
