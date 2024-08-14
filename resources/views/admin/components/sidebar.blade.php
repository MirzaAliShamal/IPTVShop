<div id="kt_aside" class="aside aside-light aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
        <a href="{{ route('admin.dashboard.index') }}">
            <img alt="Logo" src="{{ asset('admin/media/logos/iptv-shop-logo.png') }}" class="h-30px logo" />
        </a>

        <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
            <span class="svg-icon svg-icon-1 rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24" />
                        <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
                        <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.5" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
                    </g>
                </svg>
            </span>
        </div>
    </div>

    <div class="aside-menu flex-column-fluid">
        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
                <div class="menu-item">
                    <div class="menu-content pb-2">
                        <span class="menu-section text-muted text-uppercase fs-8 ls-1">Dashboard</span>
                    </div>
                </div>
                <div class="menu-item">
                    <a class="menu-link @routeis('admin.dashboard.index') active @endrouteis" href="{{ route('admin.dashboard.index') }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                                    <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </div>
                <div class="menu-item">
                    <div class="menu-content pb-2">
                        <span class="menu-section text-muted text-uppercase fs-8 ls-1">Management</span>
                    </div>
                </div>
                <div class="menu-item">
                    <a class="menu-link @routeis('admin.iptv.service.*') active @endrouteis" href="{{ route('admin.iptv.service.index') }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <path d="M4.5,6 L19.5,6 C20.8807119,6 22,6.97004971 22,8.16666667 L22,16.8333333 C22,18.0299503 20.8807119,19 19.5,19 L4.5,19 C3.11928813,19 2,18.0299503 2,16.8333333 L2,8.16666667 C2,6.97004971 3.11928813,6 4.5,6 Z M4,8 L4,17 L20,17 L20,8 L4,8 Z" fill="#000000" fill-rule="nonzero"/>
                                    <polygon fill="#000000" opacity="0.3" points="4 8 4 17 20 17 20 8"/>
                                    <rect fill="#000000" opacity="0.3" x="7" y="20" width="10" height="1" rx="0.5"/>
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title">IPTV Services</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link @routeis('admin.service.*') active @endrouteis" href="{{ route('admin.service.index') }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3" d="M5 8.04999L11.8 11.95V19.85L5 15.85V8.04999Z" fill="black"/>
                                    <path d="M20.1 6.65L12.3 2.15C12 1.95 11.6 1.95 11.3 2.15L3.5 6.65C3.2 6.85 3 7.15 3 7.45V16.45C3 16.75 3.2 17.15 3.5 17.25L11.3 21.75C11.5 21.85 11.6 21.85 11.8 21.85C12 21.85 12.1 21.85 12.3 21.75L20.1 17.25C20.4 17.05 20.6 16.75 20.6 16.45V7.45C20.6 7.15 20.4 6.75 20.1 6.65ZM5 15.85V7.95L11.8 4.05L18.6 7.95L11.8 11.95V19.85L5 15.85Z" fill="black"/>
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title">Services</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link @routeis('admin.product.*') active @endrouteis" href="{{ route('admin.product.index') }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3" d="M3 13H10C10.6 13 11 13.4 11 14V21C11 21.6 10.6 22 10 22H3C2.4 22 2 21.6 2 21V14C2 13.4 2.4 13 3 13Z" fill="black"/>
                                    <path d="M7 16H6C5.4 16 5 15.6 5 15V13H8V15C8 15.6 7.6 16 7 16Z" fill="black"/>
                                    <path opacity="0.3" d="M14 13H21C21.6 13 22 13.4 22 14V21C22 21.6 21.6 22 21 22H14C13.4 22 13 21.6 13 21V14C13 13.4 13.4 13 14 13Z" fill="black"/>
                                    <path d="M18 16H17C16.4 16 16 15.6 16 15V13H19V15C19 15.6 18.6 16 18 16Z" fill="black"/>
                                    <path opacity="0.3" d="M3 2H10C10.6 2 11 2.4 11 3V10C11 10.6 10.6 11 10 11H3C2.4 11 2 10.6 2 10V3C2 2.4 2.4 2 3 2Z" fill="black"/>
                                    <path d="M7 5H6C5.4 5 5 4.6 5 4V2H8V4C8 4.6 7.6 5 7 5Z" fill="black"/>
                                    <path opacity="0.3" d="M14 2H21C21.6 2 22 2.4 22 3V10C22 10.6 21.6 11 21 11H14C13.4 11 13 10.6 13 10V3C13 2.4 13.4 2 14 2Z" fill="black"/>
                                    <path d="M18 5H17C16.4 5 16 4.6 16 4V2H19V4C19 4.6 18.6 5 18 5Z" fill="black"/>
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title">Products</span>
                    </a>
                </div>
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion @routeis('admin.funds.card.*') here show @endrouteis">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z" fill="#000000" opacity="0.3" transform="translate(11.500000, 12.000000) rotate(-345.000000) translate(-11.500000, -12.000000) "/>
                                        <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z M11.5,14 C12.6045695,14 13.5,13.1045695 13.5,12 C13.5,10.8954305 12.6045695,10 11.5,10 C10.3954305,10 9.5,10.8954305 9.5,12 C9.5,13.1045695 10.3954305,14 11.5,14 Z" fill="#000000"/>
                                    </g>
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title">Funds Cards</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link @routeis('admin.funds.card.add') active @endrouteis" href="{{ route('admin.funds.card.add') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Add Funds Card</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link @routeis('admin.funds.card.giftcard') active @endrouteis" href="{{ route('admin.funds.card.giftcard') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Giftcards</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link @routeis('admin.funds.card.paypal') active @endrouteis" href="{{ route('admin.funds.card.paypal') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">PayPal</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link @routeis('admin.funds.card.visa') active @endrouteis" href="{{ route('admin.funds.card.visa') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Visa</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-content pb-2">
                        <span class="menu-section text-muted text-uppercase fs-8 ls-1">Settings</span>
                    </div>
                </div>
                <div class="menu-item">
                    <a class="menu-link @routeis('admin.bank.account.*') active @endrouteis" href="{{ route('admin.bank.account.index') }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.25" d="M4 10H8V17H10V10H14V17H16V10H20V17C21.1046 17 22 17.8954 22 19V20C22 21.1046 21.1046 22 20 22H4C2.89543 22 2 21.1046 2 20V19C2 17.8954 2.89543 17 4 17V10Z" fill="#12131A"/>
                                    <path d="M2 7.35405C2 6.53624 2.4979 5.80083 3.25722 5.4971L11.2572 2.2971C11.734 2.10637 12.266 2.10637 12.7428 2.2971L20.7428 5.4971C21.5021 5.80083 22 6.53624 22 7.35405V7.99999C22 9.10456 21.1046 9.99999 20 9.99999H4C2.89543 9.99999 2 9.10456 2 7.99999V7.35405Z" fill="#12131A"/>
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title">Bank Accounts</span>
                    </a>
                    <a class="menu-link @routeis('admin.paypal.account.*') active @endrouteis" href="{{ route('admin.paypal.account.index') }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg fill="#a1a5b7" height="24px" width="24px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        viewBox="0 0 502 502" xml:space="preserve">
                                    <g>
                                        <g>
                                            <g>
                                                <path d="M316.129,81.637c-13.729-9.916-33.767-14.736-61.259-14.736h-43.604c-4.676,0-8.727,3.24-9.755,7.801l-28.075,124.543
                                                    c-0.669,2.965,0.047,6.071,1.945,8.445c1.898,2.373,4.772,3.754,7.81,3.754h50.773c34.428,0,59.611-6.433,76.991-19.664
                                                    c17.975-13.686,27.088-34.449,27.088-61.716C338.043,108.444,330.671,92.152,316.129,81.637z M298.84,175.867
                                                    c-13.575,10.336-35.402,15.577-64.875,15.577h-38.269l23.568-104.543h35.606c22.819,0,39.489,3.684,49.544,10.946
                                                    c9.171,6.631,13.629,17.169,13.629,32.217C318.043,151.046,311.762,166.028,298.84,175.867z"/>
                                                <path d="M376.58,29.694C347.618,9.713,304.191,0,243.819,0h-83.106c-14.866,0-27.523,10.131-30.779,24.636L40.451,423.269
                                                    c-2.111,9.399,0.131,19.102,6.15,26.622c6.02,7.52,14.996,11.833,24.629,11.833h39.818c14.817,0,27.466-10.09,30.758-24.537
                                                    l35.923-157.647h67.882c55.006,0,98.418-13.54,129.027-40.246c31.008-27.055,46.731-65.514,46.731-114.308
                                                    C421.369,82.267,406.301,50.207,376.58,29.694z M361.489,224.224c-26.86,23.434-65.848,35.316-115.879,35.316h-75.859
                                                    c-4.667,0-8.713,3.228-9.75,7.778l-37.695,165.425c-1.205,5.288-5.834,8.981-11.258,8.981H71.23
                                                    c-3.526,0-6.812-1.579-9.014-4.331c-2.203-2.752-3.023-6.303-2.252-9.743l89.483-398.633C150.64,23.708,155.272,20,160.713,20
                                                    h83.107c55.4,0,96.246,8.8,121.401,26.156c24.324,16.789,36.148,42.575,36.148,78.831
                                                    C401.369,168.35,388.324,200.811,361.489,224.224z"/>
                                                <path d="M164.962,65.242c-5.391-1.208-10.738,2.179-11.947,7.567l-8.834,39.354c-1.21,5.389,2.177,10.738,7.566,11.948
                                                    c0.738,0.166,1.473,0.245,2.2,0.245c4.575,0,8.703-3.161,9.747-7.812l8.834-39.354C173.738,71.801,170.351,66.452,164.962,65.242
                                                    z"/>
                                                <path d="M147.597,142.596c-5.394-1.209-10.737,2.179-11.947,7.567L76.244,414.809c-1.21,5.389,2.177,10.738,7.566,11.948
                                                    c0.737,0.166,1.474,0.245,2.199,0.245c4.576,0,8.704-3.16,9.748-7.812l59.406-264.646
                                                    C156.373,149.155,152.986,143.806,147.597,142.596z"/>
                                                <path d="M399.526,255.512c-30.605,28.528-74.177,44.889-119.546,44.889h-75.859c-4.713,0-8.785,3.29-9.776,7.897l-35.214,163.71
                                                    c-1.255,5.883-5.873,9.992-11.228,9.992h-39.818c-5.522,0-10,4.477-10,10s4.478,10,10,10h39.818
                                                    c14.884,0,27.544-10.618,30.784-25.803l33.512-155.796h67.781c50.374,0,98.918-18.319,133.183-50.259
                                                    c4.04-3.766,4.263-10.093,0.496-14.133C409.893,251.967,403.564,251.746,399.526,255.512z"/>
                                                <path d="M452.326,133.523c-5.522,0-10,4.477-10,10c0,20.481-2.659,39.104-7.905,55.353c-1.697,5.256,1.188,10.892,6.444,12.589
                                                    c1.021,0.329,2.056,0.486,3.074,0.486c4.222,0,8.147-2.697,9.515-6.931c5.887-18.237,8.872-38.928,8.872-61.497
                                                    C462.326,138,457.848,133.523,452.326,133.523z"/>
                                            </g>
                                        </g>
                                    </g>
                                    </svg>
                            </span>
                        </span>
                        <span class="menu-title">PayPal Accounts</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
