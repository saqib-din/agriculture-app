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
                            <p class="sub-title">Buy Health Foods At Our Store</p>
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
            /* start off-screen right */
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

        .success-icon,
        .error-icon {
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

        .error-icon svg {
            color: #dc3545;
            stroke: #dc3545;
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

        /* Error Message Styling */
        .error-message-box {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border-left: 5px solid #dc3545;
            padding: 20px 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 8px 20px rgba(245, 87, 108, 0.3);
            animation: slideDown 0.5s ease-out;
        }

        .error-content {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #ffffff;
        }

        .error-content strong {
            font-size: 18px;
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
        }

        .error-content p {
            margin: 0;
            font-size: 14px;
            opacity: 0.9;
            line-height: 1.5;
        }

        /* Slide in from right */
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

        /* Slide out to right */
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
    </style>
    <!-- Main-content -->
    <div class="main-content page-shop-product pt-0">
        <div class="tf-container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="tf-sidebar">
                        <div class="sidebar-item sb-category">
                            <h5 class="sb-title">Categories</h5>
                            <div class="sb-content">
                                <ul class="category-list">
                                    @foreach ($categories as $category)
                                        <li class="item">
                                            <a href="#tf-shop-control">
                                                {{ $category->name }} ({{ $category->products_count }})
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                        </div>
                        {{-- <div class="sidebar-item sb-latest-new">
                            <h5 class="sb-title">Popular Products</h5>
                            <div class="sb-content sb-popular-product">
                                <ul class="latest-list style-2">
                                    <li class="item img-hover">
                                        <div class="image hover-item">
                                            <img src="{{ asset('assets/images/widget/sb-new.jpg') }}" alt="">
                                        </div>
                                        <div class="content">
                                            <a href="#" class="name font-worksans fw-5 hover-text-4">
                                                Green organic mix smoothie for everyday
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div> --}}
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="tf-shop-control" id="tf-shop-control">
                        <div class="control-left">
                            <p class="font-worksans fw-5">
                                Showing {{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }} of
                                {{ $products->total() }} results
                            </p>
                        </div>
                        <div class="control-right d-flex align-items-center">
                            <div class="wrap-quantity mb-0 main-quote-section me-4" style="display: none;">
                                <button type="button" class="tf-btn btn-add-cart" data-bs-toggle="modal"
                                    data-bs-target="#quoteModal">
                                    <span class="text-style">Request A Quote (<span id="selectedCount">0</span>)</span>
                                    <span class="icon">
                                        <i class="fa-solid fa-file-lines"></i>
                                    </span>
                                </button>
                            </div>
                            <div class="tf-control-sorting">
                                <div class="tf-dropdown-sort">
                                    <div class="tf-btn style-2" data-bs-toggle="dropdown">
                                        <span class="text-sort-value">Default sorting</span>
                                        <i class="icon-arrow_down"></i>
                                    </div>
                                    <div class="dropdown-menu">
                                        <div class="select-item">
                                            <span class="text-value-item">New Post</span>
                                        </div>
                                        <div class="select-item">
                                            <span class="text-value-item">All Post</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wg-shop-content">
                        <div class="grid-layout-3 gap-30-20">
                            @foreach ($products as $product)
                                <div class="card-product style-2 wow fadeInUp" data-wow-delay="0s">
                                    <button class="request-quote-btn" data-product-id="{{ $product->id }}"
                                        data-product-name="{{ $product->name }}"
                                        data-product-image="{{ $product->images->first() ? asset('storage/' . $product->images->first()->image) : asset('assets/images/item/haagen.png') }}"
                                        data-product-price="{{ $product->price }}">
                                        Request a Quote
                                    </button>

                                    <div class="image">
                                        <img src="{{ $product->images->first()
                                            ? asset('storage/' . $product->images->first()->image)
                                            : asset('assets/images/item/haagen.png') }}"
                                            data-src="{{ $product->images->first()
                                                ? asset('storage/' . $product->images->first()->image)
                                                : asset('assets/images/item/haagen.png') }}"
                                            alt="{{ $product->name }}" class="lazyload" style="height:6em;">
                                    </div>

                                    <a href="{{ route('products.show', $product->slug) }}"
                                        class="name-product font-worksans hover-text-4">
                                        {{ $product->name }}
                                    </a>

                                    <div class="pricing-star">
                                        <div class="price-wrap">
                                            <span class="price-2">
                                                PKR {{ number_format($product->price, 2) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Pagination -->
                    @if ($products->hasPages())
                        <div class="tf-page-pagination">
                            <ul>
                                @if ($products->onFirstPage())
                                    <li class="disabled">
                                        <a class="prev"><i class="fas fa-angle-double-left"></i></a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ $products->previousPageUrl() }}" class="prev">
                                            <i class="fas fa-angle-double-left"></i>
                                        </a>
                                    </li>
                                @endif

                                @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                    <li>
                                        <a class="{{ $page == $products->currentPage() ? 'active' : '' }}"
                                            href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                @if ($products->hasMorePages())
                                    <li>
                                        <a href="{{ $products->nextPageUrl() }}" class="next">
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
                    @endif
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
                        <p class="fw-normal font-nunito h6 fs-18 text-main">
                            Request a quote for selected products
                        </p>
                    </div>

                    <!-- Selected Products List -->
                    <div class="selected-products-list mb-4">
                        <h6 class="mb-3">Selected Products:</h6>
                        <div id="selectedProductsList" class="list-group">
                            <!-- Products will be dynamically added here -->
                        </div>
                    </div>

                    <form id="quoteRequestForm" class="form-log">
                        @csrf
                        <div class="form-content">
                            <!-- Row 1: Name and Email -->
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

                            <!-- Row 2: Phone -->
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset>
                                        <label for="customer_email" class="text-uppercase">Email *</label>
                                        <input type="email" name="customer_email" id="customer_email"
                                            placeholder="Enter Email" required>
                                    </fieldset>
                                </div>
                            </div>

                            <!-- Row 3: Message -->
                            <div class="row">
                                <div class="col-12">
                                    <fieldset>
                                        <label for="customer_message" class="text-uppercase">Message</label>
                                        <textarea name="customer_message" id="customer_message" placeholder="Additional information or requirements"
                                            rows="3"></textarea>
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

    <style>
        .card-product {
            position: relative;
        }

        .card-product .image {
            position: relative;
            overflow: hidden;
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

        .request-quote-btn.selected:hover {
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
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quoteButtons = document.querySelectorAll('.request-quote-btn');
            const mainQuoteSection = document.querySelector('.main-quote-section');
            const quoteForm = document.getElementById('quoteRequestForm');
            const selectedProductsList = document.getElementById('selectedProductsList');
            const selectedCountSpan = document.getElementById('selectedCount');
            let selectedProducts = [];

            // Function to update selected products display
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
                            <input type="number" class="quantity-input" data-index="${index}" 
                                   value="${product.quantity}" min="1" max="1000">
                        </div>
                        <button type="button" class="product-item-remove ms-2" data-index="${index}">
                            <i class="fas fa-times"></i>
                        </button>
                    `;
                    selectedProductsList.appendChild(productItem);
                });

                // Add event listeners for quantity change
                document.querySelectorAll('.quantity-input').forEach(input => {
                    input.addEventListener('change', function() {
                        const index = parseInt(this.dataset.index);
                        const newQuantity = parseInt(this.value) || 1;
                        if (newQuantity > 0) {
                            selectedProducts[index].quantity = newQuantity;
                        } else {
                            this.value = 1;
                            selectedProducts[index].quantity = 1;
                        }
                    });
                });

                // Add event listeners for remove buttons
                document.querySelectorAll('.product-item-remove').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const index = parseInt(this.dataset.index);
                        const productId = selectedProducts[index].id;

                        // Remove from array
                        selectedProducts.splice(index, 1);

                        // Update button state
                        const button = document.querySelector(`[data-product-id="${productId}"]`);
                        if (button) {
                            button.classList.remove('selected');
                            button.textContent = 'Request a Quote';
                        }

                        // Update display
                        updateSelectedProductsDisplay();
                        updateMainQuoteButton();
                    });
                });
            }

            // Function to update main quote button
            function updateMainQuoteButton() {
                selectedCountSpan.textContent = selectedProducts.length;
                if (selectedProducts.length > 0) {
                    mainQuoteSection.style.display = 'block';
                } else {
                    mainQuoteSection.style.display = 'none';
                }
            }

            // Handle individual product selection
            quoteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
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

            // When modal opens, update the products list
            document.getElementById('quoteModal').addEventListener('show.bs.modal', function() {
                updateSelectedProductsDisplay();
            });

            // Handle form submission
            quoteForm.addEventListener('submit', function(e) {
                e.preventDefault();

                if (selectedProducts.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'No Products Selected',
                        text: 'Please select at least one product to request a quote.',
                        confirmButtonColor: '#235130'
                    });
                    return;
                }

                const submitBtn = this.querySelector('button[type="submit"]');
                const submitText = submitBtn.querySelector('.submit-text');
                const spinner = submitBtn.querySelector('.spinner-border');

                submitBtn.disabled = true;
                submitText.classList.add('d-none');
                spinner.classList.remove('d-none');

                const formData = new FormData(this);

                // Add selected products with quantities
                selectedProducts.forEach(product => {
                    formData.append('products[]', product.id);
                    formData.append('quantities[]', product.quantity);
                });

                // Calculate total quantity
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
                            // Show left-side slide-in message
                            showSuccessMessage();

                            // Reset form and selections
                            quoteForm.reset();
                            selectedProducts = [];

                            quoteButtons.forEach(btn => {
                                btn.classList.remove('selected');
                                btn.textContent = 'Request a Quote';
                            });

                            updateMainQuoteButton();

                            const modalElement = document.getElementById('quoteModal');
                            const modal = bootstrap.Modal.getInstance(modalElement);
                            if (modal) modal.hide();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message ||
                                    'Failed to submit quote request. Please try again.',
                                confirmButtonColor: '#235130'
                            });
                        }
                    })
                    .catch(error => {
                        submitBtn.disabled = false;
                        submitText.classList.remove('d-none');
                        spinner.classList.add('d-none');

                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred. Please try again later.',
                            confirmButtonColor: '#235130'
                        });
                    });
            });
        });

        function showSuccessMessage() {
            const msgBox = document.getElementById('msg');

            // Reset position and display
            msgBox.style.display = 'flex';
            msgBox.style.right = '-400px'; // start off-screen
            msgBox.style.animation = 'slideInRight 0.5s forwards';

            // Auto hide after 4 seconds
            setTimeout(() => {
                msgBox.style.animation = 'slideOutRight 0.5s forwards';
                setTimeout(() => {
                    msgBox.style.display = 'none';
                }, 500);
            }, 4000);
        }
    </script>
@endsection
