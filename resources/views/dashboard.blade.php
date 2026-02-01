@extends('layouts.admin')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title d-flex justify-content-between">
                                <h2 class="mb-0">Dashboard</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                .classical-image-container {
                    position: relative;
                    height: 100%;
                    min-height: 100px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .image-wrapper {
                    position: relative;
                    width: 100%;
                    max-width: 420px;
                }

                .glass-frame {
                    padding: 18px;
                    animation: float-gentle 6s ease-in-out infinite;
                }

                .banner-image {
                    width: 100%;
                    height: auto;
                    max-height: 200px;
                    object-fit: contain;
                    border-radius: 16px;
                    filter: drop-shadow(0 18px 45px rgba(0, 0, 0, 0.35));
                }

                .float-icon {
                    position: absolute;
                    width: 52px;
                    height: 52px;
                    background: rgba(255, 255, 255, 0.25);
                    backdrop-filter: blur(12px);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
                }

                .float-icon i {
                    font-size: 24px;
                    color: #fff;
                    animation: sparkle-rotate 2.5s ease-in-out infinite;
                }

                .icon-1 {
                    top: -0px;
                    right: -10px;
                    animation: float-up-down 3s ease-in-out infinite;
                }

                .icon-2 {
                    bottom: 10px;
                    left: -10px;
                    animation: float-up-down 4s ease-in-out infinite .8s;
                }

                .icon-3 {
                    top: 65%;
                    right: -15px;
                    animation: float-up-down 3.5s ease-in-out infinite 1.2s;
                }

                @keyframes float-gentle {

                    0%,
                    100% {
                        transform: translateY(0);
                    }

                    50% {
                        transform: translateY(-20px);
                    }
                }

                @keyframes float-up-down {

                    0%,
                    100% {
                        transform: translateY(0);
                    }

                    50% {
                        transform: translateY(-15px);
                    }
                }

                @keyframes sparkle-rotate {

                    0%,
                    100% {
                        transform: rotate(0deg);
                        opacity: 1;
                    }

                    50% {
                        transform: rotate(180deg);
                        opacity: .7;
                    }
                }

                :root {
                    --card-bg: #ffffff;
                    --card-border: rgba(0, 0, 0, 0.08);
                    --text-primary: #2c3e50;
                    --text-muted: #6c757d;
                    --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.06);
                    --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.08);
                    --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.12);
                }

                [data-pc-theme="dark"] {
                    --card-bg: #1e293b;
                    --card-border: rgba(255, 255, 255, 0.1);
                    --text-primary: #f1f5f9;
                    --text-muted: #cbd5e1;
                    --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.3);
                    --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.4);
                    --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.5);
                }

                .stat-card {
                    position: relative;
                    border: 1px solid var(--card-border);
                    border-radius: 12px;
                    background: var(--card-bg);
                    box-shadow: var(--shadow-sm);
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    overflow: hidden;
                }

                .stat-card::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    height: 3px;
                    opacity: 0;
                    transition: opacity 0.3s ease;
                }

                .stat-card-primary::before {
                    background: linear-gradient(90deg, #0d6efd, #0a58ca);
                }

                .stat-card-success::before {
                    background: linear-gradient(90deg, #198754, #146c43);
                }

                .stat-card-info::before {
                    background: linear-gradient(90deg, #0dcaf0, #087990);
                }

                .stat-card-warning::before {
                    background: linear-gradient(90deg, #ffc107, #cc9a06);
                }

                .stat-card-danger::before {
                    background: linear-gradient(90deg, #dc3545, #b02a37);
                }

                .stat-card:hover {
                    transform: translateY(-8px);
                    box-shadow: var(--shadow-lg);
                    border-color: transparent;
                }

                .stat-card:hover::before {
                    opacity: 1;
                }

                .avtar {
                    width: 56px;
                    height: 56px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border-radius: 14px;
                    transition: all 0.3s ease;
                    position: relative;
                    overflow: hidden;
                }

                .avtar::before {
                    content: '';
                    position: absolute;
                    inset: 0;
                    border-radius: 14px;
                    padding: 2px;
                    background: linear-gradient(135deg, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.1));
                    -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
                    mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
                    -webkit-mask-composite: xor;
                    mask-composite: exclude;
                    opacity: 0;
                    transition: opacity 0.3s ease;
                }

                .stat-card:hover .avtar {
                    transform: scale(1.1) rotate(5deg);
                }

                .stat-card:hover .avtar::before {
                    opacity: 1;
                }

                .avtar-primary {
                    background: linear-gradient(135deg, rgba(13, 110, 253, 0.15), rgba(13, 110, 253, 0.05));
                    color: #0d6efd;
                }

                .avtar-success {
                    background: linear-gradient(135deg, rgba(25, 135, 84, 0.15), rgba(25, 135, 84, 0.05));
                    color: #198754;
                }

                .avtar-info {
                    background: linear-gradient(135deg, rgba(13, 202, 240, 0.15), rgba(13, 202, 240, 0.05));
                    color: #0dcaf0;
                }

                .avtar-warning {
                    background: linear-gradient(135deg, rgba(255, 193, 7, 0.15), rgba(255, 193, 7, 0.05));
                    color: #ffc107;
                }

                .avtar-danger {
                    background: linear-gradient(135deg, rgba(220, 53, 69, 0.15), rgba(220, 53, 69, 0.05));
                    color: #dc3545;
                }

                .f-26 {
                    font-size: 26px;
                }

                .stat-label {
                    font-size: 13px;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                    color: var(--text-muted);
                }

                .stat-value {
                    color: var(--text-primary);
                    font-size: 2rem;
                    line-height: 1;
                    transition: all 0.3s ease;
                }

                .stat-card:hover .stat-value {
                    transform: scale(1.05);
                }

                .badge {
                    padding: 4px 8px;
                    border-radius: 6px;
                    font-size: 11px;
                    font-weight: 600;
                }

                .badge-primary {
                    background: rgba(13, 110, 253, 0.1);
                    color: #0d6efd;
                }

                .badge-success {
                    background: rgba(25, 135, 84, 0.1);
                    color: #198754;
                }

                .badge-info {
                    background: rgba(13, 202, 240, 0.1);
                    color: #0dcaf0;
                }

                .badge-warning {
                    background: rgba(255, 193, 7, 0.1);
                    color: #ffc107;
                }

                .badge-danger {
                    background: rgba(220, 53, 69, 0.1);
                    color: #dc3545;
                }

                .progress-wrapper {
                    position: relative;
                }

                .progress {
                    height: 6px;
                    border-radius: 10px;
                    background: rgba(0, 0, 0, 0.05);
                    overflow: hidden;
                }

                [data-pc-theme="dark"] .progress {
                    background: rgba(255, 255, 255, 0.05);
                }

                .progress-bar {
                    border-radius: 10px;
                    transition: width 1.5s cubic-bezier(0.4, 0, 0.2, 1);
                    position: relative;
                    overflow: hidden;
                }

                .progress-bar::after {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
                    animation: shimmer 2s infinite;
                }

                @keyframes shimmer {
                    0% {
                        transform: translateX(-100%);
                    }

                    100% {
                        transform: translateX(100%);
                    }
                }

                .bg-primary {
                    background: linear-gradient(90deg, #0d6efd, #0a58ca);
                }

                .bg-success {
                    background: linear-gradient(90deg, #198754, #146c43);
                }

                .bg-info {
                    background: linear-gradient(90deg, #0dcaf0, #087990);
                }

                .bg-warning {
                    background: linear-gradient(90deg, #ffc107, #cc9a06);
                }

                .bg-danger {
                    background: linear-gradient(90deg, #dc3545, #b02a37);
                }

                .card-glow {
                    position: absolute;
                    top: -50%;
                    left: -50%;
                    width: 200%;
                    height: 200%;
                    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
                    opacity: 0;
                    transition: opacity 0.5s ease;
                    pointer-events: none;
                }

                .stat-card:hover .card-glow {
                    opacity: 1;
                    animation: rotateGlow 10s linear infinite;
                }

                @keyframes rotateGlow {
                    from {
                        transform: rotate(0deg);
                    }

                    to {
                        transform: rotate(360deg);
                    }
                }

                @keyframes fadeUp {
                    from {
                        opacity: 0;
                        transform: translateY(30px);
                    }

                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                [data-aos="fade-up"] {
                    animation: fadeUp 0.6s ease backwards;
                }

                @media (max-width: 768px) {
                    .stat-value {
                        font-size: 1.5rem;
                    }

                    .avtar {
                        width: 48px;
                        height: 48px;
                    }

                    .f-26 {
                        font-size: 22px;
                    }

                    .stat-card:hover {
                        transform: translateY(-4px);
                    }
                }

                @media print {
                    .stat-card {
                        break-inside: avoid;
                        box-shadow: none;
                        border: 1px solid #ddd;
                    }

                    .card-glow {
                        display: none;
                    }
                }

                @keyframes countUp {
                    from {
                        opacity: 0;
                        transform: translateY(10px);
                    }

                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                .stat-value {
                    animation: countUp 0.5s ease;
                }

                .stat-card {
                    cursor: pointer;
                }

                .stat-card:active {
                    transform: translateY(-4px) scale(0.98);
                }

                [data-pc-theme="dark"] .stat-card {
                    background: linear-gradient(135deg, var(--card-bg) 0%, rgba(30, 41, 59, 0.8) 100%);
                }

                [data-pc-theme="dark"] .stat-card:hover {
                    background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
                }

                [data-pc-theme="light"] .stat-card {
                    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
                }

                [data-pc-theme="light"] .stat-card:hover {
                    background: linear-gradient(135deg, #ffffff 0%, #ffffff 100%);
                }

                .quick-stat {
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    padding: 8px 14px;
                    background: rgba(255, 255, 255, 0.15);
                    backdrop-filter: blur(10px);
                    border-radius: 10px;
                    color: #fff;
                    font-size: 14px;
                    white-space: nowrap;
                }

                .quick-stat i {
                    font-size: 20px;
                }
            </style>

            <div class="row">
                <div class="col-12">
                    <div class="card welcome-banner">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-12 d-flex align-items-center">
                                    <div class="d-flex align-items-start justify-content-between w-100">
                                        <div class="d-flex justify-content-between w-100">
                                            <div class="d-flex w-100">
                                                <div class="d-flex align-items-start">
                                                    <div class="me-3">
                                                        <div class="user-upload wid-75">
                                                            <img src="{{ asset('admin/assets/images/user/sms.png') }}"
                                                                alt="Default Logo" class="img-fluid"
                                                                style="max-width:140px;" />
                                                        </div>
                                                    </div>
                                                    <div class="content-stack">
                                                        <h2 class="text-white mb-1">Agriculture App</h2>
                                                        <div class="quick-stat mt-2">
                                                            <i class="ti ti-calendar"></i>
                                                            <span>{{ date('l, F j, Y') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 d-none d-lg-block">
                                    <div class="classical-image-container">
                                        <div class="image-wrapper">
                                            <div class="glass-frame">
                                                <img src="{{ asset('admin/assets/images/widget/welcome-banner.png') }}"
                                                    alt="Welcome Banner" class="banner-image" />
                                            </div>

                                            <div class="float-icon icon-1">
                                                <i class="ti ti-sparkles"></i>
                                            </div>
                                            <div class="float-icon icon-2">
                                                <i class="ti ti-star-filled"></i>
                                            </div>
                                            <div class="float-icon icon-3">
                                                <i class="ti ti-circle-check-filled"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4">
                        @php
                            $cards = [
                                [
                                    'title' => 'Hero Sections',
                                    'value' => $stats['hero_sections'],
                                    'icon' => 'ti ti-layout',
                                    'color' => 'primary',
                                    'max' => 3,
                                ],
                                [
                                    'title' => 'Services',
                                    'value' => $stats['services'],
                                    'icon' => 'ti ti-briefcase',
                                    'color' => 'success',
                                    'max' => 20,
                                ],
                                [
                                    'title' => 'Products',
                                    'value' => $stats['products'],
                                    'icon' => 'ti ti-package',
                                    'color' => 'info',
                                    'max' => 100,
                                ],
                                [
                                    'title' => 'Categories',
                                    'value' => $stats['categories'],
                                    'icon' => 'ti ti-folder',
                                    'color' => 'warning',
                                    'max' => 20,
                                ],
                                [
                                    'title' => 'Quote Requests',
                                    'value' => $stats['quoteRequests'],
                                    'icon' => 'ti ti-clipboard',
                                    'color' => 'danger',
                                    'max' => 100,
                                ],
                                [
                                    'title' => 'Clients',
                                    'value' => $stats['clients'],
                                    'icon' => 'ti ti-users',
                                    'color' => 'primary',
                                    'max' => 100,
                                ],
                                [
                                    'title' => 'Orders',
                                    'value' => $stats['orders'],
                                    'icon' => 'ti ti-shopping-cart',
                                    'color' => 'success',
                                    'max' => 200,
                                ],
                                [
                                    'title' => 'Team Members',
                                    'value' => $stats['teams'],
                                    'icon' => 'ti ti-user',
                                    'color' => 'info',
                                    'max' => 30,
                                ],
                                [
                                    'title' => 'Testimonials',
                                    'value' => $stats['testimonials'],
                                    'icon' => 'ti ti-message-dots',
                                    'color' => 'warning',
                                    'max' => 50,
                                ],
                                [
                                    'title' => 'FAQs',
                                    'value' => $stats['faqs'],
                                    'icon' => 'ti ti-help',
                                    'color' => 'danger',
                                    'max' => 20,
                                ],
                                [
                                    'title' => 'Contact Messages',
                                    'value' => $stats['contacts'],
                                    'icon' => 'ti ti-mail',
                                    'color' => 'primary',
                                    'max' => 100,
                                ],
                                [
                                    'title' => 'Partner Logos',
                                    'value' => $stats['partners'],
                                    'icon' => 'ti ti-brand-apple',
                                    'color' => 'success',
                                    'max' => 15,
                                ],
                                [
                                    'title' => 'Footer Pages',
                                    'value' => $stats['footer_pages'],
                                    'icon' => 'ti ti-list',
                                    'color' => 'info',
                                    'max' => 5,
                                ],
                            ];
                        @endphp

                        @foreach ($cards as $index => $card)
                            @php
                                $percentage = $card['max'] > 0 ? min(($card['value'] / $card['max']) * 100, 100) : 0;
                                $percentage = max($percentage, 5);
                            @endphp

                            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                                <div class="card stat-card stat-card-{{ $card['color'] }}">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avtar avtar-{{ $card['color'] }}">
                                                    <i class="{{ $card['icon'] }} f-26"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="mb-1 text-muted fw-semibold stat-label">{{ $card['title'] }}</p>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <h3 class="mb-0 fw-bold stat-value" data-count="{{ $card['value'] }}">
                                                        {{ $card['value'] }}+</h3>
                                                    <span class="badge badge-{{ $card['color'] }}">
                                                        <i class="ti ti-trending-up"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress-wrapper mt-3">
                                            <div class="progress">
                                                <div class="progress-bar bg-{{ $card['color'] }}" role="progressbar"
                                                    data-width="{{ $percentage }}" style="width: 0%"
                                                    aria-valuenow="{{ $card['value'] }}" aria-valuemin="0"
                                                    aria-valuemax="{{ $card['max'] }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-glow"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statValues = document.querySelectorAll('.stat-value');

            statValues.forEach(element => {
                const target = parseInt(element.getAttribute('data-count'));
                if (isNaN(target)) return;

                let current = 0;
                const increment = target / 60;
                const duration = 1500;
                const stepTime = duration / 60;

                const counter = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        element.textContent = target + '+';
                        clearInterval(counter);
                    } else {
                        element.textContent = Math.floor(current) + '+';
                    }
                }, stepTime);
            });

            const progressBars = document.querySelectorAll('.progress-bar');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const bar = entry.target;
                        const targetWidth = bar.getAttribute('data-width');

                        bar.style.width = '0%';

                        setTimeout(() => {
                            bar.style.width = targetWidth + '%';
                        }, 100);

                        observer.unobserve(bar);
                    }
                });
            }, {
                threshold: 0.5
            });

            progressBars.forEach(bar => observer.observe(bar));
        });
    </script>
@endsection
