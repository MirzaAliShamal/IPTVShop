@extends('layouts.app')

@section('title', 'Help')
@section('page-title', 'Help')

@section('content')
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center my-5">
                        <div class="col-lg-11 col-md-12 col-12">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                                    <h3>For More Information</h3>
                                    <h1 class="fw-bolder">Contact us</h1>
                                    <div class="d-flex gap-3 mt-5">
                                        <a href=""><img src="{{ asset('app/images/whatsapp-icon.png') }}" width="60px" class="img-fluid" alt=""></a>
                                        <a href=""><img src="{{ asset('app/images/telegram-icon.png') }}" width="60px" class="img-fluid" alt=""></a>
                                        <a href=""><img src="{{ asset('app/images/gmail-icon.png') }}" width="60px" class="img-fluid" alt=""></a>
                                        <a href=""><img src="{{ asset('app/images/chat-icon.png') }}" width="60px" class="img-fluid" alt=""></a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                    <img src="{{ asset('app/images/contact-image.png') }}" class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 mb-5">
                                    <h3>We’re loved by our customers</h3>
                                </div>
                                <div class="col-12">
                                    <div class="accordion" id="accordionFAQ">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
                                                    What is TopIPTVShop?
                                                </button>
                                            </h2>
                                            <div id="faq1" class="accordion-collapse collapse show">
                                                <div class="accordion-body">
                                                    TopIPTVShop is a premium IPTV service that provides access to thousands of live TV channels, movies, series, and on-demand content. You can enjoy entertainment from all over the world, streamed directly to your device with high-quality video and minimal buffering.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="true" aria-controls="faq2">
                                                    How do I sign up for TopIPTVShop?
                                                </button>
                                            </h2>
                                            <div id="faq2" class="accordion-collapse collapse">
                                                <div class="accordion-body">
                                                    Signing up for TopIPTVShop is easy! Simply visit our website, choose the subscription plan that best suits your needs, and follow the registration process. Once completed, you will receive an email with setup instructions.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="true" aria-controls="faq3">
                                                    What devices are compatible with TopIPTVShop?
                                                </button>
                                            </h2>
                                            <div id="faq3" class="accordion-collapse collapse">
                                                <div class="accordion-body">
                                                    TopIPTVShop is compatible with a wide range of devices, including Smart TVs, Android and iOS smartphones, tablets, Firestick, Roku, MAG boxes, and computers (Windows and macOS). Our service works with popular IPTV apps like IPTV Smarters, Perfect Player, and others.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="true" aria-controls="faq4">
                                                    What content can I watch with TopIPTVShop?
                                                </button>
                                            </h2>
                                            <div id="faq4" class="accordion-collapse collapse">
                                                <div class="accordion-body">
                                                    TopIPTVShop provides access to thousands of live TV channels from various countries, including sports, news, movies, entertainment, and children's content. You can also enjoy a vast library of on-demand movies, TV series, and more.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="true" aria-controls="faq5">
                                                    Do I need a VPN to use TopIPTVShop?
                                                </button>
                                            </h2>
                                            <div id="faq5" class="accordion-collapse collapse">
                                                <div class="accordion-body">
                                                    Using a VPN is not mandatory for TopIPTVShop, but we recommend it for enhanced privacy and security, especially if you live in a region where IPTV usage is restricted or if you experience ISP throttling.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6" aria-expanded="true" aria-controls="faq6">
                                                    How do I set up TopIPTVShop on my device?
                                                </button>
                                            </h2>
                                            <div id="faq6" class="accordion-collapse collapse">
                                                <div class="accordion-body">
                                                    Once you've subscribed, we will send you an email with detailed setup instructions. Typically, you'll need to install an IPTV player app and enter your M3U or Xtream Codes provided by TopIPTVShop. Our support team is always available to assist with setup if needed.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq7" aria-expanded="true" aria-controls="faq7">
                                                    Is there a free trial available at TopIPTVShop?
                                                </button>
                                            </h2>
                                            <div id="faq7" class="accordion-collapse collapse">
                                                <div class="accordion-body">
                                                    Yes, TopIPTVShop offers a free trial for new users to test our service before committing to a subscription. Please visit our website to request your trial and experience the variety of content we offer.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq8" aria-expanded="true" aria-controls="faq8">
                                                    Can I watch TopIPTVShop on multiple devices simultaneously?
                                                </button>
                                            </h2>
                                            <div id="faq8" class="accordion-collapse collapse">
                                                <div class="accordion-body">
                                                    Depending on your subscription plan, TopIPTVShop allows multiple device connections at the same time. Be sure to choose a plan that matches your viewing needs for multi-device access.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq9" aria-expanded="true" aria-controls="faq9">
                                                    How reliable is the streaming quality on TopIPTVShop?
                                                </button>
                                            </h2>
                                            <div id="faq9" class="accordion-collapse collapse">
                                                <div class="accordion-body">
                                                    TopIPTVShop uses high-performance servers to deliver HD and Full HD content with minimal buffering or lag. However, the quality of your streaming experience can also depend on your internet connection speed.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq10" aria-expanded="true" aria-controls="faq10">
                                                    What should I do if I encounter issues with TopIPTVShop?
                                                </button>
                                            </h2>
                                            <div id="faq10" class="accordion-collapse collapse">
                                                <div class="accordion-body">
                                                    If you experience any problems with our service, please first check your internet connection and device settings. If the issue persists, feel free to contact our support team via email or live chat. We’re committed to resolving any issues as quickly as possible.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
