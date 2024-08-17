@extends('layouts.app')

@section('title', 'Thank You')
@section('page-title', 'Thank You')

@section('content')
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center mb-5">
                        <div class="col-lg-6 col-12 text-center">
                            <div class="d-flex justify-content-center align-items-center mb-5">
                                <img src="{{ asset('app/images/iptv-shop-icon-green.png') }}" class="img-fluid" alt="">
                            </div>
                            <h4 class="mb-5">Thank you for your purchase of our Product! We appreciate your trust in our service.</h4>
                            <p class="mb-3">We are currently processing your order and will display the details shortly</p>
                            <p class="mb-3">To access your product details.please navigate to the "My Products" section where you will find comprehensive information about your order.</p>

                            <div class="d-flex flex-row justify-content-center">
                                <a href="" class="btn btn-secondary">
                                    Join us
                                    <span class="ms-2">
                                        <svg width="24" height="24" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M51 25.5C51 39.5888 39.5888 51 25.5 51C11.4113 51 0 39.5888 0 25.5C0 11.4113 11.4113 0 25.5 0C39.5888 0 51 11.4113 51 25.5Z" fill="url(#paint0_linear_106_113)"/>
                                            <path d="M20.8248 37.1868C19.9961 37.1868 20.1448 36.8681 19.8473 36.0818L17.4248 28.0918L32.4698 18.6993L34.2336 19.1668L32.7673 23.1618L20.8248 37.1868Z" fill="#C8DAEA"/>
                                            <path d="M20.8247 37.1873C21.4622 37.1873 21.7385 36.8898 22.0997 36.5498C22.6522 36.0186 29.7497 29.1123 29.7497 29.1123L25.3935 28.0498L21.356 30.5998L20.8247 36.9748V37.1873Z" fill="#A9C9DD"/>
                                            <path d="M21.2501 30.6848L31.5351 38.2711C32.7039 38.9086 33.5539 38.5898 33.8514 37.1873L38.0376 17.4673C38.4626 15.7461 37.3789 14.9811 36.2526 15.4911L11.6876 24.9686C10.0089 25.6486 10.0301 26.5836 11.3901 26.9873L17.7014 28.9636L32.3001 19.7623C32.9801 19.3373 33.6176 19.5711 33.1076 20.0386L21.2501 30.6848Z" fill="url(#paint1_linear_106_113)"/>
                                            <defs>
                                            <linearGradient id="paint0_linear_106_113" x1="32.9736" y1="8.06013" x2="20.2236" y2="37.8097" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#37AEE2"/>
                                            <stop offset="1" stop-color="#1E96C8"/>
                                            </linearGradient>
                                            <linearGradient id="paint1_linear_106_113" x1="27.4107" y1="26.2978" x2="32.7232" y2="34.7978" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#EFF7FC"/>
                                            <stop offset="1" stop-color="white"/>
                                            </linearGradient>
                                            </defs>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
