@extends('layouts.landing')

@section('content')
    <!-- Page-title -->
    <div class="page-title page-shop-detail">
        <div class="rellax" data-rellax-speed="5">
            <img src="{{ asset('assets/images/page-title/shop-detail.jpg') }}" alt="">
        </div>
        <div class="content-wrap">
            <div class="tf-container w-1290">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content center">
                            <p class="sub-title">Buy Solar Plant Products at Our Store</p>
                            <h1 class="title">Shop products</h1>
                            <div class="icon-img">
                                <img src="{{ asset('assets/images/item/line-throw-title.png') }}" alt="">
                            </div>
                            <div class="breadcrumb">
                                <a href="{{ url('/') }}">Home</a>
                                <div class="icon">
                                    <i class="icon-arrow-right1"></i>
                                </div>
                                <a href="javascript:void(0)">Products</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="img-item item-2">
            <img src="{{ asset('assets/images/item/grass-6.png') }}" alt="">
        </div>
    </div>

    <!-- Success Message -->
    <div id="msg" class="success-message-box" style="display: none;">
        <div class="success-content">
            <div class="success-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
            <div>
                <strong>Request Sent Successfully!</strong>
                <p>Thank you for contacting us. Our team will review your request and respond within 24 hours via email.</p>
            </div>
        </div>
    </div>

    <style>
        .success-message-box {
            position: fixed;
            top: 20px;
            right: -400px;
            max-width: 450px;
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 15px;
            color: #fff;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-left: 5px solid #28a745;
            padding: 20px 25px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        .success-content {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #ffffff;
        }

        .success-icon {
            background: rgba(255, 255, 255, 0.2);
            padding: 10px;
            border-radius: 50%;
            min-width: 50px;
            min-height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .success-icon svg {
            color: #28a745;
            stroke: #28a745;
        }

        .success-content strong {
            font-size: 18px;
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
        }

        .success-content p {
            margin: 0;
            font-size: 14px;
            opacity: 0.9;
            line-height: 1.5;
        }

        @keyframes slideInRight {
            0% {
                right: -400px;
                opacity: 0;
            }

            100% {
                right: 20px;
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            0% {
                right: 20px;
                opacity: 1;
            }

            100% {
                right: -400px;
                opacity: 0;
            }
        }

        .card-product {
            position: relative;
        }

        .card-product .image {
            position: relative;
            overflow: hidden;
            height: 128px !important;
            width: 216px;
        }

        .request-quote-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #235130;
            color: white;
            border: none;
            padding: 8px 15px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 11px;
            cursor: pointer;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 10;
        }

        .card-product:hover .request-quote-btn {
            opacity: 1;
            transform: translateY(0);
        }

        .request-quote-btn.selected {
            opacity: 1;
            transform: translateY(0);
            background-color: #f8c32c;
            color: black;
        }

        .request-quote-btn.selected::after {
            content: ' ✓';
        }

        .main-quote-section {
            transition: all 0.3s ease;
        }

        .selected-products-list {
            max-height: 300px;
            overflow-y: auto;
        }

        .product-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border: 1px solid #e5e5e5;
            border-radius: 8px;
            margin-bottom: 10px;
            background: #f9f9f9;
        }

        .product-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            margin-right: 15px;
        }

        .product-item-info {
            flex: 1;
        }

        .product-item-name {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 5px;
            color: #333;
        }

        .product-item-price {
            font-size: 13px;
            color: #235130;
            font-weight: 500;
        }

        .product-item-quantity {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .product-item-quantity input {
            width: 70px;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-align: center;
        }

        .product-item-remove {
            background: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }

        .product-item-remove:hover {
            background: #c82333;
        }

        .tf-page-pagination .disabled {
            opacity: 0.5;
            pointer-events: none;
        }

        .active-category {
            color: #278d45 !important;
            font-weight: 600;
        }

        .category-list .item a {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .category-list .item a:hover {
            color: #235130;
            padding-left: 5px;
        }

        .no-products-found {
            background: #f9f9f9;
            border-radius: 25px;
            padding: 60px 20px;
            text-align: center;
        }

        .no-products-found i {
            font-size: 4rem;
            color: #ddd;
            margin-bottom: 20px;
        }

        .tf-shop-control {
            display: flex;
            align-items: center;
        }

        .control-left {
            width: -webkit-fill-available;
        }

        .search-product {
            width: -webkit-fill-available;
        }

        .control-right {
            display: flex;
            align-items: center;
        }

        .filters {
            padding: 1em;
            width: 18em;
            border-radius: 100px;
            background-color: #f8c32c;
            border: none;
            color: black;
        }

        @media (max-width: 991.98px) {
            .tf-shop-control {
                flex-wrap: wrap;
                gap: 15px;
            }

            .control-left {
                flex: 1 1 100%;
                width: 100% !important;
            }

            .search-product {
                width: 100% !important;
                margin-right: 0 !important;
            }

            .control-right {
                flex: 1 1 100%;
                width: 100%;
                justify-content: space-between;
            }

            .main-quote-section {
                margin-right: 10px !important;
            }
        }

        @media (max-width: 767.98px) {
            .tf-shop-control {
                flex-direction: column;
                gap: 12px;
            }

            .control-left {
                width: 100% !important;
            }

            .search-product {
                width: 100% !important;
                margin-right: 0 !important;
            }

            .control-right {
                width: 100%;
                flex-direction: column;
                gap: 10px;
            }

            .main-quote-section {
                width: 100%;
                margin-right: 0 !important;
            }

            .main-quote-section .tf-btn {
                width: 100%;
                justify-content: center;
            }

            .tf-control-sorting {
                width: 100%;
            }

            .tf-dropdown-sort {
                width: 100%;
            }

            .tf-btn.style-2 {
                width: 100%;
            }

            .dropdown-menu {
                width: 100%;
            }
        }


        @media (max-width: 575.98px) {
            .tf-shop-control {
                padding: 10px;
            }

            .form-search input {
                font-size: 13px;
                padding: 10px 45px 10px 15px;
            }

            .btn-search {
                padding: 8px 12px;
            }

            .tf-btn.btn-add-cart {
                font-size: 13px;
                padding: 10px 15px;
            }

            .tf-btn.style-2 {
                font-size: 13px;
                padding: 10px 15px;
            }
        }

        @media (max-width: 399.98px) {
            .form-search input {
                font-size: 12px;
                padding: 8px 40px 8px 12px;
            }

            .btn-search {
                padding: 6px 10px;
                font-size: 12px;
            }

            .tf-btn.btn-add-cart .text-style {
                font-size: 12px;
            }

            .tf-btn.style-2 .text-sort-value {
                font-size: 12px;
            }
        }
    </style>

    <!-- Main-content -->
    <div class="main-content page-shop-product pt-0">
        <div class="tf-container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="tf-sidebar">
                        <!-- Categories -->
                        <div class="sidebar-item sb-category">
                            <h5 class="sb-title">Categories</h5>
                            <div class="sb-content">
                                <ul class="category-list">
                                    <li class="item">
                                        <a href="{{ route('products.public.list', ['search' => request('search'), 'sort' => request('sort')]) }}"
                                            class="{{ !request('category') ? 'active-category' : '' }}">
                                            All Products
                                        </a>
                                    </li>
                                    @foreach ($categories as $category)
                                        <li class="item">
                                            <a href="{{ route('products.public.list', ['category' => $category->id, 'search' => request('search'), 'sort' => request('sort')]) }}"
                                                class="{{ request('category') == $category->id ? 'active-category' : '' }}">
                                                {{ $category->name }} ({{ $category->products_count }})
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Popular Products -->
                        <div class="sidebar-item sb-latest-new">
                            <h5 class="sb-title">Popular Products</h5>
                            <div class="sb-content sb-popular-product">
                                <ul class="latest-list style-2">
                                    @forelse ($popularProducts as $popularProduct)
                                        <li class="item img-hover">
                                            <div class="image hover-item">
                                                <a href="{{ route('products.show', $popularProduct->slug) }}">
                                                    <img src="{{ $popularProduct->images->first() ? asset('storage/' . $popularProduct->images->first()->image) : asset('assets/images/item/haagen.png') }}"
                                                        alt="{{ $popularProduct->name }}" style="height:6em;">
                                                </a>
                                            </div>
                                            <div class="content">
                                                <a href="{{ route('products.show', $popularProduct->slug) }}"
                                                    class="name font-worksans fw-5 hover-text-4">
                                                    {{ Str::limit($popularProduct->name, 40) }}
                                                </a>
                                                <div class="pricing-star">
                                                    <span class="price font-worksans fw-6">
                                                        PKR {{ number_format($popularProduct->price, 2) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </li>
                                    @empty
                                        <li class="item">
                                            <p class="text-muted">No popular products yet</p>
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Section -->
                <div class="col-lg-8">
                    <div class="tf-shop-control" id="tf-shop-control">
                        <!-- Search Bar -->
                        <div class="control-left" style="width: -webkit-fill-available;">
                            <div class="search-product me-4" style="width: -webkit-fill-available;">
                                <form action="{{ route('products.public.list') }}" method="GET"
                                    class="form-search style-1" id="searchForm">
                                    <input type="hidden" name="category" value="{{ request('category') }}"
                                        id="categoryInput">
                                    <input type="hidden" name="sort" value="{{ request('sort') }}" id="sortInput">
                                    <fieldset>
                                        <input type="text" name="search" id="searchInput"
                                            placeholder="Search Product..." value="{{ request('search') }}"
                                            autocomplete="off">
                                    </fieldset>
                                    <button type="submit" class="btn-search">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Quote Button & Sorting -->
                        <div class="control-right d-flex align-items-center">
                            <div class="wrap-quantity mb-0 main-quote-section me-4" style="display: none;">
                                <button type="button" class="tf-btn btn-add-cart" data-bs-toggle="modal"
                                    data-bs-target="#quoteModal">
                                    <span class="text-style">Request A Quote (<span id="selectedCount">0</span>)</span>
                                    <span class="icon"><i class="fa-solid fa-file-lines"></i></span>
                                </button>
                            </div>

                            <div class="tf-control-sorting">
                                <div class="tf-dropdown-sort">
                                    <div class="tf-btn style-2" data-bs-toggle="dropdown">
                                        <span class="text-sort-value">
                                            @switch(request('sort'))
                                                @case('popular')
                                                    Popular Products
                                                @break

                                                @default
                                                    Recent Products
                                            @endswitch
                                        </span>
                                        <i class="icon-arrow_down"></i>
                                    </div>
                                    <div class="dropdown-menu">
                                        <div class="select-item">
                                            <a href="{{ route('products.public.list', array_merge(request()->query(), ['sort' => 'recent'])) }}"
                                                class="select-item">
                                                <span class="text-value-item">Recent Products</span>
                                            </a>
                                        </div>
                                        <div class="select-item">
                                            <a href="{{ route('products.public.list', array_merge(request()->query(), ['sort' => 'popular'])) }}"
                                                class="select-item">
                                                <span class="text-value-item">Popular Products</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    <div class="wg-shop-content" id="productsContainer">
                        @if ($products->count() > 0)
                            <div class="grid-layout-3 gap-30-20" id="productGrid">
                                @foreach ($products as $product)
                                    <div class="card-product style-2 wow fadeInUp" data-wow-delay="0s">
                                        <button class="request-quote-btn" data-product-id="{{ $product->id }}"
                                            data-product-name="{{ $product->name }}"
                                            data-product-image="{{ $product->images->first() ? asset('storage/' . $product->images->first()->image) : asset('assets/images/item/haagen.png') }}"
                                            data-product-price="{{ $product->price }}">
                                            Request a Quote
                                        </button>

                                        <div class="image">
                                            <a href="{{ route('products.show', $product->slug) }}">
                                                <img src="{{ $product->images->first() ? asset('storage/' . $product->images->first()->image) : asset('assets/images/item/haagen.png') }}"
                                                    alt="{{ $product->name }}">
                                            </a>
                                        </div>

                                        <a href="{{ route('products.show', $product->slug) }}"
                                            class="name-product font-worksans hover-text-4">
                                            {{ $product->name }}
                                        </a>

                                        <div class="pricing-star">
                                            <div class="price-wrap">
                                                <span class="price-2">
                                                    @if ($product->price_display === 'hide')
                                                        {{-- Don't show anything --}}
                                                    @elseif ($product->price_display === 'call')
                                                        Email for Price
                                                    @else
                                                        {{-- 'price' or default - show price --}}
                                                        @if ($product->price)
                                                            PKR {{ number_format($product->price, 2) }}
                                                        @else
                                                            N/A
                                                        @endif
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="no-products-found">
                                <i class="fas fa-box-open"></i>
                                <h4>No Products Found</h4>
                                <p class="text-muted">Try adjusting your search or filter criteria</p>
                                <a href="{{ route('products.public.list') }}"
                                    class="btn btn-secondary filters mt-2 fs-5">
                                    Clear Filters
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Loading Spinner -->
                    <div id="loadingSpinner" class="text-center my-5" style="display: none;">
                        <div class="spinner-border text-success" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2 text-muted">Searching products...</p>
                    </div>

                    <!-- Pagination -->
                    <div id="paginationContainer">
                        @if ($products->hasPages())
                            <div class="d-flex justify-content-between align-items-center flex-wrap mt-4">
                                <!-- Results Count -->
                                <p class="font-worksans text-dark fw-5 mb-0">
                                    Showing {{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }}
                                    of {{ $products->total() }} results
                                </p>

                                <!-- Pagination -->
                                <div class="tf-page-pagination">
                                    <ul class="mb-0 d-flex align-items-center">

                                        {{-- Previous --}}
                                        @if ($products->onFirstPage())
                                            <li class="disabled">
                                                <a class="prev"><i class="fas fa-angle-double-left"></i></a>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ $products->appends(request()->query())->previousPageUrl() }}"
                                                    class="prev">
                                                    <i class="fas fa-angle-double-left"></i>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Page Numbers (Only 3) --}}
                                        @php
                                            $current = $products->currentPage();
                                            $last = $products->lastPage();
                                            $start = max(1, $current - 1);
                                            $end = min($last, $current + 1);
                                        @endphp

                                        @for ($page = $start; $page <= $end; $page++)
                                            <li>
                                                <a class="{{ $page == $current ? 'active' : '' }}"
                                                    href="{{ $products->appends(request()->query())->url($page) }}">
                                                    {{ $page }}
                                                </a>
                                            </li>
                                        @endfor

                                        {{-- Next --}}
                                        @if ($products->hasMorePages())
                                            <li>
                                                <a href="{{ $products->appends(request()->query())->nextPageUrl() }}"
                                                    class="next">
                                                    <i class="fas fa-angle-double-right"></i>
                                                </a>
                                            </li>
                                        @else
                                            <li class="disabled">
                                                <a class="next"><i class="fas fa-angle-double-right"></i></a>
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
    </div>

    <!-- Quotation Modal -->
    <div class="modal modalCentered fade modal-log" id="quoteModal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <span class="icon icon-close btn-hide-popup" data-bs-dismiss="modal"></span>
                <div class="modal-log-wrap list-file-delete">
                    <div class="box-title">
                        <h2 class="title fw-bold">Quotation Request</h2>
                        <p class="fw-normal font-nunito h6 fs-18 text-main">Request a quote for selected products</p>
                    </div>

                    <div class="selected-products-list mb-4">
                        <h6 class="mb-3">Selected Products:</h6>
                        <div id="selectedProductsList" class="list-group"></div>
                    </div>

                    <form id="quoteRequestForm" class="form-log">
                        @csrf
                        <div class="form-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset>
                                        <label for="customer_name" class="text-uppercase">Name *</label>
                                        <input type="text" name="customer_name" id="customer_name"
                                            placeholder="Enter Name" required>
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset>
                                        <label for="customer_phone" class="text-uppercase">Phone</label>
                                        <input type="tel" name="customer_phone" id="customer_phone"
                                            placeholder="Enter Phone Number">
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset>
                                        <label for="customer_email" class="text-uppercase">Email *</label>
                                        <input type="email" name="customer_email" id="customer_email"
                                            placeholder="Enter Email" required>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <fieldset>
                                        <label for="customer_message" class="text-uppercase">Message</label>
                                        <textarea name="customer_message" id="customer_message" placeholder="Additional information or requirements"
                                            rows="3">Hello,

I would like to request a quotation for the selected product(s).
Please provide pricing, availability, and any additional details at your earliest convenience.

Thank you.</textarea>
                                    </fieldset>
                                </div>
                            </div>
                        </div>

                        <div class="button-submit">
                            <button type="submit" class="tf-btn-nor w-100">
                                <span class="submit-text">Send Request</span>
                                <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // QUOTE MANAGEMENT SYSTEM
            let selectedProducts = [];
            const mainQuoteSection = document.querySelector('.main-quote-section');
            const selectedCountSpan = document.getElementById('selectedCount');
            const selectedProductsList = document.getElementById('selectedProductsList');
            const quoteForm = document.getElementById('quoteRequestForm');

            // Make this function global so search can access it
            window.initializeQuoteButtons = function() {
                const quoteButtons = document.querySelectorAll('.request-quote-btn');

                quoteButtons.forEach(button => {
                    // Remove existing listeners by cloning
                    const newButton = button.cloneNode(true);
                    button.parentNode.replaceChild(newButton, button);

                    const productId = newButton.getAttribute('data-product-id');
                    const isSelected = selectedProducts.some(p => p.id === productId);

                    if (isSelected) {
                        newButton.classList.add('selected');
                        newButton.textContent = 'Selected';
                    }

                    newButton.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        const productId = this.getAttribute('data-product-id');
                        const productName = this.getAttribute('data-product-name');
                        const productImage = this.getAttribute('data-product-image');
                        const productPrice = this.getAttribute('data-product-price');

                        this.classList.toggle('selected');

                        if (this.classList.contains('selected')) {
                            this.textContent = 'Selected';
                            selectedProducts.push({
                                id: productId,
                                name: productName,
                                image: productImage,
                                price: productPrice,
                                quantity: 1
                            });
                        } else {
                            this.textContent = 'Request a Quote';
                            selectedProducts = selectedProducts.filter(p => p.id !== productId);
                        }

                        updateMainQuoteButton();
                    });
                });
            };

            function updateSelectedProductsDisplay() {
                selectedProductsList.innerHTML = '';

                if (selectedProducts.length === 0) {
                    selectedProductsList.innerHTML = '<p class="text-muted">No products selected</p>';
                    return;
                }

                selectedProducts.forEach((product, index) => {
                    const productItem = document.createElement('div');
                    productItem.className = 'product-item';
                    productItem.innerHTML = `
                    <img src="${product.image}" alt="${product.name}">
                    <div class="product-item-info">
                        <div class="product-item-name">${product.name}</div>
                        <div class="product-item-price">PKR ${parseFloat(product.price).toLocaleString('en-PK', {minimumFractionDigits: 2})}</div>
                    </div>
                    <div class="product-item-quantity">
                        <label style="margin: 0; font-size: 12px;">Qty:</label>
                        <input type="number" class="quantity-input" data-index="${index}" value="${product.quantity}" min="1" max="1000">
                    </div>
                    <button type="button" class="product-item-remove ms-2" data-index="${index}">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                    selectedProductsList.appendChild(productItem);
                });

                document.querySelectorAll('.quantity-input').forEach(input => {
                    input.addEventListener('change', function() {
                        const index = parseInt(this.dataset.index);
                        const newQuantity = parseInt(this.value) || 1;
                        selectedProducts[index].quantity = newQuantity > 0 ? newQuantity : 1;
                        if (newQuantity <= 0) this.value = 1;
                    });
                });

                document.querySelectorAll('.product-item-remove').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const index = parseInt(this.dataset.index);
                        const productId = selectedProducts[index].id;
                        selectedProducts.splice(index, 1);
                        const button = document.querySelector(`[data-product-id="${productId}"]`);
                        if (button) {
                            button.classList.remove('selected');
                            button.textContent = 'Request a Quote';
                        }
                        updateSelectedProductsDisplay();
                        updateMainQuoteButton();
                    });
                });
            }

            function updateMainQuoteButton() {
                selectedCountSpan.textContent = selectedProducts.length;
                mainQuoteSection.style.display = selectedProducts.length > 0 ? 'block' : 'none';
            }

            // Initialize quote buttons on page load
            window.initializeQuoteButtons();

            document.getElementById('quoteModal').addEventListener('show.bs.modal', function() {
                updateSelectedProductsDisplay();
            });

            quoteForm.addEventListener('submit', function(e) {
                e.preventDefault();

                if (selectedProducts.length === 0) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'No Products Selected',
                            text: 'Please select at least one product to request a quote.',
                            confirmButtonColor: '#235130'
                        });
                    } else {
                        alert('Please select at least one product to request a quote.');
                    }
                    return;
                }

                const submitBtn = this.querySelector('button[type="submit"]');
                const submitText = submitBtn.querySelector('.submit-text');
                const spinner = submitBtn.querySelector('.spinner-border');

                submitBtn.disabled = true;
                submitText.classList.add('d-none');
                spinner.classList.remove('d-none');

                const formData = new FormData(this);
                selectedProducts.forEach(product => {
                    formData.append('products[]', product.id);
                    formData.append('quantities[]', product.quantity);
                });

                const totalQty = selectedProducts.reduce((sum, p) => sum + parseInt(p.quantity), 0);
                formData.set('total_quantity', totalQty);

                fetch('/quote-request', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        submitBtn.disabled = false;
                        submitText.classList.remove('d-none');
                        spinner.classList.add('d-none');

                        if (data.success) {
                            const msgBox = document.getElementById('msg');
                            msgBox.style.display = 'flex';
                            msgBox.style.right = '-400px';
                            msgBox.style.animation = 'slideInRight 0.5s forwards';
                            setTimeout(() => {
                                msgBox.style.animation = 'slideOutRight 0.5s forwards';
                                setTimeout(() => {
                                    msgBox.style.display = 'none';
                                }, 500);
                            }, 5000);

                            quoteForm.reset();
                            selectedProducts = [];
                            document.querySelectorAll('.request-quote-btn').forEach(btn => {
                                btn.classList.remove('selected');
                                btn.textContent = 'Request a Quote';
                            });
                            updateMainQuoteButton();
                            const modal = bootstrap.Modal.getInstance(document.getElementById(
                                'quoteModal'));
                            if (modal) modal.hide();
                        } else {
                            if (typeof Swal !== 'undefined') {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.message || 'Failed to submit quote request.',
                                    confirmButtonColor: '#235130'
                                });
                            } else {
                                alert(data.message || 'Failed to submit quote request.');
                            }
                        }
                    })
                    .catch(error => {
                        submitBtn.disabled = false;
                        submitText.classList.remove('d-none');
                        spinner.classList.add('d-none');
                        console.error('Error:', error);
                        alert('An error occurred. Please try again later.');
                    });
            });

            // REAL-TIME SEARCH FUNCTIONALITY
            const searchInput = document.getElementById('searchInput');
            const categoryInput = document.getElementById('categoryInput');
            const sortInput = document.getElementById('sortInput');
            const productsContainer = document.getElementById('productsContainer');
            const paginationContainer = document.getElementById('paginationContainer');
            const loadingSpinner = document.getElementById('loadingSpinner');

            let searchTimeout;
            const DEBOUNCE_DELAY = 500;

            // Real-time search on input
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                const searchValue = this.value.trim();

                searchTimeout = setTimeout(() => {
                    performSearch(searchValue);
                }, DEBOUNCE_DELAY);
            });

            // Main search function
            function performSearch(searchQuery, page = 1) {
                loadingSpinner.style.display = 'block';
                productsContainer.style.opacity = '0.5';

                const params = new URLSearchParams();
                if (searchQuery) params.append('search', searchQuery);
                if (categoryInput.value) params.append('category', categoryInput.value);
                if (sortInput.value) params.append('sort', sortInput.value);
                if (page > 1) params.append('page', page);

                fetch(`{{ route('products.public.list') }}?${params.toString()}`, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            productsContainer.innerHTML = data.html;
                            paginationContainer.innerHTML = data.pagination;

                            // Re-initialize quote buttons
                            window.initializeQuoteButtons();
                            attachPaginationHandlers();

                            // Update URL
                            const newUrl = `${window.location.pathname}?${params.toString()}`;
                            window.history.pushState({}, '', newUrl);

                            // Smooth scroll
                            document.getElementById('tf-shop-control').scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        } else {
                            throw new Error(data.message || 'Search failed');
                        }
                    })
                    .catch(error => {
                        console.error('Search error:', error);
                        productsContainer.innerHTML = `
                        <div class="no-products-found">
                            <i class="fas fa-exclamation-triangle"></i>
                            <h4>Error Loading Products</h4>
                            <p class="text-muted">${error.message || 'Please try again later'}</p>
                        </div>
                    `;
                    })
                    .finally(() => {
                        loadingSpinner.style.display = 'none';
                        productsContainer.style.opacity = '1';
                    });
            }

            // Pagination handlers
            function attachPaginationHandlers() {
                document.querySelectorAll('.pagination-link').forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        const page = this.getAttribute('data-page');
                        if (page) {
                            performSearch(searchInput.value, page);
                        }
                    });
                });
            }

            // Category filter
            document.querySelectorAll('.category-list .item a').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    document.querySelectorAll('.category-list .item a').forEach(a =>
                        a.classList.remove('active-category')
                    );
                    this.classList.add('active-category');

                    const url = new URL(this.href);
                    const categoryId = url.searchParams.get('category') || '';
                    categoryInput.value = categoryId;

                    performSearch(searchInput.value);
                });
            });

            // Sort dropdown
            document.querySelectorAll('.dropdown-menu .select-item a').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    const url = new URL(this.href);
                    const sortValue = url.searchParams.get('sort') || 'recent';
                    sortInput.value = sortValue;

                    const sortText = this.querySelector('.text-value-item').textContent;
                    document.querySelector('.text-sort-value').textContent = sortText;

                    performSearch(searchInput.value);
                });
            });

            // Initialize pagination on page load
            attachPaginationHandlers();
        });
    </script>
@endsection
