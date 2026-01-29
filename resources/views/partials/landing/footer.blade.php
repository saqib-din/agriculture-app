<!-- Footer -->
<footer class="footer" id="footer-main">

    {{-- @php
        $variables = \App\Models\Variable::pluck('value', 'key');
    @endphp --}}

    <div class="footer-inner">
        <div class="tf-container w-1290">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-top">
                        <div class="footer-left">
                            <div class="logo">
                                <a href="{{ url('/') }}">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('assets/images/logo/logo3x.png') }}" style="height: 3em;"
                                                alt="" />
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="text-light mb-0 fw-5">
                                                {{ $company['company_name'] ?: 'Scrumad' }}
                                                {{-- <span class="text-light">
                                                    {{ $company['company_slogan'] ?: 'N/A' }}
                                                </span> --}}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-between">

                {{-- Contact Info --}}
                <div class="col-lg-3 col-md-6">
                    <div class="footer-inner-wrap footer-col-block">
                        <h4 class="footer-title mb-23">Contact Us!</h4>
                        <ul class="contact-list tf-collapse-content">
                            <li>
                                <i class="fa-solid fa-location-dot fs-17"></i>
                                <p class="address">Address: {{ $company['company_address'] ?: 'N/A' }}</p>
                            </li>
                            <li>
                                <i class="fa-solid fa-phone"></i>
                                <p class="phone-number fs-15">Call us: {{ $company['company_phone'] ?: 'N/A' }}</p>
                            </li>
                            <li>
                                <i class="icon-package-box"></i>
                                <p class="email fs-15">Mail: {{ $company['company_email'] ?: 'N/A' }}</p>
                            </li>
                            <li>
                                <i class="fa-solid fa-clock"></i>
                                <p class="time-open fs-15">Mon - Sat: {{ $company['working_hours'] ?: 'N/A' }}</p>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Quick Links --}}
                @php
                    $footerPages = \App\Models\Page::where('display_in_footer', 1)->where('status', 'Active')->get();
                @endphp

                @if ($footerPages->count())
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-inner-wrap footer-col-block">
                            <h4 class="footer-title mb-28">Quick Links</h4>
                            <ul class="link-list tf-collapse-content">
                                @foreach ($footerPages as $footerPage)
                                    <li class="item">
                                        <a href="{{ route('page.show', $footerPage->slug) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="14"
                                                height="16">
                                                <path
                                                    d="M264.547 70.633L440.547 238.633C445.297 243.164 447.984 249.445 447.984 256.008S445.297 268.852 440.547 273.383L264.547 441.383C254.953 450.508 239.766 450.164 230.609 440.57C221.453 431.07 221.797 415.82 231.422 406.633L364.09 280.008H24C10.75 280.008 0 269.258 0 256.008S10.75 232.008 24 232.008H364.09L231.422 105.383C221.797 96.227 221.453 80.977 230.609 71.445C239.766 61.852 254.953 61.508 264.547 70.633Z">
                                                </path>
                                            </svg>
                                            {{ $footerPage->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <div class="tf-container w-1290">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-bottom">
                    <p class="no-copy font-nunito">
                        Copyright &copy; {{ date('Y') }} {{ config('app.name', 'Donal Farm') }}. All Rights
                        Reserved.
                    </p>

                    {{-- Social Icons --}}
                    <div class="footer-right">
                        <div class="wg-social">
                            <ul class="list">
                                @foreach (['facebook', 'twitter', 'instagram', 'youtube', 'linkedin'] as $social)
                                    @if (!empty($company[$social]))
                                        <li class="item">
                                            <a href="{{ $company[$social] }}" target="_blank">
                                                <i class="icon-{{ $social }}"></i>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Decorative Images --}}
    <div class="img-item item-1">
        <img src="{{ asset('assets/images/item/grass-2.png') }}" alt="" />
    </div>
    <div class="img-item item-2">
        <div class="scroll-element-3">
            <img class="wow zoomIn" src="{{ asset('assets/images/item/silo.png') }}" alt="silo" />
        </div>
    </div>

</footer>
<!-- /.Footer -->
