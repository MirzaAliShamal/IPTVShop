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
                                                    How does IPTV work?
                                                </button>
                                            </h2>
                                            <div id="faq1" class="accordion-collapse collapse show">
                                                <div class="accordion-body">
                                                    Quisque rutrum. Aenean imperdi. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="true" aria-controls="faq2">
                                                    Can I add Extras to my delivery?
                                                </button>
                                            </h2>
                                            <div id="faq2" class="accordion-collapse collapse">
                                                <div class="accordion-body">
                                                    Quisque rutrum. Aenean imperdi. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="true" aria-controls="faq3">
                                                    Can I add Extras to my delivery?
                                                </button>
                                            </h2>
                                            <div id="faq3" class="accordion-collapse collapse">
                                                <div class="accordion-body">
                                                    Quisque rutrum. Aenean imperdi. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="true" aria-controls="faq4">
                                                    Can I add Extras to my delivery?
                                                </button>
                                            </h2>
                                            <div id="faq4" class="accordion-collapse collapse">
                                                <div class="accordion-body">
                                                    Quisque rutrum. Aenean imperdi. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="true" aria-controls="faq5">
                                                    Can I add Extras to my delivery?
                                                </button>
                                            </h2>
                                            <div id="faq5" class="accordion-collapse collapse">
                                                <div class="accordion-body">
                                                    Quisque rutrum. Aenean imperdi. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget.
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
