<!-- Footer -->
<footer class="footer" id="footer-main">

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
                                            @if (isset($variables) && $variables->isNotEmpty())
                                                <h5 class="text-light mb-0 fw-5">{{ $variables->first()->name ?? 'N/A' }}
                                                </h5>
                                                {{-- <span
                                                    class="text-light">{{ $variables->first()->slogan ?? 'N/A' }}</span> --}}
                                            @else
                                                <h5 class="text-light mb-0 fw-5">Scrumad</h5>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-between">
                <div class="col-lg-3 col-md-6 ">

                    <div class="footer-inner-wrap footer-col-block">
                        <h4 class="footer-title footer-title-desktop mb-23">
                            Contact Us!
                        </h4>
                        <h4 class="footer-title footer-title-mobile mb-23">
                            Contact Us!
                        </h4>
                        <ul class="contact-list tf-collapse-content">
                            <li>
                                <i class="fa-solid fa-location-dot fs-17"></i>
                                @if (isset($variables) && $variables->isNotEmpty())
                                    <p class="address">{{ $variables->first()->address ?? 'N/A' }}</p>
                                @else
                                    <p class="address">N/A</p>
                                @endif
                            </li>

                            <li>
                                <i class="fa-solid fa-phone"></i>
                                @if (isset($variables) && $variables->isNotEmpty())
                                    <p class="phone-number fs-15">Call us: {{ $variables->first()->phone ?? 'N/A' }}</p>
                                @else
                                    <p class="phone-number fs-15">N/A</p>
                                @endif
                            </li>

                            <li>
                                <i class="icon-package-box"></i>
                                @if (isset($variables) && $variables->isNotEmpty())
                                    <p class="email fs-15">Mail: {{ $variables->first()->email ?? 'N/A' }}</p>
                                @else
                                    <p class="email fs-15">N/A</p>
                                @endif
                            </li>

                            <li>
                                <i class="fa-solid fa-clock"></i>
                                @if (isset($variables) && $variables->isNotEmpty())
                                    <p class="time-open fs-15">Mon - Sat:
                                        {{ $variables->first()->working_hours ?? 'N/A' }}</p>
                                @else
                                    <p class="time-open fs-15">N/A</p>
                                @endif
                            </li>
                        </ul>

                    </div>
                </div>

                @php
                    $footerPages = \App\Models\Page::where('display_in_footer', 1)->where('status', 'Active')->get();
                @endphp

                @if ($footerPages->count() > 0)
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-inner-wrap footer-col-block">
                            <h4 class="footer-title footer-title-desktop mb-28">Quick Links</h4>
                            <h4 class="footer-title footer-title-mobile mb-28">Quick Links</h4>

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
                    @php
                        $settings = isset($variables) && $variables->isNotEmpty() ? $variables->first() : null;
                    @endphp

                    @if ($settings)
                        <div class="footer-right">
                            <div class="wg-social">
                                <ul class="list">

                                    @if (!empty($settings->facebook))
                                        <li class="item">
                                            <a href="{{ $settings->facebook }}" target="_blank">
                                                <i class="icon-facebook1"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @if (!empty($settings->twitter))
                                        <li class="item">
                                            <a href="{{ $settings->twitter }}" target="_blank">
                                                <i class="icon-twitter"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @if (!empty($settings->instagram))
                                        <li class="item">
                                            <a href="{{ $settings->instagram }}" target="_blank">
                                                <i class="icon-instagram2"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @if (!empty($settings->youtube))
                                        <li class="item">
                                            <a href="{{ $settings->youtube }}" target="_blank">
                                                <i class="fa-brands fa-youtube"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @if (!empty($settings->linkedin))
                                        <li class="item">
                                            <a href="{{ $settings->linkedin }}" target="_blank">
                                                <i class="fa-brands fa-linkedin"></i>
                                            </a>
                                        </li>
                                    @endif

                                </ul>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <div class="img-item item-1">
        <img src="{{ asset('assets/images/item/grass-2.png') }}" alt="" />
    </div>
    <div class="img-item item-2">

        <div class="  scroll-element-3">
            <img class="wow zoomIn" src="{{ asset('assets/images/item/silo.png') }}"
                alt="{{ asset('assets/images/item/silo.png') }}" />
        </div>
    </div>
</footer>
<!-- /.Footer -->
